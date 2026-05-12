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
 * Inject GA4 tracking script into the footer if GA4_ID is defined
 */
add_action('wp_footer', function() {
	// GA4_ID should include G-
    if (defined('GA4_ID')) {
		$id = GA4_ID;
		?>
		<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $id; ?>"></script>
		<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		gtag('config', '<?php echo $id; ?>');
		</script>
        <?php
    }
}, 20);
