<?php
/**
 * Post meta template part
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="post-meta">
	<?php
	if ( is_singular( 'post' ) ) {
		?>
		<span class="post-author">
			<?php
			echo sprintf(
				wp_kses_post( __( 'By <a href="%s">%s</a>', 'boldface-design' ) ),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_html( get_the_author() )
			);
			?>
		</span>

		<span class="post-date">
			<?php echo esc_html( get_the_date() ); ?>
		</span>

		<?php
		$categories = get_the_category();
		if ( ! empty( $categories ) ) {
			?>
			<span class="post-categories">
				<?php
				foreach ( $categories as $category ) {
					?>
					<a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>">
						<?php echo esc_html( $category->name ); ?>
					</a>
					<?php
				}
				?>
			</span>
			<?php
		}
	}
	?>
</div>
