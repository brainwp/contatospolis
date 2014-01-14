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
    	<?php _e('Adicione o Primeiro e Último Nome do indivíduo que pretende cadastrar. Após clicar em Adicionar Contato você será redirecionado para a página onde poderá completar o preenchimento de todos os campos desse contato.', 'rolopress'); ?>
    </div><!-- .instrucoes -->

    <fieldset class="inlineLabels">

        <div class="cada-linha add">
            <div class="add">
                <span class="title title-bloco-1 grey"><?php _e('* Primeiro Nome', 'rolopress'); ?></span>
				<span class="resposta-add"><input type="text" class="first_name" tabindex="1000" size="" value="" name="rolo_contact_first_name" style="cursor: auto;"></span>
            </div>
        </div><!-- .cada-linha -->

        <div class="cada-linha add">
            <div class="add">
                <span class="title title-bloco-1 grey"><?php _e('* Último Nome', 'rolopress'); ?></span>
				<span class="resposta-add"><input type="text" class="last_name" tabindex="1001" size="" value="" name="rolo_contact_last_name"></span>
            </div>
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