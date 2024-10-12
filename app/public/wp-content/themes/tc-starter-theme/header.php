<!doctype html>
<html class="no-js" lang="it_IT">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php wp_title(); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php wp_head(); ?>
</head>
<body <?php body_class('body'); ?>>
<?php wp_body_open() ?>

<header class="tc-header fixed-top bg-white">
    <div class="container-lg ">
        <nav class="navbar navbar-expand-lg justify-content-between py-3 py-lg-2">
            <a href="<?php echo esc_url(home_url('/')); ?>">
                <img class="img-fluid tc-site-logo" src="<?php echo get_theme_mod('main_logo') ?>"
                     alt="<?php echo get_bloginfo() ?>"/>
            </a>
            <div>
                <button class=" d-flex align-items-center tcHeaderButton btn d-lg-none position-relative text-uppercase
                tc-z-index-50 p-0"
                        type="button"
                        data-bs-toggle="offcanvas"
                        data-bs-target="#tc-main-menu-offcanvas" aria-controls="tc-main-menu-offcanvas">
                    Menu
                </button>
            </div>

            <div class="offcanvas offcanvas-end" tabindex="-1" id="tc-main-menu-offcanvas"
                 aria-labelledby="offcanvasTopLabel">

                <div class="offcanvas-body py-2 text-black d-flex justify-content-end align-items-top
                 position-relative  overflow-hidden">
                    <div class="tcOffcanvasCerchio "></div>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'container' => 'div',
                        'container_class' => 'tc-main-menu-container d-flex align-items-center  text-end',
                        'container_id' => 'tc-main-menu-container',
                        'menu_id' => 'tc-main-menu',
                        'menu_class' => 'nav navbar-nav ',
                        'fallback_cb' => '__return_false',
                        'depth' => 2,
                        'walker' => new bootstrap_5_wp_nav_menu_walker()
                    ));
                    ?>
                </div>
        </nav>

    </div>


</header>
<main class="site">
