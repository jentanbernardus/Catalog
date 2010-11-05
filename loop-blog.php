<?php
/*
    Index post loop.
     Query projects
*/
$posts = new WP_Query( array( 'post_type' => 'post' ) );

while ( $posts->have_posts() ) {
    $posts->the_post();
    /*
        Include content-blog.php or fallback content.php
    */

    get_template_part('content', 'blog');
}

/*
    See: lib/helpers.php -> catalog_pagination()
*/
catalog_pagination();
?>