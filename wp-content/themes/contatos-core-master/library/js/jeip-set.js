jQuery(document).ready(function() {
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
    jQuery('#rolo_company_name,#rolo_company_address, #rolo_city, #rolo_company_state, #rolo_company_zip, #rolo_company_country, #rolo_company_email, #rolo_company_phone_Mobile, #rolo_company_phone_Home, #rolo_company_phone_Work, #rolo_company_phone_Other, #rolo_company_phone_Fax, #rolo_company_im_Yahoo, #rolo_company_im_MSN, #rolo_company_im_AOL, #rolo_company_im_GTalk, #rolo_company_im_Skype, #rolo_company_twitter, #rolo_company_website').eip(ajax_url, {
        action: 'rolo_edit_company',
        id_field: 'rolo_post_id'
    });
    */
    // Edit in place for notes
    jQuery('div.note').eip(ajax_url, {
        action: 'rolo_edit_note', form_type: "textarea"
    });

    // Edit in place - Contatos Polis
    jQuery('.resposta').not('#rolo_company_legal, .rolo_conflito, .rolo_relacao, #rolo_company_others, #rolo_contact_others, #rolo_company_contato_facil, #rolo_contact_contato_facil, #rolo_contact_telefone, #rolo_uf, #rolo_uf, #rolo_contact_company, #rolo_company_redes').eip(ajax_url.ajaxurl, {
        action: 'rolo_ajax_edit_company',
        data: ajax_url.postid,
        after_save: function(self) {
            if(jQuery(self).html() === "") {
                    jQuery(self).addClass('vazio');
                }
            }
    });

    jQuery('#rolo_contact_telefone').eip(ajax_url.ajaxurl, {
        action: 'rolo_ajax_edit_company',
        data: ajax_url.postid,
        before_save: function(self) {            
            var nu = self.new_value.replace('_','').split('-');

            if(nu[1].length > 4) {
                nu[0] = nu[0]+nu[1][0];
                nu[1] = nu[1].substr(1);
            }

            self.new_value = nu[0]+'-'+nu[1]
            return self;
            // var newstr = val.replace(re, "oranges");
        }
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

    jQuery('#rolo_uf, #rolo_uf').eip(ajax_url.ajaxurl, {
        action: 'rolo_ajax_edit_company',
        data: ajax_url.postid,
         form_type: "select",
                select_options: {
                    "AC" : "AC",
                    "AL" : "AL",
                    "AM" : "AM",
                    "AP" : "AP",
                    "BA" : "BA",
                    "CE" : "CE",
                    "DF" : "DF",
                    "ES" : "ES",
                    "GO" : "GO",
                    "MA" : "MA",
                    "MG" : "MG",
                    "MS" : "MS",
                    "MT" : "MT",
                    "PA" : "PA",
                    "PB" : "PB",
                    "PE" : "PE",
                    "PI" : "PI",
                    "PR" : "PR",
                    "RJ" : "RJ",
                    "RN" : "RN",
                    "RO" : "RO",
                    "RR" : "RR",
                    "RS" : "RS",
                    "SC" : "SC",
                    "SE" : "SE",
                    "SP" : "SP",
                    "TO" : "TO"
                }
    });    

    jQuery('#rolo_company_others').eip(ajax_url.ajaxurl, {
        data: ajax_url.postid,
        action: 'rolo_ajax_edit_company', 
        form_type: "textarea"
    });

    jQuery('#rolo_contact_others').eip(ajax_url.ajaxurl, {
        data: ajax_url.postid,
        action: 'rolo_ajax_edit_contacts',
        form_type: "textarea"
    });
/*
    jQuery('#rolo_company_redes > #tw').eip(ajax_url.ajaxurl, {
        data: ajax_url.postid,
        action: 'rolo_ajax_edit_redes'
    });
    
    jQuery('#rolo_company_redes > #fb').eip(ajax_url.ajaxurl, {
        data: ajax_url.postid,
        action: 'rolo_ajax_edit_redes'
    });    
*/
    jQuery('#rolo_company_others, #rolo_contact_others').on('click', function() {
        es = jQuery(this);
        window.setTimeout(function() {
            elem = es.next('span').find('textarea'); 
            val = elem.val();
            // lines = val.replace(/(<br>)/ig,"\n\n");
            breaks = val.replace(/(<\/p>)/ig,"\n");
            newval = breaks.replace(/(<([^>]+)>)/ig,"");
            
            elem.val(newval);
        }, 500);

    });

    jQuery('#rolo_company_contato_facil').eip(ajax_url.ajaxurl, {
        action: 'rolo_ajax_edit_company',
        data: ajax_url.postid,
         form_type: "select",
                select_options: {
                        "Telefone" : "Telefone",
                        "E-mail" : "E-mail",
                        "Redes Sociais" : "Redes Sociais"
                }
    });

    jQuery('#rolo_contact_contato_facil').eip(ajax_url.ajaxurl, {
        action: 'rolo_ajax_edit_company',
        data: ajax_url.postid,
         form_type: "select",
                select_options: {
                        "Telefone" : "Telefone",
                        "E-mail" : "E-mail",
                        "Redes Sociais" : "Redes Sociais"
                }
    }); 

    jQuery('#rolo_contact_company').eip(ajax_url.ajaxurl, {
        action: 'rolo_ajax_edit_contacts',
        data: ajax_url.postid,
        mode: 'company'
    });        

});