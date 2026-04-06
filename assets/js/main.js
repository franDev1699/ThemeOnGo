document.addEventListener('DOMContentLoaded', () => {
    const navbar = document.getElementById('mainNavbar');

    const handleScroll = () => {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    };

    handleScroll();
    window.addEventListener('scroll', handleScroll);

    const revealElements = document.querySelectorAll('.reveal-up, .reveal-left, .reveal-right');

    const revealOptions = {
        threshold: 0.15,
        rootMargin: "0px 0px -50px 0px"
    };

    const revealObserver = new IntersectionObserver(function (entries, observer) {
        entries.forEach(entry => {
            if (!entry.isIntersecting) {
                return;
            }

            const delay = entry.target.getAttribute('data-delay');
            if (delay) {
                setTimeout(() => {
                    entry.target.classList.add('active');
                }, parseInt(delay));
            } else {
                entry.target.classList.add('active');
            }

            observer.unobserve(entry.target);
        });
    }, revealOptions);

    revealElements.forEach(el => {
        revealObserver.observe(el);
    });

    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();

            const targetId = this.getAttribute('href');
            if (targetId === '#') return;

            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                const navbarToggler = document.querySelector('.navbar-toggler');
                const navbarCollapse = document.querySelector('.navbar-collapse');
                if (navbarCollapse.classList.contains('show')) {
                    navbarToggler.click();
                }

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

    const contactForm = document.querySelector('.contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const btn = contactForm.querySelector('button[type="submit"]');
            const originalText = btn.innerHTML;

            btn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin me-2"></i> Sending...';
            btn.disabled = true;

            setTimeout(() => {
                btn.innerHTML = '<i class="fa-solid fa-check me-2"></i> Request Sent!';
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

    const parallaxContainers = document.querySelectorAll('.parallax-container');

    parallaxContainers.forEach(container => {
        const elements = container.querySelectorAll('.parallax-element');

        container.addEventListener('mousemove', (e) => {
            const rect = container.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            const centerX = rect.width / 2;
            const centerY = rect.height / 2;

            const offsetX = (x - centerX) / centerX;
            const offsetY = (y - centerY) / centerY;

            elements.forEach(el => {
                const speed = parseFloat(el.getAttribute('data-speed')) || 0.05;
                const moveX = offsetX * speed * 100;
                const moveY = offsetY * speed * 100;

                const currentTransform = getComputedStyle(el).transform;
                const matrix = currentTransform !== 'none' ? currentTransform : '';

                el.style.transform = `translate(${moveX}px, ${moveY}px)`;
            });
        });

        container.addEventListener('mouseleave', () => {
            elements.forEach(el => {
                el.style.transform = `translate(0px, 0px)`;
            });
        });
    });
});
