<?php
/**
 * CTA Block Registration
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
	'key'                   => 'group_cta_block',
	'title'                 => esc_html__( 'CTA Block', 'boldface-design' ),
	'fields'                => array(
		array(
			'key'               => 'field_cta_description',
			'label'             => esc_html__( 'Description', 'boldface-design' ),
			'name'              => 'description',
			'type'              => 'textarea',
			'required'          => 0,
			'placeholder'       => esc_html__( 'e.g., Let\'s work together!', 'boldface-design' ),
		),
		array(
			'key'               => 'field_cta_heading',
			'label'             => esc_html__( 'Heading', 'boldface-design' ),
			'name'              => 'heading',
			'type'              => 'textarea',
			'required'          => 1,
			'placeholder'       => esc_html__( 'Enter CTA heading', 'boldface-design' ),
		),
		array(
			'key'               => 'field_cta_heading_placement',
			'label'             => esc_html__( 'Heading Placement', 'boldface-design' ),
			'name'              => 'heading_placement',
			'type'              => 'radio',
			'required'          => 0,
			'choices'           => array(
				'above'             => esc_html__( 'Above Description', 'boldface-design' ),
				'below'             => esc_html__( 'Below Description', 'boldface-design' ),
			),
			'default_value'     => 'above',
			'layout'            => 'horizontal',
		),
		array(
			'key'               => 'field_cta_buttons',
			'label'             => esc_html__( 'CTA Buttons', 'boldface-design' ),
			'name'              => 'cta_buttons',
			'type'              => 'repeater',
			'required'          => 0,
			'min'               => 0,
			'max'               => 0,
			'layout'            => 'block',
			'button_label'      => esc_html__( 'Add Button', 'boldface-design' ),
			'sub_fields'        => array(
				array(
					'key'           => 'field_cta_button_link',
					'label'         => esc_html__( 'Button Link', 'boldface-design' ),
					'name'          => 'button_link',
					'type'          => 'link',
					'required'      => 1,
				),
				array(
					'key'           => 'field_cta_button_style',
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
				'value'    => 'boldface-design/cta',
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
	'description'           => esc_html__( 'ACF fields for the CTA Block', 'boldface-design' ),
) );