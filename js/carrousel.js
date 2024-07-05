// Fonction pour mettre à jour le format de l'image (paysage ou portrait)
function updateImageFormat(image, container) {
    // Récupère les dimensions naturelles de l'image
    const width = image.naturalWidth;
    const height = image.naturalHeight;
    // Retire les classes existantes
    container.classList.remove('landscape', 'portrait');
    image.classList.remove('landscape', 'portrait');

    // Ajoute la classe appropriée en fonction des dimensions
    if (width > height) {
        image.classList.add('landscape');
        container.classList.add('landscape');
    } else {
        image.classList.add('portrait');
        container.classList.add('portrait');
    }
}

jQuery(document).ready(function($) {
    // Variables pour stocker les images et l'état du mode plein écran
    let images = [];
    let currentIndex = 0;
    let isFullscreenOpen = false;

    // Gestion du clic sur l'icône plein écran
    $(document).on('click', '.fullscreen-icon', function(e) {
        e.preventDefault();
        if (isFullscreenOpen) {
            return;
        }

        // Récupère l'URL de l'image
        let imageUrl = $(this).data('photo') || $(this).closest('.photo-item').find('.photo-thumbnail img').attr('src');

        // Charge le carrousel de photos via AJAX
        $.ajax({
            url: nmAjax.ajaxUrl,
            method: 'POST',
            data: {
                action: 'load_photo_carrousel',
                photo_id: $(this).data('photo')
            },
            success: function(response) {
                try {
                    // Parse la réponse JSON et ouvre le mode plein écran
                    images = JSON.parse(response).photos;
                    currentIndex = 0;
                    openFullscreen(imageUrl);
                } catch (error) {
                    console.error('Erreur lors de l\'analyse des photos:', error);
                }
            },
            error: function(_xhr, _status, error) {
                console.error('Erreur lors du chargement des photos:', error);
            }
        });
    });

    // Fonction pour ouvrir le mode plein écran
    function openFullscreen(imageUrl) {
        isFullscreenOpen = true;
        document.body.classList.add('no-scroll');

        // Création des éléments du mode plein écran
        const fullscreenContainer = document.createElement('div');
        fullscreenContainer.classList.add('fullscreen-container');

        const imageWithArrows = document.createElement('div');
        imageWithArrows.classList.add('image-with-arrows');

        const imageContainer = document.createElement('div');
        imageContainer.classList.add('image-container');

        const fullscreenImage = document.createElement('img');
        fullscreenImage.src = imageUrl;
        fullscreenImage.classList.add('fullscreen-image');

        // Mise à jour du format de l'image au chargement
        fullscreenImage.onload = function() {
            updateImageFormat(fullscreenImage, imageContainer);
        };

        const detailsContainer = document.createElement('div');
        detailsContainer.classList.add('fullscreen-details');

        // Fonction pour mettre à jour les détails de l'image
        function updateDetails(currentImage) {
            detailsContainer.innerHTML = '';

            if (currentImage.reference) {
                const reference = document.createElement('div');
                reference.classList.add('fullscreen-reference');
                reference.textContent = currentImage.reference;
                detailsContainer.appendChild(reference);
            }

            if (currentImage.categorie && currentImage.categorie.length > 0) {
                const categorie = document.createElement('div');
                categorie.classList.add('fullscreen-category');
                const categorieNames = currentImage.categorie.map(cat => cat.name);
                categorie.textContent = categorieNames.join(', ');
                detailsContainer.appendChild(categorie);
            }
        }

        updateDetails(images[currentIndex]);

        // Création des flèches de navigation
        const leftArrowContainer = document.createElement('div');
        leftArrowContainer.classList.add('left-arrow-container');

        const rightArrowContainer = document.createElement('div');
        rightArrowContainer.classList.add('right-arrow-container');

        const leftArrow = document.createElement('img');
        leftArrow.classList.add('fullscreen-arrow', 'left-arrow');
        leftArrow.src = '/wp-content/themes/nathalie-mota/images/left.png';

        const rightArrow = document.createElement('img');
        rightArrow.classList.add('fullscreen-arrow', 'right-arrow');
        rightArrow.src = '/wp-content/themes/nathalie-mota/images/right.png';

        leftArrowContainer.appendChild(leftArrow);
        rightArrowContainer.appendChild(rightArrow);

        // Fonction de navigation entre les images
        const navigate = (direction) => {
            currentIndex = (currentIndex + direction + images.length) % images.length;
            fullscreenImage.src = images[currentIndex].url;
            updateDetails(images[currentIndex]);
            updateImageFormat(fullscreenImage, imageContainer);
        };

        // Gestion des clics sur les flèches
        leftArrow.addEventListener('click', function(e) {
            e.stopPropagation();
            navigate(-1);
        }, { passive: true });

        rightArrow.addEventListener('click', function(e) {
            e.stopPropagation();
            navigate(1);
        }, { passive: true });

        // Création du conteneur des flèches
        const arrowsContainer = document.createElement('div');
        arrowsContainer.classList.add('arrows-container');
        arrowsContainer.appendChild(leftArrowContainer);
        arrowsContainer.appendChild(rightArrowContainer);

        // Assemblage des éléments
        imageContainer.appendChild(fullscreenImage);
        imageContainer.appendChild(detailsContainer);
        imageWithArrows.appendChild(imageContainer);
        fullscreenContainer.appendChild(imageWithArrows);
        fullscreenContainer.appendChild(arrowsContainer);

        // Création du bouton de fermeture
        const closeButton = document.createElement('div');
        closeButton.classList.add('close-button');
        closeButton.innerHTML = '&times;';
        fullscreenContainer.appendChild(closeButton);

        // Gestion du clic sur le bouton de fermeture
        closeButton.addEventListener('click', function() {
            document.body.removeChild(fullscreenContainer);
            isFullscreenOpen = false;
            document.body.classList.remove('no-scroll');
        }, { passive: true });

        // Animation d'ouverture du mode plein écran
        fullscreenContainer.style.opacity = 0;
        document.body.appendChild(fullscreenContainer);
        requestAnimationFrame(() => {
            fullscreenContainer.style.transition = 'opacity 1s';
            fullscreenContainer.style.opacity = 1;
        });

        // Création des flèches pour mobile
        const mobileArrows = document.createElement('div');
        mobileArrows.classList.add('fullscreen-mobile-arrows');

        const leftMobileArrow = document.createElement('span');
        leftMobileArrow.classList.add('fullscreen-mobile-arrow');
        leftMobileArrow.innerHTML = '&lt;';

        const rightMobileArrow = document.createElement('span');
        rightMobileArrow.classList.add('fullscreen-mobile-arrow');
        rightMobileArrow.innerHTML = '&gt;';

        // Gestion des clics sur les flèches mobiles
        leftMobileArrow.addEventListener('click', function(e) {
            e.stopPropagation();
            navigate(-1);
        }, { passive: true });

        rightMobileArrow.addEventListener('click', function(e) {
            e.stopPropagation();
            navigate(1);
        }, { passive: true });

        mobileArrows.appendChild(leftMobileArrow);
        mobileArrows.appendChild(rightMobileArrow);
        imageContainer.appendChild(mobileArrows);
    }

    document.addEventListener('touchstart', function() {}, { passive: true });
});

