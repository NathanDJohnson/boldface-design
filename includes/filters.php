<?php
/**
 * WordPress Filters & Hooks
 * Custom filters and hooks for content customization
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Customize excerpt length and "read more" text
 * - Sets a custom excerpt length of 20 words for better control over content display
 * 
 * @param int $length The existing excerpt length (default is usually 55)
 * @return int Modified excerpt length
 */
function boldface_design_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'boldface_design_excerpt_length' );

/** 
 * Customize the "read more" text for excerpts
 * - Adds an ellipsis and a "Read More" link that directs to the full post
 * 
 * @param string $more The existing "read more" text (default is usually '...')
 * @return string Modified "read more" text with a link to the full post
 */
function boldface_design_excerpt_more( $more ) {
	return ' ... <a href="' . esc_url( get_permalink() ) . '">Read More</a>';
}
add_filter( 'excerpt_more', 'boldface_design_excerpt_more' );

/**
 * Allow SVG files to be uploaded as images
 *
 * @param array $mimes Allowed mime types
 * @return array Modified mime types
 */
function boldface_upload_svg_as_image( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter( 'upload_mimes', 'boldface_upload_svg_as_image' );

/**
 * Add custom body classes based on page context
 * - 'single-post' for single blog posts
 * - 'is-page' for all pages
 * - 'is-front-page' for the homepage
 * 
 * @param array $classes Existing body classes
 * @return array Modified body classes
 */
function boldface_body_class( $classes ) {
	$classes = [ 'boldface-design' ];
	if ( is_singular() ) $classes[] = 'single';
	if ( is_singular( 'post' ) ) $classes[] = 'single-post';
	if ( is_singular( 'project' ) ) $classes[] = 'single-project';
	if ( is_singular( 'case-studies' ) ) $classes[] = 'single-case-study';
	if ( is_front_page() ) $classes[] = 'is-front-page';

	if( is_singular( array( 'page', 'case-studies' ) ) ) {
		$classes[] = 'is-page';
	}
	return $classes;
}
add_filter( 'body_class', 'boldface_body_class' );

/**
 * Add custom post classes based on page context
 *
 * @param array $classes Existing post classes
 * @return array Modified post classes
 */
function boldface_post_class( $classes ) {
	if ( is_singular() ) $classes[] = 'container mx-auto';
	return $classes;
}
add_filter( 'post_class', 'boldface_post_class' );

/**
 * Fix SVG image dimensions when rendered via wp_get_attachment_image
 * 
 * Some SVGs may not have proper width/height attributes set, leading to display issues. This filter checks if the file is an SVG and attempts to extract dimensions from the file itself if the default dimensions are set to 1.
 * 
 * @param array $attr Attributes for the image tag
 * @param WP_Post $attachment The attachment post object
 * @param string|array $size The requested size of the image
 * @return array Modified attributes with correct dimensions for SVGs
 */
function boldface_fix_svg_attachment_dimensions( $attr, $attachment, $size ) {
    $file = get_attached_file( $attachment->ID );
    $pathinfo = pathinfo( $file );
    
    if ( isset( $pathinfo['extension'] ) && 'svg' === strtolower( $pathinfo['extension'] ) ) {
        // If the width/height are set to default 1s, extract the correct dimensions from the XML layout
        if ( isset( $attr['width'] ) && '1' === (string) $attr['width'] ) {
            if ( file_exists( $file ) ) {
                $svg = simplexml_load_file( $file );
                if ( $svg ) {
                    $attributes = $svg->attributes();
                    
                    if ( isset( $attributes->viewBox ) ) {
                        $viewbox = explode( ' ', (string) $attributes->viewBox );
                        if ( isset( $viewbox[2] ) && isset( $viewbox[3] ) ) {
                            $attr['width']  = (string) $viewbox[2];
                            $attr['height'] = (string) $viewbox[3];
                        }
                    } elseif ( isset( $attributes->width ) && isset( $attributes->height ) ) {
                        $attr['width']  = (string) $attributes->width;
                        $attr['height'] = (string) $attributes->height;
                    }
                }
            }
        }
    }
    return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'boldface_fix_svg_attachment_dimensions', 10, 3 );
