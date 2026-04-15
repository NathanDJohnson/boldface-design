<div>
    <a href="<?php echo esc_url( get_permalink() ); ?>" class="text-h3 font-sans mb-sm inline-block hover:text-cyprus">
        <?php if( has_post_thumbnail() ) : ?>
            <div class="w-full h-300px mb-md overflow-hidden rounded-lg">
                <?php the_post_thumbnail( 'medium_large', array( 'class' => 'w-full h-auto mb-md rounded-lg' ) ); ?>
            </div>
        <?php endif; ?>
        <h3><?php the_title(); ?></h3>
    </a>
</div>
