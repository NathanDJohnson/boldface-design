<?php
/**
 * Single post template
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="main" class="site-main prose max-w-none px-sm">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				<?php
				if ( 'post' === get_post_type() ) {
					?>
					<div class="entry-meta">
						<?php boldface_design_posted_on(); ?>
						<?php boldface_design_posted_by(); ?>
					</div>
					<?php
				}
				?>
			</header>
			<?php
			if ( has_post_thumbnail() ) {
				?>
				<div class="post-thumbnail">
					<?php the_post_thumbnail( 'large' ); ?>
				</div>
				<?php
			}
			?>
			<div class="entry-content">
				<?php
				the_content();

				wp_link_pages( array(
					'before'      => '<div class="page-links">',
					'after'       => '</div>',
					'link_before' => '<span class="page-number">',
					'link_after'  => '</span>',
				) );
				?>
			</div>
			<footer class="entry-footer">
				<?php boldface_design_entry_footer(); ?>
			</footer>
		</article>

		<?php
		// Post navigation
		the_post_navigation( array(
			'prev_text' => esc_html__( 'Previous Post', 'boldface-design' ),
			'next_text' => esc_html__( 'Next Post', 'boldface-design' ),
		) );

		// Comments
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
		?>
	<?php endwhile; ?>
</main>

<?php
get_footer();
