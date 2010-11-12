<?php catalog_pagination(); ?>
<?php get_sidebar(); ?>
<section id="post-<?php the_ID() ?>" class="pagePost post blog clearfix">

    <div class="infoWrap clearfix fade">
        <div class="entryTitle">
            <h2 class="title overflow"><?php the_title() ?></h2>
        </div>

        <abbr class="published" title="<?php the_time('Y-m-d\TH:i:sO') ?>">
        <?php the_time( get_option( 'date_format' ) ); ?>
        </abbr>
    </div>
    
    <div class="entry fade">
        <?php the_content(); ?>
    </div>
    
    <div class="infoWrapFooter clearfix fade">
        <span class="categories overflow">posted in <?php the_category(', ') ?></span>
    </div>
    
    <div class="comments">
        <?php comments_template(); ?>
    </div>
    
</section>