<?php
/**
 * Testimonials Block Registration
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
	'key'                   => 'group_testimonials_block',
	'title'                 => esc_html__( 'Testimonials Block', 'boldface-design' ),
	'fields'                => array(
		array(
			'key'               => 'field_testimonials_heading',
			'label'             => esc_html__( 'Heading', 'boldface-design' ),
			'name'              => 'heading',
			'type'              => 'text',
			'required'          => 1,
			'placeholder'       => esc_html__( 'e.g., What our clients say', 'boldface-design' ),
		),
		array(
			'key'               => 'field_testimonials_featured_item',
			'label'			    => esc_html__( 'Featured Testimonial', 'boldface-design' ),
			'name'			    => 'featured_testimonial',
			'type'              => 'repeater',
			'min'               => 0,
			'max'               => 1,
			'layout'            => 'block',
			'button_label'      => esc_html__( 'Add FeaturedTestimonial', 'boldface-design' ),
			'sub_fields'        => array(
				array(
					'key'           => 'field_testimonials_quote',
					'label'         => esc_html__( 'Quote', 'boldface-design' ),
					'name'          => 'quote',
					'type'          => 'textarea',
					'required'      => 1,
					'rows'          => 2,
					'placeholder'   => esc_html__( 'Enter the testimonial text', 'boldface-design' ),
				),
				array(
					'key'           => 'field_testimonials_avatar',
					'label'         => esc_html__( 'Avatar', 'boldface-design' ),
					'name'          => 'avatar',
					'type'          => 'image',
					'required'      => 0,
					'return_format' => 'array',
					'preview_size'  => 'thumbnail',
				),
				array(
					'key'           => 'field_testimonials_name',
					'label'         => esc_html__( 'Name', 'boldface-design' ),
					'name'          => 'name',
					'type'          => 'text',
					'required'      => 1,
					'placeholder'   => esc_html__( 'Author name', 'boldface-design' ),
				),
				array(
					'key'           => 'field_testimonials_position',
					'label'         => esc_html__( 'Position', 'boldface-design' ),
					'name'          => 'position',
					'type'          => 'text',
					'required'      => 0,
					'placeholder'   => esc_html__( 'e.g., CEO, Founder', 'boldface-design' ),
				),
				array(
					'key'           => 'field_testimonials_company',
					'label'         => esc_html__( 'Company', 'boldface-design' ),
					'name'          => 'company',
					'type'          => 'text',
					'required'      => 0,
					'placeholder'   => esc_html__( 'e.g., Job Title, Company', 'boldface-design' ),
				),
				array(
					'key'           => 'field_testimonials_show_linkedin_link',
					'label'         => esc_html__( 'Show LinkedIn Link', 'boldface-design' ),
					'name'          => 'show_linkedin_link',
					'type'          => 'true_false',
					'required'      => 0,
					'ui'            => 1,
				),
			),
		),
		array(
			'key'               => 'field_testimonials_items',
			'label'             => esc_html__( 'Testimonials', 'boldface-design' ),
			'name'              => 'testimonials',
			'type'              => 'repeater',
			'required'          => 0,
			'min'               => 0,
			'max'               => 2,
			'layout'            => 'block',
			'button_label'      => esc_html__( 'Add Testimonial', 'boldface-design' ),
			'sub_fields'        => array(
				array(
					'key'           => 'field_testimonials_quote',
					'label'         => esc_html__( 'Quote', 'boldface-design' ),
					'name'          => 'quote',
					'type'          => 'textarea',
					'required'      => 1,
					'rows'          => 2,
					'placeholder'   => esc_html__( 'Enter the testimonial text', 'boldface-design' ),
				),
				array(
					'key'           => 'field_testimonials_avatar',
					'label'         => esc_html__( 'Avatar', 'boldface-design' ),
					'name'          => 'avatar',
					'type'          => 'image',
					'required'      => 0,
					'return_format' => 'array',
					'preview_size'  => 'thumbnail',
				),
				array(
					'key'           => 'field_testimonials_name',
					'label'         => esc_html__( 'Name', 'boldface-design' ),
					'name'          => 'name',
					'type'          => 'text',
					'required'      => 1,
					'placeholder'   => esc_html__( 'Author name', 'boldface-design' ),
				),
				array(
					'key'           => 'field_testimonials_position',
					'label'         => esc_html__( 'Position', 'boldface-design' ),
					'name'          => 'position',
					'type'          => 'text',
					'required'      => 0,
					'placeholder'   => esc_html__( 'e.g., CEO, Founder', 'boldface-design' ),
				),
				array(
					'key'           => 'field_testimonials_company',
					'label'         => esc_html__( 'Company', 'boldface-design' ),
					'name'          => 'company',
					'type'          => 'text',
					'required'      => 0,
					'placeholder'   => esc_html__( 'e.g., Job Title, Company', 'boldface-design' ),
				),
			),
		),
	),
	'location'              => array(
		array(
			array(
				'param'    => 'block',
				'operator' => '==',
				'value'    => 'boldface-design/testimonials',
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
	'description'           => esc_html__( 'ACF fields for the Testimonials Block', 'boldface-design' ),
) );
