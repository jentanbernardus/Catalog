<?php get_header(); ?>
    <section id="container">
      <section id="content">
        <?php
        /*
          Include loop-single.php or fallback loop.php
        */
        get_template_part('loop', 'blog');
        ?>
      </section>
    </section>
<?php get_footer(); ?>