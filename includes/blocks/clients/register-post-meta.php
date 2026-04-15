<?php
/**
 * Clients Block Registration
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
	'key'                   => 'group_clients_block',
	'title'                 => esc_html__( 'Clients Block', 'boldface-design' ),
	'fields'                => array(
		array(
			'key'               => 'field_clients_heading',
			'label'             => esc_html__( 'Heading', 'boldface-design' ),
			'name'              => 'heading',
			'type'              => 'text',
			'required'          => 1,
			'placeholder'       => esc_html__( 'e.g., We\'ve worked with some of the best businesses:', 'boldface-design' ),
		),
		array( 
			'key'               => 'field_clients_description',
			'label'             => esc_html__( 'Description', 'boldface-design' ),
			'name'              => 'description',
			'type'              => 'textarea',
			'required'          => 0,
			'rows'              => 5,
			'placeholder'       => esc_html__( 'Additional description text that appears below the heading', 'boldface-design' ),
		),
		array(
			'key'               => 'field_clients_priority_logos',
			'label'             => esc_html__( 'Priority Logos', 'boldface-design' ),
			'name'              => 'priority_logos',
			'type'              => 'repeater',
			'required'          => 0,
			'min'               => 0,
			'max'               => 0,
			'layout'            => 'block',
			'button_label'      => esc_html__( 'Add Priority Logo', 'boldface-design' ),
			'sub_fields'        => array(
				array(
					'key'           => 'field_clients_priority_logo_image',
					'label'         => esc_html__( 'Logo Image', 'boldface-design' ),
					'name'          => 'logo',
					'type'          => 'image',
					'required'      => 1,
					'return_format' => 'array',
					'preview_size'  => 'medium',
				),
				array(
					'key'           => 'field_clients_priority_logo_alt',
					'label'         => esc_html__( 'Alt Text', 'boldface-design' ),
					'name'          => 'alt_text',
					'type'          => 'text',
					'required'      => 0,
					'placeholder'   => esc_html__( 'Company name', 'boldface-design' ),
				),
			),
		),
		array(
			'key'               => 'field_clients_logos',
			'label'             => esc_html__( 'Client Logos', 'boldface-design' ),
			'name'              => 'logos',
			'type'              => 'repeater',
			'required'          => 0,
			'min'               => 0,
			'max'               => 0,
			'layout'            => 'block',
			'button_label'      => esc_html__( 'Add Logo', 'boldface-design' ),
			'sub_fields'        => array(
				array(
					'key'           => 'field_clients_logo_image',
					'label'         => esc_html__( 'Logo Image', 'boldface-design' ),
					'name'          => 'logo',
					'type'          => 'image',
					'required'      => 1,
					'return_format' => 'array',
					'preview_size'  => 'medium',
				),
				array(
					'key'           => 'field_clients_logo_alt',
					'label'         => esc_html__( 'Alt Text', 'boldface-design' ),
					'name'          => 'alt_text',
					'type'          => 'text',
					'required'      => 0,
					'placeholder'   => esc_html__( 'Company name', 'boldface-design' ),
				),
			),
		),
		array(
			'key'               => 'field_clients_proof_chips',
			'label'             => esc_html__( 'Proof Chips', 'boldface-design' ),
			'name'              => 'proof_chips',
			'type'              => 'repeater',
			'required'          => 0,
			'min'               => 0,
			'max'               => 0,
			'layout'            => 'block',
			'button_label'      => esc_html__( 'Add Proof Chip', 'boldface-design' ),
			'sub_fields'        => array(
				array(
					'key'           => 'field_clients_proof_chip_title',
					'label'         => esc_html__( 'Title', 'boldface-design' ),
					'name'          => 'title',
					'type'          => 'text',
					'required'      => 1,
					'placeholder'   => esc_html__( 'e.g., "Over 500 projects completed"', 'boldface-design' ),
				),
				array(
					'key' => 'field_clients_proof_chip_description',
					'label' => esc_html__( 'Description', 'boldface-design' ),
					'name' => 'description',
					'type' => 'text',
					'required' => 0,
					'placeholder' => esc_html__( 'Additional details about the proof point', 'boldface-design' ),
				),
			),
		),
	),
	'location'              => array(
		array(
			array(
				'param'    => 'block',
				'operator' => '==',
				'value'    => 'boldface-design/clients',
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
	'description'           => esc_html__( 'ACF fields for the Clients Block', 'boldface-design' ),
) );