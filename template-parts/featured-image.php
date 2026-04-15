<?php
/**
 * Featured image template part
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! has_post_thumbnail() ) {
	return;
}
?>

<figure class="post-thumbnail">
	<?php
	if ( is_singular() ) {
		the_post_thumbnail( 'large' );
	} else {
		?>
		<a href="<?php echo esc_url( get_permalink() ); ?>">
			<?php the_post_thumbnail( 'large' ); ?>
		</a>
		<?php
	}
	?>
	<?php
	if ( wp_get_attachment_caption( get_post_thumbnail_id() ) ) {
		?>
		<figcaption>
			<?php
			echo wp_kses_post( wp_get_attachment_caption( get_post_thumbnail_id() ) );
			?>
		</figcaption>
		<?php
	}
	?>
</figure>
