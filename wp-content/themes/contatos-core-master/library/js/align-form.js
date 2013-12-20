jQuery(function() {
    var max = 0;
    jQuery('.title-bloco-1').each(function(){
        if (jQuery(this).width() > max)
            max = jQuery(this).width();   
    });
    jQuery('.title-bloco-1').width(max);
	
	var max2 = 0;
	jQuery('.title-bloco-2').each(function(){
        if (jQuery(this).width() > max2)
            max2 = jQuery(this).width();   
    });
    jQuery('.title-bloco-2').width(max2);
	
	var max3 = 0;
	jQuery('.title-bloco-3').each(function(){
        if (jQuery(this).width() > max3)
            max3 = jQuery(this).width();   
    });
    jQuery('.title-bloco-3').width(max3);
});