<?php
/**
 * FAQ Block - Register Post Meta / ACF Fields
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
	'key'                   => 'group_faq_block',
	'title'                 => esc_html__( 'FAQ Block', 'boldface-design' ),
	'fields'                => array(
		...boldface_design_get_common_block_fields( 'faq' ),
		array(
			'key'               => 'field_faq_heading',
			'label'             => esc_html__( 'Heading', 'boldface-design' ),
			'name'              => 'heading',
			'type'              => 'text',
		),
        array(
			'key'               => 'field_faq_content',
			'label'             => esc_html__( 'Content', 'boldface-design' ),
			'name'              => 'content',
			'type'              => 'wysiwyg',
			'required'          => 0,
			'toolbar'           => 'full',
			'media_upload'      => 1,
			'instructions'      => esc_html__( 'Optional content to display above the posts', 'boldface-design' ),
		),
		array(
			'key'               => 'field_faq_items',
			'label'             => esc_html__( 'FAQ Items', 'boldface-design' ),
			'name'              => 'faq_items',
			'type'              => 'repeater',
            'layout'            => 'block',
			'required'          => 1,
			'button_label'      => esc_html__( 'Add FAQ Item', 'boldface-design' ),
			'min'               => 1,
			'sub_fields'        => array(
				array(
					'key'               => 'field_faq_question',
					'label'             => esc_html__( 'Question', 'boldface-design' ),
					'name'              => 'question',
					'type'              => 'text',
					'required'          => 1,
				),
				array(
					'key'               => 'field_faq_answer',
					'label'             => esc_html__( 'Answer', 'boldface-design' ),
					'name'              => 'answer',
					'type'              => 'wysiwyg',
					'required'          => 1,
					'toolbar'           => 'basic',
					'media_upload'      => 0,
				),
			),
		),
	),
	'location'              => array(
		array(
			array(
				'param'    => 'block',
				'operator' => '==',
				'value'    => 'boldface-design/faq',
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
	'description'           => esc_html__( 'ACF fields for the FAQ Block', 'boldface-design' ),
) );
