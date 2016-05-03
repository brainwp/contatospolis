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
register_deactivation_hook( __FILE__, 'cp_deactivate_script' );
// register_uninstall_hook( __FILE__, 'cp_uninstall_script' );

add_action( 'wp_ajax_nopriv_cp_ajax_edit_dict', 'cp_ajax_edit_dict' );
add_action( 'wp_ajax_cp_ajax_edit_dict', 'cp_ajax_edit_dict' );

$err = array();

function cp_ajax_edit_dict() {

	$dict = get_option( 'rolo_import_dict' );

	$key = $_POST['data']['data']['key'];
	$value = $_POST['data']['new_value'];

	$dict[$key] = $value;

	$response['id'] = update_option( 'rolo_import_dict', $dict );
	$response['status'] = 'sucesso';
	$response['value'] = $value;

	header( "Content-Type: application/json" );
	echo json_encode($response);
	exit;
}
function cp_deactivate_script() {
	// Opção para zerar o dicionário quando o plugin for desativado
	delete_option( 'rolo_import_dict' );
}

function cp_activate_script() {

	$dict = get_option( 'rolo_import_dict' );

	if(!$dict) {
		$dict = array(
			'ID' => 'ID',
			'name' => 'Nome',
			'type' => 'Tipo',
			'rolo_email' => 'Email',
			'rolo_city' => 'Cidade',
			'rolo_contato_facil' => 'Forma Contato',
			'rolo_contatos' => 'Contatos',
			'rolo_endereco' => 'Endereço',
			'rolo_legal' => 'Sit. Legal',
			'rolo_others' => 'Observacoes',
			'rolo_party' => 'Afiliacao politica',
			'rolo_redes_fb' => 'Facebook',
			'rolo_redes_tw' => 'Twitter',
			'rolo_redes_in' => 'Linkedin',
			'rolo_redes_alt' => 'Outra rede',
			'rolo_role' => 'Cargo',
			'rolo_telefone' => 'Telefone',
			'rolo_telefone_alt' => 'Outro telefone',
			'rolo_uf' => 'UF',
			'rolo_update' => 'Atualizacao',
			'rolo_website' => 'Website',
			'rolo_year' => 'Ano de criacao',
			'caracterizacao' => 'Caracterização Institucional',
			'abrangencia' => 'Abrangencia da Atuação',
			'interesse' => 'Áreas de interesse',
			'participacao' => 'Espaços de participação',

			'rolo_conflito_check' => '(conflito) Está em conflito?',
			'rolo_conflito_projeto' => '(conflito) Qual Projeto?',
			'rolo_conflito_desde' => '(conflito) Desde',
			'rolo_conflito_instancia' => '(conflito) Instância',
			'rolo_conflito_equacionado' => '(conflito) Foi solucionado?',
			'rolo_conflito_observacoes' => '(conflito) Observações',

			'rolo_relacao_check' => '(relação) Participou de envento?',
			'rolo_relacao_local' => '(relação) Local',
			'rolo_relacao_apoio' => '(relação) Apoia o projeto?',
			'rolo_relacao_conflito' => '(relação) Histórico de conflito?'
		);	
	}

	update_option( 'rolo_import_dict', $dict );
	

}

function cp_uninstall_script($dir = false) {

   delete_option( 'rolo_import_dict' );

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
		<p><label><input type="checkbox" name="force_update" /> Sobrescrever valores existentes? </label></p>
		<p class="description">Apenas arquivos em formato .csv. <a href="<?php echo plugin_dir_url( __FILE__ ).'exemplo.csv'; ?>">Clique aqui para fazer download de um exemplo.</a></p>

		<p class="submit">
			<input type="submit" value="Fazer upload e cadastrar novos dados" class="button button-primary" id="submit" name="submit">
		</p>
	</form>	

	<div class="results">
		<h4>Resultados</h4>
		<?php 
			global $err;
		
				echo '<table class="dict"><fieldset><tr><th>ID</th><th>Nome</th><th>Email</th><th>Status</th></tr>';
				foreach ($err as $k) {
					echo "<tr>
							<td>".$k['ID']."</td>
							<td>".$k['Nome']."</td>
							<td>".$k['Email']."</td>
							<td>".$k['err']."</td>
						</tr>";
				}
				echo '</fieldset></table>';
			
		?>
	</div>

	<div class="dictionary">
		<h4>Dicionário do importador</h4>
		<p>A coluna da esquerda representa as chaves de armazenamento das informações no banco de dados.
			<br>Caso as colunas do arquivo de importação estejam nomeadas de forma diferente, altere primeiro os nomes aqui, antes de importar o arquivo.</p>
		<p>Informações em colunas sem nome serão ignoradas.</p>

		<?php 

			global $wpdb;
			// $r = $wpdb->get_results("SELECT DISTINCT meta_key FROM {$wpdb->prefix}postmeta WHERE meta_key LIKE 'rolo_%'");
			$dict = get_option( 'rolo_import_dict' );

			echo '<table class="dict"><fieldset><tr><th>Meta Key</th><th>Coluna no arquivo de importação</th></tr>';
			
			foreach ($dict as $key => $value) {
				// $d = $dict[$key->meta_key];   
				echo "<tr><td class='dict-key'>" . $key ."</td><td class='dict-item'>" . $value ."</td></tr>";
			}
			echo '</fieldset></table>';

			

		?>
		
	</div>
</div>
<?php
}

function cp_check_post() {

	if($_POST['download']) {
		cp_download_data_new($_POST);
		// cp_make_excel();
	} elseif($_POST['upload']) {
		return cp_upload_data($_POST, $_FILES);
	} else {
		return;
	}
}

function cp_download_data_new($tipo = false) {

	if(!$tipo)
		$tipo = array('conteudo' => 'tudo');

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
			'type' => implode(',', $types)
		));

	$dict = get_option( 'rolo_import_dict' );

	$master_keys = array_keys($dict);

	foreach($master_keys as $key) {
		$csv .= '"'.$dict[$key].'",';
	}
		$csv .= "\n";

	// Corre o array de resultados
	foreach ($export_data as $exp) {
		
		// Busca todos os metadados daquele resultado
		$exports = get_post_custom( $exp->ID );
		// Busca todos os metadados exportáveis daquele resultado
		$allterms = get_the_terms( $exp->ID, array( 'type','caracterizacao','abrangencia','interesse','participacao' ) );
		// Contato ou Entidade
		if( has_term( 'contact', 'type', $exp->ID ) ) {
			$tipo = 'contact';
			$tipoprint = 'Contato';
		} elseif ( has_term( 'company', 'type', $exp->ID ) ) {
			$tipo = 'company';
			$tipoprint = 'Entidade';
		} else {
			// Pula os registros sem essa informação
			continue;
		}

		// Separa todas as chaves para comparação com o dicionário
		// Passa por cada uma delas buscando correspondentes
		$exportkeys = array_keys($exports);	
		foreach($exportkeys as $key) {
			// Confere retira as mencoes a company e contact
			$mkey = str_replace( '_'.$tipo.'_', '_', $key );
			// Se a chave está presente no dicionario
			// Colocamos no na lista de resultados com a mesma chave numérica
			$srch = array_search($mkey, $master_keys);
			if( $srch ) {
				$values[$exp->ID][$srch] = $exports[$key][0];
			} 

		}
		// Não perder as colunas sem informação
		for($i=0;$i<count($master_keys);$i++) {
			if(!$values[$exp->ID][$i]) {
				$values[$exp->ID][$i] = '--';
			}
		}
		// Organizar na mesma ordem para imprimir
		ksort($values[$exp->ID], SORT_NUMERIC);

		// Ultima passada com as condicionais para imprimir os valores
		for($i=0;$i<count($master_keys);$i++) {

			$serial = @unserialize($values[$exp->ID][$i]);
			$original_key = $master_keys[$i];
			$bits = array();

			// Se o valor é uma string, imprime, senão começam os desafios:
			if(!$serial) {
				if('ID' == $original_key) {
					$csv .= '"'.$exp->ID.'",';	
				} elseif('name' == $original_key) {
					$csv .= '"'.$exp->post_title.'",';	
				} elseif('type' == $original_key) {
					$csv .= '"'.$tipoprint.'",';	
				} elseif (taxonomy_exists($original_key)) {
					$terms = get_the_terms( $exp->ID, $original_key );
					if($terms) {
						foreach($terms as $t)
							$bits[] = $t->name;	
					}
					$csv .= '"'.implode('|', $bits).'",';
				} else {
					$csv .= '"'.$values[$exp->ID][$i].'",';	
				}
				
			} else {
				
				switch ($original_key) {
					// Imprime os nomes e IDs dos contatos
					case 'rolo_contatos':
						foreach($serial as $s) {
							$user = get_post( $s );
							$bits[] = '('.$s.') ' . $user->post_title;
						}
						$csv .= '"'.implode('|', $bits).'",';
						break;
					default:
						$csv .= '"'.implode('|', $serial).'",';	
						break;
				}
			}
		}
		$csv .= "\n";
	}

    // Ordena pelo ID
	ksort($values, SORT_NUMERIC);
	
	// Substituições por segurança
	// retira virgulas do final das linhas
	// retira aspas duplicadas
	$csv = str_replace(",\n", "\n", $csv);
	$csv = str_replace('""', '"', $csv);

   	header('Content-type: text/csv');
   	header("Content-Disposition: attachment;filename=".time().".csv");

	$f = fopen('php://output', 'w');
	fwrite($f, $csv);
	fclose($f);
    exit;

}

function cp_upload_data($data, $files, $force_update = false) {

	global $err;

	$dict = get_option( 'rolo_import_dict' );

	//$dict['ID'] = 'ID';
	//$dict['type'] = 'TIPO';
	//$dict['name'] = 'NOME';
	//$dict['email'] = 'EMAIL';

	if($data['force_update'] == 'on')
		$force_update = true;

	$cont = file_get_contents($files['import_file']['tmp_name']); // Le o conteudo do arquivo

	$matches = array();
	$cont_ids = preg_match_all("/\n\"?\d+\"?/", $cont, $matches); // Busca os IDs de cada entrada
	$matches = str_replace("\n", '', $matches[0]); // Retira as qubras de linha
	$contarr = preg_split("/\n\"?\d+\"?/", $cont); // Finalmente separa tudo em linhas para cada nova entrada

	// Determinando os separadores
	$tabs = explode("\t",  $contarr[0]);
	$commas = explode(",", $contarr[0]);
	$pontos = explode(";", $contarr[0]);
	
	if(count($tabs) > 1){
		$separador = "\t";
	} elseif(count($commas) > 1){
		$separador = ",";
	} else {
		$separador = ";";
	}

 	// Separa os cabeçalhos em outra lista
	$headers = explode($separador, array_shift($contarr));
	
	
	// Monta o array de cabeçalhos correto, com as keys conforme o dicionário do banco
	for( $i = 0; $i < count($headers); $i++ ) {
		$k = str_replace('"', '', $headers[$i]);
		$k = array_search(strtolower($k), array_map('strtolower',$dict));

		// $postarr[$k] = ""; // keys preenchidas, values em branco
		$postarr[$i] = $k; // keys numericas, values preenchidos
	}

	require_once(dirname( __FILE__ ) . '/ForceUTF8/Encoding.php'); 
	
	$encoding = new Encoding();

	for( $i = 0; $i < count($contarr); $i++ ) {
		
		$utf8_string = $encoding::toUTF8($contarr[$i]);

		// Para cada nova entrada, separa os valores em um array
		$arr = explode($separador, $utf8_string);
		$arr = str_replace('"', '', $arr);
		
		$arr[0] = $matches[$i];

		if (count($postarr) != count($arr)) {
			if(count($arr) == 1 && $arr[0] == '')
				continue;

			$err[] = array('err' => 'Linha incompleta, a planilha tem '.count($postarr).' cabeçalhos e a entrada '.$arr[$i].' tem '.count($arr).' colunas');
			
		} else {		

			// Pega as keys corretas e combina com os valores oferecidos, 
			// agora temos tudo organizado para salvar no banco
			$comb = array_combine($postarr, $arr); 

			if($comb['type'] == 'Entidade') {
				$type = 'company';
				$email = 'rolo_company_email';
				$nome = 'rolo_company_name';
			} elseif($comb['type'] == 'Contato') {
				$type = 'contact';
				$email = 'rolo_contact_email';
				$nome = 'rolo_contact_first_name';
			}

			$caracterizacao = explode('|', $comb['caracterizacao']);
			$abrangencia = explode('|', $comb['abrangencia']);
			$interesse = explode('|', $comb['interesse']);
			$participacao = explode('|', $comb['participacao']);

			foreach($caracterizacao as $c) { $tax = term_exists( $c, 'caracterizacao' ); if($tax['term_id']) { $car[] = (int) $tax['term_id']; } }
			foreach($abrangencia as $c) { $tax = term_exists( $c, 'abrangencia' ); if($tax['term_id']) { $abr[] = (int) $tax['term_id']; } }
			foreach($interesse as $c) { $tax = term_exists( $c, 'interesse' ); if($tax['term_id']) { $int[] = (int) $tax['term_id']; } }
			foreach($participacao as $c) { $tax = term_exists( $c, 'participacao' ); if($tax['term_id']) { $prt[] = (int) $tax['term_id']; } }

			$newpost = array(
				'post_title' => $comb['name'],
				'post_date' => date( 'Y-m-d H:i:s',  time() ),
				'post_date_gmt' => gmdate( 'Y-m-d H:i:s',  time() ),
				'tax_input'	 => array(
						'type' => $type,
						'caracterizacao' => $car,
						'abrangencia' => $abr,
						'interesse' => $int,
						'participacao' => $prt
					)
				
				);

			// wp_die(dump($comb));

			global $wpdb;
			$check = $wpdb->get_results($wpdb->prepare(
					"SELECT ID FROM {$wpdb->prefix}posts INNER JOIN {$wpdb->prefix}postmeta ON {$wpdb->prefix}posts.ID = {$wpdb->prefix}postmeta.post_id WHERE {$wpdb->prefix}posts.post_title = %s AND {$wpdb->prefix}postmeta.meta_key = %s AND {$wpdb->prefix}postmeta.meta_value = %s", $comb['name'], $email, $comb['rolo_email']));

			$check_id = get_post($comb['ID']);

			// Confere se o post é duplicado e não pode ser reescrito
			if($check_id && !$force_update && $comb['ID'] != '0') {
				$err[] = array('ID' => $comb['ID'], 'Nome' => $comb['name'], 'Email' => $comb['email'], 'err' => 'Já existe um post com o ID inserido mas a opção forçar update está desmarcada');
			} elseif($check && !$force_update) {
				$err[] = array('ID' => $comb['ID'], 'Nome' => $comb['name'], 'Email' => $comb['email'], 'err' => 'Já existe uma entrada com esta combinação de nome / email mas a opção forçar update está desmarcada');
			} else {
				
				if($force_update) // se estamos forçando o update, devolve o ID para o array
					$newpost['ID'] = $comb['ID'];

				 $id = wp_insert_post($newpost, true);
				 
				// Confere se a inserção foi bem sucedida
				if(is_wp_error($id)) {
					$error_string = $id->get_error_message();
					$err[] = array('ID' => $comb['ID'], 'Nome' => $comb['name'], 'Email' => $comb['email'], 'err' => $error_string);
				} else {
					// Sem erros, vamos gravar os metas
					// Primeiro tiramos do array as partes que já foram gravadas
					unset($comb['ID']);
					// unset($comb['name']);
					
					foreach($comb as $key => $value) {

						if($key != 'rolo_uf' && $key != 'rolo_city' && $key != 'rolo_contact' && $key != 'rolo_relacao') {
							$key = str_replace('_', '_'.$type.'_', $key); // Separa as chaves de company e contact
						}

						if($key == 'name') {
							if($type == 'contact') {
								$ty = $type.'_first';
							} else {
								$ty = $type;
							}
						
							$key = 'rolo_'.$ty.'_'.$key; // Nomes corretos das chaves nome e email

						} elseif ($key == 'email') {
								$ty = $type;	
							$key = 'rolo_'.$ty.'_'.$key; // Nomes corretos das chaves nome e email
						}

						if($key == 'type')
							$value = $type; 
	
						if($value)
							update_post_meta( $id, $key, $value ); // Salvar somente colunas com conteudo

					}

					$err[] = array('ID' => $comb['ID'], 'Nome' => $comb['name'], 'Email' => $comb['email'], 'err' => 'Sucesso');
				}

				
			}

		}
	}

	return $err;

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
