<?php
/**
 * Analytics & Tracking
 * Third-party analytics and tracking integration
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue Google Analytics tracking
 * Inject GA4 tracking script lazily upon real user interaction
 */
add_action('wp_footer', function() {
	if (defined('GA4_ID')) {
		$id = GA4_ID;
		?>
		<script>
		(function() {
			const ga4Id = '<?php echo esc_js($id); ?>';
			let ga4Loaded = false;

			function loadGA4() {
				if (ga4Loaded) return;
				ga4Loaded = true;

				// Create the external tracking script element
				const script = document.createElement('script');
				script.src = `https://www.googletagmanager.com/gtag/js?id=${ga4Id}`;
				script.async = true;
				document.head.appendChild(script);

				// Initialize the tracking data layer pipelines
				window.dataLayer = window.dataLayer || [];
				function gtag(){dataLayer.push(arguments);}
				gtag('js', new Date());
				gtag('config', ga4Id);

				// Clean up remaining event listeners once active
				removeListeners();
			}

			function removeListeners() {
				window.removeEventListener('scroll', loadGA4);
				window.removeEventListener('mousemove', loadGA4);
				window.removeEventListener('touchstart', loadGA4);
				document.removeEventListener('visibilitychange', loadGA4);
			}

			// Attach listeners to detect organic human interactions
			window.addEventListener('scroll', loadGA4, { passive: true });
			window.addEventListener('mousemove', loadGA4, { passive: true });
			window.addEventListener('touchstart', loadGA4, { passive: true });
			document.addEventListener('visibilitychange', loadGA4);
		})();
		</script>
		<?php
	}
}, 20);