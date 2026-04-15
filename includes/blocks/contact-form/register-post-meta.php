<?php
/**
 * Contact Form Block - Register Post Meta / ACF Fields
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
	'key'                   => 'group_contact_form_block',
	'title'                 => esc_html__( 'Contact Form Block', 'boldface-design' ),
	'fields'                => array(
		array(
			'key'               => 'field_contact_form_heading',
			'label'             => esc_html__( 'Heading', 'boldface-design' ),
			'name'              => 'heading',
			'type'              => 'text',
			'required'          => 0,
			'placeholder'       => esc_html__( 'e.g., Get in Touch', 'boldface-design' ),
		),
		array(
			'key'               => 'field_contact_form_content',
			'label'             => esc_html__( 'Content', 'boldface-design' ),
			'name'              => 'content',
			'type'              => 'wysiwyg',
			'required'          => 0,
			'toolbar'           => 'full',
			'media_upload'      => 1,
			'instructions'      => esc_html__( 'Optional content to display alongside the form', 'boldface-design' ),
		),
		array(
			'key'               => 'field_contact_form_form',
			'label'             => esc_html__( 'Form ID', 'boldface-design' ),
			'name'              => 'form',
			'type'              => 'number',
			'required'          => 1,
			'min'               => 1,
			'placeholder'       => esc_html__( 'e.g., 1, 2, 3', 'boldface-design' ),
			'instructions'      => esc_html__( 'Enter the WS Form ID. Find this by editing the form in WS Forms admin.', 'boldface-design' ),
		),
	),
	'location'              => array(
		array(
			array(
				'param'    => 'block',
				'operator' => '==',
				'value'    => 'boldface-design/contact-form',
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
	'description'           => esc_html__( 'ACF fields for the Contact Form Block', 'boldface-design' ),
) );
