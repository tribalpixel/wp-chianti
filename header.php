<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">

        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>

        <div id="website" class="site">        

            <header id="header" class="site-header" role="banner">
                
                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

                <?php if (has_nav_menu('nav-header')) : ?>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'nav-header',
                        'container' => 'nav',
                        'container_id' => 'nav-header',
                        'fallback_cb' => false,
                            //'container_class'=>'nav',
                            //'menu_class'=>'',
                            //'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    ));
                    ?>
                <?php endif; ?>

            </header>