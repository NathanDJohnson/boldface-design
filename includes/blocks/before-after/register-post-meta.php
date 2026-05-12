<?php
/**
 * Before/After Block Registration
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'acf_add_local_field_group' ) ) {
	return;
}

acf_add_local_field_group( array(
	'key'                   => 'group_before_after_block',
	'title'                 => esc_html__( 'Before/After Block', 'boldface-design' ),
	'fields'                => array(
        ...boldface_design_get_common_block_fields( 'before_after' ),
		array(
			'key'               => 'field_before_after_header',
			'label'             => esc_html__( 'Header', 'boldface-design' ),
			'name'              => 'header',
			'type'              => 'text',
			'required'          => 0,
			'placeholder'       => esc_html__( 'Enter section header', 'boldface-design' ),
		),
		array(
			'key'               => 'field_before_after_content',
			'label'             => esc_html__( 'Content', 'boldface-design' ),
			'name'              => 'content',
			'type'              => 'wysiwyg',
			'required'          => 0,
			'placeholder'       => esc_html__( 'Enter content', 'boldface-design' ),
		),
		array(
			'key'               => 'field_before_after_before_image',
			'label'             => esc_html__( 'Before Image', 'boldface-design' ),
			'name'              => 'before_image',
			'type'              => 'image',
			'required'          => 0,
			'return_format'     => 'array',
			'preview_size'      => 'medium',
			'instructions'      => esc_html__( 'Upload the "before" image', 'boldface-design' ),
		),
		array(
			'key'               => 'field_before_after_before_caption',
			'label'             => esc_html__( 'Before Caption', 'boldface-design' ),
			'name'              => 'before_caption',
			'type'              => 'text',
			'required'          => 0,
			'placeholder'       => esc_html__( 'Enter "before" caption', 'boldface-design' ),
		),
		array(
			'key'               => 'field_before_after_after_image',
			'label'             => esc_html__( 'After Image', 'boldface-design' ),
			'name'              => 'after_image',
			'type'              => 'image',
			'required'          => 0,
			'return_format'     => 'array',
			'preview_size'      => 'medium',
			'instructions'      => esc_html__( 'Upload the "after" image', 'boldface-design' ),
		),
		array(
			'key'               => 'field_before_after_after_caption',
			'label'             => esc_html__( 'After Caption', 'boldface-design' ),
			'name'              => 'after_caption',
			'type'              => 'text',
			'required'          => 0,
			'placeholder'       => esc_html__( 'Enter "after" caption', 'boldface-design' ),
		),
	),
	'location'              => array(
		array(
			array(
				'param'    => 'block',
				'operator' => '==',
				'value'    => 'boldface-design/before-after',
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
	'show_in_rest'          => true,
	'description'           => esc_html__( 'ACF fields for the Before/After block', 'boldface-design' ),
) );