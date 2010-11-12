<section id="sidebar" class="clearfix fade">
    

<!--
    <div class="widget">
        <select name="category-dropdown" onchange='document.location.href=this.options[this.selectedIndex].value;'> 
         <option value=""><?php echo attribute_escape(__('Select Category')); ?></option> 
         <?php 
          $categories=  get_categories(); 
          foreach ($categories as $category) {
          	$option = '<option value="/category/archives/'.$category->category_nicename.'">';
        	$option .= $category->cat_name;
        	$option .= ' ('.$category->category_count.')';
        	$option .= '</option>';
        	echo $option;
          }
         ?>
        </select>
    </div>
    
    <div class="widget">
        <select name="archive-dropdown" onChange='document.location.href=this.options[this.selectedIndex].value;'> 
        <option value=""><?php echo attribute_escape(__('Select Month')); ?></option> 
        <?php wp_get_archives('type=monthly&format=option&show_post_count=1'); ?> </select>
    </div>
-->
    
    <div class="widget" style="float:right;">
        <?php get_search_form(); ?>
    </div>
    
</section>