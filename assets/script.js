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


 

    function loadPhotosBySelection() {
        const categorieId = $('#categorie_id').val();
        const formatId = $('#format_id').val();
        const dateOrder = $('#date').val();

        console.log('Catégorie sélectionnée:', categorieId);
        console.log('Format sélectionné:', formatId);
        console.log('Tri sélectionné:', dateOrder);

        // Construction de la requête WP_Query en fonction des options sélectionnées
        const args = {
            action: 'load_photos_by_selection',
            date_order: (dateOrder === 'asc') ? 'DESC' : 'ASC'
        };

        if (categorieId !== '') {
            args.categorie_id = categorieId;
        }

        if (formatId !== '') {
            args.format_id = formatId;
        }

        $.ajax({
            type: 'POST',
            url: ajaxUrl,
            data: args,
            success: function(response) {
                $('.photo-grid-container').html(response);
                console.log('Réponse réussie:', response);
                applyLightboxEffect(); // Appliquer l'effet de la lightbox après chargement
            },
            error: function(response) {
                console.error('Erreur:', response);
            }
        });
    }

    // Écouteurs d'événements pour les dropdowns
    $('#categorie_id, #format_id, #date').on('change', loadPhotosBySelection);

    // Appeler la fonction au chargement initial
    loadPhotosBySelection();

    function loadMorePhotos() {
        const categorieId = $('#categorie_id').val();
        const formatId = $('#format_id').val();
        const dateOrder = $('#date').val();
    
        page++; // Incrémente la variable page
        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: {
                action: 'load_more_photos',
                page: page,
                photos_per_page: 8, // Charger 8 photos supplémentaires à chaque fois
                categorie_id: categorieId,
                format_id: formatId,
                date_order: dateOrder
            },
            success: function (response) {
                if (response) {
                    $('.photo-grid').append(response);
                    if ($(response).length < 8) { // Vérifie si moins de 8 photos ont été chargées
                        $('#load-more').prop('disabled', true).text('Toutes les photos sont chargées'); // Désactive le bouton et change son texte
                    }
                } else {
                    $('#load-more').prop('disabled', true).text('Toutes les photos sont chargées'); // Désactive le bouton et change son texte
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', status, error);
                console.log(xhr.responseText);
            }
        });
    }
    
    
    
    
    

    // Écouteur d'événement pour le bouton "load-more"
    $('#load-more').on('click', loadMorePhotos);

    // Fonction pour appliquer l'effet de la lightbox
    function applyLightboxEffect() {
        $('.photo-thumbnail').hover(function () {
            $(this).find('.lightbox').fadeIn(300);
        }, function () {
            $(this).find('.lightbox').fadeOut(300);
        });
    }


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





