<?php
/**
 * Main template file
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
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<?php
					if ( is_singular() ) {
						the_title( '<h1 class="entry-title">', '</h1>' );
					} else {
						the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' );
					}

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
				<?php
				if ( is_singular( 'post' ) ) {
					?>
					<footer class="entry-footer">
						<?php boldface_design_entry_footer(); ?>
					</footer>
					<?php
				}
				?>
			</article>
			<?php
		endwhile;

		the_posts_pagination( array(
			'prev_text' => esc_html__( 'Previous', 'boldface-design' ),
			'next_text' => esc_html__( 'Next', 'boldface-design' ),
		) );
	else :
		?>
		<article id="post-0" class="post no-results not-found">
			<header class="entry-header">
				<h1 class="entry-title"><?php esc_html_e( 'Nothing here', 'boldface-design' ); ?></h1>
			</header>
			<div class="entry-content">
				<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'boldface-design' ); ?></p>
				<?php get_search_form(); ?>
			</div>
		</article>
		<?php
	endif;
	?>
</main>

<?php
get_footer();
