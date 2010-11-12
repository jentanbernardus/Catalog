<section id="post-<?php the_ID() ?>" class="pagePost index blog clearfix fade">

    <h2 class="indexTitle">
        <a href="<?php the_permalink() ?>" title="Permalink to <?php the_title() ?>" rel="bookmark"><?php the_title() ?></a>
    </h2>
    
    <div class="meta clearfix">
        <abbr class="published" title="<?php the_time('Y-m-d\TH:i:sO') ?>"><?php the_time( get_option( 'date_format' ) ); ?></abbr>
        <span class="comments">
            <?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?>
        </span>
    </div>

    <div class="thumbnail clearfix">
    <?php 
        if ( has_post_thumbnail() ) 
            the_post_thumbnail('blog-thumbnail');
        else
            echo '<img src="<?php get_bloginfo(\'stylesheet_directory\') ?>/i/nothumb.png" alt="<?php the_title() ?> has no thumbnail.">';
    ?>
    </div>

    <div class="entry">
        <?php the_excerpt(); ?>
    </div>

</section>