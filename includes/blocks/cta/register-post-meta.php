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
			'key'               => 'field_cta_heading',
			'label'             => esc_html__( 'Heading', 'boldface-design' ),
			'name'              => 'heading',
			'type'              => 'textarea',
			'required'          => 1,
			'placeholder'       => esc_html__( 'Enter CTA heading', 'boldface-design' ),
		),
		array(
			'key'               => 'field_cta_description',
			'label'             => esc_html__( 'Description', 'boldface-design' ),
			'name'              => 'description',
			'type'              => 'textarea',
			'required'          => 0,
			'placeholder'       => esc_html__( 'e.g., Let\'s work together!', 'boldface-design' ),
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
			'key'               => 'field_cta_display_mode',
			'label'             => esc_html__( 'Display Mode', 'boldface-design' ),
			'name'              => 'display_mode',
			'type'              => 'radio',
			'required'          => 0,
			'choices'           => array(
				'buttons'       => esc_html__( 'Buttons', 'boldface-design' ),
				'form'          => esc_html__( 'Form', 'boldface-design' ),
			),
			'default_value'     => 'buttons',
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
			'conditional_logic' => array(
				array(
					array(
						'field'    => 'field_cta_display_mode',
						'operator' => '==',
						'value'    => 'buttons',
					),
				),
			),
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
		array(
			'key'               => 'field_cta_form_id',
			'label'             => esc_html__( 'Form ID', 'boldface-design' ),
			'name'              => 'form_id',
			'type'              => 'number',
			'required'          => 0,
			'placeholder'       => esc_html__( 'e.g., 42', 'boldface-design' ),
			'conditional_logic' => array(
				array(
					array(
						'field'    => 'field_cta_display_mode',
						'operator' => '==',
						'value'    => 'form',
					),
				),
			),
		),
		array(
			'key'               => 'field_cta_form_heading',
			'label'             => esc_html__( 'Form Heading', 'boldface-design' ),
			'name'              => 'form_heading',
			'type'              => 'text',
			'required'          => 0,
			'placeholder'       => esc_html__( 'Enter form heading', 'boldface-design' ),
			'conditional_logic' => array(
				array(
					array(
						'field'    => 'field_cta_display_mode',
						'operator' => '==',
						'value'    => 'form',
					),
				),
			),
		),
		array(
			'key'               => 'field_cta_form_content',
			'label'             => esc_html__( 'Form Content', 'boldface-design' ),
			'name'              => 'form_content',
			'type'              => 'wysiwyg',
			'required'          => 0,
			'tabs'              => 'all',
			'toolbar'           => 'full',
			'media_upload'      => 1,
			'conditional_logic' => array(
				array(
					array(
						'field'    => 'field_cta_display_mode',
						'operator' => '==',
						'value'    => 'form',
					),
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