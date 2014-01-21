<?php
/**
 * Template Name: Contact: Add
 *
 * Add Contact page.
 *
 * @package RoloPress
 * @subpackage Template
 */

if ( current_user_can('publish_posts') ) { // only display if user has proper permissions
	rolo_add_contact();
} else {
	rolo_permission_message();
}
					
get_header(); ?>
	
	<?php rolopress_before_container(); // Before container hook ?>
	<div id="container">
	
		<?php rolopress_before_main(); // Before main hook ?>
		<div id="main">
			
				<?php rolo_pageheader();?>
			
				<form id="contact-add" class="uniForm inlineLabels" method="post" action="">

    <div id="errorMsg">
        <h3>Mandatory fields are not filled.</h3>
    </div>
    
    <div class="instrucoes">
    	<?php _e('Adicione o Nome Completo e o E-mail do indivíduo que pretende cadastrar. Após clicar em Adicionar Contato você será redirecionado para a página onde poderá completar o preenchimento de todos os campos desse contato.', 'rolopress'); ?>
    </div><!-- .instrucoes -->

    <fieldset class="inlineLabels">

        <div class="cada-linha add">
            <div class="add">
                <span class="title title-bloco-1 grey"><?php _e('* Nome Completo', 'rolopress'); ?></span>
				<span class="resposta-add"><input type="text" class="first_name required" tabindex="1000" size="" value="" name="rolo_contact_first_name" style="cursor: auto;"></span>
            </div>
        </div><!-- .cada-linha -->

        <div class="cada-linha add">
            <div class="add">
                <span class="title title-bloco-1 grey"><?php _e('* E-mail', 'rolopress'); ?></span>
				<span class="resposta-add"><input type="text" class="email required validateEmail" tabindex="1001" size="" value="" name="rolo_contact_email"></span>
            </div>
        </div><!-- .cada-linha -->

        <div class="cada-linha ano">
			<span class="title title-bloco-1 grey"><?php _e('Cidade de Moradia', 'rolopress'); ?></span>
            <span id="rolo_city" class="resposta <?php echo ($contact_city ? '' : 'vazio'); ?>"><?php echo $contact_city; ?></span>
        </div><!-- .cada-linha -->

        <div class="cada-linha uf">
			<span class="title title-bloco-1 grey"><?php _e('Estado', 'rolopress'); ?></span>
            <select class="jeip-editfield" id="edit-rolo_uf"><option value="AC" id="edit-option-rolo_uf-AC">AC</option><option value="AL" id="edit-option-rolo_uf-AL">AL</option><option value="AM" id="edit-option-rolo_uf-AM">AM</option><option value="AP" id="edit-option-rolo_uf-AP">AP</option><option value="BA" id="edit-option-rolo_uf-BA">BA</option><option value="CE" id="edit-option-rolo_uf-CE">CE</option><option value="DF" id="edit-option-rolo_uf-DF">DF</option><option value="ES" id="edit-option-rolo_uf-ES">ES</option><option value="GO" id="edit-option-rolo_uf-GO">GO</option><option value="MA" id="edit-option-rolo_uf-MA">MA</option><option value="MG" id="edit-option-rolo_uf-MG">MG</option><option value="MS" id="edit-option-rolo_uf-MS">MS</option><option value="MT" id="edit-option-rolo_uf-MT">MT</option><option value="PA" id="edit-option-rolo_uf-PA">PA</option><option value="PB" id="edit-option-rolo_uf-PB">PB</option><option value="PE" id="edit-option-rolo_uf-PE">PE</option><option value="PI" id="edit-option-rolo_uf-PI">PI</option><option value="PR" id="edit-option-rolo_uf-PR">PR</option><option value="RJ" id="edit-option-rolo_uf-RJ">RJ</option><option value="RN" id="edit-option-rolo_uf-RN">RN</option><option value="RO" id="edit-option-rolo_uf-RO">RO</option><option value="RR" id="edit-option-rolo_uf-RR">RR</option><option value="RS" id="edit-option-rolo_uf-RS">RS</option><option value="SC" id="edit-option-rolo_uf-SC">SC</option><option value="SE" id="edit-option-rolo_uf-SE">SE</option><option value="SP" id="edit-option-rolo_uf-SP">SP</option><option value="TO" id="edit-option-rolo_uf-TO">TO</option></select>
        </div><!-- .cada-linha -->     

    </fieldset>
      
			<input type="hidden" value="add_contact" name="rp_add_contact">
			<button tabindex="1038" class="botao-add-contact submitButton" id="add_contact" name="submit" type="submit">Adicionar Contato</button>

</form>


		</div><!-- #main -->
		<?php rolopress_after_main(); // After main hook ?>
		
	</div><!-- #container -->
	<?php rolopress_after_container(); // After container hook ?>
		
<?php get_sidebar(); ?>	
<?php get_footer(); ?>