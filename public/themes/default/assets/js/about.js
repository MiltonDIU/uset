document.addEventListener('DOMContentLoaded', function() {
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');
    let activeTab = 'mission-vision';

    function switchTab(tabId) {
        // Remove active classes
        tabButtons.forEach(btn => btn.classList.remove('active'));
        tabContents.forEach(content => {
            content.classList.remove('active');
            content.style.display = 'none';
        });

        // Add active class to current tab
        const selectedTab = document.querySelector(`[data-tab="${tabId}"]`);
        const selectedContent = document.getElementById(`${tabId}-content`);
        
        if (selectedTab && selectedContent) {
            selectedTab.classList.add('active');
            selectedContent.style.display = 'block';
            
            // Animate content
            setTimeout(() => {
                selectedContent.classList.add('active');
                initializeAnimations(selectedContent);
            }, 50);

            // Update URL hash
            history.pushState(null, null, `#${tabId}`);
            activeTab = tabId;
        }
    }

    // Initialize animations for visible elements
    function initializeAnimations(container) {
        const elements = container.querySelectorAll('.animate-in');
        elements.forEach((el, index) => {
            el.style.animationDelay = `${index * 0.1}s`;
            el.classList.add('fade-in');
        });
    }

    // Tab click handlers
    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            const tabId = button.getAttribute('data-tab');
            switchTab(tabId);
        });
    });

    // Handle URL hash on page load
    const hash = window.location.hash.substring(1);
    if (hash && document.querySelector(`[data-tab="${hash}"]`)) {
        switchTab(hash);
    } else {
        switchTab('mission-vision');
    }

    // Scroll animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('fade-in');
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '50px'
    });

    document.querySelectorAll('.animate-on-scroll').forEach(el => {
        observer.observe(el);
    });

    // Scroll animation observer
    const scrollObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '50px'
    });

    // Observe all elements with animate-on-scroll class
    document.querySelectorAll('.animate-on-scroll').forEach(el => {
        scrollObserver.observe(el);
    });
});