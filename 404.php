<?php
/**
 * 404 Not Found page template
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="main" class="site-main w-full">
	<article id="post-0" class="post error404 not-found bg-white px-sm md:px-lg py-2xl">
		<div class="max-w-1280px mx-auto">
			
			<div class="text-center mb-2xl">
				<p class="text-h1 text-observatory font-semibold mb-md">404</p>
				<h1 class="text-h1 text-mine-shaft mb-lg">
					<?php esc_html_e( 'Page Not Found', 'boldface-design' ); ?>
				</h1>
				<p class="text-lead text-abbey max-w-2xl mx-auto mb-lg">
					<?php esc_html_e( 'Sorry, we couldn\'t find the page you\'re looking for. It may have been moved or deleted.', 'boldface-design' ); ?>
				</p>
			</div>

			<div class="mb-2xl max-w-md mx-auto">
				<?php get_search_form(); ?>
			</div>

			<div class="mb-2xl">
				<p class="text-h4 text-center text-mine-shaft mb-lg">
					<?php esc_html_e( 'Or visit these helpful pages:', 'boldface-design' ); ?>
				</p>
				<div class="grid grid-cols-1 md:grid-cols-3 gap-lg max-w-2xl mx-auto">

					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="block p-lg bg-whisper hover:bg-observatory hover:text-white rounded-lg transition-colors text-center, text-mine-shaft group">
						<svg class="w-8 h-8 mx-auto mb-md text-observatory group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 11l9-5M9 20l-7-5"></path>
						</svg>
						<h3 class="font-semibold text-mine-shaft group-hover:text-white mb-xs">
							<?php esc_html_e( 'Home', 'boldface-design' ); ?>
						</h3>
						<p class="text-sm text-abbey group-hover:text-white group-hover:opacity-90">
							<?php esc_html_e( 'Back to homepage', 'boldface-design' ); ?>
						</p>
					</a>

					<?php if ( post_type_exists( 'post' ) ) : ?>
					<a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" class="block p-lg bg-whisper hover:bg-observatory hover:text-white rounded-lg transition-colors text-center text-mine-shaft group">
						<svg class="w-8 h-8 mx-auto mb-md text-observatory group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C6.5 6.253 2 10.998 2 17s4.5 10.747 10 10.747c5.5 0 10-4.998 10-11.747S17.5 6.253 12 6.253z"></path>
						</svg>
						<h3 class="font-semibold text-mine-shaft group-hover:text-white mb-xs">
							<?php esc_html_e( 'Blog', 'boldface-design' ); ?>
						</h3>
						<p class="text-sm text-abbey group-hover:text-white group-hover:opacity-90">
							<?php esc_html_e( 'Read our latest posts', 'boldface-design' ); ?>
						</p>
					</a>
					<?php endif; ?>

					<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="block p-lg bg-whisper hover:bg-ocean-blue hover:text-white rounded-lg transition-colors text-center text-mine-shaft group">
						<svg class="w-8 h-8 mx-auto mb-md text-ocean-blue group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
						</svg>
						<h3 class="font-semibold text-mine-shaft group-hover:text-white mb-xs">
							<?php esc_html_e( 'Contact', 'boldface-design' ); ?>
						</h3>
						<p class="text-sm text-abbey group-hover:text-white group-hover:opacity-90">
							<?php esc_html_e( 'Get in touch with us', 'boldface-design' ); ?>
						</p>
					</a>
				</div>
			</div>

			<div class="text-center pt-lg border-t border-whisper">
				<p class="text-abbey mb-lg">
					<?php esc_html_e( 'Need help? ', 'boldface-design' ); ?>
				</p>
				<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="inline-flex items-center font-semibold text-observatory hover:text-cyprus transition-colors">
					<?php esc_html_e( 'Contact Support', 'boldface-design' ); ?>
					<svg class="w-5 h-5 ml-xs" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
					</svg>
				</a>
			</div>

		</div>
	</article>
</main>

<?php
get_footer();
