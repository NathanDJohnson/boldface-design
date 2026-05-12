<?php
/**
 * Block Registration
 * Register custom blocks and ACF field groups
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

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
