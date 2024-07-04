jQuery(document).ready(function($) {
    // Fonction pour charger les images de la bannière
    function loadBannerImages() {
        $.ajax({
            url: nmAjax.ajaxUrl,
            method: 'POST',
            data: {
                action: 'load_photos_for_banner'
            },
            success: function(response) {
                var images = JSON.parse(response);
                if (images.length > 0) {
                    displayBannerImages(images);
                } else {
                    // Aucune image de bannière trouvée.
                }
            },
            error: function(_xhr, _status, error) {
                console.error('Erreur lors du chargement des images de bannière:', error);
            }
        });
    }

    // Fonction pour afficher les images dans la bannière
    function displayBannerImages(images) {
        var $bannerContent = $('.banner-content');
        $bannerContent.empty(); // Vide le contenu actuel de la bannière

        images.forEach(function(imageUrl) {
            var $photoElement = $('<div class="photo-banner" style="background-image: url(' + imageUrl + ');"></div>');
            $bannerContent.append($photoElement);
        });
    }
// Déclencher un événement personnalisé pour indiquer que la bannière est chargée
$(document).trigger('bannerLoaded');
    // Appel de la fonction pour charger les images de la bannière au chargement de la page
    loadBannerImages();
});




