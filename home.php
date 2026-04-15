<?php
/**
 * Home page template (Blog listing)
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="main" class="site-main prose max-w-none px-sm">
	<header class="page-header">
		<h1 class="page-title">
			<?php
			single_post_title();
			?>
		</h1>
		<?php
		$page_description = get_the_excerpt( get_the_ID() );
		if ( $page_description ) {
			echo '<p class="page-description">' . wp_kses_post( $page_description ) . '</p>';
		}
		?>
	</header>

	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' ); ?>
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
						<a href="<?php echo esc_url( get_permalink() ); ?>">
							<?php the_post_thumbnail( 'large' ); ?>
						</a>
					</div>
					<?php
				}
				?>

				<div class="entry-content">
					<?php
					the_excerpt();
					?>
					<a href="<?php echo esc_url( get_permalink() ); ?>" class="read-more-link">
						<?php esc_html_e( 'Read More', 'boldface-design' ); ?>
					</a>
				</div>

				<footer class="entry-footer">
					<?php boldface_design_entry_footer(); ?>
				</footer>
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
