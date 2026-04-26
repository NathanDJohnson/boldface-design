<?php
/**
 * Case Study Details Block Template
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Enqueue lightbox script only when this block is displayed
wp_enqueue_script(
	'boldface-lightbox',
	get_template_directory_uri() . '/assets/js/lightbox.js',
	array(),
	'1.0.0',
	true
);

// Get field values
$heading      = boldface_deorphan( get_field( 'heading' ) ) ?: '';
$introduction = boldface_deorphan( get_field( 'introduction' ) ) ?: '';
$challenge    = boldface_deorphan( get_field( 'challenge' ) ) ?: '';
$solution     = boldface_deorphan( get_field( 'solution' ) ) ?: '';
$process      = boldface_deorphan( get_field( 'process' ) ) ?: '';
$results      = boldface_deorphan( get_field( 'results' ) ) ?: '';
$gallery      = get_field( 'gallery' ) ?: array();
$key_stats    = get_field( 'key_stats' ) ?: '';

// Build class name
$class_name = 'wp-block-boldface-design-case-study-details bg-white w-full px-sm md:px-lg py-2xl text-mine-shaft';

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

		<?php if ( $introduction ) : ?>
			<div class="mb-2xl">
				<div class="[&_p]:text-lead [&_h2]:mb-lg">
					<?php echo wp_kses_post( $introduction ); ?>
				</div>
			</div>
		<?php endif; ?>

		<div class="grid grid-cols-1 md:grid-cols-2 gap-lg lg:gap-xl mb-2xl">
			
			<?php if ( $challenge ) : ?>
				<div>
					<h3 class="text-observatory mb-lg">Challenge</h3>
					<?php echo wp_kses_post( $challenge ); ?>
				</div>
			<?php endif; ?>

			<?php if ( $solution ) : ?>
				<div>
					<h3 class="text-observatory  mb-lg">Solution</h3>
					<?php echo wp_kses_post( $solution ); ?>
				</div>
			<?php endif; ?>

		</div>

		<?php 
		$gallery = get_field( 'gallery' ) ?: array();
		if ( ! empty( $gallery ) ) : 
		?>
			<div class="mb-2xl">
				<div class="flex flex-wrap justify-center gap-lg">
					<?php foreach ( $gallery as $gallery_item ) : ?>
						<?php
						$image = $gallery_item['image'] ?? '';
						if ( ! $image ) {
							continue;
						}
						$image_url = is_array( $image ) ? $image['url'] : $image;
						$image_alt = is_array( $image ) ? ( $image['alt'] ?: 'Gallery image' ) : 'Gallery image';
						?>
						<a href="<?php echo esc_url( $image_url ); ?>" data-lightbox="case-study-gallery" class="md:basis-1/2 lg:basis-[calc(33%-1rem)] aspect-square block overflow-hidden rounded-lg">
							<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300" />
						</a>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>

		<?php if ( $process ) : ?>
			<div class="mb-2xl">
				<h3 class="text-h2 mb-lg">Process</h3>
				<?php echo wp_kses_post( $process ); ?>
			</div>
		<?php endif; ?>

		<?php if ( $results ) : ?>
			<div class="bg-ocean-blue text-white p-xl md:p-2xl my-2xl rounded-xl">
				<h3 class="text-h2 mb-lg">Results</h3>
				<?php echo wp_kses_post( $results ); ?>
			</div>
		<?php endif; ?>

		<?php if ( ! empty( $key_stats ) ) : ?>
			<div class="mt-2xl">
				<h3 class="mb-lg">Key Stats</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-lg w-full">
                    <?php foreach ( $key_stats as $stat_item ) : ?>
                        <?php
                        $stat = $stat_item['stat'] ?? '';
                        $context = $stat_item['context'] ?? '';
                        ?>
                        <div class="bg-whisper border border-abbey rounded-lg p-lg text-center">
                            <?php if ( $stat ) : ?>
                                <p class="text-h2 text-observatory font-semibold mb-sm"><?php echo esc_html( $stat ); ?></p>
                            <?php endif; ?>
                            <?php if ( $context ) : ?>
                                <p class="text-body text-abbey"><?php echo esc_html( $context ); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
			</div>
		<?php endif; ?>

	</div>
</section>
