    <section id="sidebarToggle" class="fade">
      <div class="padding">
        <a class="toggle" href="#"><span style="text-decoration:underline;">s</span>how projects</a>
        <!-- navigation -->
        <?php
        $pagelist = get_pages('child_of='.$post->post_parent.'&sort_column=menu_order&sort_order=asc');
        $pages = array();
        foreach ($pagelist as $page) {
           $pages[] += $page->ID;
        }
        
        $current = array_search($post->ID, $pages);
        $prevID = $pages[$current-1];
        $nextID = $pages[$current+1];
        ?>
        
        <div class="navigation">
        <?php if (!empty($prevID)) { ?>
          <div class="previousPage">
            <a href="<?php echo get_permalink($prevID); ?>" title="<?php echo get_the_title($prevID); ?>">Previous</a>
          </div>
        <?php }
        if (!empty($nextID)) { ?>
          <div class="nextPage">
            <a href="<?php echo get_permalink($nextID); ?>" title="<?php echo get_the_title($nextID); ?>">Next</a>
          </div>
        <?php } ?>
        </div>
        <!-- navigation -->
      </div>
    </section>
    <section id="sidebar" class="clearfix">
      <?php wp_nav_menu( array( 'theme_location' => 'secondary-menu','container_class' => 'clearfix','menu_class' => 'clearfix' ) ); ?>
    </section>