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

<main id="main" class="my-2xl">
	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
        <div class="mt-lg container mx-auto">
            <h1 class="mb-md"><?php the_title(); ?></h1>
		    <?php the_content(); ?>
        </div>
	<?php endwhile; ?>
</main>

<?php
get_footer();
