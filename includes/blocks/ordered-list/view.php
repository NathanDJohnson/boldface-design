<?php
/**
 * Ordered List Block Template
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get field values
$heading = get_field( 'heading' ) ?: '';
$content = get_field( 'content' ) ?: '';
$items = get_field( 'items' ) ?: array();
$image = get_field( 'image' );
$background = get_field( 'background' ) ?: 'bg-white';

// Determine text color based on background
$text_color_class = 'text-mine-shaft';
if ( in_array( $background, array( 'bg-gradient-abyss', 'bg-denim', 'bg-mine-shaft' ), true ) ) {
	$text_color_class = 'text-white';
}

// Build class name
$class_name = "wp-block-boldface-design-ordered-list w-full px-sm md:px-lg py-2xl {$background} {$text_color_class}";

if ( isset( $block['align'] ) ) {
	$class_name .= ' align' . $block['align'];
}

if ( isset( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}

// Build ID
$id = '';
if ( isset( $block['anchor'] ) ) {
	$id = 'id="' . esc_attr( $block['anchor'] ) . '"';
}
?>

<section class="<?php echo esc_attr( $class_name ); ?>" <?php echo wp_kses_post( $id ); ?>>
	<div class="max-w-1280px mx-auto">
		<!-- Header Section -->
		<div class="mb-2xl">
			<?php if ( $heading ) : ?>
				<h2 class="mb-lg"><?php echo wp_kses_post( $heading ); ?></h2>
			<?php endif; ?>

			<?php if ( $content ) : ?>
				<div class="prose prose-sm max-w-none">
					<?php echo wp_kses_post( wpautop( $content ) ); ?>
				</div>
			<?php endif; ?>
		</div>

		<!-- List Items Grid -->
		<?php if ( ! empty( $items ) ) : ?>
			<div class="grid grid-cols-1 md:grid-cols-2 gap-lg lg:gap-2xl mb-2xl">
				<?php foreach ( $items as $index => $item ) : ?>
					<?php
					$item_title = $item['title'] ?? '';
					$item_description = $item['description'] ?? '';
					$item_number = $index + 1;
					?>
					<div class="flex gap-lg">
						<!-- Number Circle -->
						<div class="flex-shrink-0 w-16 h-16 rounded-full bg-observatory flex items-center justify-center">
							<p class="text-white font-bold text-h3"><?php echo intval( $item_number ); ?></p>
						</div>

						<!-- Item Content -->
						<div class="flex-1">
							<?php if ( $item_title ) : ?>
								<h3 class="font-semibold mb-sm"><?php echo wp_kses_post( $item_title ); ?></h3>
							<?php endif; ?>

							<?php if ( $item_description ) : ?>
								<div class="text-body prose">
									<?php echo wp_kses_post( wpautop( $item_description ) ); ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<!-- Image Section -->
		<?php if ( $image ) : ?>
			<?php 
			$img_url = is_array( $image ) ? $image['url'] : $image;
			$img_alt = is_array( $image ) ? ( $image['alt'] ?: '' ) : '';
			?>
			<div class="rounded overflow-hidden h-auto w-full">
				<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>" class="w-full h-auto object-cover" />
			</div>
		<?php endif; ?>
	</div>
</section>
