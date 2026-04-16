/**
 * Hero Block - High Performance Video Loader
 * 
 * Handles dynamic injection of video sources to prevent 12MB payloads
 * and ensures visibility on iOS Low Power Mode.
 */
(function() {
	'use strict';

	const initHeroVideos = () => {
		const heroVideos = document.querySelectorAll('.hero-video[data-webm]');
		
		heroVideos.forEach(video => {
			// Connection Check: Gating for slow speeds or Data Saver
			const conn = navigator.connection || navigator.mozConnection || navigator.webkitConnection;
			const isSlow = conn && (conn.saveData || ['slow-2g', '2g', '3g'].includes(conn.effectiveType));

			// Safety Reveal: Show the poster/video container after 2s no matter what
			const revealTimeout = setTimeout(() => {
				video.classList.replace('opacity-0', 'opacity-100');
			}, 2000);

			if (isSlow) {
				video.classList.replace('opacity-0', 'opacity-100');
				return; // Exit early: Don't fetch video files on slow connections
			}

			// Inject Sources: Prevents the browser pre-parser from "double-dipping"
			const webmSrc = video.dataset.webm;
			const mp4Src = video.dataset.mp4;

			if (webmSrc) {
				const s = document.createElement('source');
				s.src = webmSrc;
				s.type = 'video/webm';
				video.appendChild(s);
			}

			if (mp4Src) {
				const s = document.createElement('source');
				s.src = mp4Src;
				s.type = 'video/mp4';
				video.appendChild(s);
			}

			// Load and Play Logic
			video.load();

			// The 'playing' event is the most reliable "visual" start point
			video.addEventListener('playing', () => {
				clearTimeout(revealTimeout);
				video.classList.replace('opacity-0', 'opacity-100');
			}, { once: true });

			// Handle iOS "Low Power Mode" or Autoplay blocks
			video.play().catch(() => {
				clearTimeout(revealTimeout);
				video.classList.replace('opacity-0', 'opacity-100');
				console.log('Autoplay blocked: Showing poster fallback.');
			});
		});
	};

	// Run on load
	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', initHeroVideos);
	} else {
		initHeroVideos();
	}
})();