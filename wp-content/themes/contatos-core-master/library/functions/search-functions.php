<?php
/**
 * Search Functions
 *
 * Functions used to render the search result
 *
 * @package RoloPress
 * @subpackage Functions
 */

if($_POST['rp_submit_busca']) :

// add_action( 'pre_get_posts', 'rolo_search_filter_geral' );
//add_action( 'pre_get_posts', 'rolo_search_filter_contact' );
//add_action( 'pre_get_posts', 'rolo_search_filter_company' );
 	
function rolo_search_filter_geral($query) {

	if($query->is_main_query() && $_POST['busca_publicos'] == 'geral') :

		$meta = array('relation' => 'OR');

		if($_POST['busca_nome']) {
			// $query->query_vars['s'] = 'teste';
		}

		if($_POST['busca_municipio']) {

			$meta_mun = array('relation' => 'OR');
				$m1 = array( 'value' => $_POST['busca_municipio'], 'key' => 'rolo_company_municipio' );
				$m2 = array( 'value' => $_POST['busca_municipio'],  'key' => 'rolo_contact_municipio' );

			array_push($meta_mun, $m1);
			array_push($meta_mun, $m2);
		}

		if($_POST['busca_uf']) {
			
			$meta_uf = array('relation' => 'OR');
				$uf1 = array( 'value' => $_POST['busca_uf'], 'key' => 'rolo_company_uf' );
				$uf2 = array( 'value' => $_POST['busca_uf'],  'key' => 'rolo_contact_uf' );

			array_push($meta_uf, $uf1);
			array_push($meta_uf, $uf2);
		}

		array_push($query->query_vars, $meta_mun);
		array_push($query->query_vars, $meta_uf);
		// $query->query_vars['meta_query'] = $meta;

		dump($_POST);
		dump($query);

	endif;
}



endif;

?>