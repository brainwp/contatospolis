/**
 * RoloPress JavaScript functions.
 * @requires jQuery
 */

// Media upload front-end
jQuery(document).ready(function($){
  var _custom_media = true,
      _orig_send_attachment = wp.media.editor.send.attachment;

  jQuery('.item-image.enabled').on('click', function(e) {
    var send_attachment_bkp = wp.media.editor.send.attachment;
    var button = jQuery(this);
    var id = button.attr('id').replace('_button', '');
    _custom_media = true;
    wp.media.editor.send.attachment = function(props, attachment){
      if ( _custom_media ) {

        jQuery.post( 
            ajax_url.ajaxurl, { 
                action : 'rolo_ajax_edit_thumbnail',
                postid : ajax_url.postid,
                att   : attachment.id
            }, function( resp ) {
                
                    jQuery("#_button"+id).html(resp);

                });

        // jQuery("#"+id).children('img').attr('src', attachment.url);

      } else {
        return _orig_send_attachment.apply( this, [props, attachment] );
      };
    }

    wp.media.editor.open(button);
    return false;
  });
/*
  jQuery('.wp-core-ui .button').on('click', function(){
    console.log('oi');
    console.log(jQuery('.media-selection .selection-view li').eq(0).children('img').attr('src'));
    // _custom_media = false;
  });
*/
});

// Auto set on page load...
jQuery(document).ready(function() {
    // Uniform
    jQuery('form.uniForm').uniform();

    // Hide all hidden elements
    jQuery('.ctrlHidden').hide();

    // Bind a custom event
    jQuery('.ctrlHolder')
    .live('show', function () {
       var $this = jQuery(this) ;
       var slug = jQuery.trim($this.attr('class').replace('ctrlHolder', '').replace('ctrlHidden', '').replace('multipleInput', ''));

       jQuery ('div.' + slug + ':visible').each(function () {
           $this.find('option[value="' + jQuery(this).find('select').val() + '"]').remove();
       });

       if (jQuery('div.' + slug + ':hidden').length == 1) {
           $this.find('img.rolo_add_ctrl').hide();
       }
    })
    .live('hide', function () {
       var $this = jQuery(this) ;
       var slug = jQuery.trim($this.attr('class').replace('ctrlHolder', '').replace('ctrlHidden', '').replace('multipleInput', ''));

       if (jQuery ('div.' + slug + ':visible').length > 0) {
           jQuery ('div.' + slug + ':visible:last').find('img.rolo_add_ctrl').show();
       }
    });

    // when the add button is clicked
    jQuery('img.rolo_add_ctrl').live('click', function () {
       var $this = jQuery(this) ;
       var slug = jQuery.trim($this.parent('div.ctrlHolder').attr('class').replace('ctrlHolder', '').replace('ctrlHidden', '').replace('multipleInput', ''));
       
       $this.hide().parents('form.uniForm').find('div.' + slug + ':hidden:first').trigger('show').show();
    });

    // when the delete button is clicked
    jQuery('img.rolo_delete_ctrl').live('click', function () {
       var $this = jQuery(this) ;
       $this.parent('.ctrlHolder').children('.textInput').val('');
       $this.parent('.ctrlHolder').hide().trigger('hide');
    });

    //on focus tricks
    jQuery('div.ctrlHolder input[name="rolo_contact_city"], div.ctrlHolder input[name="rolo_company_city"]').focus(function () {
        var $this = jQuery(this);
        if ($this.val() == 'City') {
            $this.val('');
        }
    });

    jQuery('div.ctrlHolder input[name="rolo_contact_state"], div.ctrlHolder input[name="rolo_company_state"]').focus(function () {
        var $this = jQuery(this);
        if ($this.val() == 'State') {
            $this.val('');
        }
    });

    jQuery('div.ctrlHolder input[name="rolo_contact_zip"], div.ctrlHolder input[name="rolo_company_zip"]').focus(function () {
        var $this = jQuery(this);
        if ($this.val() == 'Zip') {
            $this.val('');
        }
    });

    jQuery('div.ctrlHolder input[name="rolo_contact_country"], div.ctrlHolder input[name="rolo_company_country"]').focus(function () {
        var $this = jQuery(this);
        if ($this.val() == 'Country') {
            $this.val('');
        }
    });

    // Auto Complete taxonomy fields
    jQuery('input.company').suggest(wpurl + "/wp-admin/admin-ajax.php?action=ajax-tag-search&tax=company", {multiple:false});
	jQuery('input.city').suggest(wpurl + "/wp-admin/admin-ajax.php?action=ajax-tag-search&tax=city", {multiple:false});
	jQuery('input.state').suggest(wpurl + "/wp-admin/admin-ajax.php?action=ajax-tag-search&tax=state", {multiple:false});
	jQuery('input.zip').suggest(wpurl + "/wp-admin/admin-ajax.php?action=ajax-tag-search&tax=zip", {multiple:false});
	jQuery('input.country').suggest(wpurl + "/wp-admin/admin-ajax.php?action=ajax-tag-search&tax=country", {multiple:false});
	jQuery('input.post_tag').suggest(wpurl + "/wp-admin/admin-ajax.php?action=ajax-tag-search&tax=post_tag", {multiple:false});

    // Edit in place for contacts
    /*
    jQuery('#rolo_contact_title,#rolo_contact_address, #rolo_contact_email, #rolo_contact_phone_Mobile, #rolo_contact_phone_Home, #rolo_contact_phone_Work, #rolo_contact_phone_Other, #rolo_contact_phone_Fax, #rolo_contact_im_Yahoo, #rolo_contact_im_MSN, #rolo_contact_im_AOL, #rolo_contact_im_GTalk, #rolo_contact_im_Skype, #rolo_contact_twitter, #rolo_contact_website').eip(ajax_url, {
        action: 'rolo_edit_contact',
        id_field: 'rolo_post_id'
    });
    */
    // Edit in place for address
    jQuery('#city, #state, #zip, #country').eip(ajax_url, {
        action: 'rolo_edit_address',
        id_field: 'rolo_post_id'
    });

    // Edit in place for tags
    jQuery('#post_tag').eip(ajax_url, {
        action: 'rolo_edit_tag',
        id_field: 'rolo_post_id'
    });

    // Edit in place for company
    /*
    jQuery('#rolo_company_name,#rolo_company_address, #rolo_company_city, #rolo_company_state, #rolo_company_zip, #rolo_company_country, #rolo_company_email, #rolo_company_phone_Mobile, #rolo_company_phone_Home, #rolo_company_phone_Work, #rolo_company_phone_Other, #rolo_company_phone_Fax, #rolo_company_im_Yahoo, #rolo_company_im_MSN, #rolo_company_im_AOL, #rolo_company_im_GTalk, #rolo_company_im_Skype, #rolo_company_twitter, #rolo_company_website').eip(ajax_url, {
        action: 'rolo_edit_company',
        id_field: 'rolo_post_id'
    });
    */
    // Edit in place for notes
    jQuery('div.note').eip(ajax_url, {
        action: 'rolo_edit_note', form_type: "textarea"
    });

    // Edit in place - Contatos Polis
    jQuery('.resposta').not('#rolo_company_legal, .rolo_conflito, .rolo_relacao').eip(ajax_url.ajaxurl, {
        action: 'rolo_ajax_edit_company',
        data: ajax_url.postid
    });

    // Edit in place - Contatos Polis
    jQuery('#rolo_company_legal').eip(ajax_url.ajaxurl, {
        action: 'rolo_ajax_edit_company',
        data: ajax_url.postid,
         form_type: "select",
                select_options: {
                        "Não" : "Não",
                        "Sim" : "Sim"
                }
    });

    jQuery('input.rolo_conflito.check').on('change', function() {

        if (jQuery(".rolo_conflito.check:checked").length == 1) {
            jQuery('.input_conflito').removeClass('out');
        } else {
            jQuery('.input_conflito').not('.button').addClass('out');
        }

    });

    jQuery('input.rolo_relacao.check').on('change', function() {

        if (jQuery(".rolo_relacao.check:checked").length == 1) {
            jQuery('.input_relacao').removeClass('out');
        } else {
            jQuery('.input_relacao').not('.button').addClass('out');
        }

    });

    jQuery('.input_conflito.button, .input_relacao.button').on('click', function() {

        var cl;

        if(jQuery(this).hasClass('input_conflito')) {
            cl = '.input_conflito';
        } else {
            cl = '.input_relacao';
        }

        var list = [];
        var tags;
        var act;
        if(jQuery(this).hasClass('input_conflito')) {
            check = jQuery('.rolo_conflito.check').is(':checked');
            act = 'conflito';
            tags = jQuery('.input_conflito').not('.button');
        } else {
            check = jQuery('.rolo_relacao.check').is(':checked');
            act = 'relacao';
            tags = jQuery('.input_relacao').not('.button');
        }

        jQuery.each(tags, function() {
            
            if(jQuery(this).is('input:checked')) {
                list.push('checked');
            } else {
                list.push(jQuery(this).val());
            }
            
        });

        if(check == 1) {
            list.unshift(true);    
        } else {
            list.unshift(false);
        }
        
        jQuery.post( 
            ajax_url.ajaxurl, { 
                action : 'rolo_ajax_edit_company_other',
                act    : act,
                postid : ajax_url.postid,
                data   : list
            }, function( resp ) {
                
                    if(resp.status == 'sucesso') {
                        window.location.reload();
                    }

                });

    });
/*
    jQuery('.input_relacao.button').on('click', function() {

        var list = [];
        jQuery.each(jQuery('.input_relacao').not('.button'), function() {
            
            if(jQuery(this).is('input:checked')) {
                list.push('checked');
            } else {
                list.push(jQuery(this).val());
            }

        });

        jQuery.post( 
            ajax_url.ajaxurl, { 
                action : 'rolo_ajax_edit_company_relacao',
                data   : list
            }, function( resp ) {

                    if(resp.status == 'sucesso') {
                    }

                });

    });
*/
    jQuery('.selectit input').on('change', function() {

        var area = jQuery(this).parents('div').attr('class');
        var val = jQuery(this).val();

        var ajax_data = { area: area, val: val, postid: ajax_url.postid }

        jQuery.post( 
                ajax_url.ajaxurl, { 
                    action : 'rolo_ajax_edit_taxonomy',
                    data   : ajax_data
                }, function( resp ) {
                        var data = ajax_data;
                        if(resp.status == 'sucesso') {
                        }

                    });
    });

    // Autocomplete nomes
    var autocomp_nomes = {
         source: function(request, response) {
             jQuery.post( 
                ajax_url.ajaxurl, { 
                    action : 'rolo_ajax_autocomplete',
                    type: 'nomes',
                    data   : request.term
                }, function( resp ) {

                    response(jQuery.map(resp, function(item) {

                        var split = item.post_title.slice(0,request.term.length);

                        if (split == request.term) {
                            return {
                                label: item.post_title,
                                value: item.ID
                            }    
                        }
                        
                    }), 'json');
                })        
        },
        minLength: 2,
        delay: 500,
        select: function(event, ui) {
                this.value = ui.item.label;

                var tr = jQuery(event.target).parents('tr');
                jQuery(tr).children().eq(0).children('button').html('OK').attr('name',ui.item.value);
                
            return false;
            }
    };

    jQuery('.contatos').on('click', 'button', function() {

        if(jQuery(this).html() == "+") {

            var newrow = jQuery('<tr><td><button>-</button></td><td class="insertname" colspan="4"><input type="text" /></td></tr>');
            jQuery('input', newrow).autocomplete(autocomp_nomes);
            jQuery(this).parents('tbody').append(newrow);  


        } else if(jQuery(this).html() == "-") {
            jQuery(this).parents('tr').detach();
        } else if(jQuery(this).html() == "OK") {
            console.log('ok');
            jQuery.post( 
                ajax_url.ajaxurl, { 
                    action : 'rolo_ajax_edit_contacts',
                    mode   : 'add',
                    data   : jQuery(this).attr('name'),
                    company: ajax_url.postid
                }, function( resp ) {

                    if (resp.status == 'ok') {
                        window.location.reload();
                    };
                })    
        }
    });

    // jQuery(".contatos input").autocomplete(ajax_url.ajaxurl);
        

    // Validation for mandatory fields
    jQuery('#add_contact, #edit_contact, #add_company, #edit_company').click(function (e) {
        jQuery('div.mandatory input').each(function () {
            if (jQuery(this).val() === '') {
                jQuery('#errorMsg').show();
                jQuery(this).addClass('errorInput');
                e.preventDefault();
            } else {
                jQuery(this).removeClass('errorInput');
            }
        });
    });
});