<section id="secondaryMenuToggle" class="fade">
    <div class="padding">
        <a class="toggle" href="#"><span style="text-decoration:underline;">t</span>oggle projects</a>
        <?php catalog_pagination(); ?>
    </div>
</section>

<section id="secondaryMenu">
    <nav class="clearfix">
        <?php wp_nav_menu( array( 'theme_location' => 'secondary-menu' ) ); ?>
    </nav>
</section>

<section id="page-<?php the_ID() ?>" class="pagePost page clearfix">
    <div class="infoWrap clearfix fade">
        <div class="entryTitle">
            <h2 class="title"><?php the_title() ?></h2>
        </div>
        <div class="pageMeta clearfix">
            <span class="category"><?php the_category(' / ') ?></span>,
            <span class="year"><?php echo get_the_date('Y') ?></span>
        </div>
    </div>

    <div class="gallery clearfix fade">
        <?php catalog_gallery() ?>
    </div>

    <div class="entry fade">
        <?php the_content(); ?>
    </div>
</section>