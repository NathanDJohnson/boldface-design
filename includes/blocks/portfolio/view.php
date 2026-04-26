<?php
/**
 * Portfolio Block Template
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get field values
$intro_heading        = boldface_deorphan( get_field( 'intro_heading' ) ) ?: '';
$intro_description    = boldface_deorphan( get_field( 'intro_description' ) ) ?: '';
$case_studies_link    = get_field( 'case_studies_link' ) ?: '';
$services_heading     = boldface_deorphan( get_field( 'services_heading' ) ) ?: '';
$services_items       = get_field( 'services_items' ) ?: array();
$gallery_type         = get_field( 'gallery_type' ) ?: 'composite';
$gallery_composite    = get_field( 'gallery_composite' ) ?: '';
$gallery_images       = get_field( 'gallery_images' ) ?: array();
$action_buttons       = get_field( 'action_buttons' ) ?: array();

// Build class name
$class_name = 'wp-block-boldface-design-portfolio bg-observatory w-full px-sm md:px-lg py-2xl';

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
        <div class="grid grid-cols-1 md:grid-cols-2 gap-2xl items-start">
            <div>
                <?php if ( $services_heading ) : ?>
                    <h2 class="text-white mb-lg md:mb-2xl"><?php echo wp_kses_post( $services_heading ); ?></h2>
                <?php endif; ?>

                <?php if ( ! empty( $services_items ) ) : ?>
                    <div class="space-y-lg mb-2xl">
                        <?php foreach ( $services_items as $item ) : ?>
                            <?php
                            $item_title       = $item['title'] ?? '';
                            $item_description = $item['description'] ?? '';
                            ?>
                            <div>
                                <?php if ( $item_title ) : ?>
                                    <h3 class="md:text-h4 text-sulfur mb-sm"><?php echo wp_kses_post( $item_title ); ?></h3>
                                <?php endif; ?>

                                <?php if ( $item_description ) : ?>
                                    <p class="text-white"><?php echo wp_kses_post( $item_description ); ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if ( ! empty( $action_buttons ) ) : ?>
                    <div class="flex flex-wrap gap-md">
                        <?php foreach ( $action_buttons as $button ) : ?>
                            <?php if ( ! empty( $button['button_link'] ) ) : ?>
                                <?php 
                                    $button_style = $button['button_style'] ?? 'solid';
                                    $btn_class = 'solid' === $button_style 
                                        ? 'btn btn-sulfur' 
                                        : 'btn btn-sulfur btn-outline-sulfur';
                                ?>
                                <a href="<?php echo esc_url( $button['button_link']['url'] ); ?>" 
                                    class="<?php echo esc_attr( $btn_class ); ?>"
                                    <?php if ( ! empty( $button['button_link']['target'] ) ) { echo 'target="' . esc_attr( $button['button_link']['target'] ) . '"'; } ?>>
                                    <?php echo esc_html( $button['button_link']['title'] ); ?>
                                </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div>
                <?php if ( 'composite' === $gallery_type && ! empty( $gallery_composite ) ) : ?>
                    <div class="overflow-hidden">
                        <?php
                        if ( is_array( $gallery_composite ) ) {
                            echo wp_kses_post( wp_get_attachment_image( $gallery_composite['ID'], 'large', false, array( 'class' => 'w-full h-auto' ) ) );
                        } else {
                            echo wp_kses_post( wp_get_attachment_image( $gallery_composite, 'large', false, array( 'class' => 'w-full h-auto' ) ) );
                        }
                        ?>
                    </div>
                <?php elseif ( 'individual' === $gallery_type && ! empty( $gallery_images ) ) : ?>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-md">
                        <?php foreach ( $gallery_images as $gallery_item ) : ?>
                            <?php
                            $image     = $gallery_item['image'] ?? '';
                            $image_url = $gallery_item['image_url'] ?? '';
                            $alt_text  = $gallery_item['alt_text'] ?? '';
                            ?>
                            <?php if ( $image ) : ?>
                                <?php $img_element = ''; ?>
                                <?php if ( is_array( $image ) ) {
                                    $img_element = wp_get_attachment_image( $image['ID'], 'medium', false, array( 'class' => 'w-full h-48 object-cover rounded-lg' ) );
                                } else {
                                    $img_element = wp_get_attachment_image( $image, 'medium', false, array( 'class' => 'w-full h-48 object-cover rounded-lg' ) );
                                }?>

                                <?php if ( ! empty( $image_url ) ) : ?>
                                    <a href="<?php echo esc_url( $image_url ); ?>" class="block rounded-lg overflow-hidden">
                                        <?php echo wp_kses_post( $img_element ); ?>
                                    </a>
                                <?php else : ?>
                                    <div class="rounded-lg overflow-hidden">
                                        <?php echo wp_kses_post( $img_element ); ?>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>
