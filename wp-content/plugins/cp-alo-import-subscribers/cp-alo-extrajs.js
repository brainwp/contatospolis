jQuery(document).ready(function() {

	if(typeof(listID) != 'undefined') {
		inps = jQuery('.check_list.easymail-metabox-update-count');

		jQuery.each(inps, function(e,i) {

			if (jQuery(this).val() == listID) {
				jQuery(this).click();
			}
				
		});
	}

	jQuery('#group-exp').on('click', function() {

		var checks = jQuery('input:checked');
		var recipients = [];

		jQuery.each(checks, function(e,i) {
			recipients.push(jQuery(this).val());
		});

		if(recipients.length < 1) {
			alert("Nenhum item selecionado");
		} else {
			jQuery.post( 
	            ajax_url.ajaxurl, { 
	                action : 'cp_alo_ajax_create_mailing',
	                recipients    : recipients
	            }, function( resp ) {
	                
	                    if(resp.redirect) {
	                        window.location.href = resp.redirect;
	                    }

	                });	
		}

		

	});
	

});