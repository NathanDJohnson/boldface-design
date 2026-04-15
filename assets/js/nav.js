(function(){
    // Only run on the homepage
    if (!document.body.classList.contains('is-front-page')) return;

    const header = document.getElementById('masthead');
    if (!header) return;

    const firstSection = document.querySelector('section:first-of-type');
    if (!firstSection) return;

    // Place the header after the first section
    firstSection.after(header);
    // header.style.display = 'block';

    // Create the placeholder once; we'll insert/remove it as needed
    const placeholder = document.createElement('div');
    placeholder.setAttribute('aria-hidden', 'true');
    placeholder.style.display = 'none';

    const portfolioLink = document.getElementById('portfolio-link');
    if (portfolioLink) {
        portfolioLink.style.opacity = '0';
    }

    let isSticky = false;

    function update() {
        const headerTop = header.getBoundingClientRect().top;

        if (!isSticky && headerTop <= 0) {
            const height = header.offsetHeight;
            const width = header.offsetWidth;

            placeholder.style.display = 'block';
            placeholder.style.height = height + 'px';
            placeholder.style.width = width + 'px';

            header.insertAdjacentElement('afterend', placeholder);

            header.classList.add('sticky-active');
            isSticky = true;

            portfolioLink.style.opacity = '1';

        } else if (isSticky) {
            const placeholderTop = placeholder.getBoundingClientRect().top;

            if (placeholderTop > 0) {
                header.classList.remove('sticky-active');
                placeholder.style.display = 'none';
                placeholder.remove();
                isSticky = false;

                portfolioLink.style.opacity = '0';
            }
        }
    }

    window.addEventListener('scroll', update, { passive: true });

    update();
})();