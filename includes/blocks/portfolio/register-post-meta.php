<?php
/**
 * Portfolio Block Registration
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
	'key'                   => 'group_portfolio_block',
	'title'                 => esc_html__( 'Portfolio Block', 'boldface-design' ),
	'fields'                => array(
		array(
			'key'               => 'field_portfolio_services_heading',
			'label'             => esc_html__( 'Section 2: Services Heading', 'boldface-design' ),
			'name'              => 'services_heading',
			'type'              => 'text',
			'required'          => 0,
			'placeholder'       => esc_html__( 'e.g., But also pretty pictures.', 'boldface-design' ),
		),
		array(
			'key'               => 'field_portfolio_services_items',
			'label'             => esc_html__( 'Section 2: Services/Offerings', 'boldface-design' ),
			'name'              => 'services_items',
			'type'              => 'repeater',
			'required'          => 0,
			'min'               => 0,
			'max'               => 0,
			'layout'            => 'block',
			'button_label'      => esc_html__( 'Add Service', 'boldface-design' ),
			'sub_fields'        => array(
				array(
					'key'           => 'field_portfolio_service_title',
					'label'         => esc_html__( 'Title', 'boldface-design' ),
					'name'          => 'title',
					'type'          => 'text',
					'required'      => 1,
					'placeholder'   => esc_html__( 'Service title (displays in yellow)', 'boldface-design' ),
				),
				array(
					'key'           => 'field_portfolio_service_description',
					'label'         => esc_html__( 'Description', 'boldface-design' ),
					'name'          => 'description',
					'type'          => 'textarea',
					'required'      => 0,
					'rows'          => 2,
					'placeholder'   => esc_html__( 'Service description (displays in cyan)', 'boldface-design' ),
				),
			),
		),
		// Gallery Section
		array(
			'key'               => 'field_portfolio_gallery_type',
			'label'             => esc_html__( 'Gallery Type', 'boldface-design' ),
			'name'              => 'gallery_type',
			'type'              => 'radio',
			'required'          => 0,
			'choices'           => array(
				'composite'     => esc_html__( 'Composite Image (Single image)', 'boldface-design' ),
				'individual'    => esc_html__( 'Individual Images (Grid)', 'boldface-design' ),
			),
			'default_value'     => 'composite',
			'layout'            => 'vertical',
		),
		array(
			'key'               => 'field_portfolio_gallery_composite',
			'label'             => esc_html__( 'Composite Image', 'boldface-design' ),
			'name'              => 'gallery_composite',
			'type'              => 'image',
			'required'          => 0,
			'return_format'     => 'array',
			'preview_size'      => 'medium',
			'conditional_logic' => array(
				array(
					array(
						'field'    => 'field_portfolio_gallery_type',
						'operator' => '==',
						'value'    => 'composite',
					),
				),
			),
		),
		array(
			'key'               => 'field_portfolio_gallery_images',
			'label'             => esc_html__( 'Individual Images', 'boldface-design' ),
			'name'              => 'gallery_images',
			'type'              => 'repeater',
			'required'          => 0,
			'min'               => 0,
			'max'               => 0,
			'layout'            => 'block',
			'button_label'      => esc_html__( 'Add Image', 'boldface-design' ),
			'conditional_logic' => array(
				array(
					array(
						'field'    => 'field_portfolio_gallery_type',
						'operator' => '==',
						'value'    => 'individual',
					),
				),
			),
			'sub_fields'        => array(
				array(
					'key'           => 'field_portfolio_gallery_image',
					'label'         => esc_html__( 'Image', 'boldface-design' ),
					'name'          => 'image',
					'type'          => 'image',
					'required'      => 1,
					'return_format' => 'array',
					'preview_size'  => 'medium',
				),
				array(
					'key'           => 'field_portfolio_gallery_alt_text',
					'label'         => esc_html__( 'Alt Text', 'boldface-design' ),
					'name'          => 'alt_text',
					'type'          => 'text',
					'required'      => 1,
					'placeholder'   => esc_html__( 'Describe the image for accessibility', 'boldface-design' ),
				),
				array(
					'key'           => 'field_portfolio_gallery_url',
					'label'         => esc_html__( 'Link URL (optional)', 'boldface-design' ),
					'name'          => 'image_url',
					'type'          => 'url',
					'required'      => 0,
					'placeholder'   => esc_html__( 'e.g., https://example.com', 'boldface-design' ),
				),
			),
		),
		// Action Buttons
		array(
			'key'               => 'field_portfolio_action_buttons',
			'label'             => esc_html__( 'Section 2: Action Buttons', 'boldface-design' ),
			'name'              => 'action_buttons',
			'type'              => 'repeater',
			'required'          => 0,
			'min'               => 0,
			'max'               => 2,
			'layout'            => 'block',
			'button_label'      => esc_html__( 'Add Button', 'boldface-design' ),
			'sub_fields'        => array(
				array(
					'key'           => 'field_portfolio_button_link',
					'label'         => esc_html__( 'Button Link', 'boldface-design' ),
					'name'          => 'button_link',
					'type'          => 'link',
					'required'      => 1,
				),
				array(
					'key'           => 'field_portfolio_button_style',
					'label'         => esc_html__( 'Button Style', 'boldface-design' ),
					'name'          => 'button_style',
					'type'          => 'radio',
					'required'      => 0,
					'choices'       => array(
						'solid'         => esc_html__( 'Solid', 'boldface-design' ),
						'outline'       => esc_html__( 'Outline', 'boldface-design' ),
					),
					'default_value' => 'solid',
					'layout'        => 'horizontal',
				),
			),
		),
	),
	'location'              => array(
		array(
			array(
				'param'    => 'block',
				'operator' => '==',
				'value'    => 'boldface-design/portfolio',
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
	'description'           => esc_html__( 'ACF fields for the Portfolio Block', 'boldface-design' ),
) );