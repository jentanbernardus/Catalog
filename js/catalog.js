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
    Hide the Secondary Menu 
  */
  $("#secondaryMenu").hide();
  /*
    Secondary Menu toggle
  */
  $("#secondaryMenuToggle a.toggle").bind("click", function() {
    $(this).parent().parent().next().slideToggle(200); 
  });
  $("#secondaryMenu nav div ul li a").bind("click", function() {
    $(this).parent().parent().parent().parent().parent().slideToggle(200); 
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
    else if (event.keyCode == 84) {
      $('#secondaryMenuToggle a.toggle').click();
    }
  });
  /*
    Create inactive nav links if empty
  */
  $(".postNav .nextPage:empty").html("<span class='inactive'>Next</span>"); 
  $(".postNav .previousPage:empty").html("<span class='inactive'>Prev</span>");  
  /*
    We insert footer info here to make it harder to delete because I'm annoying
  */
  $("footer").append('<a href="#" class="grid">Grid</a> - Catalog&trade; theme');
  /*
    Grid overlay (we place this last so the previous function works)
  */
  $(".grid, #gridOverlay").click(function() {
    $("#gridOverlay").toggleClass("show");
  });
});  
