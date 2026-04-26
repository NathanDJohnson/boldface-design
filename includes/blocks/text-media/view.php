<?php
/**
 * Text & Media Block Template
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get field values
$heading = boldface_deorphan( get_field( 'heading' ) ) ?: '';
$content = boldface_deorphan( get_field( 'content' ) ) ?: '';
$image = get_field( 'image' );
$video_embed = get_field( 'video_embed' ) ?: '';
$media_position = get_field( 'media_position' ) ?: 'left';

$background = get_field( 'background' ) ?: 'bg-white';

// Determine text color based on background
$text_color_class = 'text-mine-shaft';
if ( in_array( $background, array( 'bg-gradient-abyss' , 'bg-denim', 'bg-mine-shaft' ), true ) ) {
	$text_color_class = 'text-white';
}

// Build class name
$class_name = "wp-block-boldface-design-text-media w-full px-sm md:px-lg py-2xl {$background} {$text_color_class}";

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

// Determine grid order for desktop layout
$text_order = 'md:order-1';
$media_order = 'md:order-2';

if ( 'right' === $media_position ) {
	$text_order = 'md:order-2';
	$media_order = 'md:order-1';
}
?>

<section class="<?php echo esc_attr( $class_name ); ?>" <?php echo wp_kses_post( $id ); ?>>
	<div class="max-w-1280px mx-auto">
		<div class="grid grid-cols-1 md:grid-cols-2 gap-lg lg:gap-xl items-start">

			<div class="<?php echo esc_attr( $media_order ); ?> flex flex-col">
				<?php if ( $image ) : ?>
					<?php 
					$img_url = is_array( $image ) ? $image['url'] : $image;
					$img_alt = is_array( $image ) ? ( $image['alt'] ?: '' ) : '';
					?>
					<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>" class="w-full h-auto object-cover rounded" />
				<?php elseif ( $video_embed ) : ?>
					<div class="aspect-video rounded overflow-hidden bg-mine-shaft">
						<?php echo wp_oembed_get( esc_url( $video_embed ) ); ?>
					</div>
				<?php endif; ?>
			</div>

			<div class="<?php echo esc_attr( $text_order ); ?> flex flex-col">
				<?php if ( $heading ) : ?>
					<h2 class="mb-lg"><?php echo wp_kses_post( $heading ); ?></h2>
				<?php endif; ?>

				<?php if ( $content ) : ?>
					<?php echo wp_kses_post( wpautop( $content ) ); ?>
				<?php endif; ?>
			</div>

		</div>
	</div>
</section>
