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

<main id="main" class="container mx-auto px-lg py-xl">
	<h1><?php the_title(); ?></h1>

    <?php // Output the sitemap content. ?>
    <div class="sitemap-content">
        <?php
        // Get all public post types
        // Skip Projects CPT
        $post_types = get_post_types( array( 'public' => true ), 'objects' );
        $post_types = array_filter( $post_types, function( $post_type ) {
            return ! in_array( $post_type->name, array( 'project' ), true );
        } );

        foreach ( $post_types as $post_type ) {
            // Get all posts of this post type
            $posts = get_posts( array(
                'post_type'      => $post_type->name,
                'posts_per_page' => -1,
                'post_status'    => 'publish',
                'post__not_in'   => array( 1722, 182 ),
            ) );

            if ( empty( $posts ) ) {
                continue; // Skip post types with no posts
            }

            echo '<h2>' . esc_html( $post_type->labels->name ) . '</h2>';
            echo '<ul>';

            // Get all posts of this post type
            $posts = get_posts( array(
                'post_type'      => $post_type->name,
                'posts_per_page' => -1,
                'post_status'    => 'publish',
                'post__not_in'   => array( 1722, 182 ),
            ) );

            foreach ( $posts as $post ) {
                echo '<li><a href="' . get_permalink( $post ) . '">' . esc_html( get_the_title( $post ) ) . '</a></li>';
            }

            echo '</ul>';
        }
        ?>
    </div>
</main>

<?php
get_footer();
