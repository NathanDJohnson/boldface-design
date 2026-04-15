<?php
/**
 * Value Props Block Template
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get field values
$intro_heading        = get_field( 'intro_heading' ) ?: '';
$intro_description    = get_field( 'intro_description' ) ?: '';
$value_props_columns  = get_field( 'value_props_columns' ) ?: 'three';
$text_alignment       = get_field( 'text_alignment' ) ?: 'left';
$value_props          = get_field( 'value_props' ) ?: array();
$case_studies_link    = get_field( 'case_studies_link' ) ?: '';

$column_class = 'w-full';
if ( 'two' === $value_props_columns ) {
	$column_class .= ' md:w-[calc(50%-1rem)]';
} elseif ( 'three' === $value_props_columns ) {
	$column_class .= ' md:w-[calc(33.3%-1rem)]';
} elseif ( 'four' === $value_props_columns ) {
	$column_class .= ' md:w-[calc(25%-1rem)]';
}

$align_class = 'text-left';
if ( 'center' === $text_alignment ) {
	$align_class = 'text-center';
}

// Build class name
$class_name = 'wp-block-boldface-design-value-props not-prose bg-observatory text-white w-full px-sm md:px-lg py-2xl';

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
		<?php if ( $intro_heading ) : ?>
			<h2 class="mb-lg text-left"><?php echo wp_kses_post( $intro_heading ); ?></h2>
		<?php endif; ?>

		<?php if ( $intro_description ) : ?>
			<p class="mb-2xl max-w-1100px text-left"><?php echo wp_kses_post( $intro_description ); ?></p>
		<?php endif; ?>

		<?php if ( ! empty( $value_props ) ) : ?>
			<div class="flex flex-wrap justify-center gap-lg mb-2xl">
				<?php foreach ( $value_props as $prop ) : ?>
					<?php
					$icon        = $prop['icon'] ?? '';
					$title       = $prop['title'] ?? '';
					$description = $prop['description'] ?? '';
					?>
					<div class="bg-[rgba(0,0,0,0.2)] shadow-md <?php echo esc_attr( $column_class ); ?> rounded-lg p-lg <?php echo $align_class; ?>">
						<?php if ( $title ) : ?>
							<h3 class="text-sulfur mb-sm"><?php echo wp_kses_post( $title ); ?></h3>
						<?php endif; ?>

						<?php if ( $description ) : ?>
							<p class="text-white"><?php echo wp_kses_post( $description ); ?></p>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<?php if ( ! empty( $case_studies_link ) ) : ?>
			<a href="<?php echo esc_url( $case_studies_link['url'] ); ?>" 
				class="btn btn-sulfur"
				<?php if ( ! empty( $case_studies_link['target'] ) ) { echo 'target="' . esc_attr( $case_studies_link['target'] ) . '"'; } ?>>
				<?php echo esc_html( $case_studies_link['title'] ); ?>
			</a>
		<?php endif; ?>
	</div>
</section>
