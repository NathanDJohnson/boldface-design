<?php
/**
 * Portfolio Grid Block Registration
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'acf_add_local_field_group' ) ) {
	return;
}

// Get skills taxonomy terms for filter field
$skills_terms = get_terms( array(
	'taxonomy'   => 'skills',
	'hide_empty' => false,
) );

$skills_choices = array( 'all' => 'All Skills' );
if ( ! is_wp_error( $skills_terms ) && ! empty( $skills_terms ) ) {
	foreach ( $skills_terms as $term ) {
		$skills_choices[ $term->term_id ] = $term->name;
	}
}

acf_add_local_field_group( array(
	'key'                   => 'group_portfolio_grid_block',
	'title'                 => esc_html__( 'Portfolio Grid Block', 'boldface-design' ),
	'fields'                => array(
		array(
			'key'               => 'field_portfolio_grid_heading',
			'label'             => esc_html__( 'Heading', 'boldface-design' ),
			'name'              => 'heading',
			'type'              => 'text',
			'required'          => 0,
			'placeholder'       => esc_html__( 'e.g., Our Work', 'boldface-design' ),
		),
		array(
			'key'               => 'field_portfolio_grid_content',
			'label'             => esc_html__( 'Content', 'boldface-design' ),
			'name'              => 'content',
			'type'              => 'wysiwyg',
			'required'          => 0,
			'toolbar'           => 'full',
			'media_upload'      => 1,
			'instructions'      => esc_html__( 'Optional content to display above the grid', 'boldface-design' ),
		),
		array(
			'key'               => 'field_portfolio_grid_use_manual_selection',
			'label'             => esc_html__( 'Use Manual Selection', 'boldface-design' ),
			'name'              => 'use_manual_selection',
			'type'              => 'true_false',
			'required'          => 0,
			'default_value'     => 0,
			'ui'                => 1,
			'instructions'      => esc_html__( 'Enable to manually select and order specific projects. When disabled, all projects are displayed.', 'boldface-design' ),
		),
		array(
			'key'               => 'field_portfolio_grid_selected_projects',
			'label'             => esc_html__( 'Selected Projects', 'boldface-design' ),
			'name'              => 'selected_projects',
			'type'              => 'relationship',
			'post_type'         => array( 'project' ),
			'filters'           => array( 'search', 'post_type', 'taxonomy' ),
			'elements'          => '',
			'min'               => '',
			'max'               => '',
			'return_format'     => 'id',
			'instructions'      => esc_html__( 'Select and order the projects to display. Drag to reorder.', 'boldface-design' ),
			'conditional_logic' => array(
				array(
					array(
						'field'    => 'field_portfolio_grid_use_manual_selection',
						'operator' => '==',
						'value'    => '1',
					),
				),
			),
		),
		array(
			'key'               => 'field_portfolio_grid_show_filters',
			'label'             => esc_html__( 'Show Category Filters', 'boldface-design' ),
			'name'              => 'show_filters',
			'type'              => 'true_false',
			'required'          => 0,
			'default_value'     => 1,
			'ui'                => 1,
			'instructions'      => esc_html__( 'Display the category filter buttons above the portfolio grid', 'boldface-design' ),
		),
		array(
			'key'               => 'field_portfolio_grid_default_filter',
			'label'             => esc_html__( 'Default Filter', 'boldface-design' ),
			'name'              => 'default_filter',
			'type'              => 'select',
			'choices'           => $skills_choices,
			'default_value'     => 'all',
			'instructions'      => esc_html__( 'Which skill/filter should be selected by default', 'boldface-design' ),
		),
		array(
			'key'               => 'field_portfolio_grid_projects_per_page',
			'label'             => esc_html__( 'Projects Per Page', 'boldface-design' ),
			'name'              => 'projects_per_page',
			'type'              => 'number',
			'required'          => 1,
			'default_value'     => -1,
			'instructions'      => esc_html__( 'Use -1 to show all projects, or a specific number', 'boldface-design' ),
		),
	),
	'location'              => array(
		array(
			array(
				'param'    => 'block',
				'operator' => '==',
				'value'    => 'boldface-design/portfolio-grid',
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
	'show_in_rest'          => true,
	'description'           => esc_html__( 'ACF fields for the Portfolio Grid Block', 'boldface-design' ),
) );
