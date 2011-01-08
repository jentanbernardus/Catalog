<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>

    <meta charset="<?php bloginfo( 'charset' ); ?>">

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php wp_title( '&ndash;', true, 'right' ); echo esc_html( get_bloginfo('name'), 1 ); ?></title>

    <meta name="description" content="<?php bloginfo('description') ?>">

    <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url') ?>">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

    <?php wp_head(); ?>

</head>
<body <?php body_class(); ?>> 

<div id="gridOverlay">
</div>
<div id="preloader">
</div>

<div id="wrapper">
    <header class="clearfix">
        <div id="logo" class="c1">
            <h1 style="background:transparent url(<?php header_image(); ?>) no-repeat top left;width:<?php echo HEADER_IMAGE_WIDTH; ?>px;height:<?php echo HEADER_IMAGE_HEIGHT; ?>px;">
                <a href="<?php bloginfo('url'); ?>" class="block" rel="home" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a>
            </h1>
        </div>

        <nav>
            <?php wp_nav_menu( array( 'theme_location' => 'primary-menu' ) ); ?>
        </nav>
    </header>
    
    <div id="main">