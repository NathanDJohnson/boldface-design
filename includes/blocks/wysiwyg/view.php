<?php
/**
 * WYSIWYG Block Template
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get field values
$heading = get_field( 'heading' );
$content = get_field( 'content' );
$background = get_field( 'background' ) ?: 'bg-white';

// Determine text color based on background
$text_color_class = 'text-mine-shaft';
if ( in_array( $background, array( 'bg-gradient-abyss' , 'bg-denim', 'bg-mine-shaft' ), true ) ) {
	$text_color_class = 'text-white';
}

// Build class name
$class_name = "wp-block-boldface-design-wysiwyg max-w-none w-full px-sm md:px-lg py-2xl {$background} {$text_color_class}";

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
	<div class="container text-left mx-auto">
        <?php if ( $heading ) : ?>
            <h2 class="mb-lg"><?php echo wp_kses_post( $heading ); ?></h2>
        <?php endif; ?>
		<?php if ( $content ) : ?>
            <div class="text-body">
			    <?php echo wp_kses_post( wpautop( $content ) ); ?>
            </div>
		<?php endif; ?>
	</div>
</section>
