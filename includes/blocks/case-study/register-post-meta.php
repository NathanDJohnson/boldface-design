<?php
/**
 * Case Study Block - Register Post Meta / ACF Fields
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
	'key'                   => 'group_case_study_block',
	'title'                 => esc_html__( 'Case Study Block', 'boldface-design' ),
	'fields'                => array(
		array(
			'key'               => 'field_case_study_label',
			'label'             => esc_html__( 'Label', 'boldface-design' ),
			'name'              => 'label',
			'type'              => 'text',
			'required'          => 0,
			'placeholder'       => esc_html__( 'e.g., Spotlight', 'boldface-design' ),
			'instructions'      => esc_html__( 'Optional label that displays above the title', 'boldface-design' ),
		),
		array(
			'key'               => 'field_case_study_title',
			'label'             => esc_html__( 'Title', 'boldface-design' ),
			'name'              => 'title',
			'type'              => 'text',
			'required'          => 1,
			'placeholder'       => esc_html__( 'e.g., Museum of Boulder', 'boldface-design' ),
		),
		array(
			'key'               => 'field_case_study_description',
			'label'             => esc_html__( 'Description', 'boldface-design' ),
			'name'              => 'description',
			'type'              => 'textarea',
			'required'          => 1,
			'rows'              => 5,
			'placeholder'       => esc_html__( 'Enter the case study description', 'boldface-design' ),
			'instructions'      => esc_html__( 'Main description text for the case study', 'boldface-design' ),
		),
		array(
			'key'               => 'field_case_study_link',
			'label'             => esc_html__( 'Case Study Link', 'boldface-design' ),
			'name'              => 'case_study_link',
			'type'              => 'link',
			'required'          => 1,
			'instructions'      => esc_html__( 'Link to the full case study', 'boldface-design' ),
		),
		array(
			'key'               => 'field_case_study_image',
			'label'             => esc_html__( 'Image', 'boldface-design' ),
			'name'              => 'image',
			'type'              => 'image',
			'required'          => 0,
			'return_format'     => 'array',
			'preview_size'      => 'medium',
			'instructions'      => esc_html__( 'Optional image to display below the case study description', 'boldface-design' ),
		),
	),
	'location'              => array(
		array(
			array(
				'param'    => 'block',
				'operator' => '==',
				'value'    => 'boldface-design/case-study',
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
	'description'           => esc_html__( 'ACF fields for the Case Study Block', 'boldface-design' ),
) );
