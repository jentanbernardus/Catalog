<?php get_header(); ?>
<?php get_sidebar(); ?>
    <section id="container">
      <section id="content" class="clearfix">
        
        <!-- the page -->
        <?php while ( have_posts() ) : the_post() ?>
  			<section id="page-<?php the_ID() ?>" class="pagePost page clearfix">
  		    <div class="infoWrap clearfix fade">
    				<div class="entryTitle">
        			<h2 class="title"><?php the_title() ?></h2>
        		</div>
            <div class="pageMeta clearfix">
              <?php $gallery = get_post_meta($post->ID, 'meta', true); ?>
              <?php $gal = $gallery; $gal = apply_filters('the_content', $gal ); echo $gal; ?>
            </div>
  				</div>
          <div class="gallery clearfix fade">
            <?php $gallery = get_post_meta($post->ID, 'gallery', true); ?>
            <?php $gal = $gallery; $gal = apply_filters('the_content', $gal ); echo $gal; ?>
          </div>
				  <div class="entry fade">
				    <?php the_content(); ?>
				  </div>
				  <?php endwhile; ?>
        </section>
        
      </section>
    </section>
<?php get_footer(); ?>