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

    // Module de gestion de la popup de contact
    function toggleContactPopup(event) {
        event.preventDefault();
        
        // Récupérer la référence de la photo
        const photoReference = getPhotoReference();
        
        // Insérer la référence dans le champ "subject" du formulaire de contact
        const referenceField = $('input[name="reference"]');
        if (referenceField.length && photoReference) {
            referenceField.val(photoReference);
        }
        
        // Afficher ou masquer la popup
        popupOverlay.toggleClass('hidden');
    }

    contactMenuLink.on('click', toggleContactPopup);
    burgerMenuContainer.on('click', function(event) {
        if ($(event.target).hasClass('open-popup')) {
            toggleContactPopup(event);
        }
    });

    popupCloseBtn.on('click', function() {
        popupOverlay.addClass('hidden');
    });

    popupOverlay.on('click', function(event) {
        if ($(event.target).is(popupOverlay)) {
            popupOverlay.addClass('hidden');
        }
    });

    // Module de chargement des photos
    function loadPhotosBySelection() {
        const categorieId = $('#categorie_id').val();
        const formatId = $('#format_id').val();
        const dateOrder = $('#date').val();

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
        const dateOrder = $('#date').val();

        page++;
        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: {
                action: 'load_more_photos',
                page: page,
                photos_per_page: 8,
                categorie_id: categorieId,
                format_id: formatId,
                date_order: dateOrder
            },
            success: function (response) {
                if (response) {
                    $('.photo-grid').append(response);
                    if ($(response).length < 8) {
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
        const nextPageUrl = $('.right-arrow').data('next-page-url');
        if (nextPageUrl) {
            $.ajax({
                url: nextPageUrl,
                method: 'GET',
                success: function (data) {
                    const $pageContent = $(data);
                    const nextImageUrl = $pageContent.find('.photo-display img').attr('src');
                    if (nextImageUrl) {
                        $('.next-page-preview .preview-image').attr('src', nextImageUrl);
                    } else {
                        $('.next-page-preview .preview-image').attr('src', '');
                        console.log("Aucune image trouvée sur la page suivante");
                    }
                },
                error: function (_xhr, status, error) {
                    console.log("Erreur lors de la récupération de la page suivante: ", status, error);
                }
            });
        } else {
            console.log("Aucune URL de page suivante n'a été trouvée");
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
});






