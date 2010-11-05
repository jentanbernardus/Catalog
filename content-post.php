<section id="post-<?php the_ID() ?>" class="pagePost post clearfix">

    <div class="infoWrap clearfix fade">
        <div class="entryTitle">
            <h2 class="title"><?php the_title() ?></h2>
        </div>

        <abbr class="published" title="<?php the_time('Y-m-d\TH:i:sO') ?>">
        <?php the_time( get_option( 'date_format' ) ); ?>
        </abbr>

        <span class="wordCount"><?php echo word_count(); ?> words</span>
        <span class="categories">posted in <?php the_category(', ') ?></span>
        <span class="comments"><?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?></span>
    </div>
    
    <div class="entry fade">
        <?php the_content(); ?>
    </div>

</section>

<?php comments_template('', true); ?>