<?php
/**
 * Boldface Design Theme Functions
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Define theme constants
 */
define( 'BOLDFACE_DESIGN_VERSION', '1.0.0' );
define( 'BOLDFACE_DESIGN_DIR', get_template_directory() );
define( 'BOLDFACE_DESIGN_URI', get_template_directory_uri() );
define( 'BOLDFACE_DESIGN_INC', BOLDFACE_DESIGN_DIR . '/includes' );
define( 'BOLDFACE_DESIGN_BLOCKS', BOLDFACE_DESIGN_INC . '/blocks' );
define( 'BOLDFACE_DESIGN_ASSETS', BOLDFACE_DESIGN_URI . '/assets' );

/**
 * Include template functions, utilities, and cleanup
 */
require_once BOLDFACE_DESIGN_INC . '/template-functions.php';
require_once BOLDFACE_DESIGN_INC . '/utilities.php';
require_once BOLDFACE_DESIGN_INC . '/cleanup.php';
require_once BOLDFACE_DESIGN_INC . '/schema.php';
require_once BOLDFACE_DESIGN_INC . '/acf-blocks.php';

/**
 * Enqueue theme scripts
 * 
 * - Hero block script (hero.js) only on the front page
 * - Navigation script (nav.js) only on the front page
 * - CSS is inlined in the head for better performance
 */
function boldface_design_enqueue_assets() {
	// ?? Is there a way to only load when the hero block contains a video background? Maybe we can add a class to the body when a hero block with video is present and target that class here? For now, we'll just load on the front page since that's the only place we have the hero block with video.
	if( is_front_page() ) {
		wp_enqueue_script(
			'boldface-design-hero',
			BOLDFACE_DESIGN_URI . '/assets/js/hero.js',
			[],
			BOLDFACE_DESIGN_VERSION,
			[ 'strategy' => 'defer', 'in_footer' => true ],
		);
	}

	// Contact page
	if ( is_page( 70 ) ) {
		wp_enqueue_script(
			'boldface-design-contact',
			BOLDFACE_DESIGN_URI . '/assets/js/chameleon-select.min.js',
			[],
			BOLDFACE_DESIGN_VERSION,
			true
		);
	}

	// Only load the navigation script on the front page since that's the only place we have the sticky header for now. If we add the sticky header to other pages in the future, we can either load this script globally or add a body class and target that class here.
	if( is_front_page() ) {
		wp_enqueue_script(
			'boldface-design-main',
			BOLDFACE_DESIGN_URI . '/assets/js/nav.js',
			[],
			BOLDFACE_DESIGN_VERSION,
			[ 'strategy' => 'defer', 'in_footer' => true ],
		);
	}
}
add_action( 'wp_enqueue_scripts', 'boldface_design_enqueue_assets' );

/**
 * Minify CSS by removing comments, extra whitespace, and unnecessary characters
 * 
 * @param string $css The CSS to minify
 * @return string Minified CSS
 */
function boldface_design_minify_css( $css ) {
	// Remove comments
	$css = preg_replace( '!/\*[^*]*\*+(?:[^/*][^*]*\*+)*/!', '', $css );
	// Remove whitespace around special characters
	$css = preg_replace( '/\s*([{}:;,])\s*/', '$1', $css );
	// Remove extra whitespace
	$css = preg_replace( '/\s+/', ' ', $css );
	// Remove leading/trailing whitespace
	$css = trim( $css );
	return $css;
}

/**
 * Inline minified CSS in the head for better performance
 */
add_action( 'wp_head', function() {
	$css_file = BOLDFACE_DESIGN_DIR . '/assets/css/style.css';
	
	if ( file_exists( $css_file ) ) {
		$css = file_get_contents( $css_file );
		$minified_css = boldface_design_minify_css( $css );
		echo '<style>' . $minified_css . '</style>' . "\n";
	}
});

/**
 * Enqueue admin styles (Editor/Dashboard)
 * Only load on post editing screens to avoid unnecessary loading in other admin areas
 * This stylesheet can be used to style the block editor and admin pages to match the front-end
 * 
 * @param string $hook The current admin page hook
 */
function boldface_design_enqueue_admin_assets( $hook ) {
	if ( 'post.php' !== $hook && 'post-new.php' !== $hook ) {
		return;
	}
	wp_enqueue_style(
		'boldface-design-admin',
		BOLDFACE_DESIGN_URI . '/assets/css/style.css',
		array(),
		BOLDFACE_DESIGN_VERSION
	);
}
add_action( 'admin_enqueue_scripts', 'boldface_design_enqueue_admin_assets' );

/**
 * Setup theme features
 * - Editor color palette for consistent block styling
 * - Editor font sizes for consistent typography
 * - Dynamic supports from config for flexibility in enabling features like post-thumbnails, custom-logo, etc.
 * - Additional theme supports can be added as needed
 */
function boldface_design_setup() {
	// Add support for block palette
	add_theme_support( 'editor-color-palette', array(
		array( 'name' => 'Primary', 'slug' => 'primary', 'color' => '#0073aa' ),
		array( 'name' => 'Secondary', 'slug' => 'secondary', 'color' => '#005a87' ),
		array( 'name' => 'Light Gray', 'slug' => 'light-gray', 'color' => '#f5f5f5' ),
		array( 'name' => 'Dark Gray', 'slug' => 'dark-gray', 'color' => '#333' ),
		array( 'name' => 'White', 'slug' => 'white', 'color' => '#fff' ),
	) );

	// Add support for font sizes
	add_theme_support( 'editor-font-sizes', array(
		array( 'name' => 'Small', 'slug' => 'small', 'size' => 14 ),
		array( 'name' => 'Normal', 'slug' => 'normal', 'size' => 16 ),
		array( 'name' => 'Large', 'slug' => 'large', 'size' => 20 ),
		array( 'name' => 'Extra Large', 'slug' => 'extra-large', 'size' => 28 ),
	) );

	// Dynamic supports from config
	$supports = boldface_design_get_config_value( 'supports' );
	if ( is_array( $supports ) ) {
		foreach ( $supports as $key => $feature ) {
			if( is_array( $feature ) ) {
				add_theme_support( $key, $feature );
			} else {
				add_theme_support( $feature );
			}
		}
	}
}
add_action( 'after_setup_theme', 'boldface_design_setup' );

function boldface_design_register_custom_post_types() {
	$post_types = boldface_design_get_config_value( 'post_types' );
	if ( is_array( $post_types ) ) {
		foreach ( $post_types as $post_type ) {
			register_post_type( $post_type['slug'], array(
				'labels' => array(
					'name'          => $post_type['plural_name'],
					'singular_name' => $post_type['singular_name'] ?? $post_type['plural_name'],
				),
				'public'        => $post_type['public'] ?? true,
				'publicly_queryable' => $post_type['publicly_queryable'] ?? true,
				'supports'      => $post_type['supports'] ?? array( 'title', 'editor', 'thumbnail' ),
				'rewrite'       => $post_type['rewrite'] ?? array( 'slug' => $post_type['slug'] ),
				'show_in_rest'  => $post_type['show_in_rest'] ?? true,
				'has_archive'   => $post_type['has_archive'] ?? false,
				'menu_position' => $post_type['menu_position'] ?? 20,
				'menu_icon'     => $post_type['menu_icon'] ?? 'dashicons-admin-post',
			) );
		}
	}
}
add_action( 'init', 'boldface_design_register_custom_post_types', 5 );

/**
 * Register custom taxonomies
 * Loads taxonomy definitions from the theme configuration, allowing for flexible taxonomy management
 * This function ensures that all taxonomies are registered on the 'init' hook
 */
function boldface_design_register_custom_taxonomies() {
	$taxonomies = boldface_design_get_config_value( 'taxonomies' );
	if ( is_array( $taxonomies ) ) {
		foreach ( $taxonomies as $taxonomy ) {
			register_taxonomy( $taxonomy['slug'], $taxonomy['post_types'] ?? array(), array(
				'labels' => array(
					'name'          => $taxonomy['plural_name'],
					'singular_name' => $taxonomy['singular_name'] ?? $taxonomy['plural_name'],
				),
				'public'       => $taxonomy['public'] ?? true,
				'show_in_rest' => $taxonomy['show_in_rest'] ?? true,
				'rewrite'      => $taxonomy['rewrite'] ?? array( 'slug' => $taxonomy['slug'] ),
				'hierarchical' => $taxonomy['hierarchical'] ?? false,
			) );
		}
	}
}
add_action( 'init', 'boldface_design_register_custom_taxonomies', 6 );

/**
 * Register custom blocks
 * Loads block definitions from the 'blocks' directory, allowing for modular block development
 * Each block should have its own subdirectory with a block.json file for registration
 * This function ensures that all blocks are registered on the 'init' hook
 */
function boldface_register_blocks() {
	// Load ACF block.json definitions
	if ( function_exists( 'acf_register_block_type' ) ) {
		$blocks_dir = BOLDFACE_DESIGN_INC . '/blocks';
		if ( is_dir( $blocks_dir ) ) {
			foreach ( glob( $blocks_dir . '/*/block.json' ) as $file ) {
				register_block_type( $file );
			}
		}
	}
}
add_action( 'init', 'boldface_register_blocks' );

/**
 * Register navigation menus
 * Loads menu locations defined in the theme configuration, allowing for flexible menu management
 * This function ensures that all menu locations are registered on the 'init' hook
 * Menu locations can be defined in the theme config file (e.g., 'primary', 'footer') and will be available in the WordPress admin for menu assignment
 */
function boldface_register_nav_menus() {
	register_nav_menus( boldface_design_get_config_value( 'menus' ) );
}
add_action( 'init', 'boldface_register_nav_menus' );

/**
 * Register ACF post meta (Field Groups)
 */
function boldface_register_post_meta() {
	$blocks_dir = BOLDFACE_DESIGN_INC . '/blocks';
	if ( is_dir( $blocks_dir ) ) {
		foreach ( glob( $blocks_dir . '/*/register-post-meta.php' ) as $file ) {
			require_once $file;
		}
	}
}
add_action( 'acf/init', 'boldface_register_post_meta' );

/**
 * Register Custom Block Category
 * Adds a new block category for our custom blocks to keep them organized in the editor
 * 
 * @param array $block_categories Existing block categories
 * @return array Modified block categories with our custom category added
 */
function boldface_block_category( $block_categories ) {
	return array_merge( [
		[
			'slug'  => boldface_design_get_config_value( 'block_category' ),
			'title' => boldface_design_get_config_value( 'block_name' ),
			'icon'  => 'admin-generic',
		],
	], $block_categories );
}
add_filter( 'block_categories_all', 'boldface_block_category' );

/**
 * Customize excerpt length and "read more" text
 * - Sets a custom excerpt length of 20 words for better control over content display
 * 
 * @param int $length The existing excerpt length (default is usually 55)
 * @return int Modified excerpt length
 */
function boldface_design_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'boldface_design_excerpt_length' );

/** 
 * Customize the "read more" text for excerpts
 * - Adds an ellipsis and a "Read More" link that directs to the full post
 * 
 * @param string $more The existing "read more" text (default is usually '...')
 * @return string Modified "read more" text with a link to the full post
 */
function boldface_design_excerpt_more( $more ) {
	return ' ... <a href="' . esc_url( get_permalink() ) . '">Read More</a>';
}
add_filter( 'excerpt_more', 'boldface_design_excerpt_more' );

/**
 * Allow SVG files to be uploaded as images
 *
 * @param array $mimes Allowed mime types
 * @return array Modified mime types
 */
function boldface_upload_svg_as_image( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter( 'upload_mimes', 'boldface_upload_svg_as_image' );

/**
 * Add custom body classes based on page context
 * - 'single-post' for single blog posts
 * - 'is-page' for all pages
 * - 'is-front-page' for the homepage
 * 
 * @param array $classes Existing body classes
 * @return array Modified body classes
 */
function boldface_body_class( $classes ) {
	$classes = [ 'boldface-design' ];
	if ( is_singular( 'post' ) ) $classes[] = 'single-post';
	if ( is_page() ) $classes[] = 'is-page';
	if ( is_front_page() ) $classes[] = 'is-front-page';
	return $classes;
}
add_filter( 'body_class', 'boldface_body_class' );

/**
 * Add custom post classes based on page context
 *
 * @param array $classes Existing post classes
 * @return array Modified post classes
 */
function boldface_post_class( $classes ) {
	if ( is_singular() ) $classes[] = 'container mx-auto';
	return $classes;
}
add_filter( 'post_class', 'boldface_post_class' );


/**
 * Disable Yoast's Organization/Company schema 
 * while keeping the rest of the graph intact.
 */
// add_filter( 'wpseo_schema_graph_pieces', function( $pieces, $context ) {
//     return array_filter( $pieces, function( $piece ) {
//         // This removes the 'Organization' and 'Company' nodes from Yoast's output
//         return ! ( $piece instanceof \Yoast\WP\SEO\Generators\Schema\Organization || 
//                    $piece instanceof \Yoast\WP\SEO\Generators\Schema\Company );
//     } );
// }, 11, 2 );

// add_filter( 'wpseo_schema_webpage', function( $data ) {
//     if ( is_front_page() ) {
//         $data['about'] = [ '@id' => home_url( '/#organization' ) ];
//     }
//     return $data;
// } );

add_action( 'wp_head', function() {
	if ( ! is_front_page() ) return;
	?>
	<link rel="preload" fetchpriority="high" as="image" href="https://boldfacedesign.com/wp-content/uploads/2026/03/hero-poster-scaled.jpg">
	<?php
});

add_filter( 'wp_calculate_image_srcset', '__return_false' );

add_action('wp_footer', function() {
	// GA4_ID should include G-
    if (defined('GA4_ID')) {
		$id = GA4_ID;
		?>
		<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $id; ?>"></script>
		<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		gtag('config', '<?php echo $id; ?>');
		</script>
        <?php
    }
}, 20);