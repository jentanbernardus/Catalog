<?php get_header(); ?>

    <div id="content" class="column twelve">
        <div id="archive" class="column eight">
        <?php if (have_posts()) : ?>

            <h2 class="page-title"><?php printf( __( 'Search Results for %s', 'sourdough' ), '&ldquo;'.get_search_query().'&rdquo;' ); ?></h2>

            <?php
            /*
                Search post loop.
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

        	echo "<h2 class=\"page-title\">No posts found. Try a different search.";
        	get_search_form();

        endif; ?>
    	</div>

        <?php get_sidebar() ?>

    </div> <!-- #content -->

<?php get_footer() ?>