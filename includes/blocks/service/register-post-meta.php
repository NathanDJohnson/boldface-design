<?php
/**
 * Service Block Registration
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
	'key'                   => 'group_service_block',
	'title'                 => esc_html__( 'Service Block', 'boldface-design' ),
	'fields'                => array(
		...boldface_design_get_common_block_fields( 'service' ),
		array(
			'key'               => 'field_service_heading',
			'label'             => esc_html__( 'Heading', 'boldface-design' ),
			'name'              => 'heading',
			'type'              => 'text',
			'required'          => 1,
			'placeholder'       => esc_html__( 'Enter service heading', 'boldface-design' ),
		),
		array(
			'key'               => 'field_service_content',
			'label'             => esc_html__( 'Content', 'boldface-design' ),
			'name'              => 'content',
			'type'              => 'wysiwyg',
			'required'          => 1,
			'toolbar'           => 'full',
			'media_upload'      => 1,
			'instructions'      => esc_html__( 'Add formatted content describing the service', 'boldface-design' ),
		),
		array(
			'key'               => 'field_service_image',
			'label'             => esc_html__( 'Image', 'boldface-design' ),
			'name'              => 'image',
			'type'              => 'image',
			'required'          => 1,
			'return_format'     => 'array',
			'preview_size'      => 'medium',
			'instructions'      => esc_html__( 'Upload a landscape image for the service (recommended aspect ratio: 16:9)', 'boldface-design' ),
		),
		array(
			'key'               => 'field_service_image_position',
			'label'             => esc_html__( 'Image Position', 'boldface-design' ),
			'name'              => 'image_position',
			'type'              => 'radio',
			'required'          => 1,
			'choices'           => array(
				'left'          => esc_html__( 'Left', 'boldface-design' ),
				'right'         => esc_html__( 'Right', 'boldface-design' ),
			),
			'default_value'     => 'left',
			'layout'            => 'horizontal',
			'instructions'      => esc_html__( 'Position the image on the left or right (mobile always shows image on top)', 'boldface-design' ),
		),
		array(
			'key'               => 'field_service_link',
			'label'             => esc_html__( 'Link', 'boldface-design' ),
			'name'              => 'link',
			'type'              => 'link',
			'required'          => 1,
			'instructions'      => esc_html__( 'The link to the service page', 'boldface-design' ),
		),
	),
	'location'              => array(
		array(
			array(
				'param'    => 'block',
				'operator' => '==',
				'value'    => 'boldface-design/service',
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
	'description'           => esc_html__( 'ACF fields for the Service Block', 'boldface-design' ),
) );
