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
add_action( 'admin_enqueue_scripts', 'cp_enqueue_scripts' );
add_action( 'admin_head', 'cp_check_post' );

function cp_enqueue_scripts() {
	wp_register_script( 'extrajs', plugin_dir_url( __FILE__ ) . '/cp-import-export.js', array('jquery'), false, true );

	wp_enqueue_script( 'extrajs' );
}

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
		<p><label><input type="radio" value="tudo" name="conteudo" disabled="disabled"> Todo conteúdo</label></p>
		<p class="description">Conterá todos os dados de todas as entidades e contatos cadastrados.</p>
		<p><label><input type="radio" checked="checked" value="entidades" name="conteudo"> Somente Entidades</label></p>
		<p class="description">Conterá todos os dados das entidades cadastradas, mas somente as referências (IDs) das entidades associados.</p>
		<p><label><input type="radio" value="contatos" name="conteudo" disabled="disabled"> Somente Contatos</label></p>
		<p class="description">Conterá todos os dados dos contatos cadastrados, mas somente as referências (IDs) das entidades associados.</p>

		<p class="submit">
			<input type="submit" value="Download do arquivo de exportação" class="button button-primary" id="submit" name="submit">
		</p>
	</form>

	<h3>Importar</h3>

	<form id="import-filters" method="post" action="">
		<input type="hidden" value="true" name="upload">
		<p><label><input type="file" name="import_file" disabled="disabled" /></label></p>
		<p class="description">Apenas arquivos em formato .csv. <a href="<?php echo home_url('export/exemplo.csv'); ?>">Clique aqui para fazer download de um exemplo.</a></p>

		<p class="submit">
			<input type="submit" value="Fazer upload e cadastrar novos dados" class="button button-primary" id="submit" name="submit">
		</p>
	</form>	
</div>
<?php
}

function cp_check_post() {

	if($_POST['download']) {
		cp_download_data($_POST);
	} elseif($_POST['upload']) {
		// cp_upload_data($_POST);
	} else {
		return;
	}
}

function cp_download_data($data) {

	if(!$data['conteudo'])
		return;

	if($data['conteudo'] == 'tudo') {
		$types = array('company', 'contact');
	}
	elseif($data['conteudo'] == 'entidades') {
		$types = array('company');
	}
	elseif($data['conteudo'] == 'contatos') {
		$types = array('contact');
	}

	$export_data = get_posts(array(
			'numberposts' => -1,
			'post_type' => 'post',
			'post_status' => 'publish',
			'tax_query' => array(
				array(
					'taxonomy' => 'type',
					'field' => 'slug',
					'terms' => $types,
					)
				)
		));

	$csv = "ID,Nome,Ano de Criação,Constituida legalmente?,Observações,Data das informações,E-mail,Endereço,Cidade,Estado,Telefone,Website,Redes Sociais,Forma mais fácil de contatar,Contatos,Caracterização institucional,Áreas de interesse,Abrangência de atuação,Espaços de participação,Impactos socioambientais,Relação com o projeto Litoral Sustentável\n";

	foreach ($export_data as $data) {

		// Dados iniciais
		
		$csv .= $data->ID . ',';
		$csv .= $data->post_title . ',';

		// Post Meta

		$company = get_post_custom($data->ID);

		$csv .= '"' . $company['rolo_company_year'][0] . '",';
		$csv .= '"' . $company['rolo_company_legal'][0] . '",';
		$csv .= '"' . $company['rolo_company_others'][0] . '",';
		
		$company_update = $company['rolo_company_update'][0];
			if(!$company_update) { $company_update = "Última edição em: " . date( 'd/m/Y', strtotime($data->post_modified) ); }

		$csv .= '"' . $company_update . '",';
		$csv .= '"' . $company['rolo_company_email'][0] . '",';
		$csv .= '"' . $company['rolo_company_endereco'][0] . '",';
		$csv .= '"' . $company['rolo_city'][0] . '",';
		$csv .= '"' . $company['rolo_uf'][0] . '",';
		$csv .= '"' . $company['rolo_company_telefone'][0] . '",';
		$csv .= '"' . $company['rolo_company_website'][0] . '",';

		$redes = unserialize( $company['rolo_company_redes'][0] );
		if( is_array( $redes ) ) {
			$csv .= '"' . implode( '; ', $redes ) . '",';
		} else {
			$csv .= ',';
		}
		
		$csv .= '"' . $company['rolo_company_contato_facil'][0] . '",';

		$contatos = unserialize( $company['rolo_contatos'][0] );
		if( is_array( $contatos ) ) {
			$csv .= '"' . implode( '; ', $contatos ) . '",';
		} else {
			$csv .= ',';
		}

		// Taxonomias

		$car = get_the_terms( $data->ID, 'caracterizacao' );
		if($car) {
			foreach ($car as $c) { $cars[] .= $c->name; }
			$csv .= '"' . implode('; ', $cars) . '",';
		} else {
			$csv .= ',';
		}
		
		$abr = get_the_terms( $data->ID, 'abrangencia' );
		if($abr) {
			foreach ($abr as $c) { $abrs[] .= $c->name; }
			$csv .= '"' . implode('; ', $abrs) . '",';
		} else {
			$csv .= ',';
		}

		$int = get_the_terms( $data->ID, 'interesse' );
		if($int) {
			foreach ($int as $c) { $ints[] .= $c->name; }
			$csv .= '"' . implode('; ', $ints) . '",';
		} else {
			$csv .= ',';
		}

		$par = get_the_terms( $data->ID, 'participacao' );
		if($par) {
			foreach ($par as $c) { $pars[] .= $c->name; }
			$csv .= '"' . implode('; ', $pars) . '",';
		} else {
			$csv .= ',';
		}

		// Impactos Socioambientais
		
		$csv .= '"';

		if($company['rolo_conflito_check'][0]) {
			$csv .= 'Está em situação de conflito; ';
		} else {
			$csv .= 'Não está em situação de conflito; ';
		}

		if($company['rolo_conflito_projeto'][0])
			$csv .= 'Projeto: ' . $company['rolo_conflito_projeto'][0] . '; ';

		if($company['rolo_conflito_desde'][0])
			$csv .= 'Desde: ' . $company['rolo_conflito_desde'][0] . '; ';

		if($company['rolo_conflito_instancia'][0])
			$csv .= 'Levado a alguma instância? ' . $company['rolo_conflito_instancia'][0] . '; ';

		if($company['rolo_conflito_equacionado'][0])
			$csv .= 'Equacionado? ' . $company['rolo_conflito_equacionado'][0] . '; ';

		if($company['rolo_conflito_observacoes'][0])
			$csv .= 'Observações: ' . $company['rolo_conflito_observacoes'][0] . '; ';
			
		$csv .= '",';		

		// Relação com o projeto
		
		$csv .= '"';

		if($company['rolo_relacao_check'][0]) {
			$csv .= 'Participou de evento do projeto; ';
		} else {
			$csv .= 'Não participou de evento do projeto; ';
		}

		if($company['rolo_relacao_local'][0])
			$csv .= 'Local: ' . $company['rolo_relacao_local'][0] . '; ';

		if($company['rolo_relacao_apoio'][0]) {
			$csv .= 'Tem apoiado/divulgado o projeto; ';
		} else {
			$csv .= 'Não tem apoiado/divulgado o projeto; ';
		}

		if($company['rolo_relacao_conflito'][0])
			$csv .= 'Histórico de conflito: ' . $company['rolo_relacao_conflito'][0] . '; ';
			
		$csv .= '",';		

		// Fim de linha
	    $csv .= "\n";
   
	}
	
	file_put_contents(ABSPATH . 'export/last_export.csv', $csv);

	
    header('Location: '.home_url('export/exemplo.csv'));
	// dump($export_data);


}

?>
