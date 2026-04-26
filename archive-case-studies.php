<?php
/**
 * Case studies archive file
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="main">
    <section class="wp-block-boldface-design-hero bg-[#fdf8fc] relative w-full flex items-center justify-center bg-cover bg-center overflow-hidden hero-block align bg-gradient-abyss min-h-300px">
        <div class="relative z-20 text-center px-lg py-xl lg:py-2xl text-white">
            <div class="container flex flex-col">
                <h1 class="mb-lg text-h1">Bold Ideas, Real Impact</h1>
                <div class="[&amp;_p]:text-body mb-lg">
                    <p>Strategic design is about more than just aesthetics; it’s about solving real-world challenges. Explore how we partner with our clients to build identities that command attention and drive meaningful impact.</p>
                </div>
            </div>
        </div>
    </section>

    <div class="container mx-auto py-2xl">
    
        <?php if ( have_posts() ) : ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-lg">
                <?php while ( have_posts() ) : ?>
                    <?php the_post(); ?>
                    <?php get_template_part( 'template-parts/content', get_post_type() ); ?>

                <?php endwhile; ?>
            </div>

            <?php the_posts_navigation(); ?>
        <?php else : ?>
            <?php get_template_part( 'template-parts/content', 'none' ); ?>
        <?php endif; ?>
    </div>

    <section class="wp-block-boldface-design-cta bg-gradient-abyss w-full px-sm md:px-lg py-2xl align">
        <div class="max-w-1100px mx-auto text-center">
            <h2 class="text-white mb-lg">Ready to find out if we’re the right fit?</h2>
            <p class="text-white mb-md">Tell us about your project. We’ll set up a no-obligation discovery call and give you a straight answer about whether Boldface is the right partner for what you’re trying to do.</p>
            <div class="flex flex-wrap justify-center gap-md mt-lg">
                <a href="https://boldface-2026.local/contact/" class="btn btn-observatory">Schedule a discovery call</a>
            </div>
        </div>
    </section>
</main>

<?php
get_footer(); 