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
add_action( 'init', 'cp_check_post' );
register_activation_hook( __FILE__, 'cp_activate_script' );
// register_uninstall_hook( __FILE__, 'cp_uninstall_script' );

//use SimpleExcel\SimpleExcel;
//use SimpleExcel\Spreadsheet\Worksheet;

add_action( 'wp_ajax_nopriv_cp_ajax_edit_dict', 'cp_ajax_edit_dict' );
add_action( 'wp_ajax_cp_ajax_edit_dict', 'cp_ajax_edit_dict' );

function cp_ajax_edit_dict() {

	$dict = get_option( 'rolo_import_dict' );

	$key = $_POST['data']['data']['key'];
	$value = $_POST['data']['new_value'];

	$dict[$key] = $value;

	$response = update_option( 'rolo_import_dict', $dict );

	header( "Content-Type: application/json" );
	echo json_encode($response);
	exit;
}

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
	wp_register_script( 'extrajs', plugin_dir_url( __FILE__ ) . '/cp-import-export.js', array('jquery'), '', true );
	wp_enqueue_script( 'jeip', ROLOPRESS_JS . '/jeip.js', array('jquery'), '', true );
	

	wp_enqueue_script( 'extrajs' );
	wp_localize_script( 'extrajs', 'ajax_url', array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'key' => '' ) );
}

function cp_create_plugin_page() {
	add_management_page( 'Contatos Polis', 'Contatos Polis', 'edit_posts', 'ferramentas', 'cp_ferramentas_page' );
}


function cp_ferramentas_page() {
	define(CP_URL, $_SERVER['PHP_SELF'].'?page=ferramentas');
?>
<style type="text/css">
	tr:hover {
		background: #444;
		color: #fff;
	}
</style>
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

	<div class="dictionary">
		<h4>Dicionário do importador</h4>
		<p>A coluna da esquerda representa as chaves de armazenamento das informações no banco de dados.
			<br>Caso as colunas do arquivo de importação estejam nomeadas de forma diferente, altere primeiro os nomes aqui, antes de importar o arquivo.</p>
		<p>Informações em colunas sem nome serão ignoradas.</p>

		<?php 

			// update_option( 'rolo_import_dict', array( 'rolo_city' => 'Município' ) );

			global $wpdb;
			$r = $wpdb->get_results("SELECT DISTINCT meta_key FROM {$wpdb->prefix}postmeta WHERE meta_key LIKE 'rolo_%'");
			$dict = get_option( 'rolo_import_dict' );

			echo '<table class="dict"><fieldset><tr><th>Meta Key</th><th>Coluna no arquivo de importação</th></tr>';
			foreach ($r as $key) {
				$d = $dict[$key->meta_key];   
				echo "<tr><td class='dict-key'>" . $key->meta_key ."</td><td class='dict-item'>" . $d ."</td></tr>";
			}
			echo '</fieldset></table>';

		?>
		
	</div>
</div>
<?php
}

function cp_check_post() {

	if($_POST['download']) {
		cp_download_data($_POST);
		// cp_make_excel();
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

	$csv = explode(',', $csv);
	
	$lines = array();
	$lines[] = $csv;

	foreach ($export_data as $data) {

		// Dados iniciais
		$csv = array();
		$csv[] =  $data->ID . '';

		if(has_term( 'company', 'type', $data ))
			$csv[] =  'Instituição';
		if(has_term( 'contact', 'type', $data ))
			$csv[] =  'Contato';

		$csv[] =  $data->post_title . '';

		if(has_term( 'company', 'type', $data )) :

			// Post Meta

			$company = get_post_custom($data->ID);

			$csv[] =  '"' . $company['rolo_company_email'][0] . '"';
			$csv[] =  '"' . $company['rolo_company_endereco'][0] . '"';
			$csv[] =  '"' . $company['rolo_city'][0] . '"';
			$csv[] =  '"' . $company['rolo_uf'][0] . '"';
			$csv[] =  '"' . $company['rolo_company_telefone'][0] . '"';
			$csv[] =  '"' . $company['rolo_company_website'][0] . '"';
			$redes = unserialize( $company['rolo_company_redes'][0] );
			if( is_array( $redes ) ) {
				$csv[] =  '"' . implode( '; ', $redes ) . '"';
			} else {
				$csv[] =  '';
			}
			$csv[] =  '"' . $company['rolo_company_contato_facil'][0] . '"';

			$csv[] =  '"' . $company['rolo_company_year'][0] . '"';
			$csv[] =  '"' . $company['rolo_company_legal'][0] . '"';

			$contatos = unserialize( $company['rolo_contatos'][0] );
			if( is_array( $contatos ) ) {
				$csv[] =  '"' . implode( '; ', $contatos ) . '"';
			} else {
				$csv[] =  '';
			}

			// Taxonomias

			$car = get_the_terms( $data->ID, 'caracterizacao' );
			if($car) {
				foreach ($car as $c) { $cars[] .= $c->name; }
				$csv[] =  '"' . implode('; ', $cars) . '"';
			} else {
				$csv[] =  '';
			}
			
			$abr = get_the_terms( $data->ID, 'abrangencia' );
			if($abr) {
				foreach ($abr as $c) { $abrs[] .= $c->name; }
				$csv[] =  '"' . implode('; ', $abrs) . '"';
			} else {
				$csv[] =  '';
			}

			$int = get_the_terms( $data->ID, 'interesse' );
			if($int) {
				foreach ($int as $c) { $ints[] .= $c->name; }
				$csv[] =  '"' . implode('; ', $ints) . '"';
			} else {
				$csv[] =  '';
			}

			$par = get_the_terms( $data->ID, 'participacao' );
			if($par) {
				foreach ($par as $c) { $pars[] .= $c->name; }
				$csv[] =  '"' . implode('; ', $pars) . '"';
			} else {
				$csv[] =  '';
			}

			// Impactos Socioambientais
			
			$csv[] =  '"';

			if($company['rolo_conflito_check'][0]) {
				$csv[] =  'Está em situação de conflito; ';
			} else {
				$csv[] =  'Não está em situação de conflito; ';
			}

			if($company['rolo_conflito_projeto'][0])
				$csv[] =  'Projeto: ' . $company['rolo_conflito_projeto'][0] . '; ';

			if($company['rolo_conflito_desde'][0])
				$csv[] =  'Desde: ' . $company['rolo_conflito_desde'][0] . '; ';

			if($company['rolo_conflito_instancia'][0])
				$csv[] =  'Levado a alguma instância? ' . $company['rolo_conflito_instancia'][0] . '; ';

			if($company['rolo_conflito_equacionado'][0])
				$csv[] =  'Equacionado? ' . $company['rolo_conflito_equacionado'][0] . '; ';

			if($company['rolo_conflito_observacoes'][0])
				$csv[] =  'Observações: ' . $company['rolo_conflito_observacoes'][0] . '; ';
				
			$csv[] =  '"';		

			// Relação com o projeto
			
			$csv[] =  '"';

			if($company['rolo_relacao_check'][0]) {
				$csv[] =  'Participou de evento do projeto; ';
			} else {
				$csv[] =  'Não participou de evento do projeto; ';
			}

			if($company['rolo_relacao_local'][0])
				$csv[] =  'Local: ' . $company['rolo_relacao_local'][0] . '; ';

			if($company['rolo_relacao_apoio'][0]) {
				$csv[] =  'Tem apoiado/divulgado o projeto; ';
			} else {
				$csv[] =  'Não tem apoiado/divulgado o projeto; ';
			}

			if($company['rolo_relacao_conflito'][0])
				$csv[] =  'Histórico de conflito: ' . $company['rolo_relacao_conflito'][0] . '; ';
				
			$csv[] =  '"';		

			if($tipo['conteudo'] == 'tudo')
				$csv[] =  '-,-,-';

			// Data e observações
			$company_update = $company['rolo_company_update'][0];
				if(!$company_update) { $company_update = "Última edição em: " . date( 'd/m/Y', strtotime($data->post_modified) ); }

			$csv[] =  '"' . $company_update . '"';

			$csv[] =  '"' . $company['rolo_company_others'][0] . '"';

			// Fim de linha
		    
	    	$lines[] = $csv;

	    elseif(has_term( 'contact', 'type', $data )) :
		
			$contact = get_post_custom($data->ID);

			$csv[] =  '"' . $contact['rolo_contact_email'][0] . '"';
			$csv[] =  '"' . $contact['rolo_contact_endereco'][0] . '"';
			$csv[] =  '"' . $contact['rolo_city'][0] . '"';
			$csv[] =  '"' . $contact['rolo_uf'][0] . '"';			
			$csv[] =  '"' . $contact['rolo_contact_telefone'][0] . '"';
			$csv[] =  '"' . $contact['rolo_contact_website'][0] . '"';

			$redes = unserialize( $contact['rolo_contact_redes'][0] );
			if( is_array( $redes ) ) {
				$csv[] =  '"' . implode( '; ', $redes ) . '"';
			} else {
				$csv[] =  '';
			}
			
			$csv[] =  '"' . $contact['rolo_contact_contato_facil'][0] . '"';

			if($tipo['conteudo'] == 'tudo')
				$csv[] =  '-,-,-,-,-,-,-,-,-';

			$cias = unserialize( $contact['rolo_contact_company'][0] );
			if( is_array( $cias ) ) {
				$csv[] =  '"' . implode( '; ', $cias ) . '"';
			} else {
				$csv[] =  '';
			}

			
			$csv[] =  '"' . $contact['rolo_contact_role'][0] . '"';
			$csv[] =  '"' . $contact['rolo_contact_party'][0] . '"';

			
			
			$contact_update = $contact['rolo_contact_update'][0];
				if(!$contact_update) { $contact_update = "Última edição em: " . date( 'd/m/Y', strtotime($data->post_modified) ); }

			$csv[] =  '"' . $contact_update . '"';

			$csv[] =  '"' . $contact['rolo_contact_others'][0] . '"';

			$lines[] = $csv;

	    endif;
   		$i++;
   	}

   	// cp_make_excel();
   	header('Content-type: text/csv');
   	header("Content-Disposition: attachment;filename=".time().".csv");

	$f  =   fopen('php://output', 'w');
    foreach($lines as $l) {
    	fputcsv($f, $l);
    }
    exit;
}

function cp_upload_data($data, $files, $force_update = false) {

	error_log("Importação iniciada em ".date('d/m/Y G:i:s'));

	$dict = get_option( 'rolo_import_dict' );

	dump($data);
	dump($files);

	$cont = file_get_contents($files['import_file']['tmp_name']); // Le o conteudo do arquivo
	$contarr = explode("\n", $cont); // Explode em linhas para cada nova entrada
	$headers = explode(',', array_shift($contarr)); // Separa os cabeçalhos em outra lista

	foreach ($contarr as $l) {

		// Para cada nova entrada, separa os valores em um array
		$arr = explode(',', $l);

		// Para cada valor do header
		for( $i = 0; $i < count($headers); $i++ ) {
			$postarr[strtolower($headers[$i])] = $arr[$i]; // Associa o header ao seu valor da entrada
		}

		dump($dict['rolo_city']);
		dump($postarr[$dict['rolo_city']]);

		$newpost = array(
			'post_title' => $postarr[$dict['nome']]
			/*
			'tax_input'	 => array(
					'caracterizacao' => $postarr['Caracterização institucional'],
					'abrangencia' => $postarr['Abrangência de Atuação'],
					'interesse' => $postarr['Caracterização institucional'],
					'participacao' => array(),
				)
			*/
			);
			
		$check = get_posts(
			array(
				'post_title' => $postarr[$dict['nome']], 
				'meta_query' => array(
					'relation' => 'OR', 
					array('key' => 'rolo_company_email', 
						'value' => $postarr[$dict['rolo_company_email']]
					),
					array('key' => 'rolo_contact_email', 
						'value' => $postarr[$dict['rolo_contact_email']]
					)
				)
			)
		);

		//dump($check);

		// Confere se o post é duplicado e não pode ser reescrito
		if($check && !$force_update) {
			$err[] = array($dict['nome'] => $postarr[$dict['nome']], 'err' => 'Já existe uma entrada com esta combinação de nome / email');
		} else {
			if($force_update) // se estamos forçando o update, devolve o ID para o array
				$newpost['ID'] = $postarr['ID'];

			// $id = wp_insert_post($newpost, true);

			// Confere se a inserção foi bem sucedida
			if(is_wp_error($id)) {
				$error_string = $id->get_error_message();
				$err[] = array($dict['nome'] => $postarr[$dict['nome']], 'err' => $error_string);
			} else {
				// Sem erros, vamos gravar os metas
				// Primeiro tiramos do array as partes que já foram gravadas
				unset($postarr['ID']);
				unset($postarr[$dict['nome']]);

				

				foreach($postarr as $key => $value) {

					dump($key);
					dump($value);
					// update_post_meta( $id, $dict[$p], $meta_value, $prev_value );

				}

			}
		}

			

		// dump($newpost);
		// dump($postarr);

	}

	dump($err);
	dump($headers);

	error_log("Importação finalizada em ".date('d/m/Y G:i:s'));

}


function cp_make_excel($ids) {
	
	include(dirname( __FILE__ ) . '/PHPExcel.php');	

	// Create new PHPExcel object
	$objPHPExcel = new PHPExcel();

	// Set document properties
	$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
	->setLastModifiedBy("Maarten Balliauw")
	->setTitle("Office 2007 XLSX Test Document")
	->setSubject("Office 2007 XLSX Test Document")
	->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
	->setKeywords("office 2007 openxml php")
	->setCategory("Test result file");

	$export_data = get_posts(array(
		'numberposts' => -1,
		'post_type' => 'post',
		'post_status' => 'publish',
		'post__in' => explode(',', $ids)
		/*,
		 'tax_query' => array(
			array(
				'taxonomy' => 'type',
				'field' => 'slug',
				'terms' => $types,
				)
			)*/
	));

	if($tipo['conteudo'] == 'entidades') 
		$cols = "ID,Tipo,Nome,E-mail,Endereço,Cidade,Estado,Telefone,Website,Redes Sociais,Forma mais fácil de contactar,Ano de Criação,Constituida legalmente?,Contatos,Caracterização institucional,Áreas de interesse,Abrangência de atuação,Espaços de participação,Impactos socioambientais,Relação com o projeto Litoral Sustentável,Data das informações,Observações\n";
	if($tipo['conteudo'] == 'contatos') 
		$cols = "ID,Tipo,Nome,E-mail,Endereço,Cidade,Estado,Telefone,Website,Redes Sociais,Forma mais fácil de contactar,Instituição,Cargo,Posicionamento político,Data das informações,Observações\n";
	if($tipo['conteudo'] == 'tudo')
		$cols = "ID,Tipo,Nome,E-mail,Endereço,Cidade,Estado,Telefone,Website,Redes Sociais,Forma mais fácil de contactar,Ano de Criação,Constituida legalmente?,Contatos,Caracterização institucional,Áreas de interesse,Abrangência de atuação,Espaços de participação,Impactos socioambientais,Relação com o projeto Litoral Sustentável,Instituição,Cargo,Posicionamento político,Data das informações,Observações\n";

	// $cols = "ID,Tipo,Nome,E-mail,Endereço,Cidade,Estado,Telefone,Website,Redes Sociais,Forma mais fácil de contactar,Ano de Criação,Constituida legalmente?,Contatos,Caracterização institucional,Áreas de interesse,Abrangência de atuação,Espaços de participação,Impactos socioambientais,Relação com o projeto Litoral Sustentável,Instituição,Cargo,Posicionamento político,Data das informações,Observações\n";
	
	global $wpdb;

	$cols = $wpdb->get_results("SELECT DISTINCT meta_key FROM {$wpdb->prefix}postmeta WHERE meta_key LIKE 'rolo_%'");

	foreach ($cols as $val) {
		$cols_array[] = $val->meta_key;
	}

	// $cols_array = explode(',', $v);

	// Headers
	for( $i=0; $i<count( $cols_array ); $i++ ) {
		$colref = cp_ExcelColumnFromNumber( $i ); // Ref (ex.: A, B, AA, AB)
		$colname = str_replace( 'rolo_', '', $cols_array[$i] ); // Strip prefix
		$colname = ucwords( str_replace('_', ' ', $colname ) ); // Strip underlines and capitalize words
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colref.'1', $colname);
	}

	// Content
	$line = 2;
	for( $i=0; $i<count( $export_data ); $i++ ) {
		
		$colname = 'A';
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colname.$line, $export_data[$i]->post_name);
		

		$line++;
	}


	// Rename worksheet
	$objPHPExcel->getActiveSheet()->setTitle('Contatos Polis');

	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$objPHPExcel->setActiveSheetIndex(0);


	// Redirect output to a client’s web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="'.time().'".xls');
	header('Cache-Control: max-age=0');
	// If you're serving to IE 9, then the following may be needed
	header('Cache-Control: max-age=1');

	// If you're serving to IE over SSL, then the following may be needed
	header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
	header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
	header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
	header ('Pragma: public'); // HTTP/1.0

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
	exit;

}

function cp_ExcelColumnFromNumber($num) {
           
    $numeric = $num % 26;
    $letter = chr(65 + $numeric);
    $num2 = intval($num / 26);
    if ($num2 > 0) {
        return cp_ExcelColumnFromNumber($num2 - 1) . $letter;
    } else {
        return $letter;
    }

}

if($_GET['xls']) {
	// var_dump($_GET['xls']);
cp_make_excel($_GET['xls']);
	// echo cp_ExcelColumnFromNumber(124);
	// 
	// $ids = explode(',', $_GET['xls']) {
	/*
	global $wpdb;

	$q = $wpdb->get_results("SELECT DISTINCT meta_key FROM {$wpdb->prefix}postmeta WHERE meta_key LIKE 'rolo_%'");

	foreach ($q as $val) {
		$v[] = $val->meta_key;
	}

	var_dump($v);
	*/
}
	

?>
