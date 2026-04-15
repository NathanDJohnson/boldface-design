<?php
/**
 * Archive Block Registration
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'acf_add_local_field_group' ) ) {
	return;
}

$post_type_choices = [
    'post' => 'Posts',
    'case-studies' => 'Case Studies',
];

acf_add_local_field_group( array(
	'key'                   => 'group_archive_block',
	'title'                 => esc_html__( 'Archive Block', 'boldface-design' ),
	'fields'                => array(
		...boldface_design_get_common_block_fields( 'archive' ),
		array(
			'key'               => 'field_archive_heading',
			'label'             => esc_html__( 'Heading', 'boldface-design' ),
			'name'              => 'heading',
			'type'              => 'text',
			'required'          => 0,
			'placeholder'       => esc_html__( 'e.g., Latest Projects', 'boldface-design' ),
		),
		array(
			'key'               => 'field_archive_content',
			'label'             => esc_html__( 'Content', 'boldface-design' ),
			'name'              => 'content',
			'type'              => 'wysiwyg',
			'required'          => 0,
			'toolbar'           => 'full',
			'media_upload'      => 1,
			'instructions'      => esc_html__( 'Optional content to display above the posts', 'boldface-design' ),
		),
		array(
			'key'               => 'field_archive_post_type',
			'label'             => esc_html__( 'Post Type', 'boldface-design' ),
			'name'              => 'post_type',
			'type'              => 'select',
			'required'          => 1,
			'choices'           => $post_type_choices,
			'default_value'     => 'post',
			'instructions'      => esc_html__( 'Select which post type to display', 'boldface-design' ),
		),
		array(
			'key'               => 'field_archive_sort_order',
			'label'             => esc_html__( 'Sort Order', 'boldface-design' ),
			'name'              => 'sort_order',
			'type'              => 'radio',
			'required'          => 1,
			'choices'           => array(
				'newest'        => esc_html__( 'Newest First', 'boldface-design' ),
				'oldest'        => esc_html__( 'Oldest First', 'boldface-design' ),
				'alphabetical'  => esc_html__( 'Alphabetical (A-Z)', 'boldface-design' ),
			),
			'default_value'     => 'newest',
			'layout'            => 'horizontal',
		),
		array(
			'key'               => 'field_archive_posts_per_page',
			'label'             => esc_html__( 'Number of Posts', 'boldface-design' ),
			'name'              => 'posts_per_page',
			'type'              => 'number',
			'required'          => 1,
			'default_value'     => 6,
			'min'               => 1,
			'max'               => 100,
			'instructions'      => esc_html__( 'How many posts to display in the grid', 'boldface-design' ),
		),
	),
	'location'              => array(
		array(
			array(
				'param'    => 'block',
				'operator' => '==',
				'value'    => 'boldface-design/archive',
			),
		),
	),
	'menu_order'            => 0,
	'position'              => 'normal',
	'style'                 => 'default',
	'label_placement'       => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen'        => '',
	'active'                => true,
	'description'           => esc_html__( 'ACF fields for the Archive Block', 'boldface-design' ),
) );
