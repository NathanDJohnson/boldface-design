<header id="masthead" class="site-header sticky z-50 top-0 w-full">
    <div class="bg-sulfur h-100px flex items-center">
        <div class="container mx-auto px-sm py-sm flex gap-lg items-center justify-between">
            <div class="site-branding flex items-center gap-sm">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="text-abbey font-bold text-lg no-underline hover:no-underline flex items-center gap-sm">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/boldface-design-logo-grey.svg' ); ?>" alt="<?php bloginfo( 'name' ); ?> Logo" class="h-8 w-auto" width="24" height="32">
                    <span>boldface design</span>
                </a>
            </div>

            <div class="flex items-center gap-lg">
                <?php
                $button_class = 'hidden md:inline-block btn btn-observatory';
                if ( is_page( 52 ) ) {
                    $button_class = str_replace( 'btn-observatory', 'btn-outline-observatory pointer-events-none', $button_class );
                }
                ?>
                <div id="portfolio-link" class="flex gap-md justify-center items-center text-center transition-opacity duration-300">
                    <a href="<?php echo esc_url( home_url( '/portfolio/' ) ); ?>" class="<?php echo esc_attr( $button_class ); ?>">
                        <?php esc_html_e( 'View Portfolio', 'boldface-design' ); ?>
                    </a>
                </div>

                <nav id="primary-menu" class="main-navigation hidden md:flex md:justify-end">
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'fallback_cb'    => false,
                        'depth'          => 1,
                        'container'      => false,
                        'items_wrap'     => '<ul class="flex gap-lg m-0 p-0 list-none [&_li]:flex [&_li]:items-center [&_li]:text-mine-shaft [&_li]:font-medium [&_li]:text-center">%3$s</ul>',
                    ) );
                    ?>
                </nav>
            </div>

            <div class="md:hidden flex items-center gap-md">
                <button class="z-50 md:hidden menu-toggle p-sm" aria-controls="primary-menu" aria-expanded="false">
                    <span class="sr-only">Open Menu</span>
                    <svg class="w-24px h-24px text-mine-shaft" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</header>