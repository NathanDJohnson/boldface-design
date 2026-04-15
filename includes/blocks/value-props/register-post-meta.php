<?php
/**
 * Value Props Block Registration
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
	'key'                   => 'group_value_props_block',
	'title'                 => esc_html__( 'Value Props Block', 'boldface-design' ),
	'fields'                => array(
		array(
			'key'               => 'field_value_props_intro_heading',
			'label'             => esc_html__( 'Intro Heading', 'boldface-design' ),
			'name'              => 'intro_heading',
			'type'              => 'text',
			'required'          => 0,
			'placeholder'       => esc_html__( 'e.g., Not just pretty pictures.', 'boldface-design' ),
		),
		array(
			'key'               => 'field_value_props_intro_description',
			'label'             => esc_html__( 'Intro Description', 'boldface-design' ),
			'name'              => 'intro_description',
			'type'              => 'textarea',
			'required'          => 0,
			'rows'              => 3,
			'placeholder'       => esc_html__( 'Enter intro description text', 'boldface-design' ),
		),
		array(
			'key'               => 'field_value_props_columns',
			'label'             => esc_html__( 'Value Props Columns', 'boldface-design' ),
			'name'              => 'value_props_columns',
			'type'              => 'select',
			'required'          => 0,
			'choices'           => array(
				'one'  => esc_html__( 'One Column', 'boldface-design' ),
				'two'   => esc_html__( 'Two Columns', 'boldface-design' ),
				'three' => esc_html__( 'Three Columns', 'boldface-design' ),
				'four'  => esc_html__( 'Four Columns', 'boldface-design' ),
			),
			'default_value'     => 'three',
			'layout'            => 'horizontal',
		),
		array(
			'key'               => 'field_value_props_text_alignment',
			'label'             => esc_html__( 'Text Alignment', 'boldface-design' ),
			'name'              => 'text_alignment',
			'type'              => 'radio',
			'choices'           => array(
				'left'          => esc_html__( 'Left', 'boldface-design' ),
				'center'        => esc_html__( 'Center', 'boldface-design' ),
			),
			'default_value'     => 'left',
			'layout'            => 'horizontal',
			'instructions'      => esc_html__( 'Choose whether to align the text in the value prop boxes to the left or center', 'boldface-design' ),
		),
		array(
			'key' => 'field_value_props',
			'label' => esc_html__( 'Value Props', 'boldface-design' ),
			'name' => 'value_props',
			'type' => 'repeater',
			'required' => 0,
			'min' => 0,
			'max' => 0,
			'layout' => 'block',
			'button_label' => esc_html__( 'Add Value Prop', 'boldface-design' ),
			'sub_fields' => array(
				array(
					'key' => 'field_value_prop_title',
					'label' => esc_html__( 'Title', 'boldface-design' ),
					'name' => 'title',
					'type' => 'text',
					'required' => 1,
					'placeholder' => esc_html__( 'e.g., Beautiful, functional design', 'boldface-design' ),
				),
				array(
					'key' => 'field_value_prop_description',
					'label' => esc_html__( 'Description', 'boldface-design' ),
					'name' => 'description',
					'type' => 'textarea',
					'required' => 1,
					'rows' => 4,
					'placeholder' => esc_html__( 'Enter the value prop description', 'boldface-design' ),
				),
			),
		),
		array(
			'key'               => 'field_value_props_case_studies_link',
			'label'             => esc_html__( 'Case Studies Button', 'boldface-design' ),
			'name'              => 'case_studies_link',
			'type'              => 'link',
			'required'          => 0,
		),
	),
	'location'              => array(
		array(
			array(
				'param'    => 'block',
				'operator' => '==',
				'value'    => 'boldface-design/value-props',
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
	'description'           => esc_html__( 'ACF fields for the Value Props Block', 'boldface-design' ),
) );