<?php
/**
 * Features Block Template
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get field values
$background       = get_field( 'background' ) ?: 'bg-white';
$columns          = get_field( 'features_columns' ) ?: 'four';
$service_items    = get_field( 'service_items' ) ?: array();
$description      = boldface_deorphan( get_field( 'description' ) ) ?: '';
$content          = boldface_deorphan( get_field( 'content' ) ) ?: '';

$text_color_class = boldface_design_get_text_color_from_background_color( $background );

// Build class name
$class_name = "wp-block-boldface-design-features max-w-none w-full px-sm md:px-lg py-2xl {$background} {$text_color_class}";

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
	<div class="container mx-auto">
		<div class="text-left">
			<?php if ( $description ) : ?>
				<h2 class="medium mb-lg"><?php echo wp_kses_post( $description ); ?></h2>
			<?php else : ?>
				<h2 class="sr-only">Features</h2>
			<?php endif; ?>

			<?php if ( $content ) : ?>
				<div class="text-body [&_p]:mb-md">
					<?php echo wp_kses_post( $content ); ?>
				</div>
			<?php endif; ?>
		</div>
		<?php if ( ! empty( $service_items ) ) : ?>
			<?php
			$grid_cols = 'grid gap-lg lg:gap:2xl';
			if ( $columns === 'one' ) {
				$grid_cols .= ' grid-cols-1';
			} else if (  $columns === 'two' ) {
				$grid_cols .= ' grid-cols-1 md:grid-cols-2';
			} else if (  $columns === 'three' ) {
				$grid_cols .= ' grid-cols-1 md:grid-cols-3';
			} else if (  $columns === 'four' ) {
				$grid_cols .= ' grid-cols-1 md:grid-cols-2 lg:grid-cols-4';
			}
			?>
			<div class="<?php echo esc_attr( $grid_cols ); ?>">
				<?php foreach ( $service_items as $item ) : ?>
					<?php
					$image   = $item['image'] ?? '';
					$title   = $item['title'] ?? '';
					$item_content = $item['content'] ?? '';
					?>
					<div class="overflow-hidden">
						<?php if ( $image ) : ?>
							<div class="h-300px w-full rounded-xl overflow-hidden">
								<?php
								if ( is_array( $image ) ) {
									echo wp_kses_post( wp_get_attachment_image( $image['ID'], 'large', false, array( 'class' => 'w-full h-full object-cover' ) ) );
								} else {
									echo wp_kses_post( wp_get_attachment_image( $image, 'large', false, array( 'class' => 'w-full h-full object-cover' ) ) );
								}
								?>
							</div>
						<?php endif; ?>

						<div class="pt-lg">
							<?php if ( $title ) : ?>
								<h3 class="font-medium font-sans md:text-h4 mb-sm"><?php echo wp_kses_post( $title ); ?></h3>
							<?php endif; ?>

							<?php if ( $item_content ) : ?>
								<p class="text-body"><?php echo wp_kses_post( $item_content ); ?></p>
							<?php endif; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>