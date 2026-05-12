<?php
/**
 * Before/After Block Template
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get field values
$header              = boldface_deorphan( get_field( 'header' ) ) ?: '';
$content             = boldface_deorphan( get_field( 'content' ) ) ?: '';
$before_image        = get_field( 'before_image' );
$before_caption      = boldface_deorphan( get_field( 'before_caption' ) ) ?: '';
$after_image         = get_field( 'after_image' );
$after_caption       = boldface_deorphan( get_field( 'after_caption' ) ) ?: '';
$background_color    = get_field( 'background' ) ?: 'bg-white';

// Build class name
$class_name = boldface_design_get_block_common_classes( 'before-after', $block, $background_color );

// Build ID
$id = '';
if ( isset( $block['anchor'] ) ) {
	$id = 'id="' . esc_attr( $block['anchor'] ) . '"';
}
?>

<section class="<?php echo esc_attr( $class_name ); ?>" <?php echo wp_kses_post( $id ); ?>>
	<div class="container mx-auto px-sm py-2xl">
		<?php if ( $header ) : ?>
			<h2 class="text-h2 mb-md"><?php echo wp_kses_post( $header ); ?></h2>
		<?php endif; ?>

		<?php if ( $content ) : ?>
			<div class="[&_p]:text-body mb-lg"><?php echo wp_kses_post( $content ); ?></div>
		<?php endif; ?>

		<?php if ( $before_image || $after_image ) : ?>
			<div class="grid grid-cols-1 md:grid-cols-2 gap-lg">
				<?php if ( $before_image ) : ?>
					<div class="flex flex-col">
						<?php
							$before_image_id = is_array( $before_image ) ? $before_image['ID'] : $before_image;
							echo wp_get_attachment_image( $before_image_id, 'full', false, array( 'class' => 'w-full h-auto object-cover rounded-md aspect-video' ) );
						?>
						<?php if ( $before_caption ) : ?>
							<p class="text-center mt-sm text-caption"><?php echo wp_kses_post( $before_caption ); ?></p>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<?php if ( $after_image ) : ?>
					<div class="flex flex-col">
						<?php
							$after_image_id = is_array( $after_image ) ? $after_image['ID'] : $after_image;
							echo wp_get_attachment_image( $after_image_id, 'full', false, array( 'class' => 'w-full h-auto object-cover rounded-md aspect-video' ) );
						?>
						<?php if ( $after_caption ) : ?>
							<p class="text-center mt-sm text-caption"><?php echo wp_kses_post( $after_caption ); ?></p>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
