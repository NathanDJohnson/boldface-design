/**
 * Hero Block - Background Video Handler
 * 
 * Handles loading and displaying background videos in hero blocks.
 * The video replaces the background image once it's loaded.
 */

(function() {
	'use strict';

	function initHeroVideo() {
        const heroBlocks = document.querySelectorAll('.hero-block');

        heroBlocks.forEach(function(heroBlock) {
            const video = heroBlock.querySelector('.hero-video');
            if (!video) return;

            // Listen for the 'playing' event
            // 'canplay' triggers when enough is buffered, 
            // 'playing' triggers when the first frame actually hits the screen.
            video.addEventListener('playing', function() {
                // Remove the opacity-0 class and let Tailwind's transition-opacity take over
                video.classList.remove('opacity-0');
                video.classList.add('opacity-100');
                
                // Slightly dim or hide the poster image underneath to save GPU resources
                const poster = heroBlock.querySelector('img.absolute');
                if (poster) {
                    poster.style.transition = 'opacity 2s ease';
                    poster.style.opacity = '0.5';
                }
            }, { once: true });

            // Data Saver / Battery Check
            // If the user has "Save Data" on, don't force a 12.9MB download
            if (navigator.connection && navigator.connection.saveData) {
                video.remove(); 
                return;
            }

            // Graceful Error Handling
            video.addEventListener('error', function() {
                video.remove();
            });

            // Emergency Timeout (5s for that 12MB file)
            setTimeout(function() {
                if (video.paused) {
                    video.classList.remove('opacity-0');
                    video.classList.add('opacity-100');
                }
            }, 5000);
        });
    }

	// Initialize when DOM is ready
	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', initHeroVideo);
	} else {
		initHeroVideo();
	}

	// Re-initialize if new hero blocks are added dynamically (e.g., AJAX)
	if (window.MutationObserver) {
		const observer = new MutationObserver(function(mutations) {
			mutations.forEach(function(mutation) {
				if (mutation.addedNodes.length) {
					mutation.addedNodes.forEach(function(node) {
						if (node.nodeType === 1 && node.classList && node.classList.contains('hero-block')) {
							initHeroVideo();
						}
					});
				}
			});
		});

		observer.observe(document.body, {
			childList: true,
			subtree: true
		});
	}
})();
