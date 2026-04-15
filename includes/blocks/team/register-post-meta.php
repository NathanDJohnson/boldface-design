<?php
/**
 * Team Block Registration
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

acf_add_local_field_group( array(
	'key'                   => 'group_team_block',
	'title'                 => esc_html__( 'Team Block', 'boldface-design' ),
	'fields'                => array(
		...boldface_design_get_common_block_fields( 'team' ),
		array(
			'key'               => 'field_team_block_heading',
			'label'             => esc_html__( 'Heading', 'boldface-design' ),
			'name'              => 'heading',
			'type'              => 'text',
			'required'          => 0,
			'placeholder'       => esc_html__( 'e.g., Meet the team', 'boldface-design' ),
		),
		array(
			'key'               => 'field_team_block_description',
			'label'             => esc_html__( 'Description', 'boldface-design' ),
			'name'              => 'description',
			'type'              => 'wysiwyg',
			'required'          => 0,
			'placeholder'       => esc_html__( 'Enter a brief description or introduction for the team section', 'boldface-design' ),
		),
		array(
			'key'               => 'field_team_members',
			'label'             => esc_html__( 'Team Members', 'boldface-design' ),
			'name'              => 'team_members',
			'type'              => 'repeater',
			'required'          => 0,
			'min'               => 0,
			'max'               => 0,
			'layout'            => 'row',
			'collapsed'         => 'field_team_member_name',
			'button_label'      => esc_html__( 'Add Team Member', 'boldface-design' ),
			'sub_fields'        => array(
				array(
					'key'           => 'field_team_member_image',
					'label'         => esc_html__( 'Image', 'boldface-design' ),
					'name'          => 'image',
					'type'          => 'image',
					'required'      => 0,
					'return_format' => 'array',
					'preview_size'  => 'medium',
				),
				array(
					'key'           => 'field_team_member_image_object_fit',
					'label'         => esc_html__( 'Image Object Fit', 'boldface-design' ),
					'name'          => 'object_fit',
					'type'          => 'select',
					'required'      => 0,
					'choices'       => array(
						'object-cover'     => esc_html__( 'Cover', 'boldface-design' ),
						'object-contain'   => esc_html__( 'Contain', 'boldface-design' ),
						'object-fill'      => esc_html__( 'Fill', 'boldface-design' ),
					),
					'default_value' => 'object-cover',
				),
				array(
					'key'           => 'field_team_member_name',
					'label'         => esc_html__( 'Name', 'boldface-design' ),
					'name'          => 'name',
					'type'          => 'text',
					'required'      => 1,
					'placeholder'   => esc_html__( 'e.g., Carolyn McHale', 'boldface-design' ),
				),
				array(
					'key'           => 'field_team_member_title',
					'label'         => esc_html__( 'Title', 'boldface-design' ),
					'name'          => 'title',
					'type'          => 'text',
					'required'      => 0,
					'placeholder'   => esc_html__( 'e.g., Creative Director + Brand Strategist', 'boldface-design' ),
				),
				array(
					'key'           => 'field_team_member_content',
					'label'         => esc_html__( 'Bio/Content', 'boldface-design' ),
					'name'          => 'content',
					'type'          => 'wysiwyg',
					'required'      => 0,
					'rows'          => 5,
					'placeholder'   => esc_html__( 'Enter team member bio or description', 'boldface-design' ),
				),
				array(
					'key'           => 'field_team_member_link',
					'label'         => esc_html__( 'Link', 'boldface-design' ),
					'name'          => 'link',
					'type'          => 'link',
					'required'      => 0,
				),
			),
		),
	),
	'location'              => array(
		array(
			array(
				'param'    => 'block',
				'operator' => '==',
				'value'    => 'boldface-design/team',
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
	'description'           => esc_html__( 'ACF fields for the Team Block', 'boldface-design' ),
) );