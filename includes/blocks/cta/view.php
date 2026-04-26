<?php
/**
 * CTA Block Template
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get field values
$heading            = boldface_deorphan( get_field( 'heading' ) ) ?: '';
$heading_placement  = get_field( 'heading_placement' ) ?: 'above';
$description        = boldface_deorphan( get_field( 'description' ) ) ?: '';
$display_mode       = get_field( 'display_mode' ) ?: 'buttons';
$cta_buttons        = 'buttons' === $display_mode ? get_field( 'cta_buttons' ) ?: array() : array();
$form_id            = 'form' === $display_mode ? get_field( 'form_id' ) : 0;
$form_heading       = 'form' === $display_mode ? get_field( 'form_heading' ) : '';
$form_content       = 'form' === $display_mode ? get_field( 'form_content' ) : '';

// Build class name
$class_name = 'wp-block-boldface-design-cta bg-gradient-abyss w-full px-sm md:px-lg py-2xl';

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
	<div class="max-w-1100px mx-auto text-center">
		<?php if ( 'above' === $heading_placement && $heading ) : ?>
			<h2 class="text-white mb-lg"><?php echo wp_kses_post( nl2br( $heading ) ); ?></h2>
		<?php endif; ?>

		<?php if ( $description ) : ?>
            <?php
                $description_class = 'text-white mb-md';
                if ( 'below' === $heading_placement ) {
                     $description_class .= ' text-h3';
                }
            ?>
			<p class="<?php echo $description_class; ?>"><?php echo wp_kses_post( nl2br( $description ) ); ?></p>
		<?php endif; ?>

		<?php if ( 'below' === $heading_placement && $heading ) : ?>
			<h2 class="text-white mb-lg"><?php echo wp_kses_post( nl2br( $heading ) ); ?></h2>
		<?php endif; ?>

		<?php if ( 'buttons' === $display_mode && ! empty( $cta_buttons ) ) : ?>
			<div class="flex flex-wrap justify-center gap-md mt-lg">
				<?php foreach ( $cta_buttons as $button ) : ?>
					<?php if ( ! empty( $button['button_link'] ) ) : ?>
						<?php 
							$button_style = $button['button_style'] ?? 'solid';
							$btn_class = 'solid' === $button_style 
								? 'btn btn-observatory' 
								: 'btn btn-observatory btn-outline-observatory';
						?>
						<a href="<?php echo esc_url( $button['button_link']['url'] ); ?>" 
						   class="<?php echo esc_attr( $btn_class ); ?>"
						   <?php if ( ! empty( $button['button_link']['target'] ) ) { echo 'target="' . esc_attr( $button['button_link']['target'] ) . '"'; } ?>>
						    <?php echo esc_html( $button['button_link']['title'] ); ?>
						</a>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		<?php elseif ( 'form' === $display_mode && ! empty( $form_id ) ) : ?>
			<div class="mt-2xl grid grid-cols-1 lg:grid-cols-2 gap-lg lg:gap-xl items-start">
				<div class="text-left">
					<?php if ( $form_heading ) : ?>
						<h3 class="text-white mb-md"><?php echo wp_kses_post( nl2br( $form_heading ) ); ?></h3>
					<?php endif; ?>
					<?php if ( $form_content ) : ?>
						<div class="text-white prose prose-invert max-w-none">
							<?php echo wp_kses_post( $form_content ); ?>
						</div>
					<?php endif; ?>
				</div>
				<div class="form-wrapper text-left">
					<?php echo do_shortcode( '[ws_form id="' . intval( $form_id ) . '"]' ); ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
</section>
