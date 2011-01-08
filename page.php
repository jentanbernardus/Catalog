<?php get_header(); ?>

    <section id="container">
        <section id="content">
        <?php
        if ( is_page(array('blog', 'Blog', 'journal', 'Journal')) ) {
            /*
                Check if the page slug or title matches these common
                `blog` related terms, and include the blog template.
            */
            $temp = $wp_query;
            $wp_query = null;
            $wp_query = new WP_Query( array( 'post_type' => 'post', 'paged' => $paged ) );

            while ( $wp_query->have_posts() ) {
                $wp_query->the_post();
                /*
                    Include content-blog.php or fallback content.php
                */
                get_template_part('content', 'blog');
            }
        }
        else {
            /*
                Default page loop.
            */
            while ( have_posts() ) {
                the_post();
                /*
                    Include content-page.php or fallback content.php
                */
                get_template_part('content', 'page');
            }
        }

        /*
            Grab sidebar
        */
        get_sidebar();

        /*
            See: lib/helpers.php -> catalog_pagination()
        */
        catalog_pagination();
        
        /*
            Reset the query var.
        */
        $wp_query = null;
        $wp_query = $temp;
        wp_reset_query();
        ?>

        </section>
    </section>

<?php get_footer(); ?>