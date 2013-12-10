jQuery(function() {
    var max = 0;
    jQuery('.title-bloco-1').each(function(){
        if (jQuery(this).width() > max)
            max = jQuery(this).width();   
    });
    jQuery('.title-bloco-1').width(max);
});