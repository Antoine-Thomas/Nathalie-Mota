document.addEventListener('DOMContentLoaded', function () {
    const menuToggle = document.querySelector('.menu-toggle');
    const burgerMenuContainer = document.querySelector('.burger-menu-container');
    const closeMenu = document.querySelector('.close-menu');
    const body = document.querySelector('body');
    const popupOverlay = document.querySelector('.popup-overlay');
    const contactMenuLink = document.querySelector('.open-popup');
    const popupCloseBtn = document.querySelector('.close-popup');

    function unScroll() {
        if (burgerMenuContainer.classList.contains('active')) {
            body.style.overflow = 'hidden';
        } else {
            body.style.overflow = 'auto';
        }
    }

    menuToggle.addEventListener('click', () => {
        menuToggle.classList.toggle('active');
        burgerMenuContainer.classList.toggle('active');
        unScroll();
    });

    closeMenu.addEventListener('click', () => {
        menuToggle.classList.remove('active');
        burgerMenuContainer.classList.remove('active');
        unScroll();
    });

    // Ouvrir la popup lors du clic sur le lien du menu "Contact"
    contactMenuLink.addEventListener('click', function(event) {
        event.preventDefault();
        popupOverlay.classList.remove('hidden');
    });

    // Fermer la popup lors du clic sur le bouton de fermeture
    popupCloseBtn.addEventListener('click', function() {
        popupOverlay.classList.add('hidden');
    });

    // Fermer la popup lors du clic en dehors de la zone de la popup
    popupOverlay.addEventListener('click', function(event) {
        if (event.target === popupOverlay) {
            popupOverlay.classList.add('hidden');
        }
    });
});



