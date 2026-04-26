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

$background = get_field( 'background' ) ?: 'bg-observatory';
$text_color = boldface_design_get_text_color_from_background_color( $background );

$border_color = match($background) {
    'bg-white', 'bg-whisper' => 'border-observatory',
    'bg-denim', 'bg-mine-shaft', 'bg-gradient-abyss' => 'border-sulfur',
    'bg-observatory' => 'border-white',
    default => 'border-observatory',
};

$column_class = 'shadow-md w-full rounded-lg p-lg';
if ( 'two' === $value_props_columns ) {
	$column_class .= ' md:w-[calc(50%-1rem)]';
} elseif ( 'three' === $value_props_columns ) {
	$column_class .= ' md:w-[calc(33.3%-1rem)]';
} elseif ( 'four' === $value_props_columns ) {
	$column_class .= ' md:w-[calc(25%-1rem)]';
}
if( boldface_design_is_dark_background( $background ) ) {
	$column_class .= ' bg-[rgba(0,0,0,0.2)]';
}

$align_class = ' text-left';
if ( 'center' === $text_alignment ) {
	$align_class = ' text-center';
}
$column_class .= $align_class;

$card_header_color = boldface_design_is_dark_background( $background ) ? 'text-sulfur' : 'text-denim';
$card_subtitle_color = boldface_design_is_dark_background( $background ) ? 'text-whisper' : 'text-mine-shaft';

// Build class name
$class_name = 'wp-block-boldface-design-value-props w-full px-sm md:px-lg py-2xl';
$class_name .= " $background $text_color";

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
					$image       = $prop['image'] ?? '';
					$title       = $prop['title'] ?? '';
					$subtitle    = $prop['subtitle'] ?? '';
					$description = $prop['description'] ?? '';
					$highlight   = $prop['highlight'] ?? '';

					$this_column_class = $column_class;
					if( $highlight ) {
						$this_column_class .= " border border-2 $border_color";
					}
					?>
					<div class="<?php echo esc_attr( $this_column_class ); ?>">
						<?php if ( $image ) : ?>
							<?php if ( is_array( $image ) ) : ?>
								<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ?? 'Case study image' ); ?>" class="w-full rounded-lg max-w-[250px] mb-sm" loading="lazy" decoding="async">
							<?php else : ?>
								<?php echo wp_get_attachment_image( $image, 'full', false, array( 'class' => 'w-full rounded-lg max-w-[250px] mb-sm', 'loading' => 'lazy', 'decoding' => 'async', ) ); ?>
							<?php endif; ?>
						<?php endif; ?>

						<?php if ( $title ) : ?>
							<h3 class="<?php echo wp_kses_post( $card_header_color ); ?> mb-sm"><?php echo wp_kses_post( $title ); ?></h3>
						<?php endif; ?>

						<?php if ( $subtitle ) : ?>
							<p class="<?php echo wp_kses_post( $card_subtitle_color ); ?> italic mb-sm"><?php echo wp_kses_post( $subtitle ); ?></p>
						<?php endif; ?>

						<?php if ( $description ) : ?>
							<p class="<?php echo wp_kses_post( $text_color ); ?>"><?php echo wp_kses_post( nl2br( $description ) ); ?></p>
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
