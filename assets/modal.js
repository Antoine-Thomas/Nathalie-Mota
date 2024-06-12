jQuery(document).ready(function($) {
    // Gestionnaire d'événements pour les clics sur les icônes de plein écran
    $(document).on('click', '.fullscreen-icon', function(e) {
        e.preventDefault();
        
        // Récupérer l'URL de l'image à partir de l'attribut de données "data-image"
        let imageUrl = $(this).data('image');
        
        // Si l'attribut "data-image" n'est pas défini, récupérer l'URL de l'image à partir de la classe "photo" dans le conteneur parent
        if (!imageUrl) {
            imageUrl = $(this).closest('.photo-item').find('.photo-thumbnail img').attr('src');
        }
        
        // Ouvrir l'image en plein écran
        openFullscreen(imageUrl);
    });

    // Fonction pour ouvrir l'image en plein écran
    function openFullscreen(imageUrl) {
        // Créer un conteneur plein écran
        const fullscreenContainer = document.createElement('div');
        fullscreenContainer.classList.add('fullscreen-container');

        // Créer un élément image plein écran
        const fullscreenImage = document.createElement('img');
        fullscreenImage.src = imageUrl;
        fullscreenImage.classList.add('fullscreen-image');

        // Ajouter l'image au conteneur
        fullscreenContainer.appendChild(fullscreenImage);
        document.body.appendChild(fullscreenContainer);

        // Fermer l'image en plein écran lors du clic
        fullscreenContainer.addEventListener('click', function() {
            document.body.removeChild(fullscreenContainer);
        });
    }
});

