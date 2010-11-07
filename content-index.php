<li class="c1 project fade">

    <a href="<?php the_permalink() ?>" title="Permalink to <?php the_title() ?>" rel="bookmark">
    <?php 
        if ( has_post_thumbnail() ) 
            the_post_thumbnail();
        else
            echo '<img src="<?php get_bloginfo(\'stylesheet_directory\') ?>/i/nothumb.gif" alt="<?php the_title() ?> has no thumbnail.">';
    ?>
    </a>
    
    <h3><a href="<?php the_permalink() ?>" title="Permalink to <?php the_title() ?>" rel="bookmark" class="block overflow"><?php the_title(); ?></a></h3>

    <div class="brief overflow">
        <?php the_category(' / ') ?>,
        <?php echo get_the_date('Y') ?>
    </div>

</li>