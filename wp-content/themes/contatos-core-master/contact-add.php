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

        <div class="cada-linha add">
			<span class="title title-bloco-1 grey"><?php _e('* Cidade de Moradia', 'rolopress'); ?></span>
            <span class="resposta-add"><input type="text" class="cidade required" tabindex="1002" size="" value="" name="rolo_city"></span>
        </div><!-- .cada-linha -->

        <div class="cada-linha add">
			<span class="title title-bloco-1 grey"><?php _e('* Estado', 'rolopress'); ?></span>
            		<select name="rolo_uf">
					    <option value="">Selecione</option>
					    <option value="AC">AC</option>
					    <option value="AL">AL</option>
					    <option value="AM">AM</option>
					    <option value="AP">AP</option>
					    <option value="BA">BA</option>
					    <option value="CE">CE</option>
					    <option value="DF">DF</option>
					    <option value="ES">ES</option>
					    <option value="GO">GO</option>
					    <option value="MA">MA</option>
					    <option value="MG">MG</option>
					    <option value="MS">MS</option>
					    <option value="MT">MT</option>
					    <option value="PA">PA</option>
					    <option value="PB">PB</option>
					    <option value="PE">PE</option>
					    <option value="PI">PI</option>
					    <option value="PR">PR</option>
					    <option value="RJ">RJ</option>
					    <option value="RN">RN</option>
					    <option value="RO">RO</option>
					    <option value="RR">RR</option>
					    <option value="RS">RS</option>
					    <option value="SC">SC</option>
					    <option value="SE">SE</option>
					    <option value="SP">SP</option>
					    <option value="TO">TO</option>
					</select>
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