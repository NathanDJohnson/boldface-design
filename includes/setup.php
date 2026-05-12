<?php
/**
 * Theme Setup
 * Core theme setup, features, and initialization
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Setup theme features
 * - Editor color palette for consistent block styling
 * - Editor font sizes for consistent typography
 * - Dynamic supports from config for flexibility in enabling features like post-thumbnails, custom-logo, etc.
 * - Additional theme supports can be added as needed
 */
function boldface_design_setup() {
	// Add support for block palette
	add_theme_support( 'editor-color-palette', array(
		array( 'name' => 'Primary', 'slug' => 'primary', 'color' => '#0073aa' ),
		array( 'name' => 'Secondary', 'slug' => 'secondary', 'color' => '#005a87' ),
		array( 'name' => 'Light Gray', 'slug' => 'light-gray', 'color' => '#f5f5f5' ),
		array( 'name' => 'Dark Gray', 'slug' => 'dark-gray', 'color' => '#333' ),
		array( 'name' => 'White', 'slug' => 'white', 'color' => '#fff' ),
	) );

	// Add support for font sizes
	add_theme_support( 'editor-font-sizes', array(
		array( 'name' => 'Small', 'slug' => 'small', 'size' => 14 ),
		array( 'name' => 'Normal', 'slug' => 'normal', 'size' => 16 ),
		array( 'name' => 'Large', 'slug' => 'large', 'size' => 20 ),
		array( 'name' => 'Extra Large', 'slug' => 'extra-large', 'size' => 28 ),
	) );

	// Dynamic supports from config
	$supports = boldface_design_get_config_value( 'supports' );
	if ( is_array( $supports ) ) {
		foreach ( $supports as $key => $feature ) {
			if( is_array( $feature ) ) {
				add_theme_support( $key, $feature );
			} else {
				add_theme_support( $feature );
			}
		}
	}
}
add_action( 'after_setup_theme', 'boldface_design_setup' );

/**
 * Register navigation menus
 * Loads menu locations defined in the theme configuration, allowing for flexible menu management
 * Menu locations can be defined in the theme config file (e.g., 'primary', 'footer') and will be available in the WordPress admin for menu assignment
 */
function boldface_register_nav_menus() {
	register_nav_menus( boldface_design_get_config_value( 'menus' ) );
}
add_action( 'init', 'boldface_register_nav_menus' );
