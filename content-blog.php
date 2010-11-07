<section id="post-<?php the_ID() ?>" class="pagePost index clearfix fade">

    <h2 class="indexTitle">
        <a href="<?php the_permalink() ?>" title="Permalink to <?php the_title() ?>" rel="bookmark"><?php the_title() ?></a>
    </h2>
    
    <div class="meta">
        <abbr class="published" title="<?php the_time('Y-m-d\TH:i:sO') ?>"><?php the_time( get_option( 'date_format' ) ); ?></abbr>
        <span class="wordCount"><?php echo word_count(); ?> words</span>
        <span class="categories overflow"><?php the_category(', ') ?></span>
        <span class="comments"><?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?></span>
    </div>

</section>