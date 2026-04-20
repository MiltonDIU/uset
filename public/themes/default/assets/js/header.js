// JavaScript for the header/navbar functionality

document.addEventListener('DOMContentLoaded', function() {
  // Add event listener for scroll to change navbar styling
  window.addEventListener('scroll', function() {
    const navbar = document.querySelector('.navbar');
    if (window.scrollY > 10) {
      navbar.classList.add('py-2', 'shadow');
      navbar.classList.remove('py-3');
    } else {
      navbar.classList.remove('py-2', 'shadow');
      navbar.classList.add('py-3');
    }
  });

  /*
  // Add active class to current navigation item based on URL
  const currentLocation = window.location.pathname;
  const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
  
  navLinks.forEach(link => {
    // Remove any existing active classes first
    link.classList.remove('active');
    
    const linkPath = link.getAttribute('href');
    // Handle both absolute and relative paths
    const cleanLinkPath = linkPath.replace(/^\s*\//, ''); // Remove leading slash and spaces
    const cleanCurrentPath = currentLocation.replace(/^\s*\//, '');
    
    if (cleanLinkPath === cleanCurrentPath || 
        (cleanLinkPath !== 'index.html' && cleanCurrentPath.includes(cleanLinkPath))) {
      link.classList.add('active');
    }
    // Special case for home page
    if ((cleanCurrentPath === '' || cleanCurrentPath === 'index.html') && 
        (cleanLinkPath === 'index.html' || cleanLinkPath === '/')) {
      link.classList.add('active');
    }
  });
  */
});