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
define( 'BOLDFACE_DESIGN_VERSION', '1.1.0' );
define( 'BOLDFACE_DESIGN_DIR', get_template_directory() );
define( 'BOLDFACE_DESIGN_URI', get_template_directory_uri() );
define( 'BOLDFACE_DESIGN_INC', BOLDFACE_DESIGN_DIR . '/includes' );
define( 'BOLDFACE_DESIGN_BLOCKS', BOLDFACE_DESIGN_INC . '/blocks' );
define( 'BOLDFACE_DESIGN_ASSETS', BOLDFACE_DESIGN_URI . '/assets' );

/**
 * Include template functions, utilities, and organized modules
 */
require_once BOLDFACE_DESIGN_INC . '/utilities.php';
require_once BOLDFACE_DESIGN_INC . '/config.php';
require_once BOLDFACE_DESIGN_INC . '/template-functions.php';
require_once BOLDFACE_DESIGN_INC . '/setup.php';
require_once BOLDFACE_DESIGN_INC . '/post-types.php';
require_once BOLDFACE_DESIGN_INC . '/blocks.php';
require_once BOLDFACE_DESIGN_INC . '/assets.php';
require_once BOLDFACE_DESIGN_INC . '/filters.php';
require_once BOLDFACE_DESIGN_INC . '/admin.php';
require_once BOLDFACE_DESIGN_INC . '/schema.php';
require_once BOLDFACE_DESIGN_INC . '/cleanup.php';
require_once BOLDFACE_DESIGN_INC . '/acf-blocks.php';
require_once BOLDFACE_DESIGN_INC . '/tracking.php';
