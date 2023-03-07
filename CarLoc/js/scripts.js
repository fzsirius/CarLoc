
window.addEventListener('DOMContentLoaded', event => {

    // Fonction de réduction de la barre de navigation
    var navbarShrink = function () {
        const navbarCollapsible = document.body.querySelector('#mainNav');
        if (!navbarCollapsible) {
            return;
        }
        if (window.scrollY === 0) {
            navbarCollapsible.classList.remove('navbar-shrink')
        } else {
            navbarCollapsible.classList.add('navbar-shrink')
        }

    };

    // Réduire la barre de navigation
    navbarShrink();

    // Réduire la barre de navigation lors du défilement de la page
    document.addEventListener('scroll', navbarShrink);

    // Activez Bootstrap scrollspy sur l'élément de navigation principal
    const mainNav = document.body.querySelector('#mainNav');
    if (mainNav) {
        new bootstrap.ScrollSpy(document.body, {
            target: '#mainNav',
            offset: 74,
        });
    };

    // Réduire la barre de navigation réactive lorsque le basculeur est visible
    const navbarToggler = document.body.querySelector('.navbar-toggler');
    const responsiveNavItems = [].slice.call(
        document.querySelectorAll('#navbarResponsive .nav-link')
    );
    responsiveNavItems.map(function (responsiveNavItem) {
        responsiveNavItem.addEventListener('click', () => {
            if (window.getComputedStyle(navbarToggler).display !== 'none') {
                navbarToggler.click();
            }
        });
    });

    // Activer le plugin SimpleLightbox pour les éléments 
    new SimpleLightbox({
        elements: '#portfolio a.portfolio-box'
    });

});
