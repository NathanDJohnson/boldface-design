<?php
/**
 * Case Study Details Block - Register Post Meta / ACF Fields
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
	'key'                   => 'group_case_study_details_block',
	'title'                 => esc_html__( 'Case Study Details Block', 'boldface-design' ),
	'fields'                => array(
        array(
			'key'               => 'field_case_study_details_heading',
			'label'             => esc_html__( 'Heading', 'boldface-design' ),
			'name'              => 'heading',
			'type'              => 'text',
			'required'          => 1,
			'placeholder'       => esc_html__( 'e.g., We\'ve worked with some of the best businesses:', 'boldface-design' ),
		),
		array(
			'key'               => 'field_case_study_details_introduction',
			'label'             => esc_html__( 'Introduction', 'boldface-design' ),
			'name'              => 'introduction',
			'type'              => 'wysiwyg',
			'required'          => 1,
			'toolbar'           => 'full',
			'media_upload'      => 1,
			'instructions'      => esc_html__( 'Overview of the case study project', 'boldface-design' ),
		),
		array(
			'key'               => 'field_case_study_details_challenge',
			'label'             => esc_html__( 'Challenge', 'boldface-design' ),
			'name'              => 'challenge',
			'type'              => 'wysiwyg',
			'required'          => 1,
			'toolbar'           => 'full',
			'media_upload'      => 1,
			'instructions'      => esc_html__( 'Describe the challenge or problem faced', 'boldface-design' ),
		),
		array(
			'key'               => 'field_case_study_details_solution',
			'label'             => esc_html__( 'Solution', 'boldface-design' ),
			'name'              => 'solution',
			'type'              => 'wysiwyg',
			'required'          => 1,
			'toolbar'           => 'full',
			'media_upload'      => 1,
			'instructions'      => esc_html__( 'Explain the solution provided', 'boldface-design' ),
		),
		array(
			'key'               => 'field_case_study_details_results',
			'label'             => esc_html__( 'Results', 'boldface-design' ),
			'name'              => 'results',
			'type'              => 'wysiwyg',
			'required'          => 1,
			'toolbar'           => 'full',
			'media_upload'      => 1,
			'instructions'      => esc_html__( 'Describe the results achieved', 'boldface-design' ),
		),
		array(
			'key'               => 'field_case_study_details_gallery',
			'label'             => esc_html__( 'Gallery', 'boldface-design' ),
			'name'              => 'gallery',
			'type'              => 'repeater',
			'required'          => 0,
			'min'               => 0,
			'max'               => 6,
			'layout'            => 'block',
			'button_label'      => esc_html__( 'Add Image', 'boldface-design' ),
			'instructions'      => esc_html__( 'Add gallery images (optional, maximum 6 images)', 'boldface-design' ),
			'sub_fields'        => array(
				array(
					'key'           => 'field_case_study_details_gallery_image',
					'label'         => esc_html__( 'Image', 'boldface-design' ),
					'name'          => 'image',
					'type'          => 'image',
					'required'      => 1,
					'return_format' => 'array',
					'preview_size'  => 'medium',
				),
			),
		),
		array(
			'key'               => 'field_case_study_details_key_stats',
			'label'             => esc_html__( 'Key Stats', 'boldface-design' ),
			'name'              => 'key_stats',
			'type'              => 'repeater',
			'required'          => 1,
			'min'               => 1,
			'max'               => 3,
			'layout'            => 'block',
			'button_label'      => esc_html__( 'Add Stat', 'boldface-design' ),
			'instructions'      => esc_html__( 'Add key statistics (minimum 1, maximum 3)', 'boldface-design' ),
			'sub_fields'        => array(
				array(
					'key'           => 'field_case_study_details_stat_number',
					'label'         => esc_html__( 'Stat', 'boldface-design' ),
					'name'          => 'stat',
					'type'          => 'number',
					'required'      => 1,
					'placeholder'   => esc_html__( 'e.g., 150.5', 'boldface-design' ),
				),
				array(
					'key'           => 'field_case_study_details_stat_context',
					'label'         => esc_html__( 'Context', 'boldface-design' ),
					'name'          => 'context',
					'type'          => 'textarea',
					'required'      => 1,
					'rows'          => 2,
					'placeholder'   => esc_html__( 'e.g., Increase in engagement', 'boldface-design' ),
				),
			),
		),
	),
	'location'              => array(
		array(
			array(
				'param'    => 'block',
				'operator' => '==',
				'value'    => 'boldface-design/case-study-details',
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
	'description'           => esc_html__( 'ACF fields for the Case Study Details Block', 'boldface-design' ),
) );
