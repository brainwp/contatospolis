<?php
/**
 * @package cp-alo-import-subscribers
 * @version 0.1
 */
/*
Plugin Name: Contatos Polis Importador de Assinantes / Mailing Lists
Description: Ferramenta para gerar Mailing Lists a partir dos cadastros do site Contatos Polis
Author: Brasa
Version: 0.1
Author URI: http://brasa.art.br/
*/

add_action( 'admin_head', 'cp_alo_check_list' );
add_action( 'admin_enqueue_scripts', 'cp_alo_admin_enqueue_scripts' );
add_action( 'wp_enqueue_scripts', 'cp_alo_enqueue_scripts' );
add_action( 'wp_ajax_nopriv_cp_alo_ajax_create_mailing', 'cp_alo_ajax_create_mailing' );
add_action( 'wp_ajax_cp_alo_ajax_create_mailing', 'cp_alo_ajax_create_mailing' );

function cp_alo_ajax_create_mailing() {

	$recp = $_POST['recipients'];

	$new_mailing_list = array('name' => array('pt' => 'Lista exportada em: '.date('d/m/Y G:i:s')), 'available' => 'admin', 'order' => 0);

	$lists = get_option('alo_em_mailinglists');
	$lists[] = $new_mailing_list;

	// Salva nova mailing list
	alo_em_save_mailinglists ( $lists );

	$listid = count($lists) - 1;

	foreach($recp as $r) {

		// Reune infos
		$sub = get_post($r);
		$email = get_post_meta($r, 'rolo_'.$type.'_email', true);
		$contato = has_term( 'Contact', 'type', $r );
		if($contato) { $type = 'contact'; } else { $type = 'company'; }

		// Cria o novo assinante
		$subs = array(
					'name' => $sub->post_title,
					'email' => $email
					//,
					//'join_date' => date('Y-m-d G:i:s'),
					//'active' => 1,
					//'lang' => 'pt'
				);

		// Pega o id pelo email
		$subscriber = alo_em_is_subscriber ( $email );
		if(!$subscriber && $email)
			$subscriber = alo_em_add_subscriber($subs, 1, 'pt');
		
		// Adiciona à lista
		$list = alo_em_add_subscriber_to_list ( $subscriber, $listid );
	}

	$response = array('lista' => $listid, 'redirect' => admin_url( '/post-new.php?post_type=newsletter&list='.$listid ));


	header( "Content-Type: application/json" );
	echo json_encode($response);
	exit;
}

function cp_alo_admin_enqueue_scripts() {
	
	wp_register_script( 'cp-alo-extrajs', plugin_dir_url( __FILE__ ) . '/cp-alo-extrajs.js', array('jquery'), false, true );	
	wp_enqueue_script( 'cp-alo-extrajs' );
}

function cp_alo_enqueue_scripts() {

	if(is_search() || !is_admin()) {
		wp_register_script( 'cp-alo-extrajs', plugin_dir_url( __FILE__ ) . '/cp-alo-extrajs.js', array('jquery'), false, true );	
		wp_enqueue_script( 'cp-alo-extrajs' );
	}
	
}

function cp_alo_check_list() {
	
	if($_GET['list']) {
		echo '<script>var listID = '.$_GET['list'].'</script>';
	}
		
		
}


	

?>
