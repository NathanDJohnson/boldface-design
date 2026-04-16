<?php
/**
 * Footer template
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
	<footer id="colophon" class="site-footer relative border-t-8 border-sulfur bg-white mt-[4rem]">
		<div class="container mx-auto px-lg py-xl">
			<div class="bg-white absolute top-0 transform -translate-y-3/4">
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/boldface-logo-outline.svg' ); ?>" alt="Boldface Design Logo" class="h-16 mx-auto" width="48" height="64">
			</div>


			<div class="grid grid-cols-1 md:grid-cols-3 gap-xl">
				<div class="footer-info">
					<address class="not-italic leading-[3.025] text-sm mt-[-8px]">
						<strong>Boldface Design Group, Inc.</strong><br>
						4678 White Rock Cir #5<br>
						Boulder, CO 80301<br>
						<a href="tel:+13035066650">(303) 506-6650</a><br>
						<a href="mailto:hello@boldfacedesign.com">hello@boldfacedesign.com</a>
					</address>
				</div>

				<div class="footer-navigation">
					<nav>
						<?php
						wp_nav_menu( array(
							'theme_location' => 'footer',
							'fallback_cb'    => function() {
								echo '<ul class="space-y-xs">';
								echo '<li><a href="' . esc_url( home_url( '/' ) ) . '" class="text-abbey text-footer">Home</a></li>';
								echo '</ul>';
							},
							'container'      => false,
							'items_wrap'     => '<ul class="space-y-xs text-abbey [&_li]:text-footer">%3$s</ul>',
							'depth'          => 1,
						) );
						?>
					</nav>
				</div>

				<div class="footer-social">
					<p class="font-bold text-abbey text-footer mb-sm">Follow our shenanigans:</p>
					<div class="flex gap-md">
						<?php
						$facebook = 'https://www.facebook.com/BoldfaceDesign/';
						$linkedin = 'https://www.linkedin.com/in/boldface/';
						?>
						<a href="<?php echo esc_url( $facebook ); ?>" target="_blank" rel="noopener noreferrer" class="hover:opacity-75 transition" aria-label="Facebook">
							<img loading="lazy" decoding="async" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/facebook.svg' ); ?>" alt="Facebook" class="w-32px h-32px">
						</a>
						<a href="<?php echo esc_url( $linkedin ); ?>" target="_blank" rel="noopener noreferrer" class="hover:opacity-75 transition" aria-label="LinkedIn">
							<img loading="lazy" decoding="async" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/linkedin.svg' ); ?>" alt="LinkedIn" class="w-32px h-32px">
						</a>
					</div>
					<div class="mt-md">
						<p class="text-abbey text-footer">
							&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> 
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="">
								<?php bloginfo( 'name' ); ?>
							</a>
						</p>
					</div>
				</div>
			</div>
		</div>
	</footer>

	<?php wp_footer(); ?>
</body>
</html>
