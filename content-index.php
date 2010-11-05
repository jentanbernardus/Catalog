<li class="c1 project fade">

    <a href="<?php the_permalink() ?>" title="Permalink to <?php the_title() ?>" rel="bookmark">
    <?php 
        if ( has_post_thumbnail() ) 
            the_post_thumbnail();
        else
            echo '<img src="<?php get_bloginfo(\'stylesheet_directory\') ?>/i/nothumb.gif" alt="<?php the_title() ?> has no thumbnail.">';
    ?>
    </a>
    
    <h3><a href="<?php the_permalink() ?>" title="Permalink to <?php the_title() ?>" rel="bookmark" class="block"><?php the_title(); ?></a></h3>

    <span class="brief">
        <span class="category"><?php the_category(' / ') ?></span>,
        <span class="year"><?php echo get_the_date('Y') ?></span>
    </span>

</li>