<?php if ( ! is_single() ) : ?>

<div class="navigation clearfix">
  <div class="alignLeft">
    <div class="previousPage"><?php next_posts_link('Older entries') ?></div>
  </div>

  <div class="alignRight">
    <div class="nextPage"><?php previous_posts_link('Newer entries') ?></div>
  </div>
</div>

<?php else: ?>

<div class="navigation postNav fade">
    <div class="previousPage"><?php previous_post_link( '%link', 'Previous' ); ?></div>
    <div class="nextPage"><?php next_post_link( '%link', 'Next' ); ?></div>
</div>

<?php endif; ?>