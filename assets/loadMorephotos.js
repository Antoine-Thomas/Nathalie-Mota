jQuery(document).ready(function($) {
  
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

   
});