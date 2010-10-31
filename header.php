<!DOCTYPE html>
<html>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; width=device-width;">
  <title><?php wp_title( '-', true, 'right' ); echo wp_specialchars( get_bloginfo('name'), 1 ); ?></title> 
  <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url') ?>" />
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
  <?php wp_enqueue_script("jquery"); ?>
  <?php wp_head(); ?>
  <script src="<?php bloginfo('template_directory'); ?>/js/init.js" type="text/javascript"></script>
</head>
<?php flush(); ?>
<body>
<div id="gridOverlay">
</div>
<div id="preloader">
</div>
<div id="wrapper">
  <header class="clearfix">
    <a href="<?php bloginfo('home') ?>/">
      <div id="logo" class="c1">
        <h1><?php bloginfo('name'); ?></h1>
      </div>
    </a>
    <nav>
      <?php wp_nav_menu( array( 'theme_location' => 'primary-menu' ) ); ?>
    </nav>
  </header> 
  <div id="main">
