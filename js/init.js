//footer html
jQuery(document).ready(function() { 
  jQuery("footer").append('<a href="#" class="grid">Grid</a> - Catalog&trade; theme'); //we insert footer info here to make it harder to delete because I'm annoying
  jQuery("#sidebar").hide(); //we hide the sidebar by default
});  
//toggle grid
jQuery(document).ready(function() { 
  jQuery(".grid, #gridOverlay").click(function() {
    jQuery("#gridOverlay").toggleClass("show");
  });
});
//preload page before revealing it
jQuery(window).load(function(){
  jQuery('#preloader').fadeOut(1,function(){jQuery(this).remove();});
});
//fade in objects, thanks Staydecent for this one!
jQuery(window).load(function(){  
  jQuery(".fade").each(function(i) {
    var e = jQuery(this);
    e.fadeTo(0, 0.05);
    setTimeout(function(){
      e.fadeTo(250, 1);
    }, i*100);
  });    
});
//toggle sidebar
jQuery(function(jQuery){
  jQuery("#sidebarToggle a.toggle").bind("click", function() {
    jQuery(this).parent().parent().slideToggle(200); 
    jQuery(this).parent().parent().next().slideToggle(200);
  });
  jQuery("#sidebar li a").bind("click", function() { //click on menu item collapses the sidebar
    jQuery(this).parent().parent().parent().parent().slideToggle(200); 
    jQuery(this).parent().parent().parent().parent().prev().slideToggle(200);
  });
});
//keyboard shortcuts
jQuery(document.documentElement).keyup(function (event) {
  if (event.keyCode == 39 && jQuery('.navigation .nextPage a').length) {
    location = jQuery('.navigation .nextPage a').attr('href');
  } else if (event.keyCode == 37 && jQuery('.navigation .previousPage a').length) {
    location = jQuery('.navigation .previousPage a').attr('href');
  } else if (event.keyCode == 71) {
    jQuery('.grid').click();
  } else if (event.keyCode == 83) {
    jQuery('#sidebarToggle a.toggle').click();
  }
});