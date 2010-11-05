<section id="post-<?php the_ID() ?>" class="pagePost post clearfix">
    <div class="infoWrap clearfix fade">
        <div class="entryTitle">
            <h2 class="title"><?php the_title() ?></h2>
        </div>
    </div>
    <div class="entry fade">
        <?php the_content(); ?>
    </div>
</section>