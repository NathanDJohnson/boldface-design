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
$heading = boldface_deorphan( get_field( 'heading' ) ) ?: '';
$content = get_field( 'content' ) ?: '';
$background = get_field( 'background' ) ?: 'bg-white';

// Build class name
$class_name = boldface_design_get_block_common_classes( 'wysiwyg', $block );

// Build ID
$id = '';
if ( isset( $block['anchor'] ) ) {
	$id = 'id="' . esc_attr( $block['anchor'] ) . '"';
}
?>

<section class="<?php echo esc_attr( $class_name ); ?>" <?php echo $id; ?>>
	<div class="container text-left mx-auto">
        <?php if ( $heading ) : ?>
            <h2 class="mb-lg"><?php echo wp_kses_post( $heading ); ?></h2>
        <?php endif; ?>
		<?php if ( $content ) : ?>
            <div class="text-body">
			    <?php echo wpautop( $content ); ?>
            </div>
		<?php endif; ?>
	</div>
</section>
