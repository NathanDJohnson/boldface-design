<?php
/**
 * Footer landing template
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
	<footer id="colophon" class="site-footer relative border-t-8 border-sulfur bg-white">
		<div class="container mx-auto px-lg py-xl">
			<div class="bg-transparent absolute top-0 transform -translate-y-3/4">
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/boldface-logo-footer.svg' ); ?>" alt="Boldface Design Logo" class="h-16 mx-auto" width="48" height="64">
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
			</div>
		</div>
	</footer>

	<?php wp_footer(); ?>
</body>
</html>
