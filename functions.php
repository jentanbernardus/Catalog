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

// Begin comments stuff courtesy of thematic

// Custom callback to list comments in the your-theme style
function custom_comments($comment, $args, $depth) {
  $GLOBALS['comment'] = $comment;
 $GLOBALS['comment_depth'] = $depth;
  ?>
   <li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
    <div class="comment-author vcard"><?php commenter_link() ?></div>
    <div class="comment-meta"><?php printf(__('Posted %1$s at %2$s <span class="meta-sep">|</span> <a href="%3$s" title="Permalink to this comment">Permalink</a>', 'your-theme'),
       get_comment_date(),
       get_comment_time(),
       '#comment-' . get_comment_ID() );
       edit_comment_link(__('Edit', 'your-theme'), ' <span class="meta-sep">|</span> <span class="edit-link">', '</span>'); ?></div>
  <?php if ($comment->comment_approved == '0') _e("\t\t\t\t\t<span class='unapproved'>Your comment is awaiting moderation.</span>\n", 'your-theme') ?>
          <div class="comment-content">
        <?php comment_text() ?>
    </div>
  <?php // echo the comment reply link
   if($args['type'] == 'all' || get_comment_type() == 'comment') :
    comment_reply_link(array_merge($args, array(
     'reply_text' => __('Reply','your-theme'),
     'login_text' => __('Log in to reply.','your-theme'),
     'depth' => $depth,
     'before' => '<div class="comment-reply-link">',
     'after' => '</div>'
    )));
   endif;
  ?>
<?php } // end custom_comments

// Custom callback to list pings
function custom_pings($comment, $args, $depth) {
       $GLOBALS['comment'] = $comment;
        ?>
      <li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
       <div class="comment-author"><?php printf(__('By %1$s on %2$s at %3$s', 'your-theme'),
         get_comment_author_link(),
         get_comment_date(),
         get_comment_time() );
         edit_comment_link(__('Edit', 'your-theme'), ' <span class="meta-sep">|</span> <span class="edit-link">', '</span>'); ?></div>
    <?php if ($comment->comment_approved == '0') _e('\t\t\t\t\t<span class="unapproved">Your trackback is awaiting moderation.</span>\n', 'your-theme') ?>
            <div class="comment-content">
       <?php comment_text() ?>
   </div>
<?php } // end custom_pings

// Produces an avatar image with the hCard-compliant photo class
function commenter_link() {
 $commenter = get_comment_author_link();
 if ( ereg( '<a[^>]* class=[^>]+>', $commenter ) ) {
  $commenter = ereg_replace( '(<a[^>]* class=[\'"]?)', '\\1url ' , $commenter );
 } else {
  $commenter = ereg_replace( '(<a )/', '\\1class="url "' , $commenter );
 }
 $avatar_email = get_comment_author_email();
 $avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar( $avatar_email, 80 ) );
 echo $avatar . ' <span class="fn n">' . $commenter . '</span>';
} // end commenter_link

?>