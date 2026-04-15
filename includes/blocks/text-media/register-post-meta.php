<?php
/**
 * Text & Media Block - Register Post Meta / ACF Fields
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
	'key'                   => 'group_text_media_block',
	'title'                 => esc_html__( 'Text & Media Block', 'boldface-design' ),
	'fields'                => array(
		array(
			'key'               => 'field_text_media_heading',
			'label'             => esc_html__( 'Heading', 'boldface-design' ),
			'name'              => 'heading',
			'type'              => 'text',
			'required'          => 0,
			'placeholder'       => esc_html__( 'Enter section heading', 'boldface-design' ),
		),
		array(
			'key'               => 'field_text_media_content',
			'label'             => esc_html__( 'Content', 'boldface-design' ),
			'name'              => 'content',
			'type'              => 'wysiwyg',
			'required'          => 0,
			'toolbar'           => 'full',
			'media_upload'      => 1,
		),
		array(
			'key'               => 'field_text_media_image',
			'label'             => esc_html__( 'Image', 'boldface-design' ),
			'name'              => 'image',
			'type'              => 'image',
			'required'          => 0,
			'return_format'     => 'array',
			'preview_size'      => 'medium',
			'instructions'      => esc_html__( 'Upload an image to display alongside the text', 'boldface-design' ),
		),
		array(
			'key'               => 'field_text_media_video_embed',
			'label'             => esc_html__( 'Video Embed', 'boldface-design' ),
			'name'              => 'video_embed',
			'type'              => 'oembed',
			'required'          => 0,
			'instructions'      => esc_html__( 'Paste a YouTube, Vimeo, or other oEmbed-compatible video URL', 'boldface-design' ),
		),
		array(
			'key'               => 'field_text_media_position',
			'label'             => esc_html__( 'Media Position', 'boldface-design' ),
			'name'              => 'media_position',
			'type'              => 'radio',
			'required'          => 1,
			'choices'           => array(
				'left'          => esc_html__( 'Left', 'boldface-design' ),
				'right'         => esc_html__( 'Right', 'boldface-design' ),
			),
			'default_value'     => 'left',
			'layout'            => 'horizontal',
			'instructions'      => esc_html__( 'Position the media on the left or right (mobile always shows media on top)', 'boldface-design' ),
		),
	),
	'location'              => array(
		array(
			array(
				'param'    => 'block',
				'operator' => '==',
				'value'    => 'boldface-design/text-media',
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
	'description'           => esc_html__( 'ACF fields for the Text & Media Block', 'boldface-design' ),
) );
