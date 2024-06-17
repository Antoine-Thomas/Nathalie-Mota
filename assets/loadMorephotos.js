jQuery(document).ready(function($) {
    var page = 1;

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

        console.log('Load Photos By Selection Args:', args);

        $.ajax({
            type: 'POST',
            url: ajaxUrl,
            data: args,
            success: function (response) {
                $('.photo-grid').html(response);
                applyLightboxEffect();
                page = 1; // Reset the page number when new selection is made
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
        const args = {
            action: 'load_more_photos',
            page: page,
            photos_per_page: 8,
            date_order: dateOrder
        };

        if (categorieId !== '') {
            args.categorie_id = categorieId;
        }

        if (formatId !== '') {
            args.format_id = formatId;
        }

        console.log('Load More Photos Args:', args);

        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: args,
            success: function (response) {
                if (response.trim() !== '') {
                    $('.photo-grid').append(response);
                    if ($(response).filter('.photo-item').length < 8) {
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
});





