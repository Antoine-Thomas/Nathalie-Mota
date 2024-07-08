jQuery(document).ready(function ($) {
    const menuToggle = $('.menu-toggle');
    const burgerMenuContainer = $('.burger-menu-container');
    const closeMenu = $('.close-menu');
    const body = $('body');
    const popupOverlay = $('.popup-overlay');
    const contactMenuLink = $('.open-popup');
    const popupCloseBtn = $('.close-popup');
    

    // Module de gestion du menu burger
    function toggleBurgerMenu() {
        menuToggle.toggleClass('active');
        burgerMenuContainer.toggleClass('active');
        unScroll();
    }

    function unScroll() {
        body.css('overflow', burgerMenuContainer.hasClass('active') ? 'hidden' : 'auto');
    }

    menuToggle.on('click', toggleBurgerMenu);
    closeMenu.on('click', toggleBurgerMenu);

    // Fonction pour extraire la référence de la photo
    function getPhotoReference() {
        return $('.reference').text().replace('Référence : ', '').trim();
    }

    // Fonction pour basculer l'affichage de la popup de contact
    function toggleContactPopup(event) {
        event.preventDefault();

        const photoReference = getPhotoReference();
        const referenceField = $('input[name="reference"]');
        if (referenceField.length && photoReference) {
            referenceField.val(photoReference);
        }

        popupOverlay.toggleClass('hidden visible');
    }

    // Écouteur de clic sur le lien de contact
    contactMenuLink.on('click', toggleContactPopup);

    // Écouteur de clic sur le burger menu
    burgerMenuContainer.on('click', function(event) {
        if ($(event.target).hasClass('open-popup')) {
            toggleContactPopup(event);
        } else {
            // Fermer la popup si nécessaire lors du clic sur le burger menu
            popupOverlay.addClass('hidden').removeClass('visible');
        }
    });

    // Écouteur de clic sur le bouton de fermeture de la popup
    popupCloseBtn.on('click', function() {
        popupOverlay.addClass('hidden').removeClass('visible');
    });

    // Écouteur de clic sur l'overlay de la popup pour la fermer
    popupOverlay.on('click', function(event) {
        if ($(event.target).is(popupOverlay)) {
            popupOverlay.addClass('hidden').removeClass('visible');
        }
    });

    // Fonction pour ouvrir/fermer la popup de contact
    function toggleContactPopup() {
        const popupOverlay = $('.popup-overlay');
        popupOverlay.toggleClass('hidden'); // Toggle la classe hidden
    }

    // Écouteur d'événement pour le clic sur le lien de contact
    $('.contact-menu-link').on('click', function(event) {
        event.preventDefault();
        toggleContactPopup();
    });

    // Écouteur d'événement pour le clic sur le menu burger
    $('.burger-menu-container').on('click', function(event) {
        if ($(event.target).hasClass('open-popup')) {
            toggleContactPopup();
        } else {
            // Fermer le popup si nécessaire lors du clic sur une autre partie du burger menu
            $('.popup-overlay').addClass('hidden');
        }
    });

    // Écouteur d'événement pour le clic sur le bouton de fermeture de la popup
    $('.popup-close-btn').on('click', function() {
        $('.popup-overlay').addClass('hidden');
    });

    // Écouteur d'événement pour fermer la popup en cliquant en dehors de celle-ci
    $('.popup-overlay').on('click', function(event) {
        if ($(event.target).is('.popup-overlay')) {
            $('.popup-overlay').addClass('hidden');
        }
    });


// Ajout de l'écouteur d'événement passif
    document.addEventListener('touchstart', function() {}, { passive: true });
});