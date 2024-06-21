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

    // Module de gestion du menu burger
    function toggleBurgerMenu() {
        menuToggle.toggleClass('active');
        burgerMenuContainer.toggleClass('active');
        unScroll();
    }

    function unScroll() {
        body.css('overflow', burgerMenuContainer.hasClass('active') ? 'hidden' : 'auto');
    }

    menuToggle.on('click', toggleBurgerMenu);
    closeMenu.on('click', toggleBurgerMenu);

    // Fonction pour extraire la référence de la photo
    function getPhotoReference() {
        return $('.reference').text().replace('Référence : ', '').trim();
    }





  // Fonction pour basculer l'affichage de la popup de contact
function toggleContactPopup(event) {
    event.preventDefault();

    const photoReference = getPhotoReference();
    const referenceField = $('input[name="reference"]');
    if (referenceField.length && photoReference) {
        referenceField.val(photoReference);
    }

    popupOverlay.toggleClass('hidden visible');
}

// Écouteur de clic sur le lien de contact
contactMenuLink.on('click', toggleContactPopup);

// Écouteur de clic sur le burger menu
burgerMenuContainer.on('click', function(event) {
    if ($(event.target).hasClass('open-popup')) {
        toggleContactPopup(event);
    } else {
        // Fermer la popup si nécessaire lors du clic sur le burger menu
        popupOverlay.addClass('hidden').removeClass('visible');
    }
});

// Écouteur de clic sur le bouton de fermeture de la popup
popupCloseBtn.on('click', function() {
    popupOverlay.addClass('hidden').removeClass('visible');
});

// Écouteur de clic sur l'overlay de la popup pour la fermer
popupOverlay.on('click', function(event) {
    if ($(event.target).is(popupOverlay)) {
        popupOverlay.addClass('hidden').removeClass('visible');
    }
});

    
// Fonction pour ouvrir/fermer la popup de contact
function toggleContactPopup() {
    const popupOverlay = $('.popup-overlay');
    popupOverlay.toggleClass('hidden'); // Toggle la classe hidden
}

// Écouteur d'événement pour le clic sur le lien de contact
$('.contact-menu-link').on('click', function(event) {
    event.preventDefault();
    toggleContactPopup();
});

// Écouteur d'événement pour le clic sur le menu burger
$('.burger-menu-container').on('click', function(event) {
    if ($(event.target).hasClass('open-popup')) {
        toggleContactPopup();
    } else {
        // Fermer le popup si nécessaire lors du clic sur une autre partie du burger menu
        $('.popup-overlay').addClass('hidden');
    }
});

// Écouteur d'événement pour le clic sur le bouton de fermeture de la popup
$('.popup-close-btn').on('click', function() {
    $('.popup-overlay').addClass('hidden');
});

// Écouteur d'événement pour fermer la popup en cliquant en dehors de celle-ci
$('.popup-overlay').on('click', function(event) {
    if ($(event.target).is('.popup-overlay')) {
        $('.popup-overlay').addClass('hidden');
    }
});






    // Module de chargement des photos
    function loadPhotosBySelection() {
        const categorieId = $('#categorie_id').val();
        const formatId = $('#format_id').val();
        const dateOrder = $('#date').val() || "ASC";

        const args = {
            action: 'load_photos_by_selection',
            date_order: dateOrder.toUpperCase() 
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
                applyLightboxEffect();
            },
            error: function (response) {
                console.error('Erreur:', response);
            }
        });
    }

    function loadMorePhotos() {
        const categorieId = $('#categorie_id').val();
        const formatId = $('#format_id').val();
        const dateOrder = $('#date').val() || "ASC";
    
        page++; // Incrémente la page pour charger la suivante
        console.log(page)
        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: {
                action: 'load_more_photos',
                page: page,
                photos_per_page: 8, // Nombre de photos à charger par page
                categorie_id: categorieId,
                format_id: formatId,
                date_order: dateOrder.toUpperCase()
                    
                
        
            },
            success: function (response) {
                if (response) {
                    $('.photo-grid').append(response);
                    // Vérifie si le nombre de nouvelles photos chargées est inférieur à 9
                    if ($(response).find('.photo-item').length < 8) {
                        showEndOfResultsMessage(); // Affiche un message à l'utilisateur
                    }
                } else {
                    showEndOfResultsMessage(); // Affiche un message à l'utilisateur
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', status, error);
                console.log(xhr.responseText);
            }
        });
    }
    

    function showEndOfResultsMessage() {
        $('#load-more')
            .prop('disabled', true)
            .text('Vous avez atteint la fin des résultats');
    }

    $('#load-more').on('click', loadMorePhotos);
    $('#categorie_id, #format_id, #date').on('change', loadPhotosBySelection);
    loadPhotosBySelection(); // Charge les photos initiales

    // Module de gestion de l'effet de lightbox
    function applyLightboxEffect() {
        $('.photo-thumbnail').hover(
            function () {
                $(this).find('.lightbox').fadeIn(300);
            },
            function () {
                $(this).find('.lightbox').fadeOut(300);
            }
        );
    }

    // Appeler la fonction pour appliquer l'effet de lightbox
    applyLightboxEffect();

   // Module de navigation entre les pages
function updatePreviewImage() {
    const rightArrow = $('.right-arrow');
    const nextPageUrl = rightArrow.data('next-page-url');
    const previewImage = $('.next-page-preview .preview-image');

    if (nextPageUrl) {
        $.ajax({
            url: nextPageUrl,
            method: 'GET',
            success: function(data) {
                const $pageContent = $(data);
                const nextImageUrl = $pageContent.find('.photo-display img').attr('src');
                if (nextImageUrl) {
                    previewImage.attr('src', nextImageUrl);
                } else {
                    previewImage.attr('src', ''); // Réinitialiser l'aperçu de l'image s'il n'y a pas d'image trouvée
                }
            },
            error: function(_xhr, _status, _error) {
                previewImage.attr('src', ''); // Réinitialiser l'aperçu de l'image en cas d'erreur
            }
        });
    } else {
        // Si nextPageUrl n'est pas défini, vérifier si rightArrow existe
        if (rightArrow.length > 0) {
            previewImage.attr('src', ''); // Réinitialiser l'aperçu de l'image
        } else {
            // Sinon, ne rien faire (dernière page)
        }
    }
}


    $('.left-arrow').on('click', function (event) {
        event.preventDefault();
        const prevPageUrl = $(this).data('prev-page-url');
        if (prevPageUrl) {
            window.location.href = prevPageUrl;
        }
    });

    $('.right-arrow').on('click', function (event) {
        event.preventDefault();
        const nextPageUrl = $(this).data('next-page-url');
        if (nextPageUrl) {
            window.location.href = nextPageUrl;
        }
    });

    updatePreviewImage();

    // Ajout de l'écouteur d'événement passif
    document.addEventListener('touchstart', function() {}, { passive: true });
});






