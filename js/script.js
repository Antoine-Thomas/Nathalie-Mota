jQuery(document).ready(function ($) {
    const menuToggle = $('.menu-toggle');
    const burgerMenuContainer = $('.burger-menu-container');
    const closeMenu = $('.close-menu');
    const body = $('body');
    const popupOverlay = $('.popup-overlay');
    const contactMenuLink = $('.open-popup');
    const popupCloseBtn = $('.close-popup');
    const dropdowns = document.querySelectorAll('.custom-dropdown');
    const ajaxUrl = nmAjax.ajaxUrl;

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

    $(document).ready(function() {
        let page = 1;
        const photosPerPage = 8;
        const maxPhotos = 1000; // Définir le nombre maximum de photos à charger
        let endOfResultsShown = false; // Nouvelle variable pour suivre l'affichage du message
    
        // Fonction pour charger les photos en fonction de la sélection
        function loadPhotosBySelection() {
            page = 1; // Réinitialiser la page à 1 lors de la sélection des filtres
            const categorieId = $('#categorie_id').val();
            const formatId = $('#format_id').val();
            const dateOrder = $('#date').val() || "ASC";
    
            const args = {
                action: 'load_photos_by_selection',
                date_order: dateOrder.toUpperCase(),
                page: page,
                photos_per_page: photosPerPage
            };
    
            if (categorieId && categorieId !== 'categories') {
                args.categorie_id = categorieId;
            }
    
            if (formatId && formatId !== 'formats') {
                args.format_id = formatId;
            }
    
            if (dateOrder !== 'trier_par') {
                args.date_order = dateOrder.toUpperCase();
            }
    
            $.ajax({
                type: 'POST',
                url: ajaxUrl,
                data: args,
                success: function(response) {
                    $('.photo-grid-container').html(response);
                    applyLightboxEffect(); // Appliquer l'effet de lightbox après le chargement
                    initializeFeatures(); // Réinitialiser les fonctionnalités après chargement
                },
                error: function(response) {
                    console.error('Erreur:', response);
                }
            });
        }
    
        function loadMorePhotos() {
            const categorieId = $('#categorie_id').val();
            const formatId = $('#format_id').val();
            const dateOrder = $('#date').val() || "ASC";
    
            page++; // Incrémente la page pour charger la suivante
    
            const args = {
                action: 'load_more_photos',
                page: page,
                photos_per_page: photosPerPage,
                date_order: dateOrder.toUpperCase()
            };
    
            if (categorieId && categorieId !== 'categories') {
                args.categorie_id = categorieId;
            }
    
            if (formatId && formatId !== 'formats') {
                args.format_id = formatId;
            }
    
            $.ajax({
                url: ajaxUrl,
                type: 'POST',
                data: args,
                success: function(response) {
                    if (response.trim() !== '') {
                        $('.photo-grid').append(response);
                        applyLightboxEffect(); // Appliquer l'effet de lightbox pour les nouvelles photos
    
                        // Vérifier si le nombre maximum de photos est atteint
                        const totalPhotosLoaded = $('.photo-item').length;
                        if (totalPhotosLoaded >= maxPhotos && !endOfResultsShown) {
                            showEndOfResultsMessage();
                            endOfResultsShown = true; // Marquer que le message a été affiché
                            $('#load-more').off('click'); // Supprimer l'événement de clic sur le bouton
                        }
                    } else if (!endOfResultsShown) {
                        showEndOfResultsMessage();
                        endOfResultsShown = true; // Marquer que le message a été affiché
                        $('#load-more').off('click'); // Supprimer l'événement de clic sur le bouton
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                    console.log(xhr.responseText);
                }
            });
        }
    
        // Fonction pour afficher un message de fin des résultats
        function showEndOfResultsMessage() {
            $('#load-more')
                .prop('disabled', true)
                .text('Vous avez atteint la fin des résultats');
        }
    
        // Fonction pour initialiser les fonctionnalités
        function initializeFeatures() {
            // Réinitialiser les événements de clic pour les lightboxes
            $('.lightbox-icon.fullscreen-icon').off('click').on('click', function(e) {
                e.preventDefault();
                // Code pour afficher l'image en plein écran
            });
    
            // Réinitialiser les événements des dropboxes
            $('.custom-dropdown .list_items_filter .list_item').off('click').on('click', function() {
                const $dropdown = $(this).closest('.custom-dropdown');
                const $selectedValue = $dropdown.find('.selected-value');
                const $hiddenInput = $dropdown.find('input[type="hidden"]');
    
                const selectedValue = $(this).data('value');
                $selectedValue.text($(this).text());
                $hiddenInput.val(selectedValue);
    
                loadPhotosBySelection();
            });
    
            // Réinitialiser le bouton Load More
            $('#load-more').off('click').on('click', loadMorePhotos).prop('disabled', false).text('Charger plus');
        }
    
        // Initialiser les événements des dropboxes et charger les photos initiales
        initializeFeatures();
        loadPhotosBySelection(); // Charger les photos initiales
    });

    
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

// dropdown

    dropdowns.forEach(function(dropdown) {
        const titleBox = dropdown.querySelector('.title_filter_box');
        const optionsList = dropdown.querySelector('.list_items_filter');
        const iconSpan = titleBox.querySelector('.span_icon_filter');
        const hiddenInput = dropdown.querySelector('input[type="hidden"]');
    
        // Gestion de l'ouverture/fermeture de la liste au clic
        titleBox.addEventListener('click', function() {
            optionsList.classList.toggle('menu_open');
            iconSpan.classList.toggle('span_icon_filter_rotate');
        });
    
        // Gestion de la sélection d'une option
        const listItems = optionsList.querySelectorAll('.list_item');
        listItems.forEach(function(item) {
            item.addEventListener('click', function() {
                const selectedValue = item.textContent;
                const selectedDataValue = item.getAttribute('data-value');
    
                // Supprimer la classe .list_item_selected des éléments précédemment sélectionnés
                optionsList.querySelectorAll('.list_item_selected').forEach(function(item) {
                    item.classList.remove('list_item_selected');
                });
    
                // Ajouter la classe .list_item_selected à l'élément cliqué
                item.classList.add('list_item_selected');
    
                // Mettre à jour la valeur sélectionnée dans le titre
                titleBox.querySelector('.selected-value').textContent = selectedValue;
    
                // Mettre à jour la valeur du champ caché avec l'ID sélectionné
                hiddenInput.value = selectedDataValue;
    
                // Fermer la liste déroulante après la sélection
                optionsList.classList.remove('menu_open');
                iconSpan.classList.remove('span_icon_filter_rotate');
            });
        });
    });

// Ajout de l'écouteur d'événement passif
    document.addEventListener('touchstart', function() {}, { passive: true });
});