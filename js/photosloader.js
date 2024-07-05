(function($) {
    // Déclaration de la variable ajaxUrl en utilisant nmAjax.ajaxUrl défini par wp_localize_script
    const ajaxUrl = nmAjax.ajaxUrl;
    // Initialisation des variables de pagination et de chargement des photos
    let page = 1; // Page de pagination initiale
    const photosPerPage = 8; // Nombre de photos par page à charger
    const maxPhotos = 1000; // Nombre maximum de photos à charger avant d'afficher un message de fin de résultats
    let endOfResultsShown = false; // Indicateur pour savoir si le message de fin de résultats a déjà été affiché

    // Fonction pour charger les photos en fonction des sélections de catégorie, format et ordre de date
    function loadPhotosBySelection() {
        // Réinitialisation de la page à la première page
        page = 1;
        // Récupération des valeurs sélectionnées pour catégorie, format et ordre de date
        const categorieId = $('#categorie_id').val();
        const formatId = $('#format_id').val();
        const dateOrder = $('#date').val() || "ASC"; // Par défaut, ordre ascendant si aucune valeur sélectionnée

        // Paramètres de la requête AJAX
        const args = {
            action: 'load_photos_by_selection',
            date_order: dateOrder.toUpperCase(), // Conversion en majuscules de l'ordre de date
            page: page,
            photos_per_page: photosPerPage
        };

        // Ajout des paramètres optionnels (catégorie et format) à la requête s'ils sont sélectionnés
        if (categorieId && categorieId !== 'categories') {
            args.categorie_id = categorieId;
        }

        if (formatId && formatId !== 'formats') {
            args.format_id = formatId;
        }

        // Requête AJAX pour charger les photos
        $.ajax({
            type: 'POST',
            url: ajaxUrl,
            data: args,
            success: function(response) {
                // Insertion du contenu de réponse dans le conteneur des grilles de photos
                $('.photo-grid-container').html(response);
                // Initialisation des fonctionnalités comme la lightbox après chargement des nouvelles photos
                applyLightboxEffect();
                initializeFeatures();
            },
            error: function(response) {
                console.error('Erreur:', response);
            }
        });
    }

    // Fonction pour charger plus de photos (pagination)
    function loadMorePhotos() {
        // Récupération des valeurs actuelles de catégorie, format et ordre de date
        const categorieId = $('#categorie_id').val();
        const formatId = $('#format_id').val();
        const dateOrder = $('#date').val() || "ASC";

        // Incrémentation de la page pour charger la page suivante
        page++;

        // Paramètres de la requête AJAX pour charger plus de photos
        const args = {
            action: 'load_more_photos',
            page: page,
            photos_per_page: photosPerPage,
            date_order: dateOrder.toUpperCase()
        };

        // Ajout des paramètres optionnels (catégorie et format) à la requête s'ils sont sélectionnés
        if (categorieId && categorieId !== 'categories') {
            args.categorie_id = categorieId;
        }

        if (formatId && formatId !== 'formats') {
            args.format_id = formatId;
        }

        // Requête AJAX pour charger plus de photos
        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: args,
            success: function(response) {
                if (response.trim() !== '') {
                    // Ajout du contenu de réponse à la grille existante des photos
                    $('.photo-grid').append(response);
                    // Réappliquer l'effet de lightbox aux nouvelles photos chargées
                    applyLightboxEffect();

                    // Vérification si le nombre total de photos chargées atteint ou dépasse maxPhotos
                    const totalPhotosLoaded = $('.photo-item').length;
                    if (totalPhotosLoaded >= maxPhotos && !endOfResultsShown) {
                        // Affichage du message de fin des résultats une fois le maximum atteint
                        showEndOfResultsMessage();
                        endOfResultsShown = true;
                        $('#load-more').off('click'); // Désactivation du bouton "Charger plus"
                    }
                } else if (!endOfResultsShown) {
                    // Affichage du message de fin des résultats si la réponse est vide
                    showEndOfResultsMessage();
                    endOfResultsShown = true;
                    $('#load-more').off('click'); // Désactivation du bouton "Charger plus"
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
                console.log(xhr.responseText);
            }
        });
    }

    // Fonction pour afficher le message de fin des résultats
    function showEndOfResultsMessage() {
        $('#load-more')
            .prop('disabled', true) // Désactivation du bouton "Charger plus"
            .text('Vous avez atteint la fin des résultats'); // Modification du texte du bouton
    }

    // Fonction pour initialiser les fonctionnalités comme la lightbox et les filtres
    function initializeFeatures() {
        // Écouteur d'événement pour le clic sur l'icône de plein écran dans la lightbox
        $('.lightbox-icon.fullscreen-icon').off('click').on('click', function(e) {
            e.preventDefault();
            // Code pour afficher l'image en plein écran (à implémenter si nécessaire)
        });

        // Écouteur d'événement pour le clic sur les éléments de filtre dans les dropdowns personnalisés
        $('.custom-dropdown .list_items_filter .list_item').off('click').on('click', function() {
            const $dropdown = $(this).closest('.custom-dropdown');
            const $selectedValue = $dropdown.find('.selected-value');
            const $hiddenInput = $dropdown.find('input[type="hidden"]');

            const selectedValue = $(this).data('value');
            $selectedValue.text($(this).text());
            $hiddenInput.val(selectedValue);

            loadPhotosBySelection(); // Recharger les photos en fonction de la sélection
        });

        // Initialisation de l'écouteur d'événement pour charger plus de photos
        $('#load-more').off('click').on('click', loadMorePhotos).prop('disabled', false).text('Charger plus');
    }

    // Fonction pour appliquer l'effet de lightbox sur les vignettes de photos
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

    // Exécution des fonctions initiales une fois que le document est prêt
    $(document).ready(function() {
        initializeFeatures(); // Initialiser les fonctionnalités comme la lightbox et les filtres
        loadPhotosBySelection(); // Charger les premières photos lors du chargement initial de la page
        applyLightboxEffect(); // Appliquer l'effet de lightbox aux vignettes de photos
    });
})(jQuery);
