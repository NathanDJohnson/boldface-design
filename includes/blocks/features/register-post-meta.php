<?php
/**
 * Features Block Registration
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
	'key'                   => 'group_features_block',
	'title'                 => esc_html__( 'Features Block', 'boldface-design' ),
	'fields'                => array(
		...boldface_design_get_common_block_fields( 'features' ),
		array(
			'key'               => 'field_features_columns',
			'label'             => esc_html__( 'Features Columns', 'boldface-design' ),
			'name'              => 'features_columns',
			'type'              => 'select',
			'required'          => 0,
			'choices'           => array(
				'one'  => esc_html__( 'One Column', 'boldface-design' ),
				'two'   => esc_html__( 'Two Columns', 'boldface-design' ),
				'three' => esc_html__( 'Three Columns', 'boldface-design' ),
				'four'  => esc_html__( 'Four Columns', 'boldface-design' ),
			),
			'default_value'     => 'four',
			'layout'            => 'horizontal',
		),
		array(
			'key'               => 'field_features_service_items',
			'label'             => esc_html__( 'Service Items', 'boldface-design' ),
			'name'              => 'service_items',
			'type'              => 'repeater',
			'required'          => 0,
			'min'               => 0,
			'max'               => 4,
			'layout'            => 'block',
			'button_label'      => esc_html__( 'Add Service', 'boldface-design' ),
			'sub_fields'        => array(
				array(
					'key'           => 'field_features_service_image',
					'label'         => esc_html__( 'Image', 'boldface-design' ),
					'name'          => 'image',
					'type'          => 'image',
					'required'      => 0,
					'return_format' => 'array',
					'preview_size'  => 'medium',
				),
				array(
					'key'           => 'field_features_service_title',
					'label'         => esc_html__( 'Title', 'boldface-design' ),
					'name'          => 'title',
					'type'          => 'text',
					'required'      => 1,
					'placeholder'   => esc_html__( 'e.g., Brand Creation', 'boldface-design' ),
				),
				array(
					'key'           => 'field_features_service_content',
					'label'         => esc_html__( 'Content', 'boldface-design' ),
					'name'          => 'content',
					'type'          => 'textarea',
					'required'      => 0,
					'rows'          => 3,
					'placeholder'   => esc_html__( 'Enter service description', 'boldface-design' ),
				),
			),
		),
		array(
			'key'               => 'field_features_description',
			'label'             => esc_html__( 'Description', 'boldface-design' ),
			'name'              => 'description',
			'type'              => 'text',
			'required'          => 0,
			'placeholder'       => esc_html__( 'e.g., We tell stories.', 'boldface-design' ),
		),
		array(
			'key'               => 'field_features_content',
			'label'             => esc_html__( 'Content', 'boldface-design' ),
			'name'              => 'content',
			'type'              => 'wysiwyg',
			'required'          => 0,
			'toolbar'           => 'full',
			'media_upload'      => 1,
		),
	),
	'location'              => array(
		array(
			array(
				'param'    => 'block',
				'operator' => '==',
				'value'    => 'boldface-design/features',
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
	'description'           => esc_html__( 'ACF fields for the Features/Services Block', 'boldface-design' ),
) );
