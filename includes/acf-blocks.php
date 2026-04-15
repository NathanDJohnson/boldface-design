<?php
/**
 * ACF Blocks
 * Register custom ACF blocks
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Project Post Type - Featured Field
 */
function boldface_design_register_project_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
		'key'                   => 'group_project_post_type',
		'title'                 => esc_html__( 'Project', 'boldface-design' ),
		'fields'                => array(
			array(
				'key'               => 'field_project_column_span',
				'label'             => esc_html__( 'Column Span', 'boldface-design' ),
				'name'              => 'column_span',
				'type'              => 'select',
				'required'          => 0,
				'choices'           => array(
					'1' => esc_html__( '1 Column', 'boldface-design' ),
					'2' => esc_html__( '2 Columns', 'boldface-design' ),
					'3' => esc_html__( '3 Columns', 'boldface-design' ),
				),
				'default_value'     => '1',
				'instructions'      => esc_html__( 'Select how many columns this project should span in the portfolio grid (on desktop only)', 'boldface-design' ),
			),
		),
		'location'              => array(
			array(
				array(
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'project',
				),
			),
		),
		'menu_order'            => 0,
		'position'              => 'side',
		'style'                 => 'default',
		'label_placement'       => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen'        => '',
		'active'                => true,
		'description'           => esc_html__( 'ACF fields for the Project post type', 'boldface-design' ),
	) );
}
add_action( 'acf/init', 'boldface_design_register_project_fields' );

