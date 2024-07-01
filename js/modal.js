jQuery(document).ready(function($) {
    var images = [];
    var currentIndex = 0;
    var isFullscreenOpen = false;

    $(document).on('click', '.fullscreen-icon', function(e) {
        e.preventDefault();
        if (isFullscreenOpen) {
            return;
        }

        let imageUrl = $(this).data('photo');
        if (!imageUrl) {
            imageUrl = $(this).closest('.photo-item').find('.photo-thumbnail img').attr('src');
        }

        $.ajax({
            url: nmAjax.ajaxUrl,
            method: 'POST',
            data: {
                action: 'load_photo_carrousel',
                photo_id: $(this).data('photo')
            },
            success: function(response) {
                images = JSON.parse(response).photos;
                currentIndex = 0;
                openFullscreen(imageUrl);
            }
        });
    });

    function openFullscreen(imageUrl) {
        isFullscreenOpen = true;
        
        // Ajouter la classe no-scroll au body
        document.body.classList.add('no-scroll');

        const fullscreenContainer = document.createElement('div');
        fullscreenContainer.classList.add('fullscreen-container');

        const imageWithArrows = document.createElement('div');
        imageWithArrows.classList.add('image-with-arrows');

        const imageContainer = document.createElement('div');
        imageContainer.classList.add('image-container');

        const fullscreenImage = document.createElement('img');
        fullscreenImage.src = imageUrl;
        fullscreenImage.classList.add('fullscreen-image');

        fullscreenImage.onload = function() {
            updateImageFormat(fullscreenImage, imageContainer);
        };

        const detailsContainer = document.createElement('div');
        detailsContainer.classList.add('fullscreen-details');

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

        const leftArrowContainer = document.createElement('div');
        leftArrowContainer.classList.add('left-arrow-container');

        const rightArrowContainer = document.createElement('div');
        rightArrowContainer.classList.add('right-arrow-container');

        const leftArrow = document.createElement('img');
        leftArrow.classList.add('fullscreen-arrow', 'left-arrow', 'chevron-arrow', 'modal-arrows');
        leftArrow.src = '/wp-content/themes/nathalie-mota/images/left.png';

        const rightArrow = document.createElement('img');
        rightArrow.classList.add('fullscreen-arrow', 'right-arrow', 'chevron-arrow', 'modal-arrows');
        rightArrow.src = '/wp-content/themes/nathalie-mota/images/right.png';

        leftArrowContainer.appendChild(leftArrow);
        rightArrowContainer.appendChild(rightArrow);

        leftArrow.addEventListener('click', function(e) {
            e.stopPropagation();
            currentIndex = (currentIndex > 0) ? currentIndex - 1 : images.length - 1;
            fullscreenImage.src = images[currentIndex].url;
            updateDetails(images[currentIndex]);
            updateImageFormat(fullscreenImage, imageContainer);
        });

        rightArrow.addEventListener('click', function(e) {
            e.stopPropagation();
            currentIndex = (currentIndex < images.length - 1) ? currentIndex + 1 : 0;
            fullscreenImage.src = images[currentIndex].url;
            updateDetails(images[currentIndex]);
            updateImageFormat(fullscreenImage, imageContainer);
        });

        const arrowsContainer = document.createElement('div');
        arrowsContainer.classList.add('arrows-container');
        arrowsContainer.appendChild(leftArrowContainer);
        arrowsContainer.appendChild(rightArrowContainer);

        imageContainer.appendChild(fullscreenImage);
        imageContainer.appendChild(detailsContainer);
        imageWithArrows.appendChild(imageContainer);
        fullscreenContainer.appendChild(imageWithArrows);
        fullscreenContainer.appendChild(arrowsContainer);

        const closeButton = document.createElement('div');
        closeButton.classList.add('close-button');
        closeButton.innerHTML = '&times;';
        fullscreenContainer.appendChild(closeButton);

        closeButton.addEventListener('click', function() {
            document.body.removeChild(fullscreenContainer);
            isFullscreenOpen = false;
            // Supprimer la classe no-scroll du body
            document.body.classList.remove('no-scroll');
        }, { passive: true });

        fullscreenContainer.style.opacity = 0;
        document.body.appendChild(fullscreenContainer);
        requestAnimationFrame(() => {
            fullscreenContainer.style.transition = 'opacity 1s';
            fullscreenContainer.style.opacity = 1;
        });
    }

    function updateImageFormat(image, container) {
        const width = image.naturalWidth;
        const height = image.naturalHeight;
        container.classList.remove('landscape', 'portrait');
        image.classList.remove('landscape', 'portrait');

        if (width > height) {
            image.classList.add('landscape');
            container.classList.add('landscape');
        } else {
            image.classList.add('portrait');
            container.classList.add('portrait');
        }
    }

    document.addEventListener('touchstart', function() {}, { passive: true });
});




