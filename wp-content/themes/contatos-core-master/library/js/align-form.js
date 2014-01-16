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
	
	var max4 = 0;
	jQuery('.title-bloco-4').each(function(){
        if (jQuery(this).width() > max4)
            max4 = jQuery(this).width();   
    });
    jQuery('.title-bloco-4').width(max4);
	
	var max5 = 0;
	jQuery('.title-bloco-5').each(function(){
        if (jQuery(this).width() > max5)
            max5 = jQuery(this).width();   
    });
    jQuery('.title-bloco-5').width(max5);
	
	var max6 = 0;
	jQuery('.title-bloco-6').each(function(){
        if (jQuery(this).width() > max6)
            max6 = jQuery(this).width();   
    });
    jQuery('.title-bloco-6').width(max6);
});

jQuery(window).load(function() {
	jQuery('.inlineLabels.contact').css('display','none');
	jQuery('.inlineLabels.company').css('display','none');
});