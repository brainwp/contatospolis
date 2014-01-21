<?php
/**
 * @package cp-import-export
 * @version 0.1
 */
/*
Plugin Name: Contatos Polis Importador/Exportador
Description: Ferramenta para importar/exportar cadastros do site Contatos Polis
Author: Brasa
Version: 0.1
Author URI: http://brasa.art.br/
*/

add_action( 'admin_menu', 'cp_create_plugin_page' );
add_action( 'template_redirect', 'cp_check_post' );

function cp_create_plugin_page() {
	add_management_page( 'Contatos Polis', 'Contatos Polis', 'edit_posts', 'ferramentas', 'cp_ferramentas_page' );
}


function cp_ferramentas_page() {
	define(CP_URL, $_SERVER['PHP_SELF'].'?page=ferramentas');
?>
<div class="wrap">
	<h2>Contatos Polis - Ferramentas</h2>

	<p>Explicação das ferramentas</p>

	<h3>Exportar</h3>

	<form id="export-filters" method="post" action="<?php echo CP_URL; ?>">
		<input type="hidden" value="true" name="download">
		<p><label><input type="radio" checked="checked" value="all" name="content"> Todo conteúdo</label></p>
		<p class="description">Conterá todos os dados de todas as entidades e contatos cadastrados.</p>
		<p><label><input type="radio" value="posts" name="content"> Somente Entidades</label></p>
		<p class="description">Conterá todos os dados das entidades cadastradas, mas somente as referências (IDs) das entidades associados.</p>
		<p><label><input type="radio" value="pages" name="content"> Somente Contatos</label></p>
		<p class="description">Conterá todos os dados dos contatos cadastrados, mas somente as referências (IDs) das entidades associados.</p>

		<p class="submit">
			<input type="submit" value="Download do arquivo de exportação" class="button button-primary" id="submit" name="submit">
		</p>
	</form>

	<h3>Importar</h3>

	<form id="import-filters" method="post" action="">
		<input type="hidden" value="true" name="upload">
		<p><label><input type="file" name="import_file" /></label></p>
		<p class="description">Apenas arquivos em formato .csv. <a href="#">Clique aqui para fazer download de um exemplo.</a></p>

		<p class="submit">
			<input type="submit" value="Fazer upload e cadastrar novos dados" class="button button-primary" id="submit" name="submit">
		</p>
	</form>	
</div>
<?php
}

function cp_check_post() {

	if($_POST['download']) {
		// cp_download_data($_POST);
	} elseif($_POST['upload']) {
		// cp_upload_data($_POST);
	} else {
		return;
	}
}

function wp_download_data($data) {



}

?>
