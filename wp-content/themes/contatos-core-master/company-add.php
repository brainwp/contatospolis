<?php
/**
 * Template Name: Company: Add
 *
 * Add Company page.
 *
 * @package RoloPress
 * @subpackage Template
 */
get_header(); ?>
	
	<?php rolopress_before_container(); // Before container hook ?>
	<div id="container">
	
		<?php rolopress_before_main(); // Before main hook ?>
		<div id="main">
			
				<?php rolo_pageheader();?>
				
				<?php if ( current_user_can('publish_posts') ) { // only display if user has proper permissions
						// rolo_add_company();
?>
<form id="company-add" class="uniForm inlineLabels" method="post" action="">
    <div id="errorMsg">
        <h3>Mandatory fields are not filled.</h3>
    </div>

    <fieldset class="inlineLabels">

        <div class="ctrlHolder name mandatory">
            <label for="rolo_company_name">
<em>*</em>Company Name			</label>

            <input type="text" class="textInput name" tabindex="1000" size="55" value="" name="rolo_company_name">
        </div>
        <div class="ctrlHolder year mandatory">
            <label for="rolo_company_year">
<em>*</em>Foundation Year			</label>

            <input type="text" class="textInput year" tabindex="1001" size="55" value="" name="rolo_company_year">
        </div>
        <div class="ctrlHolder legal_status mandatory">
            <label for="rolo_company_legal_status">
<em>*</em>Legal Status			</label>

            <input type="text" class="textInput legal_status" tabindex="1002" size="55" value="" name="rolo_company_legal_status">
        </div>
        <div class="ctrlHolder email">
            <label for="rolo_company_email">
Email			</label>

            <input type="text" class="textInput email" tabindex="1003" size="55" value="" name="rolo_company_email">
        </div>
        <div class="ctrlHolder multipleInput phone">

            <label for="phone[0]">
                Phone            </label>
                            <input type="text" class="textInput phone" tabindex="1004" size="55" value="" name="phone[0]">
                            <select tabindex="1005" name="phone_select[0]">
<option selected="selected" value="Work">Work</option>
<option value="Mobile">Mobile</option>
<option value="Fax">Fax</option>
<option value="Other">Other</option>
            </select>
                        <img style="display:none" alt="Delete" class="rolo_delete_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/delete.png">
            <img alt="Add another" class="rolo_add_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/add.png">
        </div>
        <div class="ctrlHolder multipleInput ctrlHidden phone" style="display: none;">

            <label for="phone[1]">
                Phone            </label>
                            <input type="text" class="textInput phone" tabindex="1006" size="55" value="" name="phone[1]">
                            <select tabindex="1007" name="phone_select[1]">
<option value="Work">Work</option>
<option selected="selected" value="Mobile">Mobile</option>
<option value="Fax">Fax</option>
<option value="Other">Other</option>
            </select>
                        <img alt="Delete" class="rolo_delete_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/delete.png">
            <img alt="Add another" class="rolo_add_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/add.png">
        </div>
        <div class="ctrlHolder multipleInput ctrlHidden phone" style="display: none;">

            <label for="phone[2]">
                Phone            </label>
                            <input type="text" class="textInput phone" tabindex="1008" size="55" value="" name="phone[2]">
                            <select tabindex="1009" name="phone_select[2]">
<option value="Work">Work</option>
<option value="Mobile">Mobile</option>
<option selected="selected" value="Fax">Fax</option>
<option value="Other">Other</option>
            </select>
                        <img alt="Delete" class="rolo_delete_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/delete.png">
            <img alt="Add another" class="rolo_add_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/add.png">
        </div>
        <div class="ctrlHolder multipleInput ctrlHidden phone" style="display: none;">

            <label for="phone[3]">
                Phone            </label>
                            <input type="text" class="textInput phone" tabindex="1010" size="55" value="" name="phone[3]">
                            <select tabindex="1011" name="phone_select[3]">
<option value="Work">Work</option>
<option value="Mobile">Mobile</option>
<option value="Fax">Fax</option>
<option selected="selected" value="Other">Other</option>
            </select>
                        <img alt="Delete" class="rolo_delete_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/delete.png">
            <img alt="Add another" class="rolo_add_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/add.png">
        </div>
        <div class="ctrlHolder website">
            <label for="rolo_company_website">
Website			</label>
<span class="prefix website">http://</span>
            <input type="text" class="textInput website input-prefix" tabindex="1012" size="55" value="" name="rolo_company_website">
        </div>
        <div class="ctrlHolder multipleInput im">

            <label for="im[0]">
                IM            </label>
                            <input type="text" class="textInput im" tabindex="1013" size="55" value="" name="im[0]">
                            <select tabindex="1014" name="im_select[0]">
<option selected="selected" value="Yahoo">Yahoo</option>
<option value="MSN">MSN</option>
<option value="AOL">AOL</option>
<option value="Gtalk">Gtalk</option>
<option value="Skype">Skype</option>
            </select>
                        <img style="display:none" alt="Delete" class="rolo_delete_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/delete.png">
            <img alt="Add another" class="rolo_add_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/add.png">
        </div>
        <div class="ctrlHolder multipleInput ctrlHidden im" style="display: none;">

            <label for="im[1]">
                IM            </label>
                            <input type="text" class="textInput im" tabindex="1015" size="55" value="" name="im[1]">
                            <select tabindex="1016" name="im_select[1]">
<option value="Yahoo">Yahoo</option>
<option selected="selected" value="MSN">MSN</option>
<option value="AOL">AOL</option>
<option value="Gtalk">Gtalk</option>
<option value="Skype">Skype</option>
            </select>
                        <img alt="Delete" class="rolo_delete_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/delete.png">
            <img alt="Add another" class="rolo_add_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/add.png">
        </div>
        <div class="ctrlHolder multipleInput ctrlHidden im" style="display: none;">

            <label for="im[2]">
                IM            </label>
                            <input type="text" class="textInput im" tabindex="1017" size="55" value="" name="im[2]">
                            <select tabindex="1018" name="im_select[2]">
<option value="Yahoo">Yahoo</option>
<option value="MSN">MSN</option>
<option selected="selected" value="AOL">AOL</option>
<option value="Gtalk">Gtalk</option>
<option value="Skype">Skype</option>
            </select>
                        <img alt="Delete" class="rolo_delete_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/delete.png">
            <img alt="Add another" class="rolo_add_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/add.png">
        </div>
        <div class="ctrlHolder multipleInput ctrlHidden im" style="display: none;">

            <label for="im[3]">
                IM            </label>
                            <input type="text" class="textInput im" tabindex="1019" size="55" value="" name="im[3]">
                            <select tabindex="1020" name="im_select[3]">
<option value="Yahoo">Yahoo</option>
<option value="MSN">MSN</option>
<option value="AOL">AOL</option>
<option selected="selected" value="Gtalk">Gtalk</option>
<option value="Skype">Skype</option>
            </select>
                        <img alt="Delete" class="rolo_delete_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/delete.png">
            <img alt="Add another" class="rolo_add_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/add.png">
        </div>
        <div class="ctrlHolder multipleInput ctrlHidden im" style="display: none;">

            <label for="im[4]">
                IM            </label>
                            <input type="text" class="textInput im" tabindex="1021" size="55" value="" name="im[4]">
                            <select tabindex="1022" name="im_select[4]">
<option value="Yahoo">Yahoo</option>
<option value="MSN">MSN</option>
<option value="AOL">AOL</option>
<option value="Gtalk">Gtalk</option>
<option selected="selected" value="Skype">Skype</option>
            </select>
                        <img alt="Delete" class="rolo_delete_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/delete.png">
            <img alt="Add another" class="rolo_add_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/add.png">
        </div>
        <div class="ctrlHolder twitter">
            <label for="rolo_company_twitter">
Twitter			</label>
<span class="prefix twitter">http://twitter.com/</span>
            <input type="text" class="textInput twitter input-prefix" tabindex="1023" size="55" value="" name="rolo_company_twitter">
        </div>
        <div class="ctrlHolder">
            <label for="rolo_company_address">
Address            </label>
            <textarea class="textArea address" tabindex="1024" name="rolo_company_address" cols="20" rows="3"></textarea>
        </div>

        <div class="ctrlHolder">
            <input type="text" class="textInput city" tabindex="1025" size="30" value="City" name="rolo_company_city" autocomplete="off">
            <input type="text" class="textInput state" tabindex="1026" size="15" value="State" name="rolo_company_state" autocomplete="off">
            <input type="text" class="textInput zip" tabindex="1027" size="10" value="Zip" name="rolo_company_zip" autocomplete="off">
        </div>

        <div class="ctrlHolder">
            <label for="rolo_company_country"></label>
            <input type="text" class="textInput country" tabindex="1028" size="55" value="Country" name="rolo_company_country" autocomplete="off">
        </div>
        <div class="ctrlHolder source">
            <label for="rolo_company_source">
Information Source			</label>

            <input type="text" class="textInput source" tabindex="1029" size="55" value="" name="rolo_company_source">
        </div>
    <div class="ctrlHolder">
        <label for="rolo_company_info">
Background Info        </label>
        <textarea class="textArea info" tabindex="1030" name="rolo_company_info" cols="20" rows="3"></textarea>
    </div>
        <div class="ctrlHolder tags">
            <label for="rolo_company_post_tag">
Tags			</label>

            <input type="text" class="textInput tags" tabindex="1031" size="55" value="" name="rolo_company_post_tag">
        </div>
        <div class="ctrlHolder multipleInput popular_movements">

            <label for="popular_movements[0]">
                Popular Movements            </label>
                            <input type="checkbox" class="textInput popular_movements" tabindex="1032" size="55" value="" name="popular_movements[0]">
                            <select tabindex="1033" name="popular_movements_select[0]">
<option selected="selected" value="Popular Movements">Popular Movements</option>
<option value="Indigenous People">Indigenous People</option>
<option value="Fishermen">Fishermen</option>
<option value="Quilombolas">Quilombolas</option>
<option value="Cooperative of paper collectors">Cooperative of paper collectors</option>
<option value="Others">Others</option>
            </select>
                        <img style="display:none" alt="Delete" class="rolo_delete_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/delete.png">
            <img alt="Add another" class="rolo_add_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/add.png">
        </div>
        <div class="ctrlHolder multipleInput ctrlHidden popular_movements" style="display: none;">

            <label for="popular_movements[1]">
                Popular Movements            </label>
                            <input type="checkbox" class="textInput popular_movements" tabindex="1034" size="55" value="" name="popular_movements[1]">
                            <select tabindex="1035" name="popular_movements_select[1]">
<option value="Popular Movements">Popular Movements</option>
<option selected="selected" value="Indigenous People">Indigenous People</option>
<option value="Fishermen">Fishermen</option>
<option value="Quilombolas">Quilombolas</option>
<option value="Cooperative of paper collectors">Cooperative of paper collectors</option>
<option value="Others">Others</option>
            </select>
                        <img alt="Delete" class="rolo_delete_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/delete.png">
            <img alt="Add another" class="rolo_add_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/add.png">
        </div>
        <div class="ctrlHolder multipleInput ctrlHidden popular_movements" style="display: none;">

            <label for="popular_movements[2]">
                Popular Movements            </label>
                            <input type="checkbox" class="textInput popular_movements" tabindex="1036" size="55" value="" name="popular_movements[2]">
                            <select tabindex="1037" name="popular_movements_select[2]">
<option value="Popular Movements">Popular Movements</option>
<option value="Indigenous People">Indigenous People</option>
<option selected="selected" value="Fishermen">Fishermen</option>
<option value="Quilombolas">Quilombolas</option>
<option value="Cooperative of paper collectors">Cooperative of paper collectors</option>
<option value="Others">Others</option>
            </select>
                        <img alt="Delete" class="rolo_delete_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/delete.png">
            <img alt="Add another" class="rolo_add_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/add.png">
        </div>
        <div class="ctrlHolder multipleInput ctrlHidden popular_movements" style="display: none;">

            <label for="popular_movements[3]">
                Popular Movements            </label>
                            <input type="checkbox" class="textInput popular_movements" tabindex="1038" size="55" value="" name="popular_movements[3]">
                            <select tabindex="1039" name="popular_movements_select[3]">
<option value="Popular Movements">Popular Movements</option>
<option value="Indigenous People">Indigenous People</option>
<option value="Fishermen">Fishermen</option>
<option selected="selected" value="Quilombolas">Quilombolas</option>
<option value="Cooperative of paper collectors">Cooperative of paper collectors</option>
<option value="Others">Others</option>
            </select>
                        <img alt="Delete" class="rolo_delete_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/delete.png">
            <img alt="Add another" class="rolo_add_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/add.png">
        </div>
        <div class="ctrlHolder multipleInput ctrlHidden popular_movements" style="display: none;">

            <label for="popular_movements[4]">
                Popular Movements            </label>
                            <input type="checkbox" class="textInput popular_movements" tabindex="1040" size="55" value="" name="popular_movements[4]">
                            <select tabindex="1041" name="popular_movements_select[4]">
<option value="Popular Movements">Popular Movements</option>
<option value="Indigenous People">Indigenous People</option>
<option value="Fishermen">Fishermen</option>
<option value="Quilombolas">Quilombolas</option>
<option selected="selected" value="Cooperative of paper collectors">Cooperative of paper collectors</option>
<option value="Others">Others</option>
            </select>
                        <img alt="Delete" class="rolo_delete_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/delete.png">
            <img alt="Add another" class="rolo_add_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/add.png">
        </div>
        <div class="ctrlHolder multipleInput ctrlHidden popular_movements" style="display: none;">

            <label for="popular_movements[5]">
                Popular Movements            </label>
                            <input type="checkbox" class="textInput popular_movements" tabindex="1042" size="55" value="" name="popular_movements[5]">
                            <select tabindex="1043" name="popular_movements_select[5]">
<option value="Popular Movements">Popular Movements</option>
<option value="Indigenous People">Indigenous People</option>
<option value="Fishermen">Fishermen</option>
<option value="Quilombolas">Quilombolas</option>
<option value="Cooperative of paper collectors">Cooperative of paper collectors</option>
<option selected="selected" value="Others">Others</option>
            </select>
                        <img alt="Delete" class="rolo_delete_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/delete.png">
            <img alt="Add another" class="rolo_add_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/add.png">
        </div>
        <div class="ctrlHolder multipleInput workers_represented">

            <label for="workers_represented[0]">
                Workers Represented            </label>
                            <input type="checkbox" class="textInput workers_represented" tabindex="1044" size="55" value="" name="workers_represented[0]">
                            <select tabindex="1045" name="workers_represented_select[0]">
<option selected="selected" value="Others">Others</option>
            </select>
                        <img style="display:none" alt="Delete" class="rolo_delete_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/delete.png">
            <img alt="Add another" class="rolo_add_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/add.png">
        </div>
        <div class="ctrlHolder multipleInput public_sector">

            <label for="public_sector[0]">
                Public Sector            </label>
                            <input type="checkbox" class="textInput public_sector" tabindex="1046" size="55" value="" name="public_sector[0]">
                            <select tabindex="1047" name="public_sector_select[0]">
<option selected="selected" value="Legislative - City">Legislative - City</option>
<option value="Legislative - Federal">Legislative - Federal</option>
<option value="Executive - City">Executive - City</option>
<option value="Executive - State">Executive - State</option>
<option value="Executive - Federal">Executive - Federal</option>
<option value="MP State">MP State</option>
<option value="MP Federal">MP Federal</option>
<option value="Defensoria">Defensoria</option>
<option value="Autarquia">Autarquia</option>
<option value="Public Foundations">Public Foundations</option>
<option value="Others">Others</option>
            </select>
                        <img style="display:none" alt="Delete" class="rolo_delete_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/delete.png">
            <img alt="Add another" class="rolo_add_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/add.png">
        </div>
        <div class="ctrlHolder multipleInput ctrlHidden public_sector" style="display: none;">

            <label for="public_sector[1]">
                Public Sector            </label>
                            <input type="checkbox" class="textInput public_sector" tabindex="1048" size="55" value="" name="public_sector[1]">
                            <select tabindex="1049" name="public_sector_select[1]">
<option value="Legislative - City">Legislative - City</option>
<option selected="selected" value="Legislative - Federal">Legislative - Federal</option>
<option value="Executive - City">Executive - City</option>
<option value="Executive - State">Executive - State</option>
<option value="Executive - Federal">Executive - Federal</option>
<option value="MP State">MP State</option>
<option value="MP Federal">MP Federal</option>
<option value="Defensoria">Defensoria</option>
<option value="Autarquia">Autarquia</option>
<option value="Public Foundations">Public Foundations</option>
<option value="Others">Others</option>
            </select>
                        <img alt="Delete" class="rolo_delete_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/delete.png">
            <img alt="Add another" class="rolo_add_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/add.png">
        </div>
        <div class="ctrlHolder multipleInput ctrlHidden public_sector" style="display: none;">

            <label for="public_sector[2]">
                Public Sector            </label>
                            <input type="checkbox" class="textInput public_sector" tabindex="1050" size="55" value="" name="public_sector[2]">
                            <select tabindex="1051" name="public_sector_select[2]">
<option value="Legislative - City">Legislative - City</option>
<option value="Legislative - Federal">Legislative - Federal</option>
<option selected="selected" value="Executive - City">Executive - City</option>
<option value="Executive - State">Executive - State</option>
<option value="Executive - Federal">Executive - Federal</option>
<option value="MP State">MP State</option>
<option value="MP Federal">MP Federal</option>
<option value="Defensoria">Defensoria</option>
<option value="Autarquia">Autarquia</option>
<option value="Public Foundations">Public Foundations</option>
<option value="Others">Others</option>
            </select>
                        <img alt="Delete" class="rolo_delete_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/delete.png">
            <img alt="Add another" class="rolo_add_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/add.png">
        </div>
        <div class="ctrlHolder multipleInput ctrlHidden public_sector" style="display: none;">

            <label for="public_sector[3]">
                Public Sector            </label>
                            <input type="checkbox" class="textInput public_sector" tabindex="1052" size="55" value="" name="public_sector[3]">
                            <select tabindex="1053" name="public_sector_select[3]">
<option value="Legislative - City">Legislative - City</option>
<option value="Legislative - Federal">Legislative - Federal</option>
<option value="Executive - City">Executive - City</option>
<option selected="selected" value="Executive - State">Executive - State</option>
<option value="Executive - Federal">Executive - Federal</option>
<option value="MP State">MP State</option>
<option value="MP Federal">MP Federal</option>
<option value="Defensoria">Defensoria</option>
<option value="Autarquia">Autarquia</option>
<option value="Public Foundations">Public Foundations</option>
<option value="Others">Others</option>
            </select>
                        <img alt="Delete" class="rolo_delete_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/delete.png">
            <img alt="Add another" class="rolo_add_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/add.png">
        </div>
        <div class="ctrlHolder multipleInput ctrlHidden public_sector" style="display: none;">

            <label for="public_sector[4]">
                Public Sector            </label>
                            <input type="checkbox" class="textInput public_sector" tabindex="1054" size="55" value="" name="public_sector[4]">
                            <select tabindex="1055" name="public_sector_select[4]">
<option value="Legislative - City">Legislative - City</option>
<option value="Legislative - Federal">Legislative - Federal</option>
<option value="Executive - City">Executive - City</option>
<option value="Executive - State">Executive - State</option>
<option selected="selected" value="Executive - Federal">Executive - Federal</option>
<option value="MP State">MP State</option>
<option value="MP Federal">MP Federal</option>
<option value="Defensoria">Defensoria</option>
<option value="Autarquia">Autarquia</option>
<option value="Public Foundations">Public Foundations</option>
<option value="Others">Others</option>
            </select>
                        <img alt="Delete" class="rolo_delete_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/delete.png">
            <img alt="Add another" class="rolo_add_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/add.png">
        </div>
        <div class="ctrlHolder multipleInput ctrlHidden public_sector" style="display: none;">

            <label for="public_sector[5]">
                Public Sector            </label>
                            <input type="checkbox" class="textInput public_sector" tabindex="1056" size="55" value="" name="public_sector[5]">
                            <select tabindex="1057" name="public_sector_select[5]">
<option value="Legislative - City">Legislative - City</option>
<option value="Legislative - Federal">Legislative - Federal</option>
<option value="Executive - City">Executive - City</option>
<option value="Executive - State">Executive - State</option>
<option value="Executive - Federal">Executive - Federal</option>
<option selected="selected" value="MP State">MP State</option>
<option value="MP Federal">MP Federal</option>
<option value="Defensoria">Defensoria</option>
<option value="Autarquia">Autarquia</option>
<option value="Public Foundations">Public Foundations</option>
<option value="Others">Others</option>
            </select>
                        <img alt="Delete" class="rolo_delete_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/delete.png">
            <img alt="Add another" class="rolo_add_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/add.png">
        </div>
        <div class="ctrlHolder multipleInput ctrlHidden public_sector" style="display: none;">

            <label for="public_sector[6]">
                Public Sector            </label>
                            <input type="checkbox" class="textInput public_sector" tabindex="1058" size="55" value="" name="public_sector[6]">
                            <select tabindex="1059" name="public_sector_select[6]">
<option value="Legislative - City">Legislative - City</option>
<option value="Legislative - Federal">Legislative - Federal</option>
<option value="Executive - City">Executive - City</option>
<option value="Executive - State">Executive - State</option>
<option value="Executive - Federal">Executive - Federal</option>
<option value="MP State">MP State</option>
<option selected="selected" value="MP Federal">MP Federal</option>
<option value="Defensoria">Defensoria</option>
<option value="Autarquia">Autarquia</option>
<option value="Public Foundations">Public Foundations</option>
<option value="Others">Others</option>
            </select>
                        <img alt="Delete" class="rolo_delete_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/delete.png">
            <img alt="Add another" class="rolo_add_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/add.png">
        </div>
        <div class="ctrlHolder multipleInput ctrlHidden public_sector" style="display: none;">

            <label for="public_sector[7]">
                Public Sector            </label>
                            <input type="checkbox" class="textInput public_sector" tabindex="1060" size="55" value="" name="public_sector[7]">
                            <select tabindex="1061" name="public_sector_select[7]">
<option value="Legislative - City">Legislative - City</option>
<option value="Legislative - Federal">Legislative - Federal</option>
<option value="Executive - City">Executive - City</option>
<option value="Executive - State">Executive - State</option>
<option value="Executive - Federal">Executive - Federal</option>
<option value="MP State">MP State</option>
<option value="MP Federal">MP Federal</option>
<option selected="selected" value="Defensoria">Defensoria</option>
<option value="Autarquia">Autarquia</option>
<option value="Public Foundations">Public Foundations</option>
<option value="Others">Others</option>
            </select>
                        <img alt="Delete" class="rolo_delete_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/delete.png">
            <img alt="Add another" class="rolo_add_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/add.png">
        </div>
        <div class="ctrlHolder multipleInput ctrlHidden public_sector" style="display: none;">

            <label for="public_sector[8]">
                Public Sector            </label>
                            <input type="checkbox" class="textInput public_sector" tabindex="1062" size="55" value="" name="public_sector[8]">
                            <select tabindex="1063" name="public_sector_select[8]">
<option value="Legislative - City">Legislative - City</option>
<option value="Legislative - Federal">Legislative - Federal</option>
<option value="Executive - City">Executive - City</option>
<option value="Executive - State">Executive - State</option>
<option value="Executive - Federal">Executive - Federal</option>
<option value="MP State">MP State</option>
<option value="MP Federal">MP Federal</option>
<option value="Defensoria">Defensoria</option>
<option selected="selected" value="Autarquia">Autarquia</option>
<option value="Public Foundations">Public Foundations</option>
<option value="Others">Others</option>
            </select>
                        <img alt="Delete" class="rolo_delete_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/delete.png">
            <img alt="Add another" class="rolo_add_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/add.png">
        </div>
        <div class="ctrlHolder multipleInput ctrlHidden public_sector" style="display: none;">

            <label for="public_sector[9]">
                Public Sector            </label>
                            <input type="checkbox" class="textInput public_sector" tabindex="1064" size="55" value="" name="public_sector[9]">
                            <select tabindex="1065" name="public_sector_select[9]">
<option value="Legislative - City">Legislative - City</option>
<option value="Legislative - Federal">Legislative - Federal</option>
<option value="Executive - City">Executive - City</option>
<option value="Executive - State">Executive - State</option>
<option value="Executive - Federal">Executive - Federal</option>
<option value="MP State">MP State</option>
<option value="MP Federal">MP Federal</option>
<option value="Defensoria">Defensoria</option>
<option value="Autarquia">Autarquia</option>
<option selected="selected" value="Public Foundations">Public Foundations</option>
<option value="Others">Others</option>
            </select>
                        <img alt="Delete" class="rolo_delete_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/delete.png">
            <img alt="Add another" class="rolo_add_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/add.png">
        </div>
        <div class="ctrlHolder multipleInput ctrlHidden public_sector" style="display: none;">

            <label for="public_sector[10]">
                Public Sector            </label>
                            <input type="checkbox" class="textInput public_sector" tabindex="1066" size="55" value="" name="public_sector[10]">
                            <select tabindex="1067" name="public_sector_select[10]">
<option value="Legislative - City">Legislative - City</option>
<option value="Legislative - Federal">Legislative - Federal</option>
<option value="Executive - City">Executive - City</option>
<option value="Executive - State">Executive - State</option>
<option value="Executive - Federal">Executive - Federal</option>
<option value="MP State">MP State</option>
<option value="MP Federal">MP Federal</option>
<option value="Defensoria">Defensoria</option>
<option value="Autarquia">Autarquia</option>
<option value="Public Foundations">Public Foundations</option>
<option selected="selected" value="Others">Others</option>
            </select>
                        <img alt="Delete" class="rolo_delete_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/delete.png">
            <img alt="Add another" class="rolo_add_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/add.png">
        </div>
        <div class="ctrlHolder multipleInput entities">

            <label for="entities[0]">
                Professional, Academic and Research Entities            </label>
                            <input type="checkbox" class="textInput entities" tabindex="1068" size="55" value="" name="entities[0]">
                            <select tabindex="1069" name="entities_select[0]">
<option selected="selected" value="Others">Others</option>
            </select>
                        <img style="display:none" alt="Delete" class="rolo_delete_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/delete.png">
            <img alt="Add another" class="rolo_add_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/add.png">
        </div>
        <div class="ctrlHolder multipleInput ngos">

            <label for="ngos[0]">
                Non-governmental organizations            </label>
                            <input type="checkbox" class="textInput ngos" tabindex="1070" size="55" value="" name="ngos[0]">
                            <select tabindex="1071" name="ngos_select[0]">
<option selected="selected" value="Urban Development">Urban Development</option>
<option value="Environment">Environment</option>
<option value="Education">Education</option>
<option value="Others">Others</option>
            </select>
                        <img style="display:none" alt="Delete" class="rolo_delete_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/delete.png">
            <img alt="Add another" class="rolo_add_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/add.png">
        </div>
        <div class="ctrlHolder multipleInput ctrlHidden ngos" style="display: none;">

            <label for="ngos[1]">
                Non-governmental organizations            </label>
                            <input type="checkbox" class="textInput ngos" tabindex="1072" size="55" value="" name="ngos[1]">
                            <select tabindex="1073" name="ngos_select[1]">
<option value="Urban Development">Urban Development</option>
<option selected="selected" value="Environment">Environment</option>
<option value="Education">Education</option>
<option value="Others">Others</option>
            </select>
                        <img alt="Delete" class="rolo_delete_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/delete.png">
            <img alt="Add another" class="rolo_add_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/add.png">
        </div>
        <div class="ctrlHolder multipleInput ctrlHidden ngos" style="display: none;">

            <label for="ngos[2]">
                Non-governmental organizations            </label>
                            <input type="checkbox" class="textInput ngos" tabindex="1074" size="55" value="" name="ngos[2]">
                            <select tabindex="1075" name="ngos_select[2]">
<option value="Urban Development">Urban Development</option>
<option value="Environment">Environment</option>
<option selected="selected" value="Education">Education</option>
<option value="Others">Others</option>
            </select>
                        <img alt="Delete" class="rolo_delete_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/delete.png">
            <img alt="Add another" class="rolo_add_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/add.png">
        </div>
        <div class="ctrlHolder multipleInput ctrlHidden ngos" style="display: none;">

            <label for="ngos[3]">
                Non-governmental organizations            </label>
                            <input type="checkbox" class="textInput ngos" tabindex="1076" size="55" value="" name="ngos[3]">
                            <select tabindex="1077" name="ngos_select[3]">
<option value="Urban Development">Urban Development</option>
<option value="Environment">Environment</option>
<option value="Education">Education</option>
<option selected="selected" value="Others">Others</option>
            </select>
                        <img alt="Delete" class="rolo_delete_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/delete.png">
            <img alt="Add another" class="rolo_add_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/add.png">
        </div>
        <div class="ctrlHolder multipleInput businessmen">

            <label for="businessmen[0]">
                Businessmen            </label>
                            <input type="checkbox" class="textInput businessmen" tabindex="1078" size="55" value="" name="businessmen[0]">
                            <select tabindex="1079" name="businessmen_select[0]">
<option selected="selected" value="Private Company">Private Company</option>
<option value="Cooperative and Fair Trade">Cooperative and Fair Trade</option>
<option value="Public">Public</option>
<option value="Others">Others</option>
            </select>
                        <img style="display:none" alt="Delete" class="rolo_delete_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/delete.png">
            <img alt="Add another" class="rolo_add_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/add.png">
        </div>
        <div class="ctrlHolder multipleInput ctrlHidden businessmen" style="display: none;">

            <label for="businessmen[1]">
                Businessmen            </label>
                            <input type="checkbox" class="textInput businessmen" tabindex="1080" size="55" value="" name="businessmen[1]">
                            <select tabindex="1081" name="businessmen_select[1]">
<option value="Private Company">Private Company</option>
<option selected="selected" value="Cooperative and Fair Trade">Cooperative and Fair Trade</option>
<option value="Public">Public</option>
<option value="Others">Others</option>
            </select>
                        <img alt="Delete" class="rolo_delete_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/delete.png">
            <img alt="Add another" class="rolo_add_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/add.png">
        </div>
        <div class="ctrlHolder multipleInput ctrlHidden businessmen" style="display: none;">

            <label for="businessmen[2]">
                Businessmen            </label>
                            <input type="checkbox" class="textInput businessmen" tabindex="1082" size="55" value="" name="businessmen[2]">
                            <select tabindex="1083" name="businessmen_select[2]">
<option value="Private Company">Private Company</option>
<option value="Cooperative and Fair Trade">Cooperative and Fair Trade</option>
<option selected="selected" value="Public">Public</option>
<option value="Others">Others</option>
            </select>
                        <img alt="Delete" class="rolo_delete_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/delete.png">
            <img alt="Add another" class="rolo_add_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/add.png">
        </div>
        <div class="ctrlHolder multipleInput ctrlHidden businessmen" style="display: none;">

            <label for="businessmen[3]">
                Businessmen            </label>
                            <input type="checkbox" class="textInput businessmen" tabindex="1084" size="55" value="" name="businessmen[3]">
                            <select tabindex="1085" name="businessmen_select[3]">
<option value="Private Company">Private Company</option>
<option value="Cooperative and Fair Trade">Cooperative and Fair Trade</option>
<option value="Public">Public</option>
<option selected="selected" value="Others">Others</option>
            </select>
                        <img alt="Delete" class="rolo_delete_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/delete.png">
            <img alt="Add another" class="rolo_add_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/add.png">
        </div>
        <div class="ctrlHolder others">
            <label for="rolo_company_others">
Others			</label>

            <input type="text" class="textInput others" tabindex="1086" size="55" value="" name="rolo_company_others">
        </div>
        <div class="ctrlHolder multipleInput participation">

            <label for="participation[0]">
                Participation spaces            </label>
                            <select tabindex="1087" name="participation_select[0]">
<option selected="selected" value="Forum">Forum</option>
<option value="Comitee">Comitee</option>
<option value="Council">Council</option>
<option value="Network">Network</option>
<option value="Others">Others</option>
            </select>
                            Nome: <input type="text" style="float: none;" class="textInput participation" tabindex="1088" size="55" value="" name="participation[0]">
                        <img style="display:none" alt="Delete" class="rolo_delete_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/delete.png">
            <img alt="Add another" class="rolo_add_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/add.png">
        </div>
        <div class="ctrlHolder multipleInput ctrlHidden participation" style="display: none;">

            <label for="participation[1]">
                Participation spaces            </label>
                            <select tabindex="1089" name="participation_select[1]">
<option value="Forum">Forum</option>
<option selected="selected" value="Comitee">Comitee</option>
<option value="Council">Council</option>
<option value="Network">Network</option>
<option value="Others">Others</option>
            </select>
                            Nome: <input type="text" style="float: none;" class="textInput participation" tabindex="1090" size="55" value="" name="participation[1]">
                        <img alt="Delete" class="rolo_delete_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/delete.png">
            <img alt="Add another" class="rolo_add_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/add.png">
        </div>
        <div class="ctrlHolder multipleInput ctrlHidden participation" style="display: none;">

            <label for="participation[2]">
                Participation spaces            </label>
                            <select tabindex="1091" name="participation_select[2]">
<option value="Forum">Forum</option>
<option value="Comitee">Comitee</option>
<option selected="selected" value="Council">Council</option>
<option value="Network">Network</option>
<option value="Others">Others</option>
            </select>
                            Nome: <input type="text" style="float: none;" class="textInput participation" tabindex="1092" size="55" value="" name="participation[2]">
                        <img alt="Delete" class="rolo_delete_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/delete.png">
            <img alt="Add another" class="rolo_add_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/add.png">
        </div>
        <div class="ctrlHolder multipleInput ctrlHidden participation" style="display: none;">

            <label for="participation[3]">
                Participation spaces            </label>
                            <select tabindex="1093" name="participation_select[3]">
<option value="Forum">Forum</option>
<option value="Comitee">Comitee</option>
<option value="Council">Council</option>
<option selected="selected" value="Network">Network</option>
<option value="Others">Others</option>
            </select>
                            Nome: <input type="text" style="float: none;" class="textInput participation" tabindex="1094" size="55" value="" name="participation[3]">
                        <img alt="Delete" class="rolo_delete_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/delete.png">
            <img alt="Add another" class="rolo_add_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/add.png">
        </div>
        <div class="ctrlHolder multipleInput ctrlHidden participation" style="display: none;">

            <label for="participation[4]">
                Participation spaces            </label>
                            <select tabindex="1095" name="participation_select[4]">
<option value="Forum">Forum</option>
<option value="Comitee">Comitee</option>
<option value="Council">Council</option>
<option value="Network">Network</option>
<option selected="selected" value="Others">Others</option>
            </select>
                            Nome: <input type="text" style="float: none;" class="textInput participation" tabindex="1096" size="55" value="" name="participation[4]">
                        <img alt="Delete" class="rolo_delete_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/delete.png">
            <img alt="Add another" class="rolo_add_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/add.png">
        </div>
        <div class="ctrlHolder multipleInput impacts">

            <label for="impacts[0]">
                Environmental impacts            </label>
           <select tabindex="1099" name="impacts_select[0]">
<option value="Conflict">No</option>
<option selected="selected" value="Comitee">Yes</option>
</select>
                <input type="checkbox" class="textInput ngos" tabindex="1070" size="55" value="" name="impacts[0]">
				Qual? <input type="text" style="float: none;" class="textInput impacts" tabindex="1098" size="55" value="" name="impacts[0]">
				Data de início: <input type="text" style="float: none;" class="textInput impacts" tabindex="1098" size="55" value="" name="impacts[0]">
				Foi levado a alguma instância? <input type="text" style="float: none;" class="textInput impacts" tabindex="1098" size="55" value="" name="impacts[0]">
				Solucionado? <input type="text" style="float: none;" class="textInput impacts" tabindex="1098" size="55" value="" name="impacts[0]">
				Mais informações: <textarea class="textArea address" tabindex="1024" name="rolo_company_address" cols="20" rows="3"></textarea>
                        <img style="display:none" alt="Delete" class="rolo_delete_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/delete.png">
            <img alt="Add another" class="rolo_add_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/add.png">
        </div>
        <div class="ctrlHolder multipleInput ctrlHidden impacts" style="display: none;">

            <label for="impacts[1]">
                Environmental impacts            </label>
                            <select tabindex="1099" name="impacts_select[1]">
<option value="Conflict">Conflict</option>
<option selected="selected" value="Comitee">Comitee</option>
<option value="Council">Council</option>
<option value="Network">Network</option>
<option value="Others">Others</option>
            </select>
                            Nome: <input type="text" style="float: none;" class="textInput impacts" tabindex="1100" size="55" value="" name="impacts[1]">
                        <img alt="Delete" class="rolo_delete_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/delete.png">
            <img alt="Add another" class="rolo_add_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/add.png">
        </div>
        <div class="ctrlHolder multipleInput ctrlHidden impacts" style="display: none;">

            <label for="impacts[2]">
                Environmental impacts            </label>
                            <select tabindex="1101" name="impacts_select[2]">
<option value="Conflict">Conflict</option>
<option value="Comitee">Comitee</option>
<option selected="selected" value="Council">Council</option>
<option value="Network">Network</option>
<option value="Others">Others</option>
            </select>
                            Nome: <input type="text" style="float: none;" class="textInput impacts" tabindex="1102" size="55" value="" name="impacts[2]">
                        <img alt="Delete" class="rolo_delete_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/delete.png">
            <img alt="Add another" class="rolo_add_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/add.png">
        </div>
        <div class="ctrlHolder multipleInput ctrlHidden impacts" style="display: none;">

            <label for="impacts[3]">
                Environmental impacts            </label>
                            <select tabindex="1103" name="impacts_select[3]">
<option value="Conflict">Conflict</option>
<option value="Comitee">Comitee</option>
<option value="Council">Council</option>
<option selected="selected" value="Network">Network</option>
<option value="Others">Others</option>
            </select>
                            Nome: <input type="text" style="float: none;" class="textInput impacts" tabindex="1104" size="55" value="" name="impacts[3]">
                        <img alt="Delete" class="rolo_delete_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/delete.png">
            <img alt="Add another" class="rolo_add_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/add.png">
        </div>
        <div class="ctrlHolder multipleInput ctrlHidden impacts" style="display: none;">

            <label for="impacts[4]">
                Environmental impacts            </label>
                            <select tabindex="1105" name="impacts_select[4]">
<option value="Conflict">Conflict</option>
<option value="Comitee">Comitee</option>
<option value="Council">Council</option>
<option value="Network">Network</option>
<option selected="selected" value="Others">Others</option>
            </select>
                            Nome: <input type="text" style="float: none;" class="textInput impacts" tabindex="1106" size="55" value="" name="impacts[4]">
                        <img alt="Delete" class="rolo_delete_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/delete.png">
            <img alt="Add another" class="rolo_add_ctrl" src="http://co-di-go.biz/contatospolis/wp-content/themes/contatos-core-master/library/images/forms/add.png">
        </div>
    </fieldset>
   <div class="buttonHolder">
      <input type="hidden" value="add_company" name="rp_add_company">
      <button tabindex="1107" class="submitButton" id="add_company" name="submit" type="submit">Add company</button>
   </div>
</form>
<?php
					} else {
						rolo_permission_message();
					}
				?>	
			
		</div><!-- #main -->
		<?php rolopress_after_main(); // After main hook ?>
		
	</div><!-- #container -->
	<?php rolopress_after_container(); // After container hook ?>
		
<?php get_sidebar(); ?>	
<?php get_footer(); ?>