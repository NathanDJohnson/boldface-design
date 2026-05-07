<?php
/**
 * Service Block Template
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get field values
$heading        = boldface_deorphan( get_field( 'heading' ) ) ?: '';
$content        = get_field( 'content' ) ?: '';
$image          = get_field( 'image' );
$image_position = get_field( 'image_position' ) ?: 'left';
$link           = get_field( 'link' );
$background     = get_field( 'background' ) ?: 'bg-white';
$text_color     = boldface_design_get_text_color_from_background_color( $background );


// Build class name
$class_name = boldface_design_get_block_common_classes( 'service', $block );

// Build ID
$id = '';
if ( isset( $block['anchor'] ) ) {
	$id = 'id="' . esc_attr( $block['anchor'] ) . '"';
}

// Determine grid order for desktop layout
$text_order = 'md:order-1';
$image_order = 'md:order-2';

if ( 'right' === $image_position ) {
	$text_order = 'md:order-2';
	$image_order = 'md:order-1';
}

// Button styling based on background
$button_class = 'btn btn-observatory';
if ( in_array( $background, array( 'bg-gradient-abyss', 'bg-observatory', 'bg-denim', 'bg-mine-shaft' ), true ) ) {
	$button_class = 'btn btn-sulfur';
}
?>

<section class="<?php echo esc_attr( $class_name ); ?>" <?php echo $id; ?>>
	<div class="max-w-1280px mx-auto">
		<div class="grid grid-cols-1 md:grid-cols-5 gap-lg lg:gap-xl items-center">

			<div class="<?php echo esc_attr( $image_order ); ?> md:col-span-2 flex flex-col">
				<?php if ( $image ) : ?>
					<?php 
					$img_url = is_array( $image ) ? $image['url'] : $image;
					$img_alt = is_array( $image ) ? ( $image['alt'] ?: '' ) : '';
					
					echo wp_get_attachment_image( is_array( $image ) ? $image['id'] : $image, 'medium_large', false, array( 'class' => 'w-full h-full aspect-square object-cover rounded', 'fetchpriority' => 'low', 'loading' => 'lazy' ) );
					?>
				<?php endif; ?>
			</div>

			<div class="<?php echo esc_attr( $text_order ); ?> md:col-span-3 flex flex-col">
				<?php if ( $heading ) : ?>
					<h3 class="mb-md"><?php echo wp_kses_post( $heading ); ?></h3>
				<?php endif; ?>

				<?php if ( $content ) : ?>
					<div class="mb-lg">
						<?php echo wp_kses_post( wpautop( $content ) ); ?>
					</div>
				<?php endif; ?>

				<?php if ( ! empty( $link ) && ! empty( $link['url'] ) ) : ?>
					<div>
						<a href="<?php echo esc_url( $link['url'] ); ?>" 
						   class="<?php echo esc_attr( $button_class ); ?>"
						   <?php if ( ! empty( $link['target'] ) ) { echo 'target="' . esc_attr( $link['target'] ) . '"'; } ?>>
							<?php echo esc_html( $link['title'] ); ?>
						</a>
					</div>
				<?php endif; ?>
			</div>

		</div>
	</div>
</section>
