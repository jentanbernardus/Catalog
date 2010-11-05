<?php 
/*
    Catalog Helpers

    These just make outputting content easier and cleaner.
*/

/*
    Grabs all media attachments for a Project and outputs
    them. Loads any JS according to `project_gallery_style`.

    Use within the loop.

    TODO: Properly load Slideshow JS when needed.
*/
function catalog_gallery() {
    $attachments = get_posts(array(
        'post_type' => 'attachment',
        'numberposts' => -1,
        'post_status' => null,
        'post_parent' => get_the_ID()
    ));

    $style = get_post_meta(get_the_ID(), 'project_gallery_style', true);
    $exclude = get_post_meta(get_the_ID(), 'project_gallery_exclude', true);

    $thumb_id = get_post_thumbnail_id(get_the_ID());

    if ($attachments) {
        if ( $exclude ) {
            foreach ($attachments as $attachment)
                if ( $attachment->ID != $thumb_id )
                    echo '<div class="gallery-item">'.wp_get_attachment_image($attachment->ID, 'full').'</div>';
        }
        else {
            foreach ($attachments as $attachment)
                echo '<div class="gallery-item">'.wp_get_attachment_image($attachment->ID, 'full').'</div>';
        }   
    }
}

/*
    Loads the `pagination.php` theme file, otherwise echo's some preset html.
    Preference is given to the theme file, to allow for easier customization and collaboration.

    It is not recommended that you edit the preset html in this function, it is just a fall back.
*/
if (!function_exists('catalog_pagination')) :
function catalog_pagination( $filename = 'pagination' ) {
    $fs = STYLESHEETPATH.'/'.$filename.'.php';
    $ft = TEMPLATEPATH.'/'.$filename.'.php';
    if ( file_exists($fs) ) {
        include $fs;
    }
    elseif ( $ft ) {
        include $ft;
    }
    else { 
        if (function_exists('wp_pagenavi')) {
            wp_pagenavi();
        }
        else {
        ?>
        <div class="pagination clearfix">
            <div class="previous left"><?php previous_posts_link(); ?></div>
            <div class="next right"><?php next_posts_link(); ?></div>
        </div>
        <?php }
    }
}
endif;

/*
    Echoes the categories with the parent of each as a css class.
    Allows you to style each category link based on it's parent.
    Must be used within the loop.

    Example:
        <a href="/category" class="parent-class">cagtegory Name</a>
*/
if (!function_exists('catalog_get_categories')) :
function catalog_get_categories( $sep = ', ', $before = '', $after = '' ) {
    $total_cats = count(get_the_category());
    $i = 0;
    foreach((get_the_category()) as $cat) {
        ++$i;
        $parent = get_category( $cat->parent );
        $link   = get_category_link( $cat->cat_ID );

        echo $before;

        if(!$parent->errors) {
            echo '<a href="'.$link.'" title="'.$cat->name.'" class="'.$parent->slug.'">'.$cat->name.'</a>';
        } else {
            echo '<a href="'.$link.'" title="'.$cat->name.'">'.$cat->name.'</a>';
        }
        
        if($i < $total_cats) echo $sep;

        echo $after;
    } 
}
endif;

/*
    Echoes an unordered list of links to all children
    of the current parent category or page.

    Even when viewing a child page, we find the parent
    and output all of its children.
*/
if (!function_exists('catalog_list_children')) :
function catalog_list_children( ) {
    if ( is_category() ) {
        $cat = (int) get_query_var('cat');
        $term = get_term($cat, 'category');
        // If a child cat, then list all children of it's parent
        $parent = ($term->parent) ? (int) $term->parent : $cat;
        wp_list_categories(array(
            'child_of' => $parent,
            'title_li' => ''
        ));
    }
    elseif ( is_page() ) {
        $page = get_page_by_title(get_the_title());
        $parent = ($page->post_parent) ? (int) $page->post_parent : $page->ID;
        wp_list_pages(array(
            'child_of' => $parent,
            'title_li' => ''
        ));
    }
}
endif;
?>