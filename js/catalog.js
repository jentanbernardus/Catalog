jQuery(document).ready(function($) {
  /*
    Preload page and fade in objects
  */
  $('#preloader').fadeOut(1,function(){ jQuery(this).remove(); });
  $(".fade").each(function(i) {
    var e = jQuery(this);
    e.fadeTo(0, 0.05);
    setTimeout(function(){
      e.fadeTo(250, 1);
    }, i*100);
  });
  /*
    Sidebar toggle
  */
  $("#sidebarToggle a.toggle").bind("click", function() {
    $(this).parent().parent().slideToggle(200); 
    $(this).parent().parent().next().slideToggle(200);
  });
  $("#sidebar li a").bind("click", function() {
    $(this).parent().parent().parent().parent().slideToggle(200); 
    $(this).parent().parent().parent().parent().prev().slideToggle(200);
  });
  /*
    Keyboard shortcuts
  */
  $(document.documentElement).keyup(function (event) {
    if (event.keyCode == 39 && $('.navigation .nextPage a').length) {
      location = $('.navigation .nextPage a').attr('href');
    }
    else if (event.keyCode == 37 && $('.navigation .previousPage a').length) {
      location = $('.navigation .previousPage a').attr('href');
    }
    else if (event.keyCode == 71) {
      $('.grid').click();
    }
    else if (event.keyCode == 83) {
      $('#sidebarToggle a.toggle').click();
    }
  });
  /*
    Grid overlay
  */
  $(".grid, #gridOverlay").click(function() {
    $("#gridOverlay").toggleClass("show");
  });
  /*
    We insert footer info here to make it harder to delete because I'm annoying
  */
  $("footer").append('<a href="#" class="grid">Grid</a> - Catalog&trade; theme');
});  
