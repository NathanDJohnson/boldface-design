<?php
/**
 * Theme Utilities
 * Common helper functions
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get the theme configuration
 */
function boldface_design_get_config() {
	static $config = null;

	if ( null === $config ) {
		$config = require BOLDFACE_DESIGN_INC . '/config.php';
	}

	return $config;
}

/**
 * Get a config value by key
 */
function boldface_design_get_config_value( $key, $default = null ) {
	$config = boldface_design_get_config();

	if ( isset( $config[ $key ] ) ) {
		return $config[ $key ];
	}

	return $default;
}

/**
 * Check if ACF Pro is active
 */
function boldface_design_is_acf_active() {
	return class_exists( 'ACF' );
}

/**
 * Get a color from the color palette
 */
function boldface_design_get_color( $color_name ) {
	$colors = boldface_design_get_config_value( 'colors', array() );

	if ( isset( $colors[ $color_name ] ) ) {
		return $colors[ $color_name ];
	}

	return null;
}

/**
 * Get a post type from the config
 */
function boldface_design_get_post_types() {
	return boldface_design_get_config_value( 'post_types', array() );
}

/**
 * Get taxonomies from the config
 */
function boldface_design_get_taxonomies() {
	return boldface_design_get_config_value( 'taxonomies', array() );
}

/**
 * Get sidebars from the config
 */
function boldface_design_get_sidebars() {
	return boldface_design_get_config_value( 'sidebars', array() );
}

/**
 * Get image size from the config
 */
function boldface_design_get_image_size( $size_name ) {
	$sizes = boldface_design_get_config_value( 'image_sizes', array() );

	if ( isset( $sizes[ $size_name ] ) ) {
		return $sizes[ $size_name ];
	}

	return null;
}

/**
 * Get the SVG icon
 */
function boldface_design_get_icon( $icon_name ) {
	$icons_dir = BOLDFACE_DESIGN_DIR . '/assets/icons';

	if ( ! is_dir( $icons_dir ) ) {
		return '';
	}

	$icon_file = $icons_dir . '/' . sanitize_file_name( $icon_name ) . '.svg';

	if ( ! file_exists( $icon_file ) ) {
		return '';
	}

	return file_get_contents( $icon_file );
}

/**
 * Safely echo SVG
 */
function boldface_design_the_icon( $icon_name ) {
	echo wp_kses_post( boldface_design_get_icon( $icon_name ) );
}

/**
 * Get pagination arguments
 */
function boldface_design_get_pagination_args() {
	return array(
		'prev_text' => esc_html__( 'Previous', 'boldface-design' ),
		'next_text' => esc_html__( 'Next', 'boldface-design' ),
		'type'      => 'list',
	);
}

/**
 * Get the site logo
 */
function boldface_design_get_logo() {
	$custom_logo_id = get_theme_mod( 'custom_logo' );

	if ( ! $custom_logo_id ) {
		return null;
	}

	return wp_get_attachment_image_src( $custom_logo_id, 'full' );
}

/**
 * Display the site logo
 */
function boldface_design_the_logo() {
	$logo = boldface_design_get_logo();

	if ( ! $logo ) {
		return;
	}

	$url = home_url( '/' );
	?>
	<a href="<?php echo esc_url( $url ); ?>" class="site-logo">
		<img src="<?php echo esc_url( $logo[0] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
	</a>
	<?php
}

/**
 * Get ACF field with default value
 */
function boldface_design_get_field_value( $field_name, $post_id = false, $default = '' ) {
	if ( ! function_exists( 'get_field' ) ) {
		return $default;
	}

	$value = get_field( $field_name, $post_id );

	return $value ?: $default;
}

/**
 * Check if a post has ACF field
 */
function boldface_design_has_field( $field_name, $post_id = false ) {
	if ( ! function_exists( 'has_field' ) ) {
		return false;
	}

	return has_field( $field_name, $post_id );
}

/**
 * Get the excerpt with custom length
 */
function boldface_design_get_excerpt( $post_id = null, $length = 20, $more = '...' ) {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	$post = get_post( $post_id );

	if ( ! $post ) {
		return '';
	}

	$excerpt = $post->post_excerpt;

	if ( empty( $excerpt ) ) {
		$excerpt = wp_strip_all_tags( $post->post_content );
	}

	$words = explode( ' ', $excerpt );
	$excerpt = implode( ' ', array_slice( $words, 0, $length ) );

	if ( count( $words ) > $length ) {
		$excerpt .= $more;
	}

	return $excerpt;
}

/**
 * Display the excerpt
 */
function boldface_design_the_excerpt( $post_id = null, $length = 20, $more = '...' ) {
	echo wp_kses_post( boldface_design_get_excerpt( $post_id, $length, $more ) );
}

/**
 * Get related posts
 */
function boldface_design_get_related_posts( $post_id = null, $num_posts = 3 ) {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	$post = get_post( $post_id );

	if ( ! $post || 'post' !== $post->post_type ) {
		return array();
	}

	// Get post categories
	$categories = wp_get_post_categories( $post_id );

	if ( empty( $categories ) ) {
		return array();
	}

	$args = array(
		'category__in'     => $categories,
		'post__not_in'     => array( $post_id ),
		'posts_per_page'   => $num_posts,
		'orderby'          => 'date',
		'order'            => 'DESC',
	);

	return new WP_Query( $args );
}

/**
 * Get breadcrumbs
 */
function boldface_design_get_breadcrumbs() {
	$breadcrumbs = array();

	if ( ! is_home() && ! is_front_page() ) {
		$breadcrumbs[] = '<a href="' . esc_url( home_url() ) . '">' . esc_html__( 'Home', 'boldface-design' ) . '</a>';

		if ( is_category() ) {
			$breadcrumbs[] = single_cat_title( '', false );
		} elseif ( is_single() ) {
			$categories = get_the_category();
			if ( ! empty( $categories ) ) {
				$breadcrumbs[] = '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
			}
			$breadcrumbs[] = get_the_title();
		} elseif ( is_page() ) {
			$breadcrumbs[] = get_the_title();
		} elseif ( is_search() ) {
			$breadcrumbs[] = sprintf( esc_html__( 'Search results for "%s"', 'boldface-design' ), esc_html( get_search_query() ) );
		} elseif ( is_404() ) {
			$breadcrumbs[] = esc_html__( '404 - Page Not Found', 'boldface-design' );
		}
	}

	return $breadcrumbs;
}

/**
 * Display breadcrumbs
 */
function boldface_design_the_breadcrumbs() {
	$breadcrumbs = boldface_design_get_breadcrumbs();

	if ( empty( $breadcrumbs ) ) {
		return;
	}

	echo '<nav class="breadcrumbs">';
	echo implode( ' &gt; ', $breadcrumbs );
	echo '</nav>';
}


function boldface_design_get_common_block_fields( $block_name, $default_value = 'bg-white' ) {
	return array(
		array(
			'key'               => "field_{$block_name}_background_color",
			'label'             => esc_html__( 'Background Color', 'boldface-design' ),
			'name'              => 'background',
			'type'              => 'select',
			'choices'           => array(
				'bg-white'          => esc_html__( 'White', 'boldface-design' ),
				'bg-whisper'        => esc_html__( 'Whisper (Light Gray)', 'boldface-design' ),
				'bg-denim'          => esc_html__( 'Denim (Dark Blue)', 'boldface-design' ),
				'bg-observatory'    => esc_html__( 'Observatory', 'boldface-design' ),
				'bg-mine-shaft'     => esc_html__( 'Mine Shaft (Dark)', 'boldface-design' ),
				'bg-gradient-abyss' => esc_html__( 'Gradient Abyss', 'boldface-design' ),
			),
			'default_value'     => $default_value,
			'required'          => 1,
		),
	);
}

function boldface_design_is_dark_background( $background_color ) {
	$dark_backgrounds = [
		'bg-gradient-abyss',
		'bg-denim',
		'bg-mine-shaft',
		'bg-observatory',
	];
	return in_array( $background_color, $dark_backgrounds, true );
}

function boldface_design_get_text_color_from_background_color( $background_color ) {
	return boldface_design_is_dark_background( $background_color ) ? 'text-white' : 'text-mine-shaft';
}

function boldface_design_get_block_common_classes( string $block_name, array $block ) {
	$background = get_field( 'background' ) ?: 'bg-white';

	// Determine text color based on background
	$text_color_class = 'text-mine-shaft';
	if ( in_array( $background, array( 'bg-gradient-abyss', 'bg-denim', 'bg-mine-shaft' ), true ) ) {
		$text_color_class = 'text-white';
	}

	$class_name = "wp-block-boldface-design-{$block_name} w-full px-sm md:px-lg py-2xl {$background} {$text_color_class}";

	return $class_name;
}