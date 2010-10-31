<?php
/*
Template Name: Work index
*/
?>

<?php get_header(); ?>
    <section id="container">
      <section id="content" class="clearfix">
        <ul class="index clearfix">
        <?php query_posts('post_parent='.$post->ID.'&post_type=page&orderby=menu_order&order=ASC&posts_per_page=-1'); ?>
          <?php while (have_posts()) : the_post(); ?>  
          <li class="c1 project fade">
            <a href="<?php the_permalink() ?>">
              <?php the_post_thumbnail('thumbnail'); ?>
              <h3><?php the_title(); ?></h3>
            </a>
            <span class="brief">
              <?php $gallery = get_post_meta($post->ID, 'meta', true); ?>
              <?php $gal = $gallery; $gal = apply_filters('the_content', $gal ); echo $gal; ?>
            </span>
          </li>
          <?php endwhile; ?>
        </ul>
      </section>
    </section>
<?php get_footer(); ?>
    