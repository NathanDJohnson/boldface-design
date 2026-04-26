<?php
/**
 * Testimonials Block Template
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get field values
$heading       = get_field( 'heading' ) ?: '';
$featured_testimonial = get_field( 'featured_testimonial' ) ?: array();
$testimonials  = get_field( 'testimonials' ) ?: array();

// Build class name
$class_name = 'wp-block-boldface-design-testimonials bg-white w-full px-sm md:px-lg py-2xl';

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
	<div class="max-w-1100px mx-auto">
		<?php if ( $heading ) : ?>
			<h2 class="text-observatory text-center mb-2xl"><?php echo wp_kses_post( $heading ); ?></h2>
		<?php endif; ?>

        <?php if ( ! empty( $featured_testimonial ) ) : ?>
            <?php
            $featured_testimonial = $featured_testimonial[0]; // Get the first testimonial from the repeater
            
            $quote         = $featured_testimonial['quote'] ?? '';
            $name          = $featured_testimonial['name'] ?? '';
            $company       = $featured_testimonial['company'] ?? '';
            $position      = $featured_testimonial['position'] ?? '';
            $avatar        = $featured_testimonial['avatar'] ?? '';
            $show_linkedin = $featured_testimonial['show_linkedin_link'] ?? false;
            ?>
            <figure class="w-full bg-white text-white rounded-lg border-2 border-observatory p-lg mb-2xl flex flex-col">
                <?php if ( $quote ) : ?>
                    <blockquote class="text-mine-shaft text-body mb-lg italic">"<?php echo wp_kses_post( $quote ); ?>"</blockquote>
                <?php endif; ?>

                <figcaption class="flex items-center gap-md mt-auto">
                    <?php if ( $avatar ) : ?>
                        <div class="flex-shrink-0 h-48px w-48px rounded-full overflow-hidden bg-whisper">
                            <?php
                            if ( is_array( $avatar ) ) {
                                echo wp_kses_post( wp_get_attachment_image( $avatar['ID'], 'thumbnail', false, array( 'class' => 'h-full w-full object-cover' ) ) );
                            } else {
                                echo wp_kses_post( wp_get_attachment_image( $avatar, 'thumbnail', false, array( 'class' => 'h-full w-full object-cover' ) ) );
                            }
                            ?>
                        </div>
                    <?php endif; ?>

                    <div class="flex-1 min-w-0">
                        <?php if ( $name ) : ?>
                            <p class="text-mine-shaft truncate"><?php echo wp_kses_post( $name ); ?></p>
                        <?php endif; ?>
                        <?php if ( $position ) : ?>
                            <p class="text-steel truncate"><?php echo wp_kses_post( $position ); ?></p>
                        <?php endif; ?>
                        <?php if ( $company ) : ?>
                            <p class="text-observatory truncate"><?php echo wp_kses_post( $company ); ?></p>
                        <?php endif; ?>
                        <?php if ( $show_linkedin ) : ?>
                            <div class="mt-md">
                                <a href="https://www.linkedin.com/in/boldface/details/recommendations/" target="_blank" class="text-observatory underline">View LinkedIn Recommendation</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </figcaption>
            </figure>
        <?php endif; ?>

		<?php if ( ! empty( $testimonials ) ) : ?>
			<div class="flex flex-wrap justify-center gap-md">
				<?php foreach ( $testimonials as $testimonial ) : ?>
					<?php
					$quote       = $testimonial['quote'] ?? '';
					$name        = $testimonial['name'] ?? '';
                    $company     = $testimonial['company'] ?? '';
                    $position    = $testimonial['position'] ?? '';
					$avatar      = $testimonial['avatar'] ?? '';
					?>
					<figure class="w-full md:w-[calc(50%-1rem)] bg-white rounded-lg border border-whisper p-lg flex flex-col">
						<?php if ( $quote ) : ?>
							<blockquote class="text-mine-shaft text-body mb-lg italic">"<?php echo wp_kses_post( $quote ); ?>"</blockquote>
						<?php endif; ?>

						<figcaption class="flex items-center gap-md mt-auto">

							<div class="flex-1 min-w-0">
								<?php if ( $name ) : ?>
									<p class="text-mine-shaft truncate"><?php echo wp_kses_post( $name ); ?></p>
								<?php endif; ?>

								<?php if ( $position ) : ?>
									<p class="text-steel truncate"><?php echo wp_kses_post( $position ); ?></p>
								<?php endif; ?>

								<?php if ( $company ) : ?>
									<p class="text-observatory truncate"><?php echo wp_kses_post( $company ); ?></p>
								<?php endif; ?>
                            </div>
						</figcaption>
                    </figure>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
