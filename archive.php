<?php
/**
 * Main archive file
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <?php if ( have_posts() ) : ?>
            <header class="page-header mb-2xl">
                <h1 class="page-title text-abbey"><?php the_archive_title(); ?></h1>
                <?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>
            </header>

            <?php
            while ( have_posts() ) :
                the_post();

                get_template_part( 'template-parts/content', get_post_type() );

            endwhile;

            the_posts_navigation();
        else :
            get_template_part( 'template-parts/content', 'none' );
        endif;
        ?>
    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer(); 