<?php
/**
 * Contact Form Block Template
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get field values
$heading = get_field( 'heading' ) ?: '';
$content = get_field( 'content' ) ?: '';
$form_id = get_field( 'form' );

// Build class name
$class_name = 'wp-block-boldface-design-contact-form bg-white text-mine-shaft w-full px-sm md:px-lg py-2xl';

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
        <?php if ( $heading ) : ?>
            <h2 class="mb-lg"><?php echo wp_kses_post( $heading ); ?></h2>
        <?php endif; ?>

		<div class="grid grid-cols-1 md:grid-cols-2 gap-xl lg:gap-2xl">
			<div class="flex flex-col justify-start">
				<?php if ( $content ) : ?>
					<div class="text-abbey">
						<?php echo wp_kses_post( wpautop( $content ) ); ?>
					</div>
				<?php endif; ?>
			</div>

			<div class="flex flex-col">
				<?php if ( $form_id ) : ?>                    
					<?php echo do_shortcode( '[ws_form id="' . intval( $form_id ) . '"]' ); ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
