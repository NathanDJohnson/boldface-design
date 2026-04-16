(function() {
    'use strict';
    if (!document.body.classList.contains('is-front-page')) return;

    const header = document.getElementById('masthead');
    const firstSection = document.querySelector('.hero-block');
    const portfolioLink = document.getElementById('portfolio-link');
    if (!header || !firstSection) return;

    /**
     * SENIOR FIX: Use ResizeObserver instead of offsetHeight/resize listeners.
     * This is asynchronous and prevents "Forced Reflow" penalties.
     */
    const ro = new ResizeObserver(entries => {
        for (let entry of entries) {
            // entry.contentRect.height is calculated off-main-thread
            const height = entry.contentRect.height;
            document.documentElement.style.setProperty('--header-height', `${height}px`);
        }
    });
    ro.observe(header);

    /**
     * Sticky Logic via Intersection Observer
     */
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (!entry.isIntersecting) {
                header.classList.add('sticky-active');
                if (portfolioLink) portfolioLink.style.opacity = '1';
            } else {
                header.classList.remove('sticky-active');
                if (portfolioLink) portfolioLink.style.opacity = '0';
            }
        });
    }, { 
        threshold: 0,
        rootMargin: '-10px 0px 0px 0px' 
    });

    observer.observe(firstSection);
})();