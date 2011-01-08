<?php
/*
    Log the ID of the featured post
    so we can skip it in the main loop.
*/
do_not_duplicate(get_the_ID());
?>
<div id="feature" class="clearfix">

    <div id="post-<?php the_ID() ?>" class="post">

        <div class="clearfix">
            <h2 class="title"><a href="<?php the_permalink() ?>" title="Permalink to <?php the_title() ?>" rel="bookmark"><?php the_title() ?></a></h2>
        </div>

        <div class="column two clearfix">
            <div class="column one byline">
                <strong>Published:</strong><br> <abbr class="published" title="<?php the_time('Y-m-d\TH:i:sO') ?>"><?php the_relative_date() ?></abbr><br> By <?php the_author_link() ?>
            </div>
            <div class="column one categories">
                <strong>Posted In:</strong>
                <ul>
                <?php sourdough_get_categories('', '<li>', '</li>') ?>
                </ul>
            </div>
        </div>

        <div class="excerpt column four">
            <?php the_excerpt() ?>
        </div>

    </div>

</div>