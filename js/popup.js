document.addEventListener('DOMContentLoaded', function() {
    var contactButton = document.querySelector('.open-popup');
    var contactPopup = document.getElementById('contact-popup');
    var closePopupButton = document.getElementById('close-popup');
    var burgerMenu = document.querySelector('.burger-menu-container');

    contactButton.addEventListener('click', function(event) {
        event.preventDefault();
        if (!burgerMenu.classList.contains('active')) {
            contactPopup.classList.remove('hidden');
        }
    });

    closePopupButton.addEventListener('click', function() {
        contactPopup.classList.add('hidden');
    });
});
