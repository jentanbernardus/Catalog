<ul class="index clearfix">
<?php
/*
    Index post loop.
     Query projects
*/
$projects = new WP_Query( array( 'post_type' => 'project' ) );

while ( $projects->have_posts() ) {
    $projects->the_post();
    /*
        Include content-index.php or fallback content.php
    */

    get_template_part('content', 'index');
}

/*
    See: lib/helpers.php -> catalog_pagination()
*/
catalog_pagination();
?>
</ul>