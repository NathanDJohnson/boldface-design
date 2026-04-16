<?php
/**
 * Hero Block Template
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get field values
$logo                      = get_field( 'logo' );
$tagline 				   = get_field( 'tagline' ) ?: '';
$title                     = get_field( 'title' ) ?: '';
$subtitle				   = get_field( 'subtitle' ) ?: '';
$description               = get_field( 'description' ) ?: '';
$description_placement     = get_field( 'description_placement' ) ?: 'above';
$background_image          = get_field( 'background_image' );
$background_video          = get_field( 'background_video' );
$background_video_fallback = get_field( 'background_video_fallback' );
$cta_url                   = get_field( 'cta_url' ) ?: '';
$secondary_cta_url		   = get_field( 'secondary_cta_url' ) ?: '';

$poster_url = ( ! empty( $background_image ) ) ? $background_image['url'] : '';

// Build class name
$class_name = 'wp-block-boldface-design-hero bg-[#fdf8fc] not-prose relative w-full flex items-center justify-center bg-cover bg-center overflow-hidden hero-block';

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

// Get video URL for inline script
$video_url = '';
if ( $background_video ) {
	if ( is_array( $background_video ) ) {
		$video_url = $background_video['url'];
	} else {
		$video_url = wp_get_attachment_url( $background_video );
	}
}

$video_url_fallback = '';
if ( $background_video_fallback ) {
	if ( is_array( $background_video_fallback ) ) {
		$video_url_fallback = $background_video_fallback['url'];
	} else {
		$video_url_fallback = wp_get_attachment_url( $background_video_fallback );
	}
}

$bg_color = 'bg-gradient-abyss';
if ( ! empty( $video_url ) || ! empty( $background_image ) ) {
	$bg_color = 'bg-[#fdf8fc]';
}
$class_name .= ' ' . $bg_color;

$min_height = 'min-h-300px';
if( is_front_page() ) {
	$min_height = 'min-h-[calc(100vh-100px)]';
}
$class_name .= ' ' . $min_height;
?>

<section class="<?php echo esc_attr( $class_name ); ?>" <?php echo wp_kses_post( $id ); ?> data-hero-video="<?php echo esc_attr( $video_url ); ?>">
	<?php if ( $background_image ) : ?>
		<?php echo wp_get_attachment_image( $background_image['ID'], 'full', false, array( 'class' => 'absolute inset-0 w-full h-full object-cover', 'fetchpriority' => 'high' ) ); ?>
	<?php endif; ?>
	
	<?php if ( ! empty( $video_url ) || ! empty( $video_url_fallback ) ) : ?>
		<video 
			class="hero-video absolute inset-0 w-full h-full object-cover z-10 transition-opacity duration-200 opacity-0" 
			autoplay 
			muted 
			playsinline 
			loop
			poster="<?php echo esc_url( $poster_url ); ?>"
			data-webm="<?php echo esc_url( $video_url ); ?>"
			data-mp4="<?php echo esc_url( $video_url_fallback ); ?>">
		</video>
	<?php endif; ?>

	<?php if( ! empty( $video_url ) || ! empty( $bg_url ) ) : ?>
		<div class="overlay absolute inset-0 bg-black/50 z-10 opacity-0 duration-1000"></div>
	<?php endif; ?>

	<div class="relative z-20 text-center px-lg py-xl lg:py-2xl text-white">
		<?php if ( $logo ) : ?>
		<?php
			$logo_id = is_array( $logo ) ? $logo['ID'] : $logo;
			echo wp_get_attachment_image( $logo_id, 'medium', false, array( 'class' => 'mx-auto mb-lg h-200px w-auto object-contain mix-blend-difference' ) );
		?>
		<?php endif; ?>

		<div class="container flex flex-col">

			<?php if ( $tagline ) : ?>
				<div class="text-h3 mb-md"><?php echo wp_kses_post( $tagline ); ?></div>
			<?php endif; ?>

			<?php if ( $subtitle ) : ?>
				<h2 class="text-h1 mb-md"><?php echo wp_kses_post( $subtitle ); ?></h2>
			<?php endif; ?>

			<?php if ( $title ) : ?>
				<?php
					$h1_class = 'mb-lg';
					if( ! empty( $subtitle ) ) {
						$h1_class .= ' text-base font-montserrat';
					} else {
						$h1_class .= ' text-h1';
					}
				?>
				<?php $title = str_replace( '—', '<br>—', $title ); ?>
				<h1 class="<?php echo esc_attr( $h1_class ); ?>"><?php echo wp_kses_post( $title ); ?></h1>
			<?php endif; ?>

			<?php if ( $description ) : ?>
				<div class="[&_p]:text-body mb-lg"><?php echo wp_kses_post( $description ); ?></div>
			<?php endif; ?>

			<?php if ( $cta_url || $secondary_cta_url ) : ?>
				<div class="flex flex-col md:flex-row gap-sm justify-center">
					<?php if ( $cta_url ) : ?>
						<a href="<?php echo esc_url( $cta_url[ 'url' ] ); ?>" class="btn btn-lg btn-observatory"><?php echo esc_html( $cta_url[ 'title'] ); ?></a>
					<?php endif; ?>

					<?php if ( $secondary_cta_url ) : ?>
						<a href="<?php echo esc_url( $secondary_cta_url[ 'url' ] ); ?>" class="btn btn-lg btn-outline-observatory"><?php echo esc_html( $secondary_cta_url[ 'title'] ); ?></a>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php if( ! is_front_page() ) : ?>
	<hr class="block not-prose relative w-screen left-[50%] -translate-x-1/2">
<?php endif; ?>

<?php get_template_part( 'template-parts/breadcrumbs' ); ?>

<?php
if ( is_front_page() ) {
	get_template_part( 'template-parts/nav' );
}
?>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const video = document.querySelector('.hero-video');

    if (video) {
        video.addEventListener('playing', () => {
            video.removeAttribute('loop');
        }, { once: true });

        video.addEventListener('ended', () => {
            // console.log("Video finished one cycle.");
        }, { once: true });
    }
});
</script>