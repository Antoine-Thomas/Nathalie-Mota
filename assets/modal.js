jQuery(document).ready(function($) {
    var images = []; // Tableau d'images
    var currentIndex = 0; // Index de l'image actuellement affichée
    var isFullscreenOpen = false; // Variable pour suivre l'état du conteneur plein écran

    // Gestionnaire d'événements pour le survol sur les icônes de plein écran
    $(document).on('mouseenter', '.fullscreen-icon', function(e) {
        e.preventDefault();

        // Vérifier si un conteneur plein écran est déjà ouvert
        if (isFullscreenOpen) {
            return; // Sortir de la fonction si un conteneur est déjà ouvert
        }

        // Récupérer l'URL de l'image à partir de l'attribut de données "data-photo"
        let imageUrl = $(this).data('photo');

        // Si l'attribut "data-photo" n'est pas défini, récupérer l'URL de l'image à partir de la classe "photo" dans le conteneur parent
        if (!imageUrl) {
            imageUrl = $(this).closest('.photo-item').find('.photo-thumbnail img').attr('src');
        }

        // Faire une requête Ajax pour récupérer les photos du serveur
        $.ajax({
            url: nmAjax.ajaxUrl,
            method: 'POST',
            data: {
                action: 'load_photo_carrousel',
                photo_id: $(this).data('photo')
            },
            success: function(response) {
                images = JSON.parse(response).photos; // Mettre à jour le tableau d'images avec la réponse du serveur
                currentIndex = 0; // Réinitialiser l'index à 0 pour afficher la première image de la catégorie
                openFullscreen(imageUrl); // Ouvrir l'image en plein écran
            }
        });
    });

    // Fonction pour ouvrir l'image en plein écran
    function openFullscreen(imageUrl) {
        isFullscreenOpen = true; // Marquer le conteneur plein écran comme ouvert

        // Créer un conteneur plein écran
        const fullscreenContainer = document.createElement('div');
        fullscreenContainer.classList.add('fullscreen-container');

        // Créer un élément image plein écran
        const fullscreenImage = document.createElement('img');
        fullscreenImage.src = imageUrl;
        fullscreenImage.classList.add('fullscreen-image');

        // Appliquer le format de l'image (landscape ou portrait)
        const imageFormat = getImageFormat(imageUrl);
        if (imageFormat === 'landscape') {
            fullscreenImage.classList.add('landscape');
        } else if (imageFormat === 'portrait') {
            fullscreenImage.classList.add('portrait');
        }

        // Créer les flèches gauche et droite
        const leftArrow = document.createElement('div');
        leftArrow.classList.add('fullscreen-arrow', 'left-arrow');
        leftArrow.innerHTML = '&lt;'; // Ajouter du contenu à la flèche gauche

        const rightArrow = document.createElement('div');
        rightArrow.classList.add('fullscreen-arrow', 'right-arrow');
        rightArrow.innerHTML = '&gt;'; // Ajouter du contenu à la flèche droite

        // Gestionnaire d'événements pour la flèche gauche
        leftArrow.addEventListener('click', function(e) {
            e.stopPropagation(); // Empêcher la propagation de l'événement pour éviter la fermeture de la popup
            currentIndex = (currentIndex > 0) ? currentIndex - 1 : images.length - 1; // Passer à l'image précédente
            fullscreenImage.src = images[currentIndex].url; // Mettre à jour l'image affichée
            updateDetails(images[currentIndex]); // Mettre à jour les détails
        }, { passive: true });

        // Gestionnaire d'événements pour la flèche droite
        rightArrow.addEventListener('click', function(e) {
            e.stopPropagation(); // Empêcher la propagation de l'événement pour éviter la fermeture de la popup
            currentIndex = (currentIndex < images.length - 1) ? currentIndex + 1 : 0; // Passer à l'image suivante
            fullscreenImage.src = images[currentIndex].url; // Mettre à jour l'image affichée
            updateDetails(images[currentIndex]); // Mettre à jour les détails
        }, { passive: true });

        // Créer un conteneur pour les détails à gauche de l'image
        const leftDetails = document.createElement('div');
        leftDetails.classList.add('fullscreen-details', 'left-details');

        // Créer un conteneur pour les détails à droite de l'image
        const rightDetails = document.createElement('div');
        rightDetails.classList.add('fullscreen-details', 'right-details');

        // Fonction pour mettre à jour les détails
        function updateDetails(currentImage) {
            // Vider les détails précédents
            leftDetails.innerHTML = '';
            rightDetails.innerHTML = '';

            // Ajouter les détails de la photo courante
            if (currentImage.reference) {
                const title = document.createElement('div');
                title.classList.add('fullscreen-title');
                title.textContent = currentImage.reference;
                leftDetails.appendChild(title);
            }

            if (currentImage.categorie && currentImage.categorie.length > 0) {
                const categorie = document.createElement('div');
                categorie.classList.add('fullscreen-category');
                // Construire la chaîne de catégories séparées par une virgule
                const categorieNames = currentImage.categorie.map(cat => cat.name);
                categorie.textContent = categorieNames.join(', ');
                leftDetails.appendChild(categorie);
            }
        }

        // Appeler updateDetails pour l'image actuellement affichée
        updateDetails(images[currentIndex]);

        // Ajouter les éléments au conteneur plein écran
        fullscreenContainer.appendChild(leftArrow);
        fullscreenContainer.appendChild(fullscreenImage);
        fullscreenContainer.appendChild(rightArrow);
        fullscreenContainer.appendChild(leftDetails);
        fullscreenContainer.appendChild(rightDetails);

        // Ajouter le bouton de fermeture (croix)
        const closeButton = document.createElement('div');
        closeButton.classList.add('close-button');
        closeButton.innerHTML = '&times;'; // Symbole de croix pour fermer
        fullscreenContainer.appendChild(closeButton);

        // Gestionnaire d'événements pour fermer le fullscreen-container
        closeButton.addEventListener('click', function() {
            document.body.removeChild(fullscreenContainer);
            isFullscreenOpen = false; // Marquer le conteneur plein écran comme fermé
        }, { passive: true });

        // Ajouter la transition pour l'effet de "fade-in"
        fullscreenContainer.style.opacity = 0;
        document.body.appendChild(fullscreenContainer);
        requestAnimationFrame(() => {
            fullscreenContainer.style.transition = 'opacity 0.5s';
            fullscreenContainer.style.opacity = 1;
        });
    }

    // Fonction pour déterminer le format de l'image
    function getImageFormat(imageUrl) {
        const image = new Image();
        image.src = imageUrl;
        const width = image.naturalWidth;
        const height = image.naturalHeight;
        if (width > height) {
            return 'landscape';
        } else {
            return 'portrait';
        }
    }

    // Ajout de l'écouteur d'événement passif
    document.addEventListener('touchstart', function() {}, { passive: true });
});



