<?php global $wp_query; if ( $wp_query->max_num_pages > 1 ) : ?>
<div class="pagination clearfix">
    <span class="prev button"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'sourdough' ) ); ?></span>
    <span class="next button"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'sourdough' ) ); ?></span>
</div>
<?php endif; ?>