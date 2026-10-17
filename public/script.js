document.addEventListener('DOMContentLoaded', () => {
    
    // 1. Mobile Menu Toggle
    const mobileMenu = document.getElementById('mobile-menu');
    const navMenu = document.getElementById('nav-menu');
    const navLinks = document.querySelectorAll('#nav-menu a');

    mobileMenu.addEventListener('click', () => {
        mobileMenu.classList.toggle('active');
        navMenu.classList.toggle('active');
    });

    // Close menu when a link is clicked (unless it's a dropdown toggle)
    navLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            if (window.innerWidth <= 768 && link.parentElement.classList.contains('dropdown')) {
                return; // Let the dropdown logic handle this click
            }
            mobileMenu.classList.remove('active');
            navMenu.classList.remove('active');
        });
    });

    // 1.5 Dropdown Menu Toggle (Mobile Click Support)
    const dropdowns = document.querySelectorAll('.dropdown');
    
    dropdowns.forEach(dropdown => {
        const toggleLink = dropdown.querySelector('.nav-link');
        
        if (toggleLink) {
            toggleLink.addEventListener('click', (e) => {
                if (window.innerWidth <= 768) {
                    e.preventDefault(); // Prevent navigating to href on mobile so the menu can open
                    
                    // Close other dropdowns
                    dropdowns.forEach(d => {
                        if (d !== dropdown) d.classList.remove('active');
                    });
                    
                    // Toggle this dropdown
                    dropdown.classList.toggle('active');
                }
            });
        }
    });

    // Close dropdowns when clicking outside
    document.addEventListener('click', (e) => {
        if (!e.target.closest('.dropdown')) {
            dropdowns.forEach(d => d.classList.remove('active'));
        }
    });

    // 2. Set Active State based on current URL
    const currentPath = window.location.pathname.split('/').pop() || 'index.php';
    navLinks.forEach(link => {
        const href = link.getAttribute('href');
        if (href === currentPath) {
            link.classList.add('active');
        } else {
            link.classList.remove('active');
        }
    });

    // 3. Sticky Navbar
    const navbar = document.getElementById('navbar');
    const sections = document.querySelectorAll('section');

    window.addEventListener('scroll', () => {
        // Sticky Navbar styling on scroll
        if (window.scrollY > 50) {
            navbar.style.padding = '0.5rem 0';
            navbar.style.boxShadow = '0 4px 6px rgba(0, 0, 0, 0.1)';
        } else {
            navbar.style.padding = '1rem 0';
            navbar.style.boxShadow = '0 4px 6px rgba(0, 0, 0, 0.05)';
        }
    });

    // 4. Scroll Reveal Animations (Vanilla JS)
    const revealElements = document.querySelectorAll('.scroll-reveal');
    if ('IntersectionObserver' in window) {
        const revealObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: "0px 0px -50px 0px" });

        revealElements.forEach(el => revealObserver.observe(el));
    } else {
        // Fallback
        revealElements.forEach(el => el.classList.add('visible'));
    }

    // 5. Page Load / Navigation Transitions
    document.body.classList.add('page-loaded');

    window.addEventListener('pageshow', () => {
        document.body.classList.remove('page-leaving');
        document.body.classList.add('page-loaded');
    });

    window.addEventListener('hashchange', () => {
        document.body.classList.remove('page-leaving');
        document.body.classList.add('page-loaded');
    });

    const internalLinks = document.querySelectorAll('a[href]:not([target="_blank"])');
    internalLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const target = this.getAttribute('href');
            // Ignore jump links or js links
            if (target.startsWith('#') || target.startsWith('javascript')) return;
            
            // Check if it's a hash link for the current page
            const currentPath = window.location.pathname.split('/').pop() || 'index.php';
            const targetParts = target.split('#');
            const targetPath = targetParts[0];
            const targetHash = targetParts.length > 1 ? '#' + targetParts[1] : '';

            // If it's an anchor to the current page, skip page transition
            if (targetPath === currentPath && targetHash !== '') {
                return; // Let default browser action update the hash
            }

            // Ignore dropdown toggles on mobile so they can open the menu instead of navigating
            if (window.innerWidth <= 768 && this.parentElement.classList.contains('dropdown')) {
                return;
            }
            
            e.preventDefault();
            document.body.classList.remove('page-loaded');
            document.body.classList.add('page-leaving');
            
            setTimeout(() => {
                window.location.href = target;
            }, 300);
        });
    });

    // 4. Custom Lazy Loading for background images or older browsers
    const lazyImages = document.querySelectorAll('.lazyload');
    
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const image = entry.target;
                    // If it's a data-src approach, swap it here. For now just adding loaded class.
                    image.classList.add('loaded');
                    imageObserver.unobserve(image);
                }
            });
        });

        lazyImages.forEach(img => {
            imageObserver.observe(img);
        });
    }

    // 6. Contact Form Validation (progressive enhancement)
    const contactForm = document.getElementById('contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            let isValid = true;

            // Only the visible fields take part; the honeypot is left alone.
            const inputs = contactForm.querySelectorAll('.form-group input, .form-group textarea');

            inputs.forEach(input => {
                const group = input.closest('.form-group');
                if (!input.value.trim()) {
                    group.classList.add('error');
                    isValid = false;
                    // Remove error class after animation completes so it can re-trigger
                    setTimeout(() => group.classList.remove('error'), 400);
                } else {
                    group.classList.remove('error');
                }
            });

            // Invalid input: stop the submit so the inline errors are visible.
            if (!isValid) {
                e.preventDefault();
                return;
            }

            // Valid input: show a loading state and let the native POST continue,
            // which keeps the form working with JavaScript disabled.
            const submitBtn = document.getElementById('submit-btn');
            submitBtn.classList.add('loading');
            submitBtn.disabled = true;
        });

        // Remove error state on input
        contactForm.addEventListener('input', (e) => {
            if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA') {
                const group = e.target.closest('.form-group');
                if (group) {
                    group.classList.remove('error');
                }
            }
        });
    }

});
