<?php get_header(); ?>
    <section id="container">
      <section id="content">
        <?php while ( have_posts() ) : the_post() ?>
  
  			<section id="post-<?php the_ID() ?>" class="pagePost index clearfix fade">
  				<h2 class="indexTitle"><a href="<?php the_permalink() ?>" title="Permalink to <?php the_title() ?>" rel="bookmark"><?php the_title() ?></a></h2>
          <div class="meta">
            <abbr class="published c1" title="<?php the_time('Y-m-d\TH:i:sO') ?>"><?php the_time( get_option( 'date_format' ) ); ?></abbr>
            <span class="wordCount c1"><?php echo word_count(); ?> words</span>
            <span class="categories c1"><?php the_category(', ') ?></span>
  					<span class="comments c1"><?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?></span>
					</div>
  			</section>
  
  		<?php endwhile; ?>
  
      <?php if (show_posts_nav()) : ?>
        <div class="navigation index clearfix">
    			<div class="alignLeft">
    		    <div class="previousPage">
    		      <?php next_posts_link('Older entries') ?>
    		    </div>
    			</div>
    			<div class="alignRight clearfix">
    		    <div class="nextPage">
    		    <?php previous_posts_link('Newer entries') ?>
    		    </div>
    		  </div>
    		</div>
      <?php endif; ?>
      
      </section>
    </section>
<?php get_footer(); ?>
    