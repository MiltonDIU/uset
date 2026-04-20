// Main JavaScript file for USET University Website

document.addEventListener('DOMContentLoaded', function() {
  // Load university information for footer and other components
  fetch('/data/university_info.json')
    .then(response => response.json())
    .then(data => {
      // Update elements with university info
      // Name, address, contact, etc.
      const universityName = document.querySelectorAll('.university-name');
      const universityShortName = document.querySelectorAll('.university-short-name');
      const universitySlogan = document.querySelectorAll('.university-slogan');
      const universityAddress = document.querySelectorAll('.university-address');
      const universityPhone = document.querySelectorAll('.university-phone');
      const universityEmail = document.querySelectorAll('.university-email');
      
      // Social media links
      const facebookLinks = document.querySelectorAll('.facebook-link');
      const twitterLinks = document.querySelectorAll('.twitter-link');
      const linkedinLinks = document.querySelectorAll('.linkedin-link');
      const instagramLinks = document.querySelectorAll('.instagram-link');
      
      // Update all elements with university information
      universityName.forEach(el => el.textContent = data.name);
      universityShortName.forEach(el => el.textContent = data.shortName);
      universitySlogan.forEach(el => el.textContent = data.slogan);
      
      const fullAddress = `${data.location.address}, ${data.location.city}, ${data.location.country}`;
      universityAddress.forEach(el => el.textContent = fullAddress);
      
      universityPhone.forEach(el => {
        el.textContent = data.contact.phone;
        if (el.tagName === 'A') {
          el.href = `tel:${data.contact.phone}`;
        }
      });
      
      universityEmail.forEach(el => {
        el.textContent = data.contact.email;
        if (el.tagName === 'A') {
          el.href = `mailto:${data.contact.email}`;
        }
      });
      
      // Update social media links
      facebookLinks.forEach(el => el.href = data.contact.facebook);
      twitterLinks.forEach(el => el.href = data.contact.twitter);
      linkedinLinks.forEach(el => el.href = data.contact.linkedin);
      instagramLinks.forEach(el => el.href = data.contact.instagram);
      
      // Set copyright year in footer
      const copyrightYear = document.querySelector('.copyright-year');
      if (copyrightYear) {
        copyrightYear.textContent = new Date().getFullYear();
      }
    })
    .catch(error => console.error('Error loading university info:', error));
    
  // Initialize tooltips
  $('[data-toggle="tooltip"]').tooltip();
  
  // Initialize popovers
  $('[data-toggle="popover"]').popover();
  
  // Animate stats numbers
  function animateStats() {
    const stats = document.querySelectorAll('.stat-value');
    
    stats.forEach(stat => {
        const target = parseInt(stat.getAttribute('data-target'));
        const duration = 2000; // Animation duration in milliseconds
        const steps = 50; // Number of steps in animation
        const stepValue = target / steps;
        let current = 0;
        
        const timer = setInterval(() => {
            current += stepValue;
            stat.textContent = Math.round(current);
            
            if (current >= target) {
                stat.textContent = target;
                clearInterval(timer);
            }
        }, duration / steps);
    });
  }

  // Trigger animation when section is in view
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        animateStats();
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.5 });

  const statsSection = document.querySelector('.stats-section');
  if (statsSection) {
    observer.observe(statsSection);
  }

  var testimonialCarousel = new bootstrap.Carousel(document.getElementById('testimonialCarousel'), {
    interval: 5000,
    wrap: true
  });
});

$(document).ready(function(){
    $('.hero-slider').slick({
        dots: true,
        infinite: true,
        speed: 500,
        fade: true,
        cssEase: 'linear',
        autoplay: true,
        autoplaySpeed: 5000,
        prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
        nextArrow: '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>'
    });
});

// Back to Top Button functionality
document.addEventListener('DOMContentLoaded', function() {
    const backToTopButton = document.getElementById('backToTop');
    
    // Show/hide button based on scroll position
    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) { // Show button after 300px of scroll
            backToTopButton.classList.add('visible');
        } else {
            backToTopButton.classList.remove('visible');
        }
    });
    
    // Smooth scroll to top when clicked
    backToTopButton.addEventListener('click', function(e) {
        e.preventDefault();
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
});
