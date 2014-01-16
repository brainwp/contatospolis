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
    	<?php _e('Selecione o público para ver o formulário completo. Lembre-se, quanto mais campos preencher mais específico será o seu resultado.', 'rolopress'); ?>
    </div><!-- .instrucoes -->

    <fieldset class="inlineLabels geral width-content">

        <div class="cada-linha add">
                <span class="title title-bloco-1 grey"><?php _e('Buscar por', 'rolopress'); ?></span>
				<span class="busca inicial">
					<select name="busca_publicos" class="publicos">
					    <option value="geral">Todos</option>
					    <option value="contact">Contatos</option>
					    <option value="company">Entidades</option>
					</select>
				</span>
        </div><!-- .cada-linha -->   

        <div class="cada-linha add">
                <span class="title title-bloco-1 grey"><?php _e('Nome', 'rolopress'); ?></span>
				<span class="busca busca-resposta"><input type="text" class="name" tabindex="1000" size="" value="" name="busca_nome"></span>
        </div><!-- .cada-linha -->

        <div class="cada-linha add">
                <span class="title title-bloco-1 grey"><?php _e('Município', 'rolopress'); ?></span>
				<span class="busca busca-resposta"><input type="text" class="city" tabindex="1001" size="" value="" name="busca_municipio"></span>
        </div><!-- .cada-linha -->

        <div class="cada-linha add">
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
        </div><!-- .cada-linha -->        

    </fieldset>

    <fieldset class="inlineLabels contact width-content">

        <div class="cada-linha add">
                <span class="title title-bloco-5 grey"><?php _e('Cargo', 'rolopress'); ?></span>
				<span class="busca busca-resposta"><input type="text" class="cargo" tabindex="1000" size="" value="" name="busca_cargo" style="cursor: auto;"></span>
        </div><!-- .cada-linha -->

        <div class="cada-linha add">
                <span class="title title-bloco-5 grey"><?php _e('Instituição em que atua', 'rolopress'); ?></span>
				<span class="busca busca-resposta"><input type="text" class="instituicao" tabindex="1001" size="" value="" name="busca_instituicao"></span>
        </div><!-- .cada-linha -->

    </fieldset>

    <fieldset class="inlineLabels company margin-busca">

		<div class="item-col-1 width-50">

    	<?php require_once(ABSPATH . 'wp-admin/includes/template.php'); ?>
        <div class="cada-linha add ul-checkbox">
                <span class="title grey"><h3><?php _e('Caracterização Institucional', 'rolopress'); ?></h3></span>
				<span class="busca">
					<ul>
						<?php wp_terms_checklist( $company_id, array( 'taxonomy' => 'caracterizacao', 'checked_ontop' => false ) ); ?>
					</ul>
				</span>
        </div><!-- .cada-linha -->

        <div class="cada-linha add ul-checkbox">
                <span class="title grey"><h3><?php _e('Áreas de interesse', 'rolopress'); ?></h3></span>
				<span class="busca">
					<ul>
						<?php wp_terms_checklist( $company_id, array( 'taxonomy' => 'interesse', 'checked_ontop' => false ) ); ?>
					</ul>
				</span>
        </div><!-- .cada-linha -->

        </div><!-- .item-col-1 width-50 -->

		<div class="item-col-1 width-40">

        <div class="cada-linha add ul-checkbox">
                <span class="title title-bloco-6 grey"><h3><?php _e('Abrangência de atuação', 'rolopress'); ?></h3></span>
				<span class="busca busca-resposta">
					<ul>
						<?php wp_terms_checklist( $company_id, array( 'taxonomy' => 'abrangencia', 'checked_ontop' => false ) ); ?>
					</ul>
				</span>
        </div><!-- .cada-linha -->        

        <div class="cada-linha add ul-checkbox">
                <span class="title title-bloco-6 grey"><h3><?php _e('Impactos Socioambientais', 'rolopress'); ?></h3></span>
				<span class="busca busca-resposta">
					<ul>
						<li id="impactos"><label class="selectit"><input type="checkbox" id="in-impactos" name="tax_input[impactos][]" value="44">Encontra-se em situação de conflito?</label></li>
					</ul>
				</span>
        </div><!-- .cada-linha -->        

        <div class="cada-linha add ul-checkbox">
                <span class="title grey"><h3><?php _e('Espaços de Participação', 'rolopress'); ?></h3></span>
				<span class="busca">
					<ul>
						<li id="evento"><label class="selectit"><input type="checkbox" id="in-espaco-evento" name="tax_input[espacos][evento]" value="44">Participou de algum evento do projeto?</label></li>
						<li id="apoio"><label class="selectit"><input type="checkbox" id="in-espacos-apoio" name="tax_input[espacos][apoio]" value="44">Tem apoiado/divulgado o projeto?</label></li>
					</ul>
				</span>
        </div><!-- .cada-linha -->        

		</div><!-- item-col-1 width-40 -->

    </fieldset>

			<input type="hidden" value="submit_busca add_contact" name="rp_submit_busca">
			<button tabindex="1038" class="botao-submit-busca submitButton" id="submit_busca" name="submit" type="submit">Pesquisar</button>      

</form>

		</div><!-- #main -->
		<?php rolopress_after_main(); // After main hook ?>
		
	</div><!-- #container -->
	<?php rolopress_after_container(); // After container hook ?>
		
<?php get_sidebar(); ?>	
<?php get_footer(); ?>