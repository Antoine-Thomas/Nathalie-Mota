jQuery(document).ready(function($) {
    // Chargement initial des images de bannière
    loadBannerImages();

    function loadBannerImages() {
        $.ajax({
            url: nmAjax.ajaxUrl, // URL définie pour les requêtes AJAX dans WordPress
            method: 'POST',
            data: {
                action: 'load_photo_banner' // Action définie dans votre fichier PHP pour charger les photos de la bannière
            },
            success: function(response) {
                try {
                    var parsedResponse = JSON.parse(response);
                    console.log('Images de bannière chargées avec succès:', parsedResponse);

                    // Vérifier si des photos ont été renvoyées
                    if (parsedResponse.photos && parsedResponse.photos.length > 0) {
                        displayBannerImages(parsedResponse.photos);
                    } else {
                        console.log('Aucune image de bannière trouvée.');
                    }
                } catch (e) {
                    console.error('Erreur lors de l\'analyse de la réponse:', e);
                }
            },
            error: function(_xhr, _status, error) {
                console.error('Erreur lors du chargement des images de bannière:', error);
            }
        });
    }

    function displayBannerImages(photos) {
        var $banner = $('.banner');

        // Vider le contenu existant de la bannière
        $banner.empty();

        // Parcourir les photos et les ajouter à la bannière
        $.each(photos, function(_index, photo) {
            var $photoElement = $('<div class="photo" style="background-image: url(\'' + photo.url + '\');"></div>');
            $banner.append($photoElement);
        });
    }
});
