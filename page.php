<?php
/**
 * Page template
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="main">
	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
		<?php the_content(); ?>
	<?php endwhile; ?>
</main>

<?php
get_footer();
