$(document).ready(function () {
    let page = 1;
    const photosPerPage = 8;
    let maxPages = 1;

    // Fonction pour charger les photos selon la sélection
    function loadPhotosBySelection() {
        const categorieId = $('#categorie_id').val();
        const formatId = $('#format_id').val();
        const dateOrder = $('#date').val();

        const args = {
            action: 'load_photos_by_selection',
            date_order: (dateOrder === 'asc') ? 'DESC' : 'ASC',
            page: page,
            photos_per_page: photosPerPage
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
                const res = JSON.parse(response);
                $('.photo-grid-container').html(res.html);
                maxPages = res.max_pages;
                applyLightboxEffect();
            },
            error: function (response) {
                console.error('Erreur:', response);
            }
        });
    }

    // Fonction pour charger plus de photos
    function loadMorePhotos() {
        if (page >= maxPages) {
            showEndOfResultsMessage(); // Affiche un message à l'utilisateur
            return;
        }

        page++;
        const categorieId = $('#categorie_id').val();
        const formatId = $('#format_id').val();
        const dateOrder = $('#date').val();

        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: {
                action: 'load_photos_by_selection',
                page: page,
                photos_per_page: photosPerPage,
                categorie_id: categorieId,
                format_id: formatId,
                date_order: dateOrder
            },
            success: function (response) {
                const res = JSON.parse(response);
                $('.photo-grid').append(res.html);
                if (page >= maxPages) {
                    showEndOfResultsMessage(); // Affiche un message à l'utilisateur
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', status, error);
                console.log(xhr.responseText);
            }
        });
    }

    // Fonction pour afficher un message de fin de résultats
    function showEndOfResultsMessage() {
        $('#load-more')
            .prop('disabled', true)
            .text('Vous avez atteint la fin des résultats');
    }

    // Définir les événements
    $('#load-more').on('click', loadMorePhotos);
    $('#categorie_id, #format_id, #date').on('change', function () {
        page = 1; // Réinitialiser à la première page
        loadPhotosBySelection();
    });

    // Charger les photos initiales
    loadPhotosBySelection();

    // Fonction pour appliquer l'effet de lightbox
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
});
