<?php
/**
 * Project template
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
        <div class="mt-lg container mx-auto prose">
            <h1><?php the_title(); ?></h1>
		    <?php the_content(); ?>
        </div>
	<?php endwhile; ?>
</main>

<?php
get_footer();
