<?php
/**
 * Archive Block Template
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get field values
$heading = boldface_deorphan( get_field( 'heading' ) ) ?: '';
$content = boldface_deorphan( get_field( 'content' ) ) ?: '';
$post_type = get_field( 'post_type' ) ?: 'post';
$sort_order = get_field( 'sort_order' ) ?: 'newest';
$posts_per_page = intval( get_field( 'posts_per_page' ) ) ?: 6;

// Set up query arguments
$args = array(
	'post_type'      => $post_type,
	'posts_per_page' => $posts_per_page,
	'paged'          => 1,
);

// Handle sort order
if ( 'oldest' === $sort_order ) {
	$args['orderby'] = 'date';
	$args['order']   = 'ASC';
} elseif ( 'alphabetical' === $sort_order ) {
	$args['orderby'] = 'title';
	$args['order']   = 'ASC';
} else {
	$args['orderby'] = 'date';
	$args['order']   = 'DESC';
}

$posts_query = new WP_Query( $args );

// Build class name
$class_name = boldface_design_get_block_common_classes( 'archive', $block );

// Build ID
$id = '';
if ( isset( $block['anchor'] ) ) {
	$id = 'id="' . esc_attr( $block['anchor'] ) . '"';
}
?>

<section class="<?php echo esc_attr( $class_name ); ?>" <?php echo $id; ?>>
	<div class="max-w-1280px mx-auto">
		<div class="mb-2xl">
			<?php if ( $heading ) : ?>
				<h2 class="mb-lg"><?php echo wp_kses_post( $heading ); ?></h2>
			<?php endif; ?>

			<?php if ( $content ) : ?>
				<?php echo wp_kses_post( wp_autop( $content ) ); ?>
			<?php endif; ?>
		</div>

		<?php if ( $posts_query->have_posts() ) : ?>
			<div class="grid grid-cols-1 md:grid-cols-2 gap-lg lg:gap-xl">
				<?php
				while ( $posts_query->have_posts() ) :
					$posts_query->the_post();
					?>
					<article class="group relative overflow-hidden rounded h-[400px]">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="absolute inset-0">
								<?php
								the_post_thumbnail(
									'large',
									array(
										'class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-300',
									)
								);
								?>
							</div>
						<?php else : ?>
							<div class="absolute inset-0 bg-whisper"></div>
						<?php endif; ?>

					<div class="absolute inset-0 bg-gradient-to-t from-mine-shaft via-transparent to-transparent opacity-90"></div>

					<a href="<?php echo esc_url( get_permalink() ); ?>" class="absolute inset-0 z-10" title="<?php echo esc_attr( get_the_title() ); ?>"></a>

					<div class="absolute inset-0 flex flex-col justify-end p-lg md:p-xl pointer-events-none">
						<?php if ( get_the_title() ) : ?>
							<h3 class="text-h4 font-semibold text-white mb-sm group-hover:text-observatory transition-colors">
								<?php echo wp_kses_post( get_the_title() ); ?>
							</h3>
						<?php endif; ?>

						<?php
						$excerpt = get_the_excerpt();
						if ( $excerpt ) :
							?>
							<p class="text-caption text-white line-clamp-2">
								<?php echo wp_kses_post( $excerpt ); ?>
							</p>
						<?php endif; ?>
					</div>
					</article>
				<?php
				endwhile;
				wp_reset_postdata();
				?>
			</div>
		<?php else : ?>
			<p class="text-abbey italic"><?php esc_html_e( 'No posts found.', 'boldface-design' ); ?></p>
		<?php endif; ?>
	</div>
</section>
