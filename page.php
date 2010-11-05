<?php get_header(); ?>
    <section id="container">
      <section id="content">
        <?php
        /*
          Include loop-page.php or fallback loop.php
        */
        get_template_part('loop', 'page');
        ?>
      </section>
    </section>
<?php get_footer(); ?>