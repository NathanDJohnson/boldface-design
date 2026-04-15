<?php
/**
 * Hero Block Registration
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
	'key'                   => 'group_hero_block',
	'title'                 => esc_html__( 'Hero Block', 'boldface-design' ),
	'fields'                => array(
		array(
			'key'               => 'field_hero_logo',
			'label'             => esc_html__( 'Logo', 'boldface-design' ),
			'name'              => 'logo',
			'type'              => 'image',
			'required'          => 0,
			'return_format'     => 'array',
			'preview_size'      => 'medium',
			'instructions'      => esc_html__( 'Optional logo that displays above the title. Works best with a transparent background.', 'boldface-design' ),
		),
		array(
			'key'               => 'field_hero_title',
			'label'             => esc_html__( 'Title', 'boldface-design' ),
			'name'              => 'title',
			'type'              => 'text',
			'required'          => 1,
			'placeholder'       => esc_html__( 'Enter hero title', 'boldface-design' ),
		),
		array(
			'key'               => 'field_hero_subtitle',
			'label'             => esc_html__( 'Subtitle', 'boldface-design' ),
			'name'              => 'subtitle',
			'type'              => 'text',
			'required'          => 0,
			'placeholder'       => esc_html__( 'Optional subtitle that displays below the title', 'boldface-design' ),
		),
		array(
			'key'               => 'field_hero_tagline',
			'label'             => esc_html__( 'Tagline', 'boldface-design' ),
			'name'              => 'tagline',
			'type'              => 'text',
			'required'          => 0,
			'placeholder'       => esc_html__( 'Optional short tagline that displays above the title', 'boldface-design' ),
		),
		array(
			'key'               => 'field_hero_description',
			'label'             => esc_html__( 'Description', 'boldface-design' ),
			'name'              => 'description',
			'type'              => 'wysiwyg',
			'required'          => 0,
			'placeholder'       => esc_html__( 'Enter hero description', 'boldface-design' ),
		),
		array(
			'key'               => 'field_hero_description_placement',
			'label'             => esc_html__( 'Description Placement', 'boldface-design' ),
			'name'              => 'description_placement',
			'type'              => 'radio',
			'required'          => 0,
			'choices'           => array(
				'above'         => esc_html__( 'Above Title', 'boldface-design' ),
				'below'         => esc_html__( 'Below Title', 'boldface-design' ),
			),
			'default_value'     => 'above',
			'layout'            => 'horizontal',
		),
		array(
			'key'               => 'field_hero_background_image',
			'label'             => esc_html__( 'Background Image', 'boldface-design' ),
			'name'              => 'background_image',
			'type'              => 'image',
			'required'          => 0,
			'return_format'     => 'array',
			'preview_size'      => 'medium',
		),
		array(
			'key'               => 'field_hero_background_video',
			'label'             => esc_html__( 'Background Video', 'boldface-design' ),
			'name'              => 'background_video',
			'type'              => 'file',
			'required'          => 0,
			'return_format'     => 'array',
			'mime_types'        => 'webm',
			'media_type'        => 'video',
			'instructions'      => esc_html__( 'Upload a WEBM video. It will replace the background image on page load.', 'boldface-design' ),
		),
		array(
			'key'               => 'field_hero_background_video_fallback',
			'label'             => esc_html__( 'Background Video Fallback', 'boldface-design' ),
			'name'              => 'background_video_fallback',
			'type'              => 'file',
			'required'          => 0,
			'return_format'     => 'array',
			'mime_types'        => 'mp4',
			'media_type'        => 'video',
			'instructions'      => esc_html__( 'Upload a compressed MP4 video (H.264). This serves as the primary fallback for Safari/iOS.', 'boldface-design' ),
		),
		array(
			'key'               => 'field_hero_cta_url',
			'label'             => esc_html__( 'CTA Button URL', 'boldface-design' ),
			'name'              => 'cta_url',
			'type'              => 'link',
			'required'          => 0,
		),
		array(
			'key'               => 'field_hero_secondary_cta_url',
			'label'             => esc_html__( 'Secondary CTA Button URL', 'boldface-design' ),
			'name'              => 'secondary_cta_url',
			'type'              => 'link',
			'required'          => 0,
			'instructions'      => esc_html__( 'Optional secondary CTA button that displays below the primary CTA. If set, the primary CTA will be styled as a solid button and the secondary CTA will be styled as an outline button.', 'boldface-design' ),
		),
	),
	'location'              => array(
		array(
			array(
				'param'    => 'block',
				'operator' => '==',
				'value'    => 'boldface-design/hero',
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
	'description'           => esc_html__( 'ACF fields for the Hero block', 'boldface-design' ),
) );