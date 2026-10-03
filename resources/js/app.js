document.addEventListener('DOMContentLoaded', function () {
    // Reveal on scroll
    if ('IntersectionObserver' in window) {
        var revealEls = document.querySelectorAll('[data-reveal]');
        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });

        revealEls.forEach(function (el) {
            observer.observe(el);
        });

        // Stagger children
        var staggerParents = document.querySelectorAll('[data-reveal-stagger]');
        staggerParents.forEach(function (parent) {
            var children = parent.querySelectorAll('[data-reveal]');
            children.forEach(function (child, index) {
                child.style.setProperty('--reveal-index', index);
            });
        });
    } else {
        document.querySelectorAll('[data-reveal]').forEach(function (el) {
            el.classList.add('is-visible');
        });
    }

    var navbarToggle = document.getElementById('navbarToggle');
    var navLinks = document.getElementById('navLinks');

    if (!navbarToggle || !navLinks) return;

    function closeMobileNav() {
        document.body.classList.remove('nav-is-open');
        navbarToggle.classList.remove('active');
        navbarToggle.setAttribute('aria-expanded', 'false');
        document.body.classList.remove('no-scroll');
    }

    navbarToggle.addEventListener('click', function () {
        var isOpen = document.body.classList.toggle('nav-is-open');
        navbarToggle.classList.toggle('active', isOpen);
        navbarToggle.setAttribute('aria-expanded', isOpen);
        document.body.classList.toggle('no-scroll', isOpen);
    });

    navLinks.querySelectorAll('a').forEach(function (link) {
        link.addEventListener('click', closeMobileNav);
    });

    window.addEventListener('resize', function () {
        if (window.innerWidth > 768) closeMobileNav();
    });

    // Submit button spinner
    var submitForms = document.querySelectorAll('.contact-form');
    submitForms.forEach(function (form) {
        form.addEventListener('submit', function () {
            var btn = form.querySelector('.submit-btn');
            if (!btn || btn.disabled) return;
            btn.disabled = true;
            btn.querySelector('.submit-text').textContent = 'Sending...';
            btn.querySelector('.submit-arrow').classList.add('hidden');
            btn.querySelector('.submit-spinner').classList.remove('hidden');
        });
    });

    // About story line grow on scroll
    var storyLine = document.querySelector('.about-story-line');
    if (storyLine && 'IntersectionObserver' in window) {
        var storyObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    storyObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.3 });
        storyObserver.observe(storyLine);
    } else if (storyLine) {
        storyLine.classList.add('is-visible');
    }

    // Stats count-up
    var statEls = document.querySelectorAll('.about-stat-value');
    if (statEls.length && 'IntersectionObserver' in window) {
        var counted = new Set();
        var statObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting && !counted.has(entry.target)) {
                    counted.add(entry.target);
                    var target = parseInt(entry.target.getAttribute('data-target'), 10);
                    if (isNaN(target)) return;
                    var duration = 1800;
                    var start = performance.now();
                    function step(timestamp) {
                        var progress = Math.min((timestamp - start) / duration, 1);
                        var eased = 1 - Math.pow(1 - progress, 3);
                        entry.target.textContent = Math.floor(eased * target).toLocaleString();
                        if (progress < 1) {
                            requestAnimationFrame(step);
                        } else {
                            entry.target.textContent = target.toLocaleString();
                        }
                    }
                    requestAnimationFrame(step);
                }
            });
        }, { threshold: 0.4 });
        statEls.forEach(function (el) {
            statObserver.observe(el);
        });
    }
});
