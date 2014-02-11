jQuery(document).ready(function() {
	
	var dictkey;

	jQuery('td').on('click', function() {
		dictkey = jQuery(this).prev('.dict-key').html();
		ajax_url.key = dictkey;
	});

    jQuery('.dict-item').eip(ajax_url.ajax_url, {
        data: ajax_url,
        action: 'cp_ajax_edit_dict',
    });

});