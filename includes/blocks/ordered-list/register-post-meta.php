<?php
/**
 * Ordered List Block Registration
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
	'key'                   => 'group_ordered_list_block',
	'title'                 => esc_html__( 'Ordered List Block', 'boldface-design' ),
	'fields'                => array(
		...boldface_design_get_common_block_fields( 'ordered-list' ),
		array(
			'key'               => 'field_ordered_list_columns',
			'label'             => esc_html__( 'Ordered List Columns', 'boldface-design' ),
			'name'              => 'ordered_list_columns',
			'type'              => 'select',
			'required'          => 0,
			'choices'           => array(
				'one'  => esc_html__( 'One Column', 'boldface-design' ),
				'two'   => esc_html__( 'Two Columns', 'boldface-design' ),
			),
			'default_value'     => 'two',
			'layout'            => 'horizontal',
		),
		array(
			'key'               => 'field_ordered_list_heading',
			'label'             => esc_html__( 'Heading', 'boldface-design' ),
			'name'              => 'heading',
			'type'              => 'text',
			'required'          => 0,
			'placeholder'       => esc_html__( 'e.g., How we work', 'boldface-design' ),
		),
		array(
			'key'               => 'field_ordered_list_content',
			'label'             => esc_html__( 'Content', 'boldface-design' ),
			'name'              => 'content',
			'type'              => 'wysiwyg',
			'required'          => 0,
			'toolbar'           => 'full',
			'media_upload'      => 1,
			'instructions'      => esc_html__( 'Optional content to display above the list', 'boldface-design' ),
		),
		array(
			'key'               => 'field_ordered_list_items',
			'label'             => esc_html__( 'List Items', 'boldface-design' ),
			'name'              => 'items',
			'type'              => 'repeater',
			'required'          => 0,
			'min'               => 0,
			'max'               => 0,
			'layout'            => 'block',
			'button_label'      => esc_html__( 'Add Item', 'boldface-design' ),
			'sub_fields'        => array(
				array(
					'key'           => 'field_ordered_list_item_title',
					'label'         => esc_html__( 'Title', 'boldface-design' ),
					'name'          => 'title',
					'type'          => 'text',
					'required'      => 1,
					'placeholder'   => esc_html__( 'e.g., Discover', 'boldface-design' ),
				),
				array(
					'key'           => 'field_ordered_list_item_description',
					'label'         => esc_html__( 'Description', 'boldface-design' ),
					'name'          => 'description',
					'type'          => 'wysiwyg',
					'required'      => 1,
					'placeholder'   => esc_html__( 'Enter the item description', 'boldface-design' ),
				),
			),
		),
		array(
			'key'               => 'field_ordered_list_image',
			'label'             => esc_html__( 'Image', 'boldface-design' ),
			'name'              => 'image',
			'type'              => 'image',
			'required'          => 0,
			'return_format'     => 'array',
			'preview_size'      => 'medium',
			'instructions'      => esc_html__( 'Optional image to display below the list', 'boldface-design' ),
		),
	),
	'location'              => array(
		array(
			array(
				'param'    => 'block',
				'operator' => '==',
				'value'    => 'boldface-design/ordered-list',
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
	'description'           => esc_html__( 'ACF fields for the Ordered List Block', 'boldface-design' ),
) );
