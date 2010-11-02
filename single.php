<?php get_header(); ?>
    <section id="container">
      <section id="content" class="clearfix">
        <!-- navigation -->
  		  <div class="navigation postNav fade">
			    <div class="previousPage"><?php previous_post_link( '%link', 'Previous' ); ?></div>
			    <div class="nextPage"><?php next_post_link( '%link', 'Next' ); ?></div>
				</div>
        <!-- the post -->
        <?php while ( have_posts() ) : the_post() ?>
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
				  <?php endwhile; ?>
  			</section>

        <!-- navigation bottom-->  			
<!--
  		  <div class="navigation bottom">
  		    <div class="alignLeft">
				    <div class="previousPage"><?php previous_post_link( '%link', 'previous' ); ?></div>
					</div>
					<div class="alignRight">
				    <div class="nextPage"><?php next_post_link( '%link', 'next' ); ?></div>
				  </div>
				</div>
-->
        
      </section>
    </section>
<?php get_footer(); ?>