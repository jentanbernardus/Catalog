<?php

// Make theme available for translation
// Translations can be filed in the /languages/ directory
load_theme_textdomain( 'your-theme', TEMPLATEPATH . '/languages' );
 
$locale = get_locale();
$locale_file = TEMPLATEPATH . "/languages/$locale.php";
if ( is_readable($locale_file) )
 require_once($locale_file);
 
// Get the page number
function get_page_number() {
    if ( get_query_var('paged') ) {
        print ' | ' . __( 'Page ' , 'your-theme') . get_query_var('paged');
    }
} // end get_page_number

// adds menu support
add_theme_support( 'nav-menus' );
add_action( 'init', 'register_my_menus' );

function register_my_menus() {
	register_nav_menus(
		array(
			'primary-menu' => __( 'Primary Menu' ),
			'secondary-menu' => __( 'Secondary Menu' ),
			'tertiary-menu' => __( 'Tertiary Menu' )
		)
	);
}

// adds thumbnail support
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 140, 80, true );

// add header image support
define('HEADER_TEXTCOLOR', '');
define('NO_HEADER_TEXT', true );
define('HEADER_IMAGE', '%s/i/headers/default_header.png');
define('HEADER_IMAGE_WIDTH', 140); //  Default image width is actually the div's width
define('HEADER_IMAGE_HEIGHT', 48);  // Same for height

// gets included in the admin header
function admin_header_style() {
  ?><style type="text/css">
      .appearance_page_custom-header #headimg {
        width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
        height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
        min-height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
        background-color: #fff;
        -moz-box-shadow: 0px 2px 2px rgba(0,0,0,0.05);
        -webkit-box-shadow: 0px 2px 2px rgba(0,0,0,0.05); 
      }
    </style><?php
}

function header_style() {
  ?><style type="text/css">
      #logo {
        background: transparent url(<?php header_image(); ?>) no-repeat;
        width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
        height:<?php echo HEADER_IMAGE_HEIGHT; ?>px;
      }  
    </style><?php
}

add_custom_image_header('header_style', 'admin_header_style');

// adds wordcount
function word_count(){
    ob_start();
    the_content();
    $content = ob_get_clean();
    return sizeof(explode(" ", $content));
}

// If more than one page exists, return TRUE.
function show_posts_nav() {
	global $wp_query;
	return ($wp_query->max_num_pages > 1);
}

?>