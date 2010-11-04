<!DOCTYPE html> 
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta http-equiv="content-type" content="<?php bloginfo('html_type') ?>; charset=<?php bloginfo('charset') ?>">
  <meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; width=device-width;">

  <title><?php wp_title( '&ndash;', true, 'right' ); echo esc_html( get_bloginfo('name'), 1 ); ?></title>

  <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url') ?>">
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
  
  <?php wp_head(); ?>
</head>

<body>

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