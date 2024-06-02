jQuery(document).ready(function($) {
    const menuToggle = $('.menu-toggle');
    const burgerMenuContainer = $('.burger-menu-container');
    const closeMenu = $('.close-menu');
    const body = $('body');
    const popupOverlay = $('.popup-overlay');
    const contactMenuLink = $('.open-popup');
    const popupCloseBtn = $('.close-popup');
    const ajaxUrl = nmAjax.ajaxUrl;
    let page = 1;
    const photosPerPage = 8;

    function unScroll() {
        body.css('overflow', burgerMenuContainer.hasClass('active') ? 'hidden' : 'auto');
    }

    menuToggle.on('click', () => {
        menuToggle.toggleClass('active');
        burgerMenuContainer.toggleClass('active');
        unScroll();
    });

    closeMenu.on('click', () => {
        menuToggle.removeClass('active');
        burgerMenuContainer.removeClass('active');
        unScroll();
    });

    contactMenuLink.on('click', function(event) {
        event.preventDefault();
        popupOverlay.removeClass('hidden');
    });

    burgerMenuContainer.on('click', function(event) {
        if ($(event.target).hasClass('open-popup')) {
            event.preventDefault();
            popupOverlay.removeClass('hidden');
        }
    });

    popupCloseBtn.on('click', function() {
        popupOverlay.addClass('hidden');
    });

    popupOverlay.on('click', function(event) {
        if ($(event.target).is(popupOverlay)) {
            popupOverlay.addClass('hidden');
        }
    });

    function loadMorePhotos() {
        console.log('Load more photos clicked');
        page++;
        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: {
                action: 'load_more_photos',
                page: page,
                photos_per_page: photosPerPage
            },
            success: function(response) {
                if (response) {
                    $('.photo-grid').append(response);
                    if ($('.photo-grid .photo-item').length >= totalPhotos) {
                        $('#load-more').hide();
                    }
                } else {
                    $('#load-more-container').hide();
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
                console.log(xhr.responseText);
            }
        });
    }

    $('#load-more').on('click', loadMorePhotos);
});




    
