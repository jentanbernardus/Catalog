<?php get_header(); ?>

    <section id="container">
        <section id="content">
        <?php
        if ( is_page(array('blog', 'Blog', 'journal', 'Journal')) ) {
            /*
                Check if the page slug or title matches these common
                `blog` related terms, and include the blog template.
                Include loop-blog.php or fallback loop.php
            */
            get_template_part('loop', 'blog');
        }
        else {
            /*
                Include loop-page.php or fallback loop.php
            */
            get_template_part('loop', 'page');
        }
        ?>
        </section>
    </section>

<?php get_footer(); ?>