<?php get_header(); ?>

    <div id="content" class="column twelve">
        <div id="archive" class="column eight">

        <?php if (have_posts()) : ?>

            <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
            <?php /* If this is a category archive */ if (is_category()) { ?>
                <h2 class="page-title">Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category</h2>
            <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
                <h2 class="page-title">Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h2>
            <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
                <h2 class="page-title">Archive for <?php the_time('F jS, Y'); ?></h2>
            <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
                <h2 class="page-title">Archive for <?php the_time('F, Y'); ?></h2>
            <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
                <h2 class="page-title">Archive for <?php the_time('Y'); ?></h2>
            <?php /* If this is an author archive */ } elseif (is_author()) { ?>
                <h2 class="page-title">Author Archive</h2>
            <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
                <h2 class="page-title">Blog Archives</h2>
            <?php } ?>

            <?php
            /*
                Archive post loop.
            */
            while ( have_posts() ) {
                the_post();
                /*
                    Include content file.
                */
                get_template_part( 'excerpt', 'compact' );
            }
            ?>

        <?php else :

            if ( is_category() ) { // If this is a category archive
            	printf("<h2 class=\"page-title\">Sorry, but there aren't any posts in the %s category yet.</h2>", single_cat_title('',false));
            } else if ( is_date() ) { // If this is a date archive
            	echo("<h2 class=\"page-title\">Sorry, but there aren't any posts with this date.</h2>");
            } else if ( is_author() ) { // If this is a category archive
            	$userdata = get_userdatabylogin(get_query_var('author_name'));
            	printf("<h2 class=\"page-title\">Sorry, but there aren't any posts by %s yet.</h2>", $userdata->display_name);
            } else {
            	echo("<h2 class=\"page-title\">No posts found.</h2>");
            }
            get_search_form();

        endif; ?>

            <?php if ( $wp_query->max_num_pages > 1 ) : ?>
            <div class="pagination clearfix">
                <span class="prev button"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'sourdough' ) ); ?></span>
                <span class="next button"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'sourdough' ) ); ?></span>
            </div>
            <?php endif; ?>

        </div>

        <?php get_sidebar() ?>

    </div>

<?php get_footer() ?>