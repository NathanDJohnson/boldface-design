<?php
/**
 * Asset Enqueuing & CSS Utilities
 * Enqueue scripts, styles, and CSS utilities for the theme
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Check if the current page has a contact form block or a CTA block with form display mode
 * 
 * @return bool True if contact form or CTA form block is present
 */
function boldface_design_has_contact_form() {
	if ( ! is_singular() ) {
		return false;
	}

	$post = get_post();
	if ( ! $post || ! has_blocks( $post ) ) {
		return false;
	}

	$blocks = parse_blocks( $post->post_content );
	return boldface_design_check_contact_form_blocks( $blocks );
}

/**
 * Recursively check for contact-form or CTA form blocks
 * 
 * @param array $blocks The parsed blocks to search
 * @return bool True if contact form block or CTA with form mode is found
 */
function boldface_design_check_contact_form_blocks( $blocks ) {
	foreach ( $blocks as $block ) {
		if ( ! isset( $block['blockName'] ) ) {
			continue;
		}

		// Check for contact-form block
		if ( 'boldface-design/contact-form' === $block['blockName'] ) {
			return true;
		}

		// Check for CTA block with form display mode
		if ( 'boldface-design/cta' === $block['blockName'] ) {
			$display_mode = $block['attrs']['data']['display_mode'] ?? 'buttons';
			if ( 'form' === $display_mode ) {
				return true;
			}
		}

		// Recursively check inner blocks
		if ( isset( $block['innerBlocks'] ) && ! empty( $block['innerBlocks'] ) ) {
			if ( boldface_design_check_contact_form_blocks( $block['innerBlocks'] ) ) {
				return true;
			}
		}
	}

	return false;
}

/**
 * Enqueue theme scripts
 * 
 * - Hero block script (hero.js) only on the front page
 * - Navigation script (nav.js) only on the front page
 * - Chameleon select script if contact form or CTA form block is present
 * - CSS is inlined in the head for better performance
 */
function boldface_design_enqueue_assets() {
	// ?? Is there a way to only load when the hero block contains a video background? Maybe we can add a class to the body when a hero block with video is present and target that class here? For now, we'll just load on the front page since that's the only place we have the hero block with video.
	if( is_front_page() ) {
		wp_enqueue_script(
			'boldface-design-hero',
			BOLDFACE_DESIGN_URI . '/assets/js/hero.js',
			[],
			BOLDFACE_DESIGN_VERSION,
			[ 'strategy' => 'defer', 'in_footer' => true ],
		);
	}

	// Enqueue chameleon select script if contact form or CTA form block is present
	if ( boldface_design_has_contact_form() ) {
		wp_enqueue_script(
			'boldface-design-contact',
			BOLDFACE_DESIGN_URI . '/assets/js/chameleon-select.min.js',
			[],
			BOLDFACE_DESIGN_VERSION,
			true
		);
	}

	// Only load the navigation script on the front page since that's the only place we have the sticky header for now. If we add the sticky header to other pages in the future, we can either load this script globally or add a body class and target that class here.
	if( is_front_page() ) {
		wp_enqueue_script(
			'boldface-design-main',
			BOLDFACE_DESIGN_URI . '/assets/js/nav.js',
			[],
			BOLDFACE_DESIGN_VERSION,
			[ 'strategy' => 'defer', 'in_footer' => true ],
		);
	}
}
add_action( 'wp_enqueue_scripts', 'boldface_design_enqueue_assets' );

/**
 * Minify CSS by removing comments, extra whitespace, and unnecessary characters
 * 
 * @param string $css The CSS to minify
 * @return string Minified CSS
 */
function boldface_design_minify_css( $css ) {
	// Remove comments
	$css = preg_replace( '!/\*[^*]*\*+(?:[^/*][^*]*\*+)*/!', '', $css );
	// Remove whitespace around special characters
	$css = preg_replace( '/\s*([{}:;,])\s*/', '$1', $css );
	// Remove extra whitespace
	$css = preg_replace( '/\s+/', ' ', $css );
	// Remove leading/trailing whitespace
	$css = trim( $css );
	return $css;
}

/**
 * Preload fonts for better performance
 */
add_action( 'wp_head', function() {
	?>
	<link rel="preload" href="/wp-content/themes/boldface-design/assets/fonts/calistoga-v18-latin-regular.woff2" as="font" type="font/woff2" crossorigin>
	<link rel="preload" href="/wp-content/themes/boldface-design/assets/fonts/montserrat-v31-latin-400.woff2" as="font" type="font/woff2" crossorigin>
	<link rel="preload" href="/wp-content/themes/boldface-design/assets/fonts/montserrat-v31-latin-500.woff2" as="font" type="font/woff2" crossorigin>
	<link rel="preload" href="/wp-content/themes/boldface-design/assets/fonts/montserrat-v31-latin-700.woff2" as="font" type="font/woff2" crossorigin>
	<?php
}, 1 );

/**
 * Inline minified CSS in the head for better performance
 */
add_action( 'wp_head', function() {
	$css_file = BOLDFACE_DESIGN_DIR . '/assets/css/style.css';
	
	if ( file_exists( $css_file ) ) {
		$css = file_get_contents( $css_file );
		$minified_css = boldface_design_minify_css( $css );
		echo '<style>' . $minified_css . '</style>' . "\n";
	}
});

/**
 * Disable responsive image srcset
 */
add_filter( 'wp_calculate_image_srcset', '__return_false' );

/**
 * Preload hero image on front page for better performance
 */
add_action( 'wp_head', function() {
	if ( ! is_front_page() ) return;
	?>
	<link rel="preload" href="https://boldfacedesign.com/wp-content/uploads/2026/03/hero-poster-scaled.jpg" as="image" type="image/jpeg" fetchpriority="high" media="(prefers-reduced-motion: no-preference)">
	<link rel="preload" href="https://boldfacedesign.com/wp-content/uploads/2026/05/hero-reduced-motion.jpg" as="image" type="image/jpeg" fetchpriority="high" media="(prefers-reduced-motion: reduce)">
	<?php
});

/**
 * Enqueue editor CSS on the block editor screen only
 */
add_action( 'enqueue_block_editor_assets', function() {
	wp_enqueue_style(
		'boldface-design-editor',
		BOLDFACE_DESIGN_URI . '/assets/css/editor.css',
		[],
		BOLDFACE_DESIGN_VERSION
	);
});
