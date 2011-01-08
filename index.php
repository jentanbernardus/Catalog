<?php get_header(); ?>

    <?php if (!dynamic_sidebar( 'home-widget-area' )) : ?>
    <?php endif; ?>

    <section id="container">
        <section id="content">

            <ul class="index clearfix">
            <?php
            /*
                Index post loop.
                 Query projects
            */
            $temp = $wp_query;
            $wp_query = null;
            $wp_query = new WP_Query( array( 'post_type' => 'project', 'paged' => $paged ) );

            while ( $wp_query->have_posts() ) {
                $wp_query->the_post();
                /*
                    Include content-index.php or fallback content.php
                */
                get_template_part('content', 'index');
            }
            ?>
            </ul>

            <?php
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