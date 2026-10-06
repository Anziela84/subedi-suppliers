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

    var siteHeader = document.getElementById('siteHeader');
    if (siteHeader) {
        var onScroll = function () { siteHeader.classList.toggle('is-scrolled', window.scrollY > 24); };
        onScroll();
        window.addEventListener('scroll', onScroll, { passive: true });
    }

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
        if (window.innerWidth > 900) closeMobileNav();
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeMobileNav();
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

    // About: scroll story
    var chaptersSection = document.querySelector('.about-chapters');
    if (chaptersSection && 'IntersectionObserver' in window) {
        chaptersSection.classList.add('is-enhanced');
        var chapters = chaptersSection.querySelectorAll('.about-chapter');
        var slides = chaptersSection.querySelectorAll('.about-chapters-slide');
        var chapterObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (!entry.isIntersecting) return;
                var idx = entry.target.getAttribute('data-chapter');
                chapters.forEach(function (c) { c.classList.toggle('is-active', c.getAttribute('data-chapter') === idx); });
                slides.forEach(function (s) { s.classList.toggle('is-active', s.getAttribute('data-chapter') === idx); });
            });
        }, { rootMargin: '-45% 0px -45% 0px', threshold: 0 });
        chapters.forEach(function (c) { chapterObserver.observe(c); });
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

    // Product detail gallery
    var prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var galleries = document.querySelectorAll('[data-gallery]');
    galleries.forEach(function (gallery) {
        var mainImage = gallery.querySelector('.product-detail-main-image');
        var thumbs = gallery.querySelectorAll('.product-detail-thumb');
        var prevBtn = gallery.querySelector('.product-detail-main-prev');
        var nextBtn = gallery.querySelector('.product-detail-main-next');
        var counter = gallery.querySelector('.product-detail-main-counter');
        var total = parseInt(mainImage.getAttribute('data-total') || '1', 10);
        var current = 0;

        function showImage(index, loop) {
            if (loop) {
                if (index < 0) index = total - 1;
                if (index >= total) index = 0;
            } else {
                index = Math.max(0, Math.min(index, total - 1));
            }

            current = index;
            if (prefersReducedMotion) {
                mainImage.style.opacity = '1';
                mainImage.src = mainImage.src;
            } else {
                mainImage.style.opacity = '0';
                setTimeout(function () {
                    mainImage.src = mainImage.src;
                    mainImage.style.opacity = '1';
                }, 150);
            }

            thumbs.forEach(function (thumb, i) {
                thumb.classList.toggle('is-active', i === current);
            });

            if (counter) {
                counter.textContent = '— ' + (current + 1) + ' / ' + total;
            }
        }

        thumbs.forEach(function (thumb) {
            thumb.addEventListener('click', function () {
                showImage(parseInt(thumb.getAttribute('data-index') || '0', 10), false);
            });
        });

        if (prevBtn) {
            prevBtn.addEventListener('click', function () {
                showImage(current - 1, true);
            });
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', function () {
                showImage(current + 1, true);
            });
        }

        gallery.addEventListener('keydown', function (e) {
            if (e.key === 'ArrowLeft') {
                showImage(current - 1, true);
            } else if (e.key === 'ArrowRight') {
                showImage(current + 1, true);
            }
        });
    });

    // Copy link button
    var copyBtn = document.getElementById('copyLinkBtn');
    var copyTooltip = document.getElementById('copyTooltip');
    if (copyBtn && copyTooltip) {
        copyBtn.addEventListener('click', function () {
            navigator.clipboard.writeText(window.location.href).then(function () {
                copyTooltip.classList.add('is-visible');
                setTimeout(function () {
                    copyTooltip.classList.remove('is-visible');
                }, 1500);
            });
        });
    }

    // Related products scroll
    var prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var relatedTracks = document.querySelectorAll('.product-detail-related-track');
    relatedTracks.forEach(function (track) {
        var prev = track.parentElement.querySelector('.product-detail-related-prev');
        var next = track.parentElement.querySelector('.product-detail-related-next');

        function updateArrows() {
            if (!prev || !next) return;
            var canScroll = track.scrollWidth > track.clientWidth + 1;
            prev.style.display = canScroll ? '' : 'none';
            next.style.display = canScroll ? '' : 'none';
        }

        if (prev) {
            prev.addEventListener('click', function () {
                var card = track.querySelector('.product-detail-related-card');
                if (card) {
                    var gap = 20;
                    var amount = (card.offsetWidth + gap) * (track.dataset.cardsPerRow || 1);
                    track.scrollBy({ left: -amount, behavior: prefersReducedMotion ? 'auto' : 'smooth' });
                }
            });
        }

        if (next) {
            next.addEventListener('click', function () {
                var card = track.querySelector('.product-detail-related-card');
                if (card) {
                    var gap = 20;
                    var amount = (card.offsetWidth + gap) * (track.dataset.cardsPerRow || 1);
                    track.scrollBy({ left: amount, behavior: prefersReducedMotion ? 'auto' : 'smooth' });
                }
            });
        }

        window.addEventListener('resize', updateArrows);
        updateArrows();
    });
});
