<?php
/**
 * Search template
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="main" class="site-main w-full bg-white px-sm md:px-lg py-2xl">
	<div class="max-w-1280px mx-auto">
		
		<header class="page-header mb-2xl">
			<h1 class="text-h1 text-mine-shaft mb-md">
				<?php esc_html_e( 'Search Results', 'boldface-design' ); ?>
			</h1>
			<p class="text-lead text-abbey mb-lg">
				<?php
				printf(
					esc_html__( 'You searched for: %s', 'boldface-design' ),
					'<span class="font-semibold text-observatory">"' . esc_html( get_search_query() ) . '"</span>'
				);
				?>
			</p>
		</header>

		<?php if ( have_posts() ) : ?>

			<div class="grid grid-cols-1 md:grid-cols-2 gap-lg mb-2xl">
				<?php while ( have_posts() ) : ?>
					<?php the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'bg-whisper rounded-lg overflow-hidden hover:shadow-lg transition-shadow border border-whisper' ); ?>>
						
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="post-thumbnail h-200px overflow-hidden">
								<a href="<?php echo esc_url( get_permalink() ); ?>" class="block w-full h-full">
									<?php the_post_thumbnail( 'medium', array( 'class' => 'w-full h-full object-cover hover:scale-105 transition-transform duration-300' ) ); ?>
								</a>
							</div>
						<?php endif; ?>

						<div class="p-lg">
							
							<?php if ( 'post' === get_post_type() ) : ?>
								<div class="entry-meta text-caption text-abbey mb-md">
									<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" class="text-observatory">
										<?php echo esc_html( get_the_date() ); ?>
									</time>
									<?php
									$categories = get_the_category();
									if ( ! empty( $categories ) ) {
										echo ' • ';
										echo esc_html( $categories[0]->name );
									}
									?>
								</div>
							<?php endif; ?>

							<?php the_title( '<h3 class="text-h4 text-mine-shaft mb-md"><a href="' . esc_url( get_permalink() ) . '" class="hover:text-observatory transition-colors">', '</a></h3>' ); ?>

							<div class="entry-summary text-body text-abbey mb-lg">
								<?php the_excerpt(); ?>
							</div>

							<a href="<?php echo esc_url( get_permalink() ); ?>" class="inline-flex items-center font-semibold text-observatory hover:text-cyprus transition-colors">
								<?php esc_html_e( 'Read More', 'boldface-design' ); ?>
								<svg class="w-5 h-5 ml-xs" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
								</svg>
							</a>
						</div>
					</article>
				<?php endwhile; ?>
			</div>

			<nav class="pagination flex justify-center items-center gap-sm mb-2xl">
				<?php
				the_posts_pagination( array(
					'prev_text' => '<span class="sr-only">Previous</span><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>',
					'next_text' => '<span class="sr-only">Next</span><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>',
					'before_page_number' => '<span class="px-xs py-xs rounded text-sm">',
					'after_page_number' => '</span>',
				) ); 
				?>
			</nav>

		<?php else : ?>

			<article id="post-0" class="post no-results not-found text-center mb-2xl">
				<div class="max-w-md mx-auto">
					<svg class="w-24 h-24 mx-auto mb-lg text-whisper" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
					</svg>
					
					<h2 class="text-h3 text-mine-shaft mb-md">
						<?php esc_html_e( 'No Results Found', 'boldface-design' ); ?>
					</h2>
					
					<p class="text-body text-abbey mb-lg">
						<?php esc_html_e( 'Sorry, we couldn\'t find anything matching your search. Please try different keywords or check your spelling.', 'boldface-design' ); ?>
					</p>

					<div class="mb-lg">
						<?php get_search_form(); ?>
					</div>

					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="inline-flex items-center font-semibold text-observatory hover:text-cyprus transition-colors">
						<?php esc_html_e( 'Back to Home', 'boldface-design' ); ?>
						<svg class="w-5 h-5 ml-xs" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
						</svg>
					</a>
				</div>
			</article>

		<?php endif; ?>

	</div>
</main>

<?php
get_footer();
