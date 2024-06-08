jQuery(document).ready(function ($) {
    const menuToggle = $('.menu-toggle');
    const burgerMenuContainer = $('.burger-menu-container');
    const closeMenu = $('.close-menu');
    const body = $('body');
    const popupOverlay = $('.popup-overlay');
    const contactMenuLink = $('.open-popup');
    const popupCloseBtn = $('.close-popup');
    const ajaxUrl = nmAjax.ajaxUrl;
    let page = 1;
    const photosPerPage = 8;

    function unScroll() {
        body.css('overflow', burgerMenuContainer.hasClass('active') ? 'hidden' : 'auto');
    }

    menuToggle.on('click', () => {
        menuToggle.toggleClass('active');
        burgerMenuContainer.toggleClass('active');
        unScroll();
    });

    closeMenu.on('click', () => {
        menuToggle.removeClass('active');
        burgerMenuContainer.removeClass('active');
        unScroll();
    });

    contactMenuLink.on('click', function (event) {
        event.preventDefault();
        popupOverlay.removeClass('hidden');
    });

    burgerMenuContainer.on('click', function (event) {
        if ($(event.target).hasClass('open-popup')) {
            event.preventDefault();
            popupOverlay.removeClass('hidden');
        }
    });

    popupCloseBtn.on('click', function () {
        popupOverlay.addClass('hidden');
    });

    popupOverlay.on('click', function (event) {
        if ($(event.target).is(popupOverlay)) {
            popupOverlay.addClass('hidden');
        }
    });

    function loadMorePhotos() {
        const categorieId = $('#categorie_id').val();
        const formatId = $('#format_id').val();
        const dateOrder = $('#date').val();

        console.log('Load more photos clicked');
        page++;
        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: {
                action: 'load_more_photos',
                page: page,
                photos_per_page: photosPerPage,
                categorie_id: categorieId,
                format_id: formatId,
                date_order: dateOrder
            },
            success: function (response) {
                if (response) {
                    $('.photo-grid').append(response);
                    if ($(response).length < photosPerPage) {
                        $('#load-more').hide(); // Cache le bouton si moins de photos sont retournées
                    }
                } else {
                    $('#load-more-container').hide();
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', status, error);
                console.log(xhr.responseText);
            }
        });
    }

    function loadPhotosBySelection() {
        const categorieId = $('#categorie_id').val();
        const formatId = $('#format_id').val();
        const dateOrder = $('#date').val();

        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: {
                action: 'load_photos_by_selection',
                categorie_id: categorieId,
                format_id: formatId,
                date_order: dateOrder
            },
            success: function (response) {
                $('.photo-grid').empty().append(response); // Remplace les photos actuelles par les nouvelles
                page = 1; // Réinitialise la page pour le chargement plus
                if ($(response).length < photosPerPage) {
                    $('#load-more').hide(); // Cache le bouton si moins de photos sont retournées
                } else {
                    $('#load-more').show(); // Montre le bouton si suffisamment de photos sont retournées
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', status, error);
                console.log(xhr.responseText);
            }
        });
    }

    // Écouteurs d'événements pour les dropdowns
    $('#categorie_id, #format_id, #date').on('change', loadPhotosBySelection);

    $('#load-more').on('click', loadMorePhotos);

    // Event listeners for filters
    $('#categorie_id').on('change', function () {
        console.log('Catégorie sélectionnée:', this.value);
    });

    $('#format_id').on('change', function () {
        console.log('Format sélectionné:', this.value);
    });

    $('#date').on('change', function () {
        console.log('Tri sélectionné:', this.value);
    });

    // Ajouter l'effet de lightbox pour les nouvelles photos chargées
    function applyLightboxEffect() {
        $('.photo-thumbnail').hover(function () {
            $(this).find('.lightbox').fadeIn(300);
        }, function () {
            $(this).find('.lightbox').fadeOut(300);
        });
    }

    // Appelle cette fonction après le chargement Ajax
    $(document).ajaxComplete(function () {
        applyLightboxEffect();
    });

    // Appelle la fonction au chargement initial
    applyLightboxEffect();

// Ajouter l'effet de lightbox pour les nouvelles photos chargées
function applyLightboxEffect() {
    $('.photo-thumbnail').hover(function() {
        $(this).find('.lightbox').fadeIn(300);
    }, function() {
        $(this).find('.lightbox').fadeOut(300);
    });
}

// Appelle cette fonction après le chargement Ajax
$(document).ajaxComplete(function() {
    applyLightboxEffect();
});

// Appelle la fonction au chargement initial
applyLightboxEffect();

jQuery(document).ready(function($) {
    var currentIndex = 0;

    // Open the modal
    $(document).on('click', '.fullscreen-icon', function(e) {
        e.preventDefault();
        var photo_id = $(this).data('id');
        var clickedIndex = $(this).index('.fullscreen-icon'); // Trouver l'index de la photo cliquée
    
        $.ajax({
            url: nmAjax.ajaxUrl,
            method: 'POST',
            data: {
                action: 'load_photo_carousel',
                photo_id: photo_id
            },
            success: function(response) {
                var photos = JSON.parse(response).photos;
                if (photos.length > 0) {
                    var modal = '<div class="carousel-modal">' +
                                    '<span class="carousel-close">&times;</span>' +
                                    '<div class="carousel-content">';
                                    photos.forEach(function(photo) {
                                        var orientationClass = (photo.width > photo.height) ? 'paysage' : 'portrait'; // Déterminer la classe d'orientation en fonction des dimensions de la photo
                                        modal += '<img class="carousel-image ' + orientationClass + '" src="' + photo.url + '" alt="' + photo.title + '">';
                                    });
                                    
                    modal += '</div>' +
                             '<a class="carousel-prev">&#10094;</a>' +
                             '<a class="carousel-next">&#10095;</a>' +
                             '</div>';
                    $('body').append(modal);
                    $('.carousel-modal').fadeIn();
    
                    var totalPhotos = photos.length;
                    var currentIndex = clickedIndex; // Définir l'index actuel sur celui de la photo cliquée
    
                    showSlide(currentIndex);
                    
                    $(document).on('click', '.carousel-image', function() {
                        $('.carousel-modal').fadeOut(function() {
                            $(this).remove();
                        });
                    });
                    
                    function showSlide(index) {
                        var slides = $('.carousel-image');
                        if (index >= totalPhotos) {
                            currentIndex = 0;
                        }
                        if (index < 0) {
                            currentIndex = totalPhotos - 1;
                        }
                        slides.hide();
                        slides.eq(currentIndex).show();
                    }
    
                    $('.carousel-next').on('click', function() {
                        showSlide(++currentIndex);
                    });
    
                    $('.carousel-prev').on('click', function() {
                        showSlide(--currentIndex);
                    });
    
                    $('.carousel-close').on('click', function() {
                        $('.carousel-modal').fadeOut(function() {
                            $(this).remove();
                        });
                    });
                }
            }
        });
    });
    
});

});



