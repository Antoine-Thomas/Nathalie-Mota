jQuery(document).ready(function($) {
    var images = []; // Votre tableau d'images
    var currentIndex = 0; // L'index de l'image actuellement affichée

    // Gestionnaire d'événements pour le survol sur les icônes de plein écran
    $(document).on('mouseenter', '.fullscreen-icon', function(e) {
        e.preventDefault();

        // Récupérer l'URL de l'image à partir de l'attribut de données "data-image"
        let imageUrl = $(this).data('photo');

        // Si l'attribut "data-image" n'est pas défini, récupérer l'URL de l'image à partir de la classe "photo" dans le conteneur parent
        if (!imageUrl) {
            imageUrl = $(this).closest('.photo-item').find('.photo-thumbnail img').attr('src');
        }

        // Faire une requête Ajax pour récupérer les photos du serveur
        $.ajax({
            url: nmAjax.ajaxUrl,
            method: 'POST',
            data: {
                action: 'load_photo_carrousel',
                photo_id: $(this).data('photo') // Vous devrez peut-être ajuster cette ligne en fonction de la structure de vos données
            },
            success: function(response)  {
                images = JSON.parse(response).photos; // Mettre à jour le tableau d'images avec la réponse du serveur
                 console.log(imageUrl)
                 console.log(images[0])
                  
                  currentIndex = images.findIndex(image => image.url === imageUrl); // Mettre à jour l'index de l'image actuellement affichée
                  openFullscreen(imageUrl); // Ouvrir l'image en plein écran
              }
        });
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

        // Créer les flèches gauche et droite
        const leftArrow = document.createElement('div');
        leftArrow.classList.add('fullscreen-arrow', 'left-arrow');
        leftArrow.innerHTML = '&lt;'; // Ajouter du contenu à la flèche gauche

        const rightArrow = document.createElement('div');
        rightArrow.classList.add('fullscreen-arrow', 'right-arrow');
        rightArrow.innerHTML = '&gt;'; // Ajouter du contenu à la flèche droite

        // Ajouter des gestionnaires d'événements pour les flèches
        leftArrow.addEventListener('click', function(e) {
            console.log (currentIndex)
            e.stopPropagation(); // Empêcher la propagation de l'événement pour éviter la fermeture de la popup
            currentIndex = (currentIndex > 0) ? currentIndex - 1 : images.length - 1; // Passer à l'image précédente
            fullscreenImage.src = images[currentIndex].url; // Mettre à jour l'image affichée
        });

        rightArrow.addEventListener('click', function(e) {
            console.log (currentIndex)
            e.stopPropagation(); // Empêcher la propagation de l'événement pour éviter la fermeture de la popup
            currentIndex = (currentIndex < images.length - 1) ? currentIndex + 1 : 0; // Passer à l'image suivante
            fullscreenImage.src = images[currentIndex].url; // Mettre à jour l'image affichée
        });

        // Ajouter les flèches et l'image au conteneur
        fullscreenContainer.appendChild(leftArrow);
        fullscreenContainer.appendChild(fullscreenImage);
        fullscreenContainer.appendChild(rightArrow);
        document.body.appendChild(fullscreenContainer);

        // Fermer l'image en plein écran lors du clic en dehors des flèches
        fullscreenContainer.addEventListener('click', function(e) {
            if (!$(e.target).hasClass('fullscreen-arrow')) {
                document.body.removeChild(fullscreenContainer);
            }
        });
    }
});







