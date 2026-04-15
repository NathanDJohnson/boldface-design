<?php
/**
 * WYSIWYG Block - Register Post Meta / ACF Fields
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
	'key'                   => 'group_wysiwyg_block',
	'title'                 => esc_html__( 'WYSIWYG Block', 'boldface-design' ),
	'fields'                => array(
        ...boldface_design_get_common_block_fields( 'wysiwyg' ),
        array( 
            'key'               => 'field_wysiwyg_heading',
            'label'             => esc_html__( 'Heading', 'boldface-design' ),
            'name'              => 'heading',
            'type'              => 'text',
        ),
		array(
			'key'               => 'field_wysiwyg_content',
			'label'             => esc_html__( 'Content', 'boldface-design' ),
			'name'              => 'content',
			'type'              => 'wysiwyg',
			'required'          => 1,
			'toolbar'           => 'full',
			'media_upload'      => 1,
			'instructions'      => esc_html__( 'Add formatted content using the rich text editor', 'boldface-design' ),
		),
	),
	'location'              => array(
		array(
			array(
				'param'    => 'block',
				'operator' => '==',
				'value'    => 'boldface-design/wysiwyg',
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
	'description'           => esc_html__( 'ACF fields for the WYSIWYG Block', 'boldface-design' ),
) );
