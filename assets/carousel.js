jQuery(document).ready(function($) {
    var currentIndex = 0;

    // Fonction pour afficher le carrousel en plein écran
    $(document).on('click', '.fullscreen-icon', function(e) {
        e.preventDefault();
        var photoId = $(this).data('id');
        var modal = $('<div class="carousel-modal">' +
                        '<span class="carousel-close">&times;</span>' +
                        '<div class="carousel-content"></div>' +
                        '<a class="carousel-prev">&#10094;</a>' +
                        '<a class="carousel-next">&#10095;</a>' +
                      '</div>');

        $('body').append(modal);
        $('.carousel-modal').fadeIn();

        $.ajax({
            url: nmAjax.ajaxUrl,
            method: 'POST',
            data: {
                action: 'load_photo_carousel',
                photo_id: photoId
            },
            success: function(response) {
                var photos = JSON.parse(response).photos;
                if (photos.length > 0) {
                    photos.forEach(function(photo) {
                        $('.carousel-content').append('<img class="carousel-image" src="' + photo.url + '" alt="' + photo.title + '">');
                    });

                    var totalPhotos = photos.length;
                    showSlide(currentIndex);

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
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
                console.log(xhr.responseText);
            }
        });
    });
});
