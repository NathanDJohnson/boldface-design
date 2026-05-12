<?php
/**
 * Custom Post Types & Taxonomies
 * Register custom post types and taxonomies from theme configuration
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register custom post types
 * Loads post type definitions from the theme configuration, allowing for flexible post type management
 * This function ensures that all post types are registered on the 'init' hook
 */
function boldface_design_register_custom_post_types() {
	$post_types = boldface_design_get_config_value( 'post_types' );
	if ( is_array( $post_types ) ) {
		foreach ( $post_types as $post_type ) {
			register_post_type( $post_type['slug'], array(
				'labels' => array(
					'name'          => $post_type['plural_name'],
					'singular_name' => $post_type['singular_name'] ?? $post_type['plural_name'],
				),
				'public'        => $post_type['public'] ?? true,
				'publicly_queryable' => $post_type['publicly_queryable'] ?? true,
				'supports'      => $post_type['supports'] ?? array( 'title', 'editor', 'thumbnail' ),
				'rewrite'       => $post_type['rewrite'] ?? array( 'slug' => $post_type['slug'] ),
				'show_in_rest'  => $post_type['show_in_rest'] ?? true,
				'has_archive'   => $post_type['has_archive'] ?? false,
				'menu_position' => $post_type['menu_position'] ?? 20,
				'menu_icon'     => $post_type['menu_icon'] ?? 'dashicons-admin-post',
			) );
		}
	}
}
add_action( 'init', 'boldface_design_register_custom_post_types', 5 );

/**
 * Register custom taxonomies
 * Loads taxonomy definitions from the theme configuration, allowing for flexible taxonomy management
 * This function ensures that all taxonomies are registered on the 'init' hook
 */
function boldface_design_register_custom_taxonomies() {
	$taxonomies = boldface_design_get_config_value( 'taxonomies' );
	if ( is_array( $taxonomies ) ) {
		foreach ( $taxonomies as $taxonomy ) {
			register_taxonomy( $taxonomy['slug'], $taxonomy['post_types'] ?? array(), array(
				'labels' => array(
					'name'          => $taxonomy['plural_name'],
					'singular_name' => $taxonomy['singular_name'] ?? $taxonomy['plural_name'],
				),
				'public'       => $taxonomy['public'] ?? true,
				'show_in_rest' => $taxonomy['show_in_rest'] ?? true,
				'rewrite'      => $taxonomy['rewrite'] ?? array( 'slug' => $taxonomy['slug'] ),
				'hierarchical' => $taxonomy['hierarchical'] ?? false,
			) );
		}
	}
}
add_action( 'init', 'boldface_design_register_custom_taxonomies', 6 );
