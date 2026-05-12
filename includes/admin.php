<?php
/**
 * Admin Functions
 * Admin-specific functionality and styling
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue admin styles (Editor/Dashboard)
 * Only load on post editing screens to avoid unnecessary loading in other admin areas
 * This stylesheet can be used to style the block editor and admin pages to match the front-end
 * 
 * @param string $hook The current admin page hook
 */
function boldface_design_enqueue_admin_assets( $hook ) {
	if ( 'post.php' !== $hook && 'post-new.php' !== $hook ) {
		return;
	}
	wp_enqueue_style(
		'boldface-design-admin',
		BOLDFACE_DESIGN_URI . '/assets/css/style.css',
		array(),
		BOLDFACE_DESIGN_VERSION
	);
}
add_action( 'admin_enqueue_scripts', 'boldface_design_enqueue_admin_assets' );
