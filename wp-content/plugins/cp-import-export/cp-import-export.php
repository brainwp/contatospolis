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
register_activation_hook( __FILE__, 'cp_activate_script' );
// register_uninstall_hook( __FILE__, 'cp_uninstall_script' );

function cp_activate_script() {

	if(!is_dir(WP_CONTENT_DIR . '/export/')) {
		mkdir(WP_CONTENT_DIR . '/export/', 755);
	}
	if(!is_dir(WP_CONTENT_DIR . '/import/')) {
		mkdir(WP_CONTENT_DIR . '/import/', 755);
	}

}

function cp_uninstall_script($dir = false) {

   if($dir)
   	$dir = ABSPATH . 'wp-content/export';

   $files = array_diff(scandir($dir), array('.','..'));
    foreach ($files as $file) {
      (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");
    }

	rmdir($dir);
}

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
		<p><label><input type="radio" value="tudo" name="conteudo"> Todo conteúdo</label></p>
		<p class="description">Conterá todos os dados de todas as entidades e contatos cadastrados.</p>
		<p><label><input type="radio" value="entidades" name="conteudo"> Somente Entidades</label></p>
		<p class="description">Conterá todos os dados das entidades cadastradas, mas somente as referências (IDs) das entidades associados.</p>
		<p><label><input type="radio" value="contatos" name="conteudo"> Somente Contatos</label></p>
		<p class="description">Conterá todos os dados dos contatos cadastrados, mas somente as referências (IDs) das entidades associados.</p>

		<p class="submit">
			<input type="submit" value="Download do arquivo de exportação" class="button button-primary" id="submit" name="submit">
		</p>
	</form>

	<h3>Importar</h3>

	<form  enctype="multipart/form-data" id="import-filters" method="post" action="">
		<input type="hidden" value="true" name="upload">
		<p><label><input type="file" name="import_file" /></label></p>
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
		cp_upload_data($_POST, $_FILES);
	} else {
		return;
	}
}

function cp_download_data($tipo) {

	if(!$tipo['conteudo'])
		return;

	if($tipo['conteudo'] == 'tudo') {
		$types = array('company', 'contact');
	}
	elseif($tipo['conteudo'] == 'entidades') {
		$types = array('company');
	}
	elseif($tipo['conteudo'] == 'contatos') {
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

	if($tipo['conteudo'] == 'entidades') 
		$csv = "ID,Tipo,Nome,E-mail,Endereço,Cidade,Estado,Telefone,Website,Redes Sociais,Forma mais fácil de contactar,Ano de Criação,Constituida legalmente?,Contatos,Caracterização institucional,Áreas de interesse,Abrangência de atuação,Espaços de participação,Impactos socioambientais,Relação com o projeto Litoral Sustentável,Data das informações,Observações\n";
	if($tipo['conteudo'] == 'contatos') 
		$csv = "ID,Tipo,Nome,E-mail,Endereço,Cidade,Estado,Telefone,Website,Redes Sociais,Forma mais fácil de contactar,Instituição,Cargo,Posicionamento político,Data das informações,Observações\n";
	if($tipo['conteudo'] == 'tudo')
		$csv = "ID,Tipo,Nome,E-mail,Endereço,Cidade,Estado,Telefone,Website,Redes Sociais,Forma mais fácil de contactar,Ano de Criação,Constituida legalmente?,Contatos,Caracterização institucional,Áreas de interesse,Abrangência de atuação,Espaços de participação,Impactos socioambientais,Relação com o projeto Litoral Sustentável,Instituição,Cargo,Posicionamento político,Data das informações,Observações\n";

	$type = 'company';
	$i = 0;

	foreach ($export_data as $data) {
/*
		if($company['rolo_company_name'][0] && $i == 0) {

			$csv .= "Instituições\n";
			$csv .= "ID,Nome,Ano de Criação,Constituida legalmente?,Observações,Data das informações,E-mail,Endereço,Cidade,Estado,Telefone,Website,Redes Sociais,Forma mais fácil de contatar,Contatos,Caracterização institucional,Áreas de interesse,Abrangência de atuação,Espaços de participação,Impactos socioambientais,Relação com o projeto Litoral Sustentável\n";

		} 
		elseif($company['rolo_contact_name'][0] && !$flag) {		
		
			$csv .= "\n";
			$csv .= "Contatos\n";
			$csv .= "ID,Nome,Ano de Criação,Constituida legalmente?,Observações,Data das informações,E-mail,Endereço,Cidade,Estado,Telefone,Website,Redes Sociais,Forma mais fácil de contatar,Contatos,Caracterização institucional,Áreas de interesse,Abrangência de atuação,Espaços de participação,Impactos socioambientais,Relação com o projeto Litoral Sustentável\n";			

			$flag = true;			
		}
*/
		// Dados iniciais
		
		$csv .= $data->ID . ',';

		if(has_term( 'company', 'type', $data ))
			$csv .= 'Instituição,';
		if(has_term( 'contact', 'type', $data ))
			$csv .= 'Contato,';

		$csv .= $data->post_title . ',';

		if(has_term( 'company', 'type', $data )) :

			// Post Meta

			$company = get_post_custom($data->ID);

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

			$csv .= '"' . $company['rolo_company_year'][0] . '",';
			$csv .= '"' . $company['rolo_company_legal'][0] . '",';

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

			if($tipo['conteudo'] == 'tudo')
				$csv .= '-,-,-,';

			// Data e observações
			$company_update = $company['rolo_company_update'][0];
				if(!$company_update) { $company_update = "Última edição em: " . date( 'd/m/Y', strtotime($data->post_modified) ); }

			$csv .= '"' . $company_update . '",';

			$csv .= '"' . $company['rolo_company_others'][0] . '",';

			// Fim de linha
		    $csv .= "\n";
	    

	    elseif(has_term( 'contact', 'type', $data )) :
		
			$contact = get_post_custom($data->ID);

			$csv .= '"' . $contact['rolo_contact_email'][0] . '",';
			$csv .= '"' . $contact['rolo_contact_endereco'][0] . '",';
			$csv .= '"' . $contact['rolo_city'][0] . '",';
			$csv .= '"' . $contact['rolo_uf'][0] . '",';			
			$csv .= '"' . $contact['rolo_contact_telefone'][0] . '",';
			$csv .= '"' . $contact['rolo_contact_website'][0] . '",';

			$redes = unserialize( $contact['rolo_contact_redes'][0] );
			if( is_array( $redes ) ) {
				$csv .= '"' . implode( '; ', $redes ) . '",';
			} else {
				$csv .= ',';
			}
			
			$csv .= '"' . $contact['rolo_contact_contato_facil'][0] . '",';

			if($tipo['conteudo'] == 'tudo')
				$csv .= '-,-,-,-,-,-,-,-,-,';

			$cias = unserialize( $contact['rolo_contact_company'][0] );
			if( is_array( $cias ) ) {
				$csv .= '"' . implode( '; ', $cias ) . '",';
			} else {
				$csv .= ',';
			}

			
			$csv .= '"' . $contact['rolo_contact_role'][0] . '",';
			$csv .= '"' . $contact['rolo_contact_party'][0] . '",';

			
			
			$contact_update = $contact['rolo_contact_update'][0];
				if(!$contact_update) { $contact_update = "Última edição em: " . date( 'd/m/Y', strtotime($data->post_modified) ); }

			$csv .= '"' . $contact_update . '",';

			$csv .= '"' . $contact['rolo_contact_others'][0] . '",';


			$csv .= "\n";

	    endif;
   
   		$i++;
	}
	
	file_put_contents(WP_CONTENT_DIR . '/export/last_export.csv', $csv);
    header('Location: '. WP_CONTENT_URL . '/export/last_export.csv');

}

function cp_upload_data($data, $files) {

	$newfile = WP_CONTENT_DIR . '/import/import-'.date('d-m-Y-G-i', time()).'.txt';
	$up = move_uploaded_file($files['import_file']['tmp_name'], $newfile);

	$cont = file_get_contents($newfile);

	// dump(explode("\n", $cont));

	

}

?>
