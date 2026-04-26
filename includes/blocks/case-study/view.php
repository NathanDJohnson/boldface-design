<?php
/**
 * Case Study Block Template
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get field values
$label              = get_field( 'label' ) ?: '';
$title              = get_field( 'title' ) ?: '';
$description        = get_field( 'description' ) ?: '';
$case_study_link    = get_field( 'case_study_link' ) ?: '';
$image              = get_field( 'image' );

// Build class name
$class_name = 'wp-block-boldface-design-case-study bg-whisper w-full py-xl lg:py-2xl px-lg';

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
        <div class="flex flex-col lg:flex-row gap-2xl items-start justify-between">
            <div>
                <?php if ( $label ) : ?>
                    <p class="text-caption text-observatory font-semibold mb-md uppercase tracking-wide"><?php echo wp_kses_post( $label ); ?></p>
                <?php endif; ?>

                <?php if ( $title ) : ?>
                    <h2 class="mb-lg text-mine-shaft"><?php echo wp_kses_post( $title ); ?></h2>
                <?php endif; ?>

                <?php if ( $description ) : ?>
                    <div class="mb-lg text-body text-abbey"><?php echo wp_kses_post( wpautop( $description ) ); ?></div>
                <?php endif; ?>

                <?php if ( $case_study_link ) : ?>
                    <a href="<?php echo esc_url( $case_study_link['url'] ); ?>" class="inline-flex items-center font-semibold text-observatory hover:text-cyprus transition-colors">
                        <?php echo esc_html( $case_study_link['title'] ); ?>
                        <svg class="w-5 h-5 ml-xs" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                <?php endif; ?>
            </div>

            <?php if ( $image ) : ?>
                <div class="mt-xl w-300px lg:w-400px flex-shrink-0">
                    <?php if ( is_array( $image ) ) : ?>
                        <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ?? 'Case study image' ); ?>" class="w-full rounded-lg">
                    <?php else : ?>
                        <?php echo wp_get_attachment_image( $image, 'full', false, array( 'class' => 'w-full rounded-lg' ) ); ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
	</div>
</section>
