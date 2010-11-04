jQuery(document).ready(function($) {
    slideshow('.gallery');
    
    function slideshow(container) {
        var item_ID = 1;
        var item = $(container+' .gallery-item');
        var item_count = item.size();
        
        item.css({ position:'absolute' });
        item.each(function(i, e) { $(e).attr('id', 'item-'+(i+1)); });
        item.css({ opacity: 0.0, zIndex: '8' });

        var slide_init = function() { 
            $(container+' #item-'+item_ID).animate({ opacity: 1.0,zIndex: '10' }, 250, function() { 
                $(container).css({ height: $(container+' #item-'+item_ID).height() }, 500); 
            });
        }

        $('#item-count').html('('+item_ID+' of '+item_count+')');
        slide_init();

        $('#next-item,'+container+' .gallery-item').click(function() {
            item.css({ zIndex: '8' });
            if (item_ID < item_count) { 
                ++item_ID;
                $(container+' #item-'+item_ID).css({ opacity: 0.0, zIndex: '10' }).animate({ opacity: 1.0 }, 500, function() {
                    $(container+' #item-'+(item_ID-1)).css({ opacity: 0.0, zIndex: '9' });
                });
            }
            else {
                item_ID = 1;
                $(container+' #item-'+item_ID).css({ opacity: 0.0, zIndex: '10' }).animate({ opacity: 1.0 }, 500, function() {
                    $(container+' #item-'+item_count).css({ opacity: 0.0, zIndex: '9' });
                });
            }
            
            $(container).css({ height: $(container+' #item-'+item_ID).height() });
            $('#item-count').html('('+item_ID+' of '+item_count+')');
            return false;
        });
        $('#prev-item').click(function() {
            item.css({ zIndex: '8' });
            if (item_ID > 1) {  
                --item_ID;
                $(container+' #item-'+item_ID).css({ opacity: 0.0, zIndex: '10' }).animate({ opacity: 1.0 }, 500, function() {
                    $(container+' #item-'+(item_ID+1)).css({ opacity: 0.0, zIndex: '9' });
                });
            }
            else {
                item_ID = item_count;
                $(container+' #item-'+item_ID).css({ opacity: 0.0, zIndex: '10' }).animate({ opacity: 1.0 }, 500, function() {
                    $(container+' #item-1').css({ opacity: 0.0, zIndex: '9' });
                });
            }
            
            $(container).css({ height: $(container+' #item-'+item_ID).height() });
            $('#item-count').html('('+item_ID+' of '+item_count+')');
            return false;
        });
    }
});