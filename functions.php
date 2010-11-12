<?php
/*
    Here we'll load the utilities and helpers files.

    - Generic UDF's (lib/utilities.php)
    - Theme Helpers (lib/helpers.php)
    - Theme Support & Filters (this file)
*/
require TEMPLATEPATH.'/lib/utilities.php';
require TEMPLATEPATH.'/lib/helpers.php';

/*
    Table of Contents

    01 - catalog_init -> add post type, enqueue JS
    02 - catalog_add_project_gallery -> adds meta box for project gallery
    03 - catalog_setup -> theme support, thumbnails, headers
    04 - catalog_admin_header_style
    05 - catalog_template_part -> adds dynamic $name variable
    06, 09 - excerpt functions
    10 - catalog_search_form -> custom search form
    11 - catalog_comment -> custom comment template
    12 - catalog_widgets_init -> enable widgetized areas
*/
function catalog_init() {
    wp_enqueue_script('catalog', get_bloginfo('stylesheet_directory').'/js/catalog.js', array('jquery'), '1.0');
    // wp_enqueue_script('slideshow', get_bloginfo('stylesheet_directory').'/js/slideshow.js', array('jquery'), '1.0');

    /* 
        Add Projects post type
    */
    $labels = array(
        'name' => __('Projects', 'post type general name'),
        'singular_name' => __('Project', 'post type singular name'),
        'add_new' => __('Add New', 'project'),
        'add_new_item' => __('Add New Project'),
        'edit_item' => __('Edit Project'),
        'new_item' => __('New Project'),
        'view_item' => __('View Project'),
        'search_items' => __('Search Projects'),
        'not_found' =>  __('No projects found'),
        'not_found_in_trash' => __('No projects found in Trash'), 
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true, 
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_position' => 5,
        'menu_icon' => get_bloginfo('stylesheet_directory').'/i/admin/catalog-icon.gif',
        'supports' => array('title', 'editor', 'thumbnail', 'project_gallery'),
        'taxonomies' => array('category', 'post_tag')
    );

    register_post_type('project', $args);

    /*
        Add the meta box for selecting Gallery style.
    */
    function catalog_add_project_gallery() {
        add_meta_box( 'project_gallery', __( 'Project Gallery', 'catalog' ), 'catalog_project_gallery_content', 'project' );
    }
    add_action('add_meta_boxes', 'catalog_add_project_gallery');

    /*
        The actual content of the meta box.
    */
    function catalog_project_gallery_content() {
        global $post;
        $style = get_post_meta($post->ID, 'project_gallery_style', true);
        $exclude = get_post_meta($post->ID, 'project_gallery_exclude', true);

        wp_nonce_field( plugin_basename(__FILE__), 'catalog_project_gallery_noncename' );

        echo '<p><label for="project_gallery_style">' . __("How should we display the project's media?", 'catalog' ) . '</label> ';
        
        ?>
    <select id="project_gallery_style" name="project_gallery_style">
      <option value="list"<?php if ($style === 'list') echo ' selected="selected"'; ?>>List</option>
      <option value="slideshow"<?php if ($style === 'slideshow') echo ' selected="selected"'; ?>>Slideshow</option>
    </select></p>
   
    <p><label for="project_gallery_exclude" class="selectit">
        <?php echo __("Exclude the featured image from the gallery?", 'catalog' ) ?>
        <input name="project_gallery_exclude" type="checkbox" id="project_gallery_exclude" value="true"<?php if ($exclude) echo '  checked="checked"'; ?>>
    </label></p>
        <?php
    }

    /* 
        When the project is saved, saves our gallery style
    */
    function catalog_save_project_gallery( $post_id ) {
        # Authenticate
        if ( ! wp_verify_nonce( $_POST['catalog_project_gallery_noncename'], plugin_basename(__FILE__) ) )
            return $post_id;

        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
            return $post_id;

        if ( 'project' !== $_POST['post_type'] )
            return $post_id;

        # Save Style
        $style_data = $_POST['project_gallery_style'];
        $style_key = 'project_gallery_style';

        if ( ! update_post_meta($post_id, $style_key, $style_data) )
            add_post_meta($post_id, $style_key, $style_data, true);

        # Save Exclude
        $exclude_data = $_POST['project_gallery_exclude'];
        $exclude_key = 'project_gallery_exclude';

        if ( ! update_post_meta($post_id, $exclude_key, $exclude_data) )
            add_post_meta($post_id, $exclude_key, $exclude_data, true);

        return true;
    }
    add_action('save_post', 'catalog_save_project_gallery');
}
add_action('init', catalog_init);

/* 
    Add contextual messages
*/
function project_updated_messages( $messages ) {
    /* Post type specific messages */
    global $post, $post_ID;

    $messages['project'] = array(
        0 => '', // Unused. Messages start at index 1.
        1 => sprintf( __('Project updated. <a href="%s">View project</a>'), esc_url( get_permalink($post_ID) ) ),
        2 => __('Custom field updated.'),
        3 => __('Custom field deleted.'),
        4 => __('Project updated.'),
        /* translators: %s: date and time of the revision */
        5 => isset($_GET['revision']) ? sprintf( __('Project restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6 => sprintf( __('Project published. <a href="%s">View project</a>'), esc_url( get_permalink($post_ID) ) ),
        7 => __('Project saved.'),
        8 => sprintf( __('Project submitted. <a target="_blank" href="%s">Preview project</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
        9 => sprintf( __('Project scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview project</a>'),
        // translators: Publish box date format, see http://php.net/date
        date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
        10 => sprintf( __('Project draft updated. <a target="_blank" href="%s">Preview project</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    );

    return $messages;
}
add_filter('post_updated_messages', 'project_updated_messages');

/*
    Here we add our own setup function, to encapsulate
    all of our theme support.

    Wrapped in an `if`, so, if desired, one can override it
    in a child theme.
*/
if ( ! function_exists( 'catalog_setup' ) ) :
/* 
    Sets up theme options and features 
*/
function catalog_setup() {
    /*
        Theme Support
    */
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_custom_background();
    /*
        Enable custom menus
    */
    register_nav_menus(array(
        'primary-menu' => __( 'Primary Menu', 'catalog' ),
        'secondary-menu' => __( 'Secondary Menu', 'catalog' ),
        'tertiary-menu' => __( 'Tertiary Menu', 'catalog' ),
    ));
    /*
        Yay, you can upload your own logo!
    */
    define( 'HEADER_TEXTCOLOR', '' );
    define( 'HEADER_IMAGE', get_bloginfo('stylesheet_directory') . '/i/headers/default_header.png' );
    define( 'HEADER_IMAGE_WIDTH', apply_filters( 'catalog_header_image_width', 140 ) );
    define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'catalog_header_image_height', 48 ) );
    define( 'NO_HEADER_TEXT', true );

    add_custom_image_header('', 'catalog_admin_header_style');
    register_default_headers( array(
        'default' => array(
            'url' => get_bloginfo('stylesheet_directory').'/i/headers/default_header.png',
            'thumbnail_url' => get_bloginfo('stylesheet_directory').'/i/headers/default_header.png',
            'description' => __( 'Default', 'catalog' )
        )
    ));
    /*
        Featured image sizes.
    */
    set_post_thumbnail_size(140, 80, true); // Normal post thumbnails (loop)
    add_image_size('640-image', 640, 480, false);
    add_image_size('320-image', 320, 200, false);
    add_image_size('square-thumbnail', 50, 50, true);
    add_image_size('blog-thumbnail', 300, 200, true); // Blog post thumbnails
}
add_action( 'after_setup_theme', 'catalog_setup' );
endif;

if ( ! function_exists( 'catalog_admin_header_style' ) ) :
/* 
    Styles the header display within the admin panel
*/
function catalog_admin_header_style() {
?>
<style type="text/css">
#headimg {
    border:1px solid #000;
    border-width:1px 0;
}
/* If NO_HEADER_TEXT is false, you would style the text with these selectors:
    #headimg #name { }
    #headimg #desc { }
*/
</style>
<?php
}
endif;

/*
    Put's the requested $name into the global space
    to allow dynamic template_part loading!
*/
if ( ! function_exists( 'catalog_template_loop_name' ) ) :
function catalog_template_loop_name( $slug, $name ) {
    $GLOBALS['template_part_name'] = $name;
}
add_action( 'get_template_part_loop', 'catalog_template_loop_name', 10, 2 );
endif;

/*
    Adds a 'continue reading' link to the end
    of *all* excerpts! (auto, more and custom)
*/
if ( ! function_exists( 'catalog_excerpt_more' ) ) :
function catalog_excerpt_more( $post_excerpt ) {
    return $post_excerpt.' <a href="'.get_permalink().'" class="more">'. __( '(read more)', 'catalog' ).'</a>';
}
add_filter('wp_trim_excerpt', 'catalog_excerpt_more');
endif;

/*
    Removes the ellipsis from auto-generated
    exceprts.
*/
if ( ! function_exists( 'catalog_excerpt_ellipsis' ) ) :
function catalog_excerpt_ellipsis( $more ) {
    return '&hellip;';
}
add_filter('excerpt_more', 'catalog_excerpt_ellipsis');
endif;

/*
    Set the output length for excerpts.
*/
if ( ! function_exists( 'catalog_excerpt_length' ) ) :
function catalog_excerpt_length( $length ) {
    return 50;
}
add_filter( 'excerpt_length', 'catalog_excerpt_length' );
endif;

/*
    Return a custom search form.
    No need for a searchform.php
*/
if ( ! function_exists('catalog_search_form') ) :
function catalog_search_form( $form ) {
    $form = '<form role="search" method="get" id="searchform" action="' . trailingslashit(get_bloginfo('url')) . '">';
    $form .= '<div class="clearfix searchContainer">';
    $form .= '<input type="text" name="s" id="s" class="left" placeholder="Search" value="' . get_search_query() . '" />';
    $form .= '<input type="submit" name="searchsubmit" id="searchsubmit" class="left" value="" />';
    $form .= '</div>';
    $form .= '</form>'; 

    return $form;
}
add_filter('get_search_form', 'catalog_search_form');
endif;

/*
    Comment template
*/
if ( ! function_exists('catalog_comment') ) :
function catalog_comment( $comment, $args, $depth ) {
    die();
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
        case '' :
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <div id="comment-<?php comment_ID(); ?>">
        <div class="comment-author vcard">
            <?php echo get_avatar( $comment, 40 ); ?>
            <?php printf( __( '%s <span class="says">says:</span>', 'catalog' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
        </div><!-- .comment-author .vcard -->
        <?php if ( $comment->comment_approved == '0' ) : ?>
            <em><?php _e( 'Your comment is awaiting moderation.', 'catalog' ); ?></em>
            <br />
        <?php endif; ?>

        <div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
            <?php
                /* translators: 1: date, 2: time */
                printf( __( '%1$s at %2$s', 'catalog' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'catalog' ), ' ' );
            ?>
        </div><!-- .comment-meta .commentmetadata -->

        <div class="comment-body"><?php comment_text(); ?></div>

        <div class="reply">
            <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
        </div><!-- .reply -->
    </div><!-- #comment-##  -->

    <?php
            break;
        case 'pingback'  :
        case 'trackback' :
    ?>
    <li class="post pingback">
        <p><?php _e( 'Pingback:', 'catalog' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'catalog'), ' ' ); ?></p>
    <?php
            break;
    endswitch;
}
endif;

/*
    Enable widget areas.
*/
if ( ! function_exists('catalog_widgets_init')) :
function catalog_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Header Widget Area', 'catalog' ),
        'id'            => 'header-widget-area',
        'description'   => __( 'Widgets are spanning full-width before the posts loop', 'catalog' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    register_sidebar( array(
        'name'          => __( 'Footer Widget Area', 'catalog' ),
        'id'            => 'footer-widget-area',
        'description'   => __( 'Widgets are spanning full-width after the posts loop.', 'catalog' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action( 'widgets_init', 'catalog_widgets_init' );
endif;

/* Huzzah! */