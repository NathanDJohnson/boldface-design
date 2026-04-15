<?php
/**
 * Theme Configuration
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Theme configuration array
 */
return array(
	'name'           => __( 'Boldface Design', 'boldface-design' ),
	'slug'           => 'boldface-design',
	'block_category' =>  'boldface-blocks',
	'block_name'     => __( 'Boldface Design Block', 'boldface-design' ),
	'description'    => __( 'A custom WordPress theme built with ACF Pro blocks', 'boldface-design' ),
	'version'        => '1.0.0',
	'author'         => __( 'Boldface Design', 'boldface-design' ),
	'author_url'     => 'https://boldface.local',
	'theme_url'      => 'https://boldface.local',
	'text_domain'    => 'boldface-design',
	'domain_path'    => '/languages',
	'requires_php'   => '7.4',
	'requires_wp'    => '5.9',
	'requires_acf'   => true,

	/**
	 * Theme features
	 */
	'supports' => array(
		'responsive-embeds',
		'post-thumbnails',
		'editor-styles',
		'responsive-embeds',
		'custom-logo',
		'title-tag',
		'html5' => array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ),
	),

	/**
	 * Custom post types
	 */
	'post_types' => array(
		array(
			'slug'          => 'case-studies',
			'singular_name' => 'Case Study',
			'plural_name'   => 'Case Studies',
			'public'        => true,
			'publicly_queryable' => true,
			'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
			'rewrite'       => array( 'slug' => 'case-studies' ),
			'show_in_rest'  => true,
			// 'has_archive'   => true,
			'menu_position' => 20,
			'menu_icon'     => 'dashicons-portfolio',
		),
		array(
			'slug'          => 'project',
			'singular_name' => 'Project',
			'plural_name'   => 'Projects',
			'public'        => true,
			'publicly_queryable' => true,
			'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
			'rewrite'       => array( 'slug' => 'project' ),
			'show_in_rest'  => true,
			'menu_position' => 21,
			'menu_icon'     => 'dashicons-images-alt2',
		),
	),

	/**
	 * Custom taxonomies
	 */
	'taxonomies' => array(
		array(
			'slug'         => 'skills',
			'singular_name' => 'Skill',
			'plural_name'  => 'Skills',
			'post_types'   => array( 'project' ),
			'public'       => true,
			'show_in_rest' => true,
			'rewrite'      => array( 'slug' => 'skills' ),
		),
	),

	/**
	 * Menu locations
	 */
	'menus' => [
		'primary' => 'Primary Menu',
		'footer'  => 'Footer Menu',
	],

	/**
	 * Image sizes
	 */
	'image_sizes'    => array(
		'hero-image'      => array(
			'width'  => 1920,
			'height' => 600,
			'crop'   => true,
		),
		'feature-image'   => array(
			'width'  => 400,
			'height' => 300,
			'crop'   => true,
		),
		'thumbnail-small' => array(
			'width'  => 150,
			'height' => 150,
			'crop'   => true,
		),
	),

	/**
	 * Color palette
	 */
	'colors'         => array(
		'primary'     => '#0073aa',
		'secondary'   => '#005a87',
		'success'     => '#28a745',
		'danger'      => '#dc3545',
		'warning'     => '#ffc107',
		'info'        => '#17a2b8',
		'light'       => '#f5f5f5',
		'dark'        => '#333333',
		'white'       => '#ffffff',
	),

	/**
	 * Typography settings
	 */
	'typography'     => array(
		'primary_font'   => '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif',
		'secondary_font' => 'Georgia, "Times New Roman", serif',
	),

	/**
	 * Widget areas / Sidebars
	 */
	'sidebars'       => array(
		array(
			'name'          => 'Primary Sidebar',
			'id'            => 'primary-sidebar',
			'description'   => 'Main sidebar',
		),
		array(
			'name'          => 'Footer',
			'id'            => 'footer-1',
			'description'   => 'Footer widget area',
		),
	),
);
