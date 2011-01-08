<?php get_header(); ?>

    <section id="container">
      <section id="content">
        <?php
        /*
            Single post loop.
        */
        while ( have_posts() ) {
            the_post();
            /*
                Include content file.
            */
            get_template_part( 'content', 'project' );

            comments_template( '', true );
        }
        ?>
      </section>
    </section>
    
<?php get_footer(); ?>