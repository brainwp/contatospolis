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

add_action( 'pre_get_posts', 'rolo_search_filter_geral' );
add_action( 'pre_get_posts', 'rolo_search_filter_contact' );
add_action( 'pre_get_posts', 'rolo_search_filter_company' );
// add_action( 'loop_start', 'rolo_search_filter_company_extras' );

add_filter( 'posts_where', 'rolo_search_filter_name', 10, 2 );
 	
function rolo_search_filter_geral($query) {

	if($query->is_main_query() && $_POST['busca_publicos'] == 'geral') :

		$meta = array('relation' => 'OR');

		if( !empty( $_POST['busca_nome'] ) ) {
			// $query->query_vars['rolo_title'] = $_POST['busca_nome'];
		}

		if( !empty( $_POST['busca_municipio'] ) ) {
			$meta[] = array( 'value' => $_POST['busca_municipio'], 'key' => 'rolo_company_city' );
			$meta[] = array( 'value' => $_POST['busca_municipio'],  'key' => 'rolo_contact_city' );
		}

		if( !empty( $_POST['busca_uf'] ) && $_POST['busca_uf'] != 'todos') {
			$meta[] = array( 'value' => $_POST['busca_uf'], 'key' => 'rolo_company_uf' );
			$meta[] = array( 'value' => $_POST['busca_uf'],  'key' => 'rolo_contact_uf' );
		}

		// array_push($query->query_vars, (object) $meta_mun);
		// array_push($query->query_vars, (object) $meta_uf);

		// array_push($query->query_vars, new StdObj);
		$query->query_vars['meta_query'] = $meta;
		// $query->query_vars['meta_query'] = $meta_mun;

		// arra

		//dump($_POST);
		// dump($query->query_vars);

	endif;
}

function rolo_search_filter_contact($query) {

	if($query->is_main_query() && $_POST['busca_publicos'] == 'contact') :

		$meta = array('relation' => 'AND');

		if( !empty( $_POST['busca_nome'] ) ) {
			$query->query_vars['rolo_title'] = $_POST['busca_nome'];
		}

		if( !empty( $_POST['busca_municipio'] ) ) {
			$meta[] = array( 'value' => $_POST['busca_municipio'],  'key' => 'rolo_contact_city' );
		}

		if( !empty( $_POST['busca_uf'] ) && $_POST['busca_uf'] != 'todos') {
			$meta[] = array( 'value' => $_POST['busca_uf'],  'key' => 'rolo_contact_uf' );
		}

		if( !empty( $_POST['busca_cargo'] ) ) {
			$meta[] = array( 'value' => $_POST['busca_cargo'],  'key' => 'rolo_contact_role' );
		}		

		if( !empty( $_POST['busca_instituicao'] ) ) {
			$meta[] = array( 'value' => $_POST['busca_instituicao'],  'key' => 'rolo_contact_company' );
		}

		// array_push($query->query_vars, (object) $meta_mun);
		// array_push($query->query_vars, (object) $meta_uf);

		// array_push($query->query_vars, new StdObj);
		$query->query_vars['meta_query'] = $meta;
		// $query->query_vars['meta_query'] = $meta_mun;

		// arra

		// dump($_POST);
		// dump($query->query_vars);

	endif;
}

function rolo_search_filter_company($query) {

	if($query->is_main_query() && $_POST['busca_publicos'] == 'company') :

		$meta = array('relation' => 'AND');
		$tax = array('relation' => 'AND');

		if( !empty( $_POST['busca_nome'] ) ) {
			$query->query_vars['rolo_title'] = $_POST['busca_nome'];
		}

		if( !empty( $_POST['busca_municipio'] ) ) {
			$meta[] = array( 'value' => $_POST['busca_municipio'],  'key' => 'rolo_contact_city' );
		}

		if( !empty( $_POST['busca_uf'] ) && $_POST['busca_uf'] != 'todos') {
			$meta[] = array( 'value' => $_POST['busca_uf'],  'key' => 'rolo_contact_uf' );
		}

		if( !empty( $_POST['tax_input'] ) ) {

			if( !empty( $_POST['tax_input']['caracterizacao'] ) ) {
				$tax[] = array( 'terms' => $_POST['tax_input']['caracterizacao'],  'taxonomy' => 'caracterizacao', 'field' => 'id', 'operator' => 'AND' );
			}
			if( !empty( $_POST['tax_input']['abrangencia'] ) ) {
				$tax[] = array( 'terms' => $_POST['tax_input']['abrangencia'],  'taxonomy' => 'abrangencia', 'field' => 'id', 'operator' => 'AND' );
			}
			if( !empty( $_POST['tax_input']['interesse'] ) ) {
				$tax[] = array( 'terms' => $_POST['tax_input']['interesse'],  'taxonomy' => 'interesse', 'field' => 'id', 'operator' => 'AND' );
			}

			if( !empty( $_POST['tax_input']['impactos'] ) ) {
				// $tax[] = array( 'terms' => $_POST['tax_input']['interesse'],  'taxonomy' => 'interesse', 'field' => 'id', 'operator' => 'AND' );
			}
			if( !empty( $_POST['tax_input']['espacos'] ) ) {
				// $tax[] = array( 'terms' => $_POST['tax_input']['espacos']['',  'taxonomy' => 'interesse', 'field' => 'id', 'operator' => 'AND' );
			}			
			
		}		

		$query->query_vars['meta_query'] = $meta;
		$query->query_vars['tax_query'] = $tax;
		
		dump($_POST);
		// dump($query->query_vars);

	endif;
}

/*
function rolo_search_filter_company_extras($a) {
	
	if( !empty( $_POST['tax_input']['impactos'] ) ) {
		$qimp = true;
	}
	if( !empty( $_POST['tax_input']['espacos']['evento'] ) ) {
		$qeve = true;
	}
	if( !empty( $_POST['tax_input']['espacos']['apoio'] ) ) {
		$qapo = true;
	}

	foreach($a->posts as $p) {

		$conflito = get_post_meta( $p->ID, 'rolo_conflito', true );
		$relacao = get_post_meta( $p->ID, 'rolo_relacao', true );

		$confcheck = false; $partcheck = false; $divcheck = false;

		if($conflito) {
			
			if($conflito[0]) {
				$conf[] = $p->ID;
			}
		}

		if($relacao) {
			
			if($relacao[0]) {
				$eve[] = $p->ID;	
			}
			if($relacao[2]) {
				$div[] = $p->ID;	
			}
			
		}
	}

	dump($conf);
	dump($eve);
	dump($div);

}
*/

function rolo_search_filter_name( $where, &$wp_query )
{
    global $wpdb;
    if ( $rolo_title = $wp_query->get( 'rolo_title' ) ) {
        $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql( like_escape( $rolo_title ) ) . '%\'';
    }

    // dump($where);
    return $where;
}


endif;

?>

