<?php
/**
 * Header landing template
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>

	<a href="#main" class="screen-reader-text">
		<?php esc_html_e( 'Skip to content', 'boldface-design' ); ?>
	</a>

	<?php 
    get_template_part( 'template-parts/nav', 'landing' );
