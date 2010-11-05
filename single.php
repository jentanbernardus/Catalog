<?php get_header(); ?>

    <section id="container">
      <section id="content">
        <?php
        /*
          Include loop-post.php or fallback loop.php
        */
        get_template_part('loop', 'post');
        ?>
      </section>
    </section>
    
<?php get_footer(); ?>