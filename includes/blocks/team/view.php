<?php
/**
 * Team Block Template
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get field values
$background   = get_field( 'background' ) ?: 'bg-white';
$heading      = boldface_deorphan( get_field( 'heading' ) ) ?: '';
$description  = boldface_deorphan( get_field( 'description' ) ) ?: '';
$team_members = get_field( 'team_members' ) ?: array();

// Build class name
$class_name = "wp-block-boldface-design-team $background text-mine-shaft w-full px-sm md:px-lg py-2xl";

$class_name = boldface_design_get_block_common_classes( 'team', $block );

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
	<div class="container mx-auto">
        <?php if ( $heading ) : ?>
            <h2 class="mb-lg"><?php echo wp_kses_post( $heading ); ?></h2>
        <?php endif; ?>

        <?php if ( $description ) : ?>
            <div class="text-body [&_p]:mb-md mb-2xl">
                <?php echo wp_kses_post( $description ); ?>
            </div>
        <?php endif; ?>

        <div class="mb-lg">
            <?php foreach ( $team_members as $key => $member ) : ?>
                <?php
                    if ( $key > 0 ) {
                        echo '<span class="inline-block mr-md mb-md"> · </span>';
                    }
                    $name = $member['name'] ?? '';
                    if ( $name ) {
                        echo '<a href="#' . sanitize_title( $name ) . '" class="inline-block mr-md mb-md transition-colors duration-200">' . esc_html( $name ) . '</a>';
                    }
                ?>
            <?php endforeach; ?>
        </div>
		<?php if ( ! empty( $team_members ) ) : ?>
			<div class="grid grid-cols-1 gap-lg md:gap-2xl">
				<?php foreach ( $team_members as $key => $member ) : ?>
					<?php
					$image             = $member['image'] ?? '';
                    $object_fit        = $member['object_fit'] ?? 'cover';
					$name              = $member['name'] ?? '';
					$title             = $member['title'] ?? '';
					$content           = $member['content'] ?? '';
                    $link              = $member['link'] ?? '';
                    $flex_col          = $key % 2 === 0 ? 'md:flex-row' : 'md:flex-row-reverse';
					?>
					<div id="<?php echo sanitize_title( $name ); ?>" class="scroll-mt-[120px] flex flex-col <?php echo esc_attr( $flex_col ); ?> items-start gap-lg">
						<?php if ( $image ) : ?>
							<div class="shrink-0 max-md:w-full mb-lg rounded-xl overflow-hidden h-300px w-[300px]">
								<?php
                                $class = 'image' === $object_fit ? 'w-full h-full object-cover object-[center_10%]' : 'w-full h-full object-contain';
								if ( is_array( $image ) ) {
									echo wp_kses_post( wp_get_attachment_image( $image['ID'], 'large', false, array( 'class' => $class ) ) );
								} else {
									echo wp_kses_post( wp_get_attachment_image( $image, 'large', false, array( 'class' => $class ) ) );
								}
								?>
							</div>
                            
						<?php endif; ?>

                        <div class="w-full">
                            <?php if ( $name ) : ?>
                                <h3 class="text-observatory font-heading mb-xs">
                                    <?php echo wp_kses_post( $name ); ?>
                                </h3>
                            <?php endif; ?>

                            <?php if ( $title ) : ?>
                                <p class="text-abbey text-caption mb-md font-semibold">
                                    <?php echo wp_kses_post( $title ); ?>
                                </p>
                            <?php endif; ?>

                            <?php if ( $link ) : ?>
                                <p class="mb-md">
                                    <a rel="noopener noreferrer" href="<?php echo esc_url( $link['url'] ); ?>" class="inline-block text-observatory hover:text-cyprus underline" target="<?php echo esc_attr( $link['target'] ); ?>">
                                        <?php echo esc_html( $link['title'] ); ?>
                                    </a>
                                </p>
                            <?php endif; ?>

                            <?php if ( $content ) : ?>
                                <div class="text-abbey text-caption">
                                    <?php echo wp_kses_post( $content ); ?>
                                </div>
                            <?php endif; ?>

                        </div>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
