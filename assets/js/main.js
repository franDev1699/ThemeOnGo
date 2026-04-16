/**
 * ThemeOnGo — Main JS
 * Handles: navbar scroll, scroll-reveal animations, count-up, parallax, smooth scroll
 */
(function () {
    'use strict';

    // ANIMATION SELECTOR — all reveal classes
    const REVEAL_SELECTOR = [
        '.reveal-up',
        '.reveal-down',
        '.reveal-left',
        '.reveal-right',
        '.reveal-fade',
        '.reveal-zoom',
        '.reveal-spin',
    ].join(', ');

    // DETECT ELEMENTOR EDITOR — skip animations inside editor
    const isElementorEditor = () =>
        document.body.classList.contains('elementor-editor-active') ||
        typeof window.elementorFrontend !== 'undefined' &&
        window.elementorFrontend.isEditMode &&
        window.elementorFrontend.isEditMode();

    // SCROLL REVEAL CORE
    let revealObserver = null;

    function activateElement(el) {
        const delay = parseInt(el.getAttribute('data-delay') || '0', 10);
        if (delay > 0) {
            setTimeout(() => el.classList.add('active'), delay);
        } else {
            el.classList.add('active');
        }
    }

    function observeElements(elements) {
        if (!revealObserver) return;
        elements.forEach(el => {
            // Skip if already activated
            if (el.classList.contains('active')) return;
            revealObserver.observe(el);
        });
    }

    function initRevealObserver() {
        // In the Elementor editor, immediately make all animated elements visible
        if (isElementorEditor()) {
            document.querySelectorAll(REVEAL_SELECTOR).forEach(el => el.classList.add('active'));
            return;
        }

        revealObserver = new IntersectionObserver(function (entries, observer) {
            entries.forEach(entry => {
                if (!entry.isIntersecting) return;
                activateElement(entry.target);
                observer.unobserve(entry.target);
            });
        }, {
            threshold: 0.1,          // fire when 10% of element is visible
            rootMargin: '0px 0px -40px 0px'  // account for fixed header
        });

        observeElements(document.querySelectorAll(REVEAL_SELECTOR));
    }

    // MUTATION OBSERVER — picks up Elementor lazy-rendered content
    function watchForNewAnimatedElements() {
        if (!('MutationObserver' in window)) return;

        const mutationObserver = new MutationObserver(mutations => {
            mutations.forEach(mutation => {
                mutation.addedNodes.forEach(node => {
                    if (node.nodeType !== 1) return; // only elements

                    // Check the node itself
                    if (node.matches && node.matches(REVEAL_SELECTOR)) {
                        if (!isElementorEditor()) observeElements([node]);
                        else node.classList.add('active');
                    }

                    // Check descendants
                    const children = node.querySelectorAll ? node.querySelectorAll(REVEAL_SELECTOR) : [];
                    if (children.length) {
                        if (!isElementorEditor()) observeElements(Array.from(children));
                        else children.forEach(el => el.classList.add('active'));
                    }
                });
            });
        });

        mutationObserver.observe(document.body, {
            childList: true,
            subtree: true,
        });
    }

    // COUNT-UP ANIMATION
    function initCountUp() {
        const els = document.querySelectorAll('.count-up[data-target]');
        if (!els.length) return;

        const observer = new IntersectionObserver(function (entries, obs) {
            entries.forEach(entry => {
                if (!entry.isIntersecting) return;
                const el = entry.target;
                const target = parseInt(el.getAttribute('data-target'), 10);
                const suffix = el.getAttribute('data-suffix') || '';
                const duration = parseInt(el.getAttribute('data-duration') || '1500', 10);
                const step = Math.ceil(target / (duration / 16));
                let current = 0;
                const timer = setInterval(() => {
                    current = Math.min(current + step, target);
                    el.textContent = current.toLocaleString() + suffix;
                    if (current >= target) clearInterval(timer);
                }, 16);
                obs.unobserve(el);
            });
        }, { threshold: 0.5 });

        els.forEach(el => observer.observe(el));
    }

    // NAVBAR SCROLL EFFECT
    function initNavbar() {
        const navbar = document.getElementById('mainNavbar');
        if (!navbar) return;

        const handleScroll = () => {
            navbar.classList.toggle('scrolled', window.scrollY > 50);
        };

        handleScroll(); // run on load
        window.addEventListener('scroll', handleScroll, { passive: true });
    }

    // SMOOTH SCROLL for anchor links
    function initSmoothScroll() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const targetId = this.getAttribute('href');
                if (!targetId || targetId === '#') return;

                const targetEl = document.querySelector(targetId);
                if (!targetEl) return;

                e.preventDefault();

                // Close mobile menu if open
                const collapse = document.querySelector('.navbar-collapse');
                if (collapse && collapse.classList.contains('show')) {
                    document.querySelector('.navbar-toggler')?.click();
                }

                const offset = 80;
                const top = targetEl.getBoundingClientRect().top + window.pageYOffset - offset;
                window.scrollTo({ top, behavior: 'smooth' });
            });
        });
    }

    // PARALLAX (mouse-move on .parallax-container)
    function initParallax() {
        document.querySelectorAll('.parallax-container').forEach(container => {
            const els = container.querySelectorAll('.parallax-element');
            if (!els.length) return;

            container.addEventListener('mousemove', (e) => {
                const rect = container.getBoundingClientRect();
                const offsetX = ((e.clientX - rect.left) / rect.width - 0.5) * 2;
                const offsetY = ((e.clientY - rect.top) / rect.height - 0.5) * 2;

                els.forEach(el => {
                    const speed = parseFloat(el.getAttribute('data-speed') || '0.05');
                    el.style.transform = `translate(${offsetX * speed * 100}px, ${offsetY * speed * 100}px)`;
                });
            });

            container.addEventListener('mouseleave', () => {
                els.forEach(el => { el.style.transform = 'translate(0,0)'; });
            });
        });
    }

    // CONTACT FORM (demo handler)
    function initContactForm() {
        const form = document.querySelector('.contact-form');
        if (!form) return;

        form.addEventListener('submit', (e) => {
            e.preventDefault();
            const btn = form.querySelector('button[type="submit"]');
            const originalHTML = btn.innerHTML;

            btn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin me-2"></i> Enviando...';
            btn.disabled = true;

            setTimeout(() => {
                btn.innerHTML = '<i class="fa-solid fa-check me-2"></i> ¡Solicitud Enviada!';
                btn.classList.replace('btn-dark-green', 'btn-success');
                form.reset();

                setTimeout(() => {
                    btn.innerHTML = originalHTML;
                    btn.classList.replace('btn-success', 'btn-dark-green');
                    btn.disabled = false;
                }, 3000);
            }, 1500);
        });
    }

    // BOOT — run on DOMContentLoaded, then again after Elementor
    function boot() {
        initNavbar();
        initSmoothScroll();
        initParallax();
        initContactForm();
        initRevealObserver();
        initCountUp();
        watchForNewAnimatedElements();
    }

    // Primary: wait for DOM
    document.addEventListener('DOMContentLoaded', boot);

    // Fallback for Elementor frontend: re-init after Elementor loads
    window.addEventListener('elementor/frontend/init', () => {
        // Re-observe any elements Elementor added after DOMContentLoaded
        if (revealObserver) {
            observeElements(Array.from(document.querySelectorAll(REVEAL_SELECTOR)));
        }
        initCountUp();
        initParallax();
    });

})();
