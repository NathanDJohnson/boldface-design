<?php
/**
 * Ultimate WordPress Header/Footer Cleanup
 * Consistently removes Gutenberg bloat, Emojis, and unnecessary meta tags.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Clean up wp_head() and init hooks
 */
add_action( 'init', function() {
    // 1. Emojis
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', 'boldface_disable_emojis_tinymce' );
    add_filter( 'wp_resource_hints', 'boldface_disable_emojis_remove_dns_prefetch', 10, 2 );

    // 2. Generator, RSD, WLW, Shortlink
    remove_action( 'wp_head', 'wp_generator' );
    remove_action( 'wp_head', 'rsd_link' );
    remove_action( 'wp_head', 'wlwmanifest_link' );
    remove_action( 'wp_head', 'wp_shortlink_wp_head' );

    // 3. REST API & oEmbed discovery
    remove_action( 'wp_head', 'rest_output_link_wp_head' );
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
    remove_action( 'wp_head', 'wp_oembed_add_host_js' );
});

/**
 * Remove frontend styles (Block Library, Global Styles, Duotone)
 */
add_action( 'wp_enqueue_scripts', function() {
    // Dequeue standard block styles
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'classic-theme-styles' );
    wp_dequeue_style( 'global-styles' );
    wp_dequeue_style( 'wp-block-library-duotone' );

    // Prevent inline global styles from rendering
    remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
    remove_action( 'wp_footer', 'wp_enqueue_global_styles', 1 );
}, 100 );

/**
 * Specific Footer/SVG cleanup
 */
add_action( 'wp_footer', function() {
    wp_dequeue_style( 'core-block-supports-duotone' );
});

remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );
remove_action( 'in_admin_header', 'wp_global_styles_render_svg_filters' );

/**
 * Disable auto-sizes for images
 */
add_filter( 'wp_img_tag_add_auto_sizes', '__return_false' );

/**
 * Emoji Helper: TinyMCE
 */
function boldface_disable_emojis_tinymce( $plugins ) {
    return is_array( $plugins ) ? array_diff( $plugins, array( 'wpemoji' ) ) : array();
}

/**
 * Emoji Helper: DNS Prefetch
 */
function boldface_disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
    if ( 'dns-prefetch' === $relation_type ) {
        $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
        $urls = array_diff( $urls, array( $emoji_svg_url ) );
    }
    return $urls;
}

/**
 * Clean up wp_nav_menu markup by removing redundant IDs and Classes
 */

// Remove the ID attribute from menu items
add_filter('nav_menu_item_id', '__return_false', 10);

// Remove redundant classes, keeping only what's necessary
add_filter('nav_menu_css_class', function($classes, $item, $args, $depth) {
    // Whitelist: Only keep these classes
    $whitelist = [
        'md-hidden',
        'text-footer',
        'menu-item',
        'current-menu-item',
        'current-menu-ancestor',
        'current-menu-parent',
        'menu-item-has-children',
    ];

    // Filter the classes array
    $classes = array_intersect($classes, $whitelist);

    // Optional: If you want to add a base 'menu-item' class back in
    // $classes[] = 'menu-item';

    return $classes;
}, 10, 4);

// Remove the <span> inside menu links if you don't need them for styling
// Note: Your current HTML has <span class="text-footer">. 
// If you move that class to the <a> tag, you can use this:
add_filter('nav_menu_item_title', function($title, $item, $args, $depth) {
    return strip_tags($title);
}, 10, 4);