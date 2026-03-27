document.addEventListener('DOMContentLoaded', () => {

    // --- Navbar Scroll Effect ---
    const navbar = document.getElementById('mainNavbar');

    const handleScroll = () => {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    };

    // Initial check
    handleScroll();

    // Listen for scroll
    window.addEventListener('scroll', handleScroll);

    // --- Scroll Reveal Animations (Intersection Observer) ---
    const revealElements = document.querySelectorAll('.reveal-up, .reveal-left, .reveal-right');

    const revealOptions = {
        threshold: 0.15, // Trigger when 15% of element is visible
        rootMargin: "0px 0px -50px 0px"
    };

    const revealObserver = new IntersectionObserver(function (entries, observer) {
        entries.forEach(entry => {
            if (!entry.isIntersecting) {
                return;
            }

            // Add slight delay if data-delay attribute exists
            const delay = entry.target.getAttribute('data-delay');
            if (delay) {
                setTimeout(() => {
                    entry.target.classList.add('active');
                }, parseInt(delay));
            } else {
                entry.target.classList.add('active');
            }

            // Stop observing once revealed
            observer.unobserve(entry.target);
        });
    }, revealOptions);

    revealElements.forEach(el => {
        revealObserver.observe(el);
    });

    // --- Smooth Scrolling for Anchor Links ---
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();

            const targetId = this.getAttribute('href');
            if (targetId === '#') return;

            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                // Close mobile menu if open
                const navbarToggler = document.querySelector('.navbar-toggler');
                const navbarCollapse = document.querySelector('.navbar-collapse');
                if (navbarCollapse.classList.contains('show')) {
                    navbarToggler.click();
                }

                // Calculate scroll position factoring in the fixed navbar height
                const headerOffset = 80;
                const elementPosition = targetElement.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: "smooth"
                });
            }
        });
    });

    // --- Form Submission Prevention (for Demo) ---
    const contactForm = document.querySelector('.contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const btn = contactForm.querySelector('button[type="submit"]');
            const originalText = btn.innerHTML;

            btn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin me-2"></i> Enviando...';
            btn.disabled = true;

            // Simulate API Call
            setTimeout(() => {
                btn.innerHTML = '<i class="fa-solid fa-check me-2"></i> ¡Solicitud Enviada!';
                btn.classList.replace('btn-dark-green', 'btn-success');
                contactForm.reset();

                setTimeout(() => {
                    btn.innerHTML = originalText;
                    btn.classList.replace('btn-success', 'btn-dark-green');
                    btn.disabled = false;
                }, 3000);
            }, 1500);
        });
    }

    // --- Interactive Mouse Parallax Effect ---
    const parallaxContainers = document.querySelectorAll('.parallax-container');

    parallaxContainers.forEach(container => {
        const elements = container.querySelectorAll('.parallax-element');

        container.addEventListener('mousemove', (e) => {
            // Get position of mouse relative to container
            const rect = container.getBoundingClientRect();
            const x = e.clientX - rect.left; // x position within the element.
            const y = e.clientY - rect.top;  // y position within the element.

            // Calculate center
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;

            // Calculate offset from center (-1 to 1)
            const offsetX = (x - centerX) / centerX;
            const offsetY = (y - centerY) / centerY;

            elements.forEach(el => {
                const speed = parseFloat(el.getAttribute('data-speed')) || 0.05;
                const moveX = offsetX * speed * 100; // max movement in px
                const moveY = offsetY * speed * 100;

                // Keep existing transforms if any (like from reveal animations)
                const currentTransform = getComputedStyle(el).transform;
                const matrix = currentTransform !== 'none' ? currentTransform : '';

                el.style.transform = `translate(${moveX}px, ${moveY}px)`;
            });
        });

        // Reset on mouse leave
        container.addEventListener('mouseleave', () => {
            elements.forEach(el => {
                el.style.transform = `translate(0px, 0px)`;
            });
        });
    });
});
