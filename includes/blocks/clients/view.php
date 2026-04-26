<?php
/**
 * Clients Block Template
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get field values
$heading        = boldface_deorphan( get_field( 'heading' ) ) ?: '';
$description    = boldface_deorphan( get_field( 'description' ) ) ?: '';
$priority_logos = get_field( 'priority_logos' ) ?: array();
$logos          = get_field( 'logos' ) ?: array();
$proof_chips    = get_field( 'proof_chips' ) ?: array();

// Build class name
$class_name = 'wp-block-boldface-design-clients bg-whisper text-mine-shaft w-full px-sm md:px-lg py-2xl';

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
	<?php if ( $heading ) : ?>		
        <div class="max-w-1100px mx-auto">
            <h2 class="text-center"><?php echo wp_kses_post( $heading ); ?></h2>
        </div>    
	<?php endif; ?>

    <?php if ( $description ) : ?>
        <div class="max-w-1100px mx-auto mt-md">
            <p class="text-center"><?php echo wp_kses_post( nl2br( $description ) ); ?></p>
        </div>
    <?php endif; ?>

    <?php if ( ! empty( $priority_logos ) ) : ?>
        <div class="max-w-1280px mx-auto flex flex-wrap justify-center itens-center my-lg">
            <?php foreach ( $priority_logos as $logo ) : ?>
                <?php
                $logo_image = $logo['logo'] ?? '';
                $logo_alt   = $logo['alt_text'] ?? '';
                ?>
                <?php if ( $logo_image ) : ?>
                    <div class="basis-1/2 md:basis-1/3 lg:basis-1/4 xl:basis-1/5 flex items-center justify-center h-[100px]">
                        <?php
                        if( empty( $logo_alt ) ) {
                            $logo_alt = $logo_image['alt'] ?? '';
                        }
                        if ( is_array( $logo_image ) ) {
                            $logo_image = $logo_image['ID'];
                        }
                        
                        echo wp_kses_post( wp_get_attachment_image( $logo_image, 'medium', false, array(
                            'class' => 'h-full w-auto max-w-xs object-contain',
                            'alt'   => ! empty( $logo_alt ) ? esc_attr( $logo_alt ) : '',
                        ) ) );
                        ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

	<?php if ( ! empty( $logos ) ) : ?>
        <div class="max-w-1280px mx-auto">
            <div class="overflow-hidden clients-scroll-mask">
                <div class="clients-scroll-container flex items-center" style="width: fit-content; --logo-width: 150px; --logo-count: <?php echo count( $logos ); ?>">
                    <?php 
                    // Render logos twice for seamless infinite scroll
                    for ( $i = 0; $i < 2; $i++ ) :
                        foreach ( $logos as $key => $logo ) : ?>
                            <?php
                            $logo_image = $logo['logo'] ?? '';
                            $logo_alt   = $logo['alt_text'] ?? '';
                            ?>
                            <?php if ( $logo_image ) : ?>
                                <div class="scroll-item flex items-center justify-center h-[100px] flex-shrink-0">
                                    <?php
                                    if( empty( $logo_alt ) ) {
                                        $logo_alt = $logo_image['alt'] ?? '';
                                    }
                                    if ( is_array( $logo_image ) ) {
                                        $logo_image = $logo_image['ID'];
                                    }
                                    
                                    echo wp_kses_post( wp_get_attachment_image( $logo_image, 'medium', false, array(
                                        'class' => 'h-full w-auto max-w-xs object-contain',
                                        'alt'   => ! empty( $logo_alt ) ? esc_attr( $logo_alt ) : '',
                                    ) ) );
                                    ?>
                                </div>
                            <?php endif; ?>
                        <?php endforeach;
                    endfor;
                    ?>
                </div>
            </div>
        </div>
	<?php endif; ?>

    <?php if ( ! empty( $proof_chips ) ) : ?>
        <div class="max-w-1100px mx-auto grid grid-cols-1 md:grid-cols-3 gap-lg mt-2xl">
            <?php foreach ( $proof_chips as $chip ) : ?>
                <?php
                $title       = $chip['title'] ?? '';
                $description = $chip['description'] ?? '';
                ?>
                <div class="w-full flex flex-col items-center gap-sm bg-white text-mine-shaft rounded-lg px-lg py-sm">
                    <?php if ( $title ) : ?>
                        <span class="text-body font-semibold"><?php echo wp_kses_post( $title ); ?></span>
                    <?php endif; ?>
                    <?php if ( $description ) : ?>
                        <span class="text-caption text-abbey"><?php echo wp_kses_post( $description ); ?></span>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>