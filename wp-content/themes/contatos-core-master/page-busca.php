<?php
/**
 * Template Name: Search Page
 *
 *
 * @package RoloPress
 * @subpackage Template
 */
/*
if ( current_user_can('publish_posts') ) { // only display if user has proper permissions
	rolo_add_contact();
} else {
	rolo_permission_message();
}
*/				
get_header(); ?>
	
	<?php rolopress_before_container(); // Before container hook ?>
	<div id="container">
	
		<?php rolopress_before_main(); // Before main hook ?>
		<div id="main">
			
				<?php rolo_pageheader();?>
			
	<form id="search-form" class="inlineLabels" method="post" action="<?php echo home_url('/'); ?>" >

    <div id="errorMsg">
        <h3>Mandatory fields are not filled.</h3>
    </div>
    
    <div class="instrucoes">
    	<?php _e('Selecione o público para ver o formulário completo.', 'rolopress'); ?>
    </div><!-- .instrucoes -->

    <fieldset class="inlineLabels geral">

        <div class="cada-linha add">
            <div >
                <span class="title title-bloco-1 grey"><?php _e('Buscar por:', 'rolopress'); ?></span>
				<span class="busca inicial">
					<select name="busca_publicos" class="publicos">
					    <option value="geral">Todos</option>
					    <option value="contact">Contatos</option>
					    <option value="company">Entidades</option>
					</select>
				</span>
            </div>
        </div><!-- .cada-linha -->   

        <div class="cada-linha add">
            <div >
                <span class="title title-bloco-1 grey"><?php _e('Nome', 'rolopress'); ?></span>
				<span class="busca"><input type="text" class="name" tabindex="1000" size="" value="" name="busca_nome" style="cursor: auto;"></span>
            </div>
        </div><!-- .cada-linha -->

        <div class="cada-linha add">
            <div >
                <span class="title title-bloco-1 grey"><?php _e('Município', 'rolopress'); ?></span>
				<span class="busca"><input type="text" class="city" tabindex="1001" size="" value="" name="busca_municipio"></span>
            </div>
        </div><!-- .cada-linha -->

        <div class="cada-linha add">
            <div >
                <span class="title title-bloco-1 grey"><?php _e('UF', 'rolopress'); ?></span>
				<span class="busca">
					<select name="busca_uf">
					    <option value="todos">Todas</option>
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
				</span>
            </div>
        </div><!-- .cada-linha -->        

    </fieldset>

    <fieldset class="inlineLabels contact" style="display:none;">

        <div class="cada-linha add">
            <div >
                <span class="title title-bloco-1 grey"><?php _e('Cargo', 'rolopress'); ?></span>
				<span class="busca"><input type="text" class="cargo" tabindex="1000" size="" value="" name="busca_cargo" style="cursor: auto;"></span>
            </div>
        </div><!-- .cada-linha -->

        <div class="cada-linha add">
            <div >
                <span class="title title-bloco-1 grey"><?php _e('Instituição em que atua', 'rolopress'); ?></span>
				<span class="busca"><input type="text" class="instituicao" tabindex="1001" size="" value="" name="busca_instituicao"></span>
            </div>
        </div><!-- .cada-linha -->

    </fieldset>    

    <fieldset class="inlineLabels company" style="display:none;">
    	<?php require_once(ABSPATH . 'wp-admin/includes/template.php'); ?>
        <div class="cada-linha add">
            <div >
                <span class="title title-bloco-1 grey"><?php _e('Caracterização institucional', 'rolopress'); ?></span>
				<span class="busca">
					<ul>
						<?php wp_terms_checklist( $company_id, array( 'taxonomy' => 'caracterizacao', 'checked_ontop' => false ) ); ?>
					</ul>
				</span>
            </div>
        </div><!-- .cada-linha -->

        <div class="cada-linha add">
            <div >
                <span class="title title-bloco-1 grey"><?php _e('Área de interesse', 'rolopress'); ?></span>
				<span class="busca">
					<ul>
						<?php wp_terms_checklist( $company_id, array( 'taxonomy' => 'interesse', 'checked_ontop' => false ) ); ?>
					</ul>
				</span>
            </div>
        </div><!-- .cada-linha -->        

        <div class="cada-linha add">
            <div >
                <span class="title title-bloco-1 grey"><?php _e('Abrangência de atuação', 'rolopress'); ?></span>
				<span class="busca">
					<ul>
						<?php wp_terms_checklist( $company_id, array( 'taxonomy' => 'abrangencia', 'checked_ontop' => false ) ); ?>
					</ul>
				</span>
            </div>
        </div><!-- .cada-linha -->        
<?php /*
        <div class="cada-linha add">
            <div >
                <span class="title title-bloco-1 grey"><?php _e('Impactos Socioambientais', 'rolopress'); ?></span>
				<span class="busca">
					<ul>
						<li id="impactos"><label class="selectit"><input type="checkbox" id="in-impactos" name="tax_input[impactos]" value="conflito">Encontra-se em situação de conflito?</label></li>
					</ul>
				</span>
            </div>
        </div><!-- .cada-linha -->        

        <div class="cada-linha add">
            <div >
                <span class="title title-bloco-1 grey"><?php _e('Espaços de Participação', 'rolopress'); ?></span>
				<span class="busca">
					<ul>
						<li id="evento"><label class="selectit"><input type="checkbox" id="in-espaco-evento" name="tax_input[espacos][evento]" value="evento">Participou de algum evento do projeto?</label></li>
						<li id="apoio"><label class="selectit"><input type="checkbox" id="in-espacos-apoio" name="tax_input[espacos][apoio]" value="apoio">Tem apoiado/divulgado o projeto?</label></li>
					</ul>
				</span>
            </div>
        </div><!-- .cada-linha -->        
*/ ?>
    </fieldset>        
      
			<input type="hidden" value="submit_busca" name="rp_submit_busca">
			<button tabindex="1038" class="botao-submit-busca submitButton" id="submit_busca" name="submit" type="submit">Buscar</button>

</form>

		</div><!-- #main -->
		<?php rolopress_after_main(); // After main hook ?>
		
	</div><!-- #container -->
	<?php rolopress_after_container(); // After container hook ?>
		
<?php get_sidebar(); ?>	
<?php get_footer(); ?>