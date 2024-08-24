document.addEventListener('DOMContentLoaded', function() {
    // Get the current URL path
    const currentPath = window.location.pathname;

    // Select all nav links
    const navLinks = document.querySelectorAll('.page-links .nav-btn');

    // Loop through the links and add 'active-nav-btn' class if the href matches the current path
    navLinks.forEach(link => {
        if (link.getAttribute('href') === currentPath) {
            link.classList.add('active-nav-btn');
        }
    });
});