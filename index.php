<?php get_header(); ?>
    <section id="container">
      <section id="content">
        <?php
        /*
          Include loop-index.php or fallback loop.php
        */
        get_template_part('loop', 'index');
        ?>      
      </section>
    </section>
<?php get_footer(); ?>