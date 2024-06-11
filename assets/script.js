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
  
  
   // load photos 
   
    function loadPhotosBySelection() {
        const categorieId = $('#categorie_id').val();
        const formatId = $('#format_id').val();
        const dateOrder = $('#date').val();
    
        console.log('Catégorie sélectionnée:', categorieId);
        console.log('Format sélectionné:', formatId);
        console.log('Tri sélectionné:', dateOrder);
    
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
            success: function (response) {
                $('.photo-grid-container').html(response);
                console.log('Réponse réussie:', response);
                applyLightboxEffect();
            },
            error: function (response) {
                console.error('Erreur:', response);
            }
        });
    }
    // Écouteur d'événement pour le bouton "load-more"
    $('#load-more').on('click', loadMorePhotos);

    // Écouteurs d'événements pour les dropdownboxs
    $('#categorie_id, #format_id, #date').on('change', loadPhotosBySelection);

    
     
    // bouton load more photos par selections
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

   

    // Fonction pour appliquer l'effet de la lightbox // Navigation entre les pages
    function applyLightboxEffect() {
        $('.photo-thumbnail').hover(function () {
            $(this).find('.lightbox').fadeIn(300);
        }, function () {
            $(this).find('.lightbox').fadeOut(300);
        });
    }

function loadPage(pageUrl) {
    window.location.href = pageUrl;
}

function updatePreviewImage() {
    var nextPageUrl = $('.right-arrow').data('next-page-url');
    if (nextPageUrl) {
        $.ajax({
            url: nextPageUrl,
            method: 'GET',
            success: function(data) {
                var $pageContent = $(data);
                var nextImageUrl = $pageContent.find('.photo-display img').attr('src');
                console.log("Next image URL: ", nextImageUrl);
                if (nextImageUrl) {
                    $('.next-page-preview .preview-image').attr('src', nextImageUrl);
                } else {
                    $('.next-page-preview .preview-image').attr('src', ''); // Reset if no image found
                    console.log("No image found in the next page");
                }
            },
            error: function(xhr, status, error) {
                console.log("Error fetching next page: ", status, error);
            }
        });
    } else {
        console.log("No next page URL found");
    }
}
// URL de la page suivante
var nextPageUrl = $('.navigation-arrow.right-arrow').data('next-page-url');
console.log("Next page URL: ", nextPageUrl);

if (nextPageUrl && nextPageUrl !== '#') {
    updatePreviewImage(nextPageUrl);
} else {
    console.log("Next page URL is not valid");
}




// Navigation entre les pages minimod en cliquant sur les flèches
$('.left-arrow').on('click', function (event) {
    event.preventDefault();
    const prevPageUrl = $(this).data('prev-page-url');
    if (prevPageUrl) {
        loadPage(prevPageUrl);
    }
});

$('.right-arrow').on('click', function (event) {
    event.preventDefault();
    const nextPageUrl = $(this).data('next-page-url');
    if (nextPageUrl) {
        loadPage(nextPageUrl);
    }
});

// Mettre à jour l'image de prévisualisation lors du chargement initial de la page
$(document).ready(function() {
    updatePreviewImage(window.location.href);
});






    
    
});





