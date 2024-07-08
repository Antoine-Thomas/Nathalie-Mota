(function($) {
    $(document).ready(function() {
        // Fonction pour charger et afficher les images de la bannière
        function get_banner_images() {
            $.ajax({
                url: ajax_object.ajaxurl, // Utilisez ajaxurl fourni par WordPress pour les requêtes AJAX
                type: 'POST',
                dataType: 'json',
                data: {
                    action: 'get_banner_images' // Action PHP à appeler
                },
                success: function(response) {
                    if (response && response.length > 0) {
                        let currentIndex = 0;
                        const totalImages = response.length;

                        // Fonction pour changer l'image de la bannière
                        function changeBannerImage() {
                            $('.photo-banner').fadeOut('slow', function() {
                                $(this).css('background-image', 'url(' + response[currentIndex] + ')').fadeIn('slow');
                            });

                            currentIndex = (currentIndex + 1) % totalImages;

                            // Appeler cette fonction de manière récursive après un délai
                            setTimeout(changeBannerImage, 10000); // Changer l'image toutes les 5 secondes
                        }

                        // Démarrer le diaporama de la bannière
                        changeBannerImage();
                    } else {
                        console.log('Aucune image de bannière trouvée.');
                    }
                },
                error: function(error) {
                    console.error('Erreur lors du chargement des images de la bannière :', error);
                }
            });
        }

        // Appeler la fonction pour charger les images de la bannière au chargement de la page
        get_banner_images();
    });
})(jQuery);

