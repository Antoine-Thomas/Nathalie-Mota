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

    // Écouteurs d'événements pour la popup de contact
    contactMenuLink.on('click', toggleContactPopup);
    burgerMenuContainer.on('click', '.open-popup', toggleContactPopup);
    popupCloseBtn.on('click', function() {
        popupOverlay.addClass('hidden').removeClass('visible');
    });
    popupOverlay.on('click', function(event) {
        if ($(event.target).is('.popup-overlay')) {
            popupOverlay.addClass('hidden').removeClass('visible');
        }
    });

    // Ajout de l'écouteur d'événement passif pour la compatibilité avec les appareils tactiles
    document.addEventListener('touchstart', function() {}, { passive: true });
});
