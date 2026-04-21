<?php
/**
 * FAQ Block Template
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get field values
$heading    = boldface_deorphan( get_field( 'heading' ) ) ?: '';
$content    = boldface_deorphan( get_field( 'content' ) ) ?: '';
$faq_items  = get_field( 'faq_items' ) ?: array();
$background = get_field( 'background' ) ?: 'bg-white';

// Determine text color based on background
$text_color_class = 'text-mine-shaft';
if ( in_array( $background, array( 'bg-gradient-abyss', 'bg-denim', 'bg-mine-shaft', 'bg-observatory' ), true ) ) {
	$text_color_class = 'text-white';
}

// Build class name
$class_name = "wp-block-boldface-design-faq max-w-none w-full px-sm md:px-lg py-2xl {$background} {$text_color_class}";

if ( isset( $block['align'] ) ) {
	$class_name .= ' align' . $block['align'];
}

if ( isset( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}

// Build ID
$id = '';
$block_id = '';
if ( isset( $block['anchor'] ) ) {
	$block_id = esc_attr( $block['anchor'] );
	$id = 'id="' . $block_id . '"';
}
?>

<section class="<?php echo esc_attr( $class_name ); ?>" <?php echo wp_kses_post( $id ); ?>>
	<div class="container max-w-1100px mx-auto">
		<?php if ( $heading ) : ?>
			<h2 class="mb-lg text-center"><?php echo wp_kses_post( $heading ); ?></h2>
		<?php endif; ?>

        <?php if ( $content ) : ?>
            <div class="mb-2xl text-center text-body max-w-3xl mx-auto [&_a]:underline">
                <?php echo wp_kses_post( wpautop( $content ) ); ?>
            </div>
        <?php endif; ?>

		<?php if ( ! empty( $faq_items ) ) : ?>
			<div class="faq-container space-y-md" data-faq-container>
				<?php foreach ( $faq_items as $index => $item ) : ?>
					<?php
						$question = $item['question'] ?? '';
						$answer   = $item['answer'] ?? '';
						$item_id  = $block_id ? $block_id . '-item-' . $index : 'faq-item-' . $index;
					?>
					<div class="faq-item border border-current border-opacity-20 rounded-lg overflow-hidden" data-faq-item>
						<button
							type="button"
							class="faq-toggle w-full text-left px-lg py-md font-medium focus:outline-none"
							aria-expanded="false"
							aria-controls="<?php echo esc_attr( $item_id . '-answer' ); ?>"
							data-faq-toggle
						>
							<div class="flex items-center justify-between gap-md">
								<span><?php echo wp_kses_post( $question ); ?></span>
								<svg class="w-6 h-6 flex-shrink-0 transition-transform duration-200" data-faq-icon fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
								</svg>
							</div>
						</button>

						<div
							id="<?php echo esc_attr( $item_id . '-answer' ); ?>"
							class="faq-answer overflow-hidden max-h-0 transition-all duration-300"
							data-faq-answer
						>
							<div class="px-lg py-md border-t border-current border-opacity-20 text-body prose [&_p]:mb-md max-w-none">
								<?php echo wp_kses_post( wpautop( $answer ) ); ?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>

<script>
document.addEventListener( 'DOMContentLoaded', function() {
	const faqContainers = document.querySelectorAll( '[data-faq-container]' );

	faqContainers.forEach( function( container ) {
		const faqItems = container.querySelectorAll( '[data-faq-item]' );

		faqItems.forEach( function( item ) {
			const toggleButton = item.querySelector( '[data-faq-toggle]' );
			const answerSection = item.querySelector( '[data-faq-answer]' );
			const icon = item.querySelector( '[data-faq-icon]' );

			toggleButton.addEventListener( 'click', function() {
				const isExpanded = toggleButton.getAttribute( 'aria-expanded' ) === 'true';

				// Close all other items
				faqItems.forEach( function( otherItem ) {
					if ( otherItem !== item ) {
						const otherToggle = otherItem.querySelector( '[data-faq-toggle]' );
						const otherAnswer = otherItem.querySelector( '[data-faq-answer]' );
						const otherIcon = otherItem.querySelector( '[data-faq-icon]' );

						otherToggle.setAttribute( 'aria-expanded', 'false' );
                        otherToggle.classList.remove('bg-observatory');
                        otherToggle.classList.remove('text-white');
						otherAnswer.style.maxHeight = '0';
						otherIcon.style.transform = 'rotate(0deg)';
					}
				} );

				// Toggle current item
				if ( isExpanded ) {
					toggleButton.setAttribute( 'aria-expanded', 'false' );
                    toggleButton.classList.remove('bg-observatory');
                    toggleButton.classList.remove('text-white');
					answerSection.style.maxHeight = '0';
					icon.style.transform = 'rotate(0deg)';
				} else {
					toggleButton.setAttribute( 'aria-expanded', 'true' );
                    toggleButton.classList.add('bg-observatory');
                    toggleButton.classList.add('text-white');
					answerSection.style.maxHeight = answerSection.scrollHeight + 'px';
					icon.style.transform = 'rotate(180deg)';
				}
			} );
		} );
	} );
} );
</script>
