
document.addEventListener('DOMContentLoaded', function () {
    const menuToggle = document.querySelector('.menu-toggle');
    const burgerMenuContainer = document.querySelector('.burger-menu-container');
    const closeMenu = document.querySelector('.close-menu');
    const body = document.querySelector('body');

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


   
});
