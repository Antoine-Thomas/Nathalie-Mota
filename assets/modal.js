jQuery(document).ready(function($) {
    $(document).on('click', '.fullscreen-icon', function(e) {
        e.preventDefault();
        var photo_id = $(this).data('');
        var clickedIndex = $(this).index('.fullscreen-icon'); // Trouver l'index de la photo cliquée
    
        $.ajax({
            url: nmAjax.ajaxUrl,
            method: 'POST',
            data: {
                action: 'load_photo_carousel',
                photo_id: photo_id
            },
            success: function(response) {
                var photos = JSON.parse(response).photos;
                if (photos.length > 0) {
                    var modal = '<div class="carousel-modal">' +
                                    '<span class="carousel-close">&times;</span>' +
                                    '<div class="carousel-content">';
                                    photos.forEach(function(photo) {
                                        var orientationClass = (photo.width > photo.height) ? 'paysage' : 'portrait'; // Déterminer la classe d'orientation en fonction des dimensions de la photo
                                        modal += '<img class="carousel-image ' + orientationClass + '" src="' + photo.url + '" alt="' + photo.title + '">';
                                    });
                                    
                    modal += '</div>' +
                             '<a class="carousel-prev">&#10094;</a>' +
                             '<a class="carousel-next">&#10095;</a>' +
                             '</div>';
                    $('body').append(modal);
                    $('.carousel-modal').fadeIn();
    
                    var totalPhotos = photos.length;
                    var currentIndex = clickedIndex; // Définir l'index actuel sur celui de la photo cliquée
    
                    showSlide(currentIndex);
                    
                    $(document).on('click', '.carousel-image', function() {
                        $('.carousel-modal').fadeOut(function() {
                            $(this).remove();
                        });
                    });
                    
                    function showSlide(index) {
                        var slides = $('.carousel-image');
                        if (index >= totalPhotos) {
                            currentIndex = 0;
                        }
                        if (index < 0) {
                            currentIndex = totalPhotos - 1;
                        }
                        slides.hide();
                        slides.eq(currentIndex).show();
                    }
    
                    $('.carousel-next').on('click', function() {
                        showSlide(++currentIndex);
                    });
    
                    $('.carousel-prev').on('click', function() {
                        showSlide(--currentIndex);
                    });
    
                    $('.carousel-close').on('click', function() {
                        $('.carousel-modal').fadeOut(function() {
                            $(this).remove();
                        });
                    });
                }
            }
        });
    });
});




