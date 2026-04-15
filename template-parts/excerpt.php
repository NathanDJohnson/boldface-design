<?php
/**
 * Post excerpt template part
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$excerpt = wp_strip_all_tags( get_the_excerpt() );
if ( ! $excerpt ) {
	$excerpt = wp_strip_all_tags( get_the_content() );
	$excerpt = wp_trim_words( $excerpt, 55 );
}
?>

<div class="post-excerpt">
	<p><?php echo wp_kses_post( $excerpt ); ?></p>
</div>
