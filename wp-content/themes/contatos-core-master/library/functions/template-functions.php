<?php
/**
 * Template Functions
 *
 * Contains template functions used in theme
 *
 * @package RoloPress
 * @subpackage Functions
 */
  
/**
 * Displays a summarized version of contact information
 *
 * @param int $contact_id
 * @return <type>
 *
 * @since 0.1
 */
function rolo_contact_header($contact_id) {
    if (!$contact_id) {
        return false;
    }

    $contact = get_post_meta($contact_id, 'rolo_contact');
    $contact = $contact[0];
?>
    <ul id="hcard-<?php echo basename(get_permalink());?>" class="item-header">

			<?php echo get_avatar (($contact['rolo_contact_email']),96, rolo_get_twitter_profile_image($contact['rolo_contact_twitter'], ROLOPRESS_IMAGES . "/icons/rolo-contact.jpg") );?>

			<li><a class="fn" href="<?php the_permalink();?>"><?php echo $contact['rolo_contact_first_name'] . ' ' . $contact['rolo_contact_last_name'];?></a></li>
			<li>
			<?php 
			if ($contact['rolo_contact_title'] != "") { ?>
				<span class="title" id="rolo_contact_title"><?php echo $contact['rolo_contact_title'];?></span><?php }
			if (get_the_term_list($contact_id, 'company') != "") { ?>
				<span class="org"><?php echo get_the_term_list($contact_id, 'company', ''); ?></span><?php }
			?>
            </li>
			<?php if ($contact['rolo_contact_email'] != "") { ?><li class="email url-field"><a class="email" href="mailto:<?php echo $contact['rolo_contact_email'];?>"><?php echo $contact['rolo_contact_email'];?> </a><span id="rolo_contact_email" class="edit-icon" style=""><?php echo $contact['rolo_contact_email']; ?></span></li><?php } ?>

			<?php rolopress_after_contact_header();?>
    </ul><!-- hcard -->
<?php
}

/**
 * Displays a contact detail information
 *
 * @param int $contact_id
 * @return <type>
 *
 * @since 0.1
 */
function rolo_contact_details($contact_id) {
    if (!$contact_id) {
        return false;
    }

    $contact = get_post_meta($contact_id, 'rolo_contact', true);
?>
    <form id="contact-form">
        <input type="hidden" name="rolo_post_id" id="rolo_post_id" value ="<?php echo $contact_id;?>" />
		<ul id="vcard-<?php echo basename(get_permalink());?>" class="vcard">

			<li class="vcard-export"><a class="url-field" href="http://h2vx.com/vcf/<?php the_permalink();?>"><span><?php _e('Export vCard', 'rolopress'); ?></span></a></li>
			
			<li class="fn"><?php echo $contact['rolo_contact_first_name'] . ' ' . $contact['rolo_contact_last_name'];?></li>
			
			<?php if ($contact['rolo_contact_title'] != "") { ?>
			<li class="title" id="rolo_contact_title"><?php echo $contact['rolo_contact_title'];?></li><?php }
			?>
			<?php if (get_the_term_list($contact_id, 'company') != "") { ?>
			<li class="org"><span class="value"><?php echo get_the_term_list($contact_id, 'company', ''); ?></span></li><?php }
			?>
				
			<?php $rolo_contact_full_address = $contact['rolo_contact_address'] . get_the_term_list($contact_id, 'city', '', '', '') . get_the_term_list($contact_id, 'state', '', '', '') . get_the_term_list($contact_id, 'zip', '', '', '') . get_the_term_list($contact_id, 'country', '', '', '');
				if ($rolo_contact_full_address != "") { ?>
				<li class="map"><a class="url-field" href="http://maps.google.com/maps?f=q&source=s_q&geocode=&q=<?php echo $contact['rolo_contact_address'] . " " . rolo_get_term_list($contact_id, 'city') . " " . rolo_get_term_list($contact_id, 'state') . " " . rolo_get_term_list($contact_id, 'country')  . " " . rolo_get_term_list($contact_id, 'zip');?> "><span><?php _e('Map', 'rolopress'); ?></span></a></li><?php }
			?>
									   
			<li>
				<ul class="adr group">
				<span class="type hide">Home</span><!-- certain hcard parsers need this -->
				<?php
					if ($contact['rolo_contact_address'] != "") { ?><li class="street-address" id="rolo_contact_address"><?php echo $contact['rolo_contact_address']; ?></li><?php }
                    if (get_the_term_list($contact_id, 'city', '', '', '') != "") { ?><li class="url-field"><span class="type"><?php _e('City', 'rolopress'); ?></span><?php echo get_the_term_list($contact_id, 'city', '', '', '');?><span id="city" class="locality edit-icon" style=""><?php echo rolo_get_term_list($contact_id, 'city'); ?></span></li><?php }
					if (get_the_term_list($contact_id, 'state', '', '', '') != "") { ?><li class="url-field"><span class="type"><?php _e('State', 'rolopress'); ?></span><?php echo get_the_term_list($contact_id, 'state', '', '', '');?><span id="state" class="region edit-icon" style=""><?php echo rolo_get_term_list($contact_id, 'state'); ?></span></li><?php }
                    if (get_the_term_list($contact_id, 'zip', '', '', '') != "") { ?><li class="url-field"><span class="type"><?php _e('Zip', 'rolopress'); ?></span><?php echo get_the_term_list($contact_id, 'zip', '', '', '');?></a><span id="zip" class="postal-code edit-icon" style=""><?php echo rolo_get_term_list($contact_id, 'zip'); ?></span></li><?php }
                    if (get_the_term_list($contact_id, 'country', '', '', '') != "") { ?><li class="url-field"><span class="type"><?php _e('Country', 'rolopress'); ?></span><?php echo get_the_term_list($contact_id, 'country', '', '', '');?><span id="country" class="country-name edit-icon" style=""><?php echo rolo_get_term_list($contact_id, 'country'); ?></span></li><?php }
				?>
				</ul>
			</li>
			
			<?php if ($contact['rolo_contact_email'] != "") { ?><li class="email-address url-field group"><a class="email" href="mailto:<?php echo $contact['rolo_contact_email'];?>"><?php echo $contact['rolo_contact_email'];?> </a><span id="rolo_contact_email" class="edit-icon" style=""><?php echo $contact['rolo_contact_email']; ?></span></li><?php } ?>
            <li>
				<ul class="tel group">
				<?php
					if ($contact['rolo_contact_phone_Mobile'] != "") { ?><li class="tel tel-mobile"><span class="type"><?php _e('Mobile', 'rolopress'); ?></span>: <span class="value" id="rolo_contact_phone_Mobile"><?php echo $contact['rolo_contact_phone_Mobile']; ?></span></li> <?php }
					if ($contact['rolo_contact_phone_Home'] != "") { ?><li class="tel tel-home"><span class="type"><?php _e('Home', 'rolopress'); ?></span>: <span class="value" id="rolo_contact_phone_Home"><?php echo $contact['rolo_contact_phone_Home']; ?></span></li><?php }
					if ($contact['rolo_contact_phone_Work'] != "") { ?><li class="tel tel-work"><span class="type"><?php _e('Work', 'rolopress'); ?></span>: <span class="value" id="rolo_contact_phone_Work"><?php echo $contact['rolo_contact_phone_Work']; ?></span></li><?php }
					if ($contact['rolo_contact_phone_Fax'] != "") { ?><li class="tel tel-fax"><span class="type"><?php _e('Fax', 'rolopress'); ?></span>: <span class="value" id="rolo_contact_phone_Fax"><?php echo $contact['rolo_contact_phone_Fax']; ?></span></li><?php }
					if ($contact['rolo_contact_phone_Other'] != "") { ?><li class="tel tel-other"><span class="type"><?php _e('Other', 'rolopress'); ?></span>: <span class="value" id="rolo_contact_phone_Other"><?php echo $contact['rolo_contact_phone_Other']; ?></span></li><?php }
				?>
                </ul>
            </li>
            <li>
                <ul class="im social group">
				<?php
					if ($contact['rolo_contact_im_Yahoo'] != "") { ?><li class="social social-yahoo url-field"><span class="type"><?php _e('Yahoo', 'rolopress'); ?></span> <a class="yahoo" href="ymsgr:sendIM?<?php echo $contact['rolo_contact_im_Yahoo']; ?>"><?php echo $contact['rolo_contact_im_Yahoo']; ?></a><span id="rolo_contact_im_Yahoo" class="edit-icon" style=""><?php echo $contact['rolo_contact_im_Yahoo']; ?></span></li><?php }
					if ($contact['rolo_contact_im_MSN'] != "") { ?><li class="social social-msn url-field"><span class="type"><?php _e('MSN', 'rolopress'); ?></span> <a class="msn" href="msnim:chat?contact=<?php echo $contact['rolo_contact_im_MSN']; ?>"><?php echo $contact['rolo_contact_im_MSN']; ?></a><span id="rolo_contact_im_MSN" class="edit-icon" style=""><?php echo $contact['rolo_contact_im_MSN']; ?></span></li><?php }
					if ($contact['rolo_contact_im_AOL'] != "") { ?><li class="social social-aim url-field"><span class="type"><?php _e('AIM', 'rolopress'); ?></span> <a class="aim" href="aim:goIM?<?php echo $contact['rolo_contact_im_AOL']; ?>"><?php echo $contact['rolo_contact_im_AOL']; ?></a><span id="rolo_contact_im_AOL" class="edit-icon" style=""><?php echo $contact['rolo_contact_im_AOL']; ?></span></li><?php }
					if ($contact['rolo_contact_im_GTalk'] != "") { ?><li class="social social-gtalk url-field"><span class="type"><?php _e('GTalk', 'rolopress'); ?></span> <a class="gtalk" href="gtalk:chat?jid=<?php echo $contact['rolo_contact_im_GTalk']; ?>"><?php echo $contact['rolo_contact_im_GTalk']; ?></a><span id="rolo_contact_im_GTalk" class="edit-icon" style=""><?php echo $contact['rolo_contact_im_GTalk']; ?></span></li><?php }
					if ($contact['rolo_contact_im_Skype'] != "") { ?><li class="social social-skype url-field"><span class="type"><?php _e('Skype', 'rolopress'); ?></span> <a class="skype" href="skype:=<?php echo $contact['rolo_contact_im_Skype']; ?>"><?php echo $contact['rolo_contact_im_Skype']; ?></a><span id="rolo_contact_im_Skype" class="edit-icon" style=""><?php echo $contact['rolo_contact_im_Skype']; ?></span></li><?php }
					if ($contact['rolo_contact_twitter'] != "") { ?><li class="social social-twitter url-field"><span class="type"><?php _e('Twitter', 'rolopress'); ?></span> <a class="twitter" href="http://www.twitter.com/<?php echo $contact['rolo_contact_twitter']; ?>"><?php echo $contact['rolo_contact_twitter']; ?></a><span id="rolo_contact_twitter" class="edit-icon" style=""><?php echo $contact['rolo_contact_twitter']; ?></span></li><?php }
				?>
                </ul>
            </li>
				<?php if ($contact['rolo_contact_website'] != "") { ?><li class="website url-field group"><span class="type"><?php _e('Website', 'rolopress'); ?></span><a class="url" href="http://<?php echo $contact['rolo_contact_website']; ?>"><?php echo $contact['rolo_contact_website']; ?></a><span id="rolo_contact_website" class="edit-icon" style=""><?php echo $contact['rolo_contact_website']; ?></span></li><?php } ?>
				
				<?php if ($contact['rolo_contact_post_tag'] != "" ) { ?>
						<li class="tags url-field"><span class="type"><?php _e('Tags', 'rolopress');?></span>
							<?php $post_tags = get_the_tags();
							$tag_list = '';
							$i = 0;
							foreach ( $post_tags as $pt ) {
								$tag_list .= $pt->name;
								if ( $i+1<sizeof($post_tags) )
								$tag_list	.= ', ';
								$i++;
							}
							$tag_links	= get_the_term_list($cid, 'post_tag', '', ',','');
							$tag_links	= explode(', ', $tag_links );
							?>
							
							<ul class="tags group">
								<?php foreach ( $tag_links as $i=>$tag ): ?>
										<li class="url-field">
											<?php echo $tag; ?>
											<?php if ($i+1==sizeof($tag_links)): ?>
											<span id="post_tag" class="edit-icon" style=""><?php echo $tag_list; ?></span>
											<?php endif; ?>
										</li>
								<?php if ($i+1<sizeof($tag_links)): echo ', '; endif ?>
								<?php endforeach; ?>
							</ul>
				<?php } ?>
</li>		
				
				<?php rolopress_after_contact_details();?>
        </ul><!-- vcard -->
    </form>
<?php
}

/**
 * Displays a summarized version of company information
 *
 * @param <type> $company_id
 * @return <type>
 *
 * @since 0.1
 */
function rolo_company_header($company_id) {

    if (!$company_id) {
        return false;
    }

    // $company = get_post_meta($company_id, 'rolo_company', true);
    $company = get_post_custom($company_id);

    

    $company_name = $company['rolo_company_name'][0];
    $company_year = $company['rolo_company_year'][0];
    $company_legal = $company['rolo_company_legal'][0];
    $company_email = $company['rolo_company_email'][0];
    $company_website = $company['rolo_company_website'][0];
    
    $company_source = $company['rolo_company_source'][0];
    $company_tags = $company['rolo_company_post_tag'][0];
    $company_others = $company['rolo_company_others'][0];
    $company_address = $company['rolo_company_address'][0];
    $company_phone = $company['rolo_company_phone'][0];

    $company_redes = unserialize($company['rolo_company_redes'][0]);

    if($company_redes) {	
    foreach ($company_redes as $key => $value) {
    	if($value) {
    		$redes .= $key . '.com/' . $value . '<br>';
    	}
    }
    }

	$company_tel = $company['rolo_company_telefone'][0];
    $company_end = $company['rolo_company_endereco'][0];

    $company_contato = $company['rolo_company_contato_facil'][0];

    $company_update = get_the_time( 'd/m/Y', $company_id );
    
	$post_id = get_post($post->ID); // get current company id
    $slug = $post_id->post_name; // define slug as $slug

    $company_contatos = unserialize($company['rolo_contatos'][0]);

?>
    <div id="hcard-<?php echo basename(get_permalink());?>" class="item-header">

             <a class="fn"
                <?php if (is_single()) : // show proper links on single or archive company pages ?>
                    href="<?php echo get_term_link($company_name, 'company'); ?>"><?php echo $company_name;?>
                <?php else: ?>
                    href="<?php the_permalink();?>"><?php echo $company_name;?>
                <?php endif;?>
            </a>
			
			<div class="item-image">
			<?php echo get_avatar (($company_email),96, rolo_get_twitter_profile_image($company_twitter, ROLOPRESS_IMAGES . "/icons/rolo-company.jpg"));?>
			</div>
			<div class="item-col-1">
				<div class="ano"><span class="title"><?php _e('Ano de Criação ', 'rolopress'); ?></span><span id="rolo_company_year" class="resposta <?php echo ($company_year ? '' : 'vazio'); ?>"><?php echo $company_year; ?></span></div>
				<div class="legal"><span class="title"><?php _e('Constituída Legalmente? ', 'rolopress'); ?></span><span id="rolo_company_legal" class="resposta <?php echo ($company_legal ? '' : 'vazio'); ?>"><?php echo $company_legal; ?></span></div>
				<div class="obs"><span class="title"><?php _e('Observações ', 'rolopress'); ?></span><span id="rolo_company_others" class="resposta <?php echo ($company_others ? '' : 'vazio'); ?>"><?php echo $company_others; ?></span></div>
				<div class="data"><span class="title"><?php _e('Data das Informações ', 'rolopress'); ?></span><span id="rolo_company_update" class="resposta <?php echo ($company_update ? '' : 'vazio'); ?>"><?php echo $company_update; ?></span></div>
			</div>
			<div class="item-col-2">
				<div class="email url-field"><span class="title"><?php _e('E-mail ', 'rolopress'); ?></span><span id="rolo_company_email" class="resposta <?php echo ($company_email ? '' : 'vazio'); ?>"><a class="email" href="mailto:<?php echo $company_email;?>"><?php echo $company_email;?> </a></span></div>
				<div class="endereco"><span class="title"><?php _e('Endereço ', 'rolopress'); ?></span><span id="rolo_company_endereco" class="resposta <?php echo ($company_end ? '' : 'vazio'); ?>"><?php echo $company_end; ?></span></div>
				<div class="telefone"><span class="title"><?php _e('Telefone ', 'rolopress'); ?></span><span id="rolo_company_telefone" class="resposta <?php echo ($company_tel ? '' : 'vazio'); ?>"><?php echo $company_tel;?></span></div>
				<div class="website url-field group"><span class="title"><?php _e('Website ', 'rolopress'); ?></span><span id="rolo_company_website" class="resposta <?php echo ($company_website ? '' : 'vazio'); ?>"><a class="url" href="http://<?php echo $company_website; ?>"><?php echo $company_website; ?></a></span></div>
				<div class="redes"><span class="title"><?php _e('Redes Sociais ', 'rolopress'); ?></span><span id="rolo_company_redes" class="resposta <?php echo ($redes ? '' : 'vazio'); ?>"><?php echo $redes; ?></span></div>
				<div class="contato"><span class="title"><?php _e('Forma mais fácil de contactar ', 'rolopress'); ?></span><span id="rolo_company_contato_facil" class="resposta <?php echo ($company_contato ? '' : 'vazio'); ?>"><?php echo $company_contato; ?></span></div>
			</div>
			<hr>
			<div class="contatos">
				<table>
					<tr>
						<th></th>
						<th>Contatos</th>
						<th>Cargo</th>
						<th>Telefone</th>
						<th>E-mail</th>
					</tr>
				<?php 
                                        if($company_contatos) {
					foreach($company_contatos as $contato) {

						$user = get_post( $contato );

						if(has_term( 'Contact', 'type', $user )) { ?>

							<tr>
								<td><button>+</button></td>
								<td><?php echo $user->post_title; ?></td>
								<td><?php echo get_post_meta( $user->ID, 'rolo_contato_cargo', true ); ?></td>
								<td><?php echo get_post_meta( $user->ID, 'rolo_contato_telefone', true ); ?></td>
								<td><?php echo get_post_meta( $user->ID, 'rolo_contato_email', true ); ?></td>
							</tr>

							
						<?php }
						

					}
                                        }
					/*
				?>
							<tr>
								<td><button>+</button></td>
								<td colspan="4" class="insertname"><input type="text" ></td>
							</tr>

							*/ ?>
				</table>
			</div>
			<hr>
			<div class="taxonomias">
				<div class="item-col-1">
					<?php 
						require_once(ABSPATH . 'wp-admin/includes/template.php');
						
						echo '<div class="caracterizacao">';
							echo '<h3>Caracterização institucional</h3>';
							wp_terms_checklist( $company_id, array( 'taxonomy' => 'caracterizacao', 'checked_ontop' => false ) );
						echo '</div>';
						echo '<div class="interesse">';
							echo '<h3>Áreas de interesse</h3>';
							wp_terms_checklist( $company_id, array( 'taxonomy' => 'interesse', 'checked_ontop' => false ) );
						echo '</div>';
					?>
				</div>
				<div class="item-col-2">
					<?php
						echo '<div class="abrangencia">';
							echo '<h3>Abrangência da atuação</h3>';
							wp_terms_checklist( $company_id, array( 'taxonomy' => 'abrangencia', 'checked_ontop' => false ) );
						echo '</div>';
						echo '<div class="participacao">';
							echo '<h3>Espaços de participação</h3>';
							wp_terms_checklist( $company_id, array( 'taxonomy' => 'participacao', 'checked_ontop' => false ) );
						echo '</div>';
					?>
				</div>
			</div>
			<hr>
			<div class="impactos">
				<div class="item-col-1">
					<h3>Impactos Socioambientais</h3>
					<?php 
						$company_conflito = unserialize($company['rolo_conflito'][0]); 
						$checked = ''; if($company_conflito[0]) { $checked = 'checked="checked"'; }
						$projeto = ''; if($company_conflito[1]) { $projeto = $company_conflito[1]; }
						$desde = ''; if($company_conflito[2]) { $desde = $company_conflito[2]; }
						$instancia = ''; if($company_conflito[3]) { $instancia = $company_conflito[3]; }
						$fim = ''; if($company_conflito[4]) { $fim = 'checked="checked"'; }
						$obs = ''; if($company_conflito[5]) { $obs = $company_conflito[5]; }						
					?>

					<div><span class="title">Encontra-se em situação de conflito com grandes projetos e/ou áreas de proteção ambiental?</span><span id="rolo_conflito" class="resposta"> <input type="checkbox" <?php echo $checked; ?> /> Sim</span></div>
					<div><span class="title">Qual projeto?</span><span id="rolo_conflito" class="resposta <?php echo ($projeto ? '' : 'vazio'); ?>"><?php echo $projeto; ?></span></div>
					<div><span class="title">Desde quando isso ocorre?</span><span id="rolo_conflito" class="resposta <?php echo ($desde ? '' : 'vazio'); ?>"><?php echo $desde; ?></span></div>
					<div><span class="title">O caso foi levado a alguma instância?</span><span id="rolo_conflito" class="resposta <?php echo ($instancia ? '' : 'vazio'); ?>"><?php echo $instancia; ?></span></div>
					<div><span class="title">A situação foi equacionada?</span><span id="rolo_conflito" class="resposta"> <input type="checkbox" <?php echo $fim; ?>/> Sim</span></div>
					<div><span class="title">Outras observações relativas ao caso em questão</span><span id="rolo_conflito" class="resposta <?php echo ($obs ? '' : 'vazio'); ?>"><?php echo $obs; ?></span></div>
				</div>
				<div class="item-col-2">
					<h3>Relação com o projeto Litoral Sustentável</h3>
					<?php 
						$company_relacao = unserialize($company['rolo_relacao'][0]); 
						$checked = ''; if($company_relacao[0]) { $checked = 'checked="checked"'; }
						$local = ''; if($company_relacao[1]) { $local = $company_relacao[1]; }
						$apoio = ''; if($company_relacao[2]) { $apoio = 'checked="checked"'; }
						$conflito = ''; if($company_relacao[3]) { $conflito = $company_relacao[3]; }
					?>
					<div><span class="title">Participou de algum evento do projeto?</span><span id="rolo_relacao" class="resposta"> <input type="checkbox" <?php echo $checked; ?> /> Sim</span></div>
					<div><span class="title">Local</span><span id="rolo_relacao" class="resposta <?php echo ($local ? '' : 'vazio'); ?>"><?php echo $local; ?></span></div>
					<div><span class="title">Tem apoiado/divulgado o projeto?</span><span id="rolo_relacao" class="resposta"> <input type="checkbox" <?php echo $apoio; ?> /> Sim</span></div>
					<div><span class="title">Tem algum histórico de conflito com o projeto? Qual motivo?</span><span id="rolo_relacao" class="resposta <?php echo ($conflito ? '' : 'vazio'); ?>"><?php echo $conflito; ?></span></div>
				</div>
			</div>
			<?php rolopress_after_company_header();?>
    </div><!-- hcard -->
<?php
}


/**
 * Displays company detail information
 *
 * @param int $company_id
 * @return <type>
 *
 * @since 0.1
 */
function rolo_company_details($company_id) {
    if (!$company_id) {
        return false;
    }

    $company = get_post_meta($company_id, 'rolo_company', true);
    $slug = $post_id->post_name; // define slug as $slug
//    print_r($company);
?>
    <form id="company-form">
        <input type="hidden" name="rolo_post_id" id="rolo_post_id" value ="<?php echo $company_id;?>" />
		<ul id="vcard-<?php basename(get_permalink());?>" class="vcard">

		<li class="vcard-export"><a class="url-field" href="http://h2vx.com/vcf/<?php the_permalink();?>"><span><?php _e('Export vCard', 'rolopress'); ?></span></a></li>
		
			<li>
                 <a class="fn org"
                    <?php if (is_single()) : // show proper links on single or archive company pages ?>
                        href="<?php echo get_term_link($company['rolo_company_name'], 'company'); ?>"><?php echo $company['rolo_company_name'];?>
                    <?php else: ?>
                        href="<?php the_permalink();?>"><?php echo $company['rolo_company_name'];?>
                    <?php endif;?>
                </a>
			</li>
	               
			<?php $rolo_company_full_address = $company['rolo_company_address'] . get_the_term_list($company_id, 'city', '', '', '') . get_the_term_list($company_id, 'state', '', '', '') . get_the_term_list($company_id, 'zip', '', '', '') . get_the_term_list($company_id, 'country', '', '', '');
				if ($rolo_company_full_address != "") { ?>
					<li class="map"><a class="url" href="http://maps.google.com/maps?f=q&source=s_q&geocode=&q=<?php echo $company['rolo_company_address'] . " " . rolo_get_term_list($company_id, 'city') . " " . rolo_get_term_list($company_id, 'state') . " " . rolo_get_term_list($company_id, 'country')  . " " . rolo_get_term_list($company_id, 'zip');?> "><span><?php _e('Map', 'rolopress'); ?></span></a></li><?php }
			?>
		
			<li>
				<ul class="adr group">
				<span class="type hide">Work</span><!-- certain hcard parsers need this -->
				<?php
					if ($company['rolo_company_address'] != "") { ?><li class="street-address" id="rolo_company_address"><?php echo $company['rolo_company_address']; ?></li><?php }
                   	if (get_the_term_list($company_id, 'city', '', '', '') != "") { ?><li class="url-field"><span class="type"><?php _e('City', 'rolopress'); ?></span><?php echo get_the_term_list($company_id, 'city', '', '', '');?><span id="city" class="locality edit-icon" style=""><?php echo rolo_get_term_list($company_id, 'city'); ?></span></li><?php }
                    if (get_the_term_list($company_id, 'city', '', '', '') != "") { ?><li class="url-field"><span class="type"><?php _e('State', 'rolopress'); ?></span><?php echo get_the_term_list($company_id, 'state', '', '', '');?><span id="state" class="region edit-icon" style=""><?php echo rolo_get_term_list($company_id, 'state'); ?></span></li><?php }
                    if (get_the_term_list($company_id, 'city', '', '', '') != "") { ?><li class="url-field"><span class="type"><?php _e('Zip', 'rolopress'); ?></span><?php echo get_the_term_list($company_id, 'zip', '', '', '');?></a><span id="zip" class="postal-code edit-icon" style=""><?php echo rolo_get_term_list($company_id, 'zip'); ?></span></li><?php }
                    if (get_the_term_list($company_id, 'city', '', '', '') != "") { ?><li class="url-field"><span class="type"><?php _e('Country', 'rolopress'); ?></span><?php echo get_the_term_list($company_id, 'country', '', '', '');?><span id="country" class="country-name edit-icon" style=""><?php echo rolo_get_term_list($company_id, 'country'); ?></span></li><?php }
				?>
				
				</ul>
			</li>


            <?php if ($company['rolo_company_email'] != "") { ?><li class="email-address url-field"><a class="email" href="mailto:<?php echo $company['rolo_company_email'];?>"><?php echo $company['rolo_company_email'];?></a><span id="rolo_company_email" class="edit-icon" style=""><?php echo $company['rolo_company_email']; ?></span></li><?php } ?>

            <li>
                <ul class="tel group">
				<?php
					if ($company['rolo_company_phone_Mobile'] != "") { ?><li class="tel tel-mobile"><span class="type"><?php _e('Mobile', 'rolopress'); ?></span>: <span class="value" id="rolo_company_phone_Mobile"><?php echo $company['rolo_company_phone_Mobile']; ?></span></li><?php }
                    if ($company['rolo_company_phone_Work'] != "") { ?><li class="tel tel-work"><span class="type"><?php _e('Work', 'rolopress'); ?></span>: <span class="value" id="rolo_company_phone_Work"><?php echo $company['rolo_company_phone_Work']; ?></span></li><?php }
                    if ($company['rolo_company_phone_Fax'] != "") { ?><li class="tel tel-fax"><span class="type"><?php _e('Fax', 'rolopress'); ?></span>: <span class="value" id="rolo_company_phone_Fax"><?php echo $company['rolo_company_phone_Fax']; ?></span></li><?php }
                    if ($company['rolo_company_phone_Other'] != "") { ?><li class="tel tel-other"><span class="type"><?php _e('Other', 'rolopress'); ?></span>: <span class="value" id="rolo_company_phone_Other"><?php echo $company['rolo_company_phone_Other']; ?></span></li><?php }
				?>
                </ul>
            </li>

            <li>
                <ul class="im social group">
				<?php
					if ($company['rolo_company_im_Yahoo'] != "") { ?><li class="social social-yahoo url-field"><span class="type"><?php _e('Yahoo', 'rolopress'); ?></span>: <a class="yahoo" href="ymsgr:sendIM?<?php echo $company['rolo_company_im_Yahoo']; ?>"><?php echo $company['rolo_company_im_Yahoo']; ?></a><span id="rolo_company_im_Yahoo" class="edit-icon" style=""><?php echo $company['rolo_company_im_Yahoo']; ?></span></li><?php }
                    if ($company['rolo_company_im_MSN'] != "") { ?><li class="social social-msn url-field"><span class="type"><?php _e('MSN', 'rolopress'); ?></span>: <a class="msn" href="msnim:chat?company=<?php echo $company['rolo_company_im_MSN']; ?>"><?php echo $company['rolo_company_im_MSN']; ?></a><span id="rolo_company_im_MSN" class="edit-icon" style=""><?php echo $company['rolo_company_im_MSN']; ?></span></li><?php }
                    if ($company['rolo_company_im_AIM'] != "") { ?><li class="social social-aim url-field"><span class="type"><?php _e('AIM', 'rolopress'); ?></span>: <a class="aim" href="aim:goIM?<?php echo $company['rolo_company_im_AOL']; ?>"><?php echo $company['rolo_company_im_AOL']; ?></a><span id="rolo_company_im_AOL" class="edit-icon" style=""><?php echo $company['rolo_company_im_AOL']; ?></span></li><?php }
                    if ($company['rolo_company_im_GTalk'] != "") { ?><li class="social social-gtalk url-field"><span class="type"><?php _e('GTalk', 'rolopress'); ?></span>: <a class="gtalk" href="gtalk:chat?jid=<?php echo $company['rolo_company_im_GTalk']; ?>"><?php echo $company['rolo_company_im_GTalk']; ?></a><span id="rolo_company_im_GTalk" class="edit-icon" style=""><?php echo $company['rolo_company_im_Yahoo']; ?></span></li><?php }
					if ($company['rolo_company_twitter'] != "") { ?><li class="social social-twitter url-field"><span class="type"><?php _e('Twitter', 'rolopress'); ?></span> <a class="twitter" href="http://www.twitter.com/<?php echo $company['rolo_company_twitter']; ?>"><?php echo $company['rolo_company_twitter']; ?></a><span id="rolo_company_twitter" class="edit-icon" style=""><?php echo $company['rolo_company_twitter']; ?></span></li><?php }
				?>
                </ul>
            </li>

    		<?php if ($company['rolo_company_website'] != "") { ?><li class="website url-field group"><span class="type"><?php _e('Website', 'rolopress'); ?></span> <a class="url" href="http://<?php echo $company['rolo_company_website']; ?>"><?php echo $company['rolo_company_website']; ?></a><span id="rolo_company_website" class="edit-icon" style=""><?php echo $company['rolo_company_website']; ?></span></li><?php } ?>
			
			<?php if ($company['rolo_company_post_tag'] != "" ) { ?>
				<li class="tags url-field"><span class="type"><?php _e('Tags', 'rolopress');?></span>
					<?php $post_tags = get_the_tags();
					$tag_list = '';
					$i = 0;
					foreach ( $post_tags as $pt ) {
						$tag_list	.= $pt->name;
						if ( $i+1<sizeof($post_tags) )
						$tag_list	.= ', ';
						$i++;
					}
					$tag_links	= get_the_term_list($cid, 'post_tag', '', ', ');
					$tag_links	= explode(', ', $tag_links );
					?>
					
				<ul class="tags group">
					<?php foreach ( $tag_links as $i=>$tag ): ?>
						<li class="url-field">
							<?php echo $tag; ?>
							<?php if ($i+1==sizeof($tag_links)): ?>
								<span id="post_tag" class="edit-icon" style=""><?php echo $tag_list; ?></span>
							<?php endif; ?>
						</li>
			
				<?php if ($i+1<sizeof($tag_links)): echo ', '; endif ?>
					<?php endforeach; ?>
				</ul>
			<?php } ?>

</li>
			
			
			
			
			<?php rolopress_after_company_details();?>
    </ul><!-- vcard -->
    </form>
<?php
}

/**
 *
 * @param <type> $post_id
 * @param <type> $taxonomy
 * @return <type>
 *
 * @since 1.0
 */
function rolo_get_term_list($post_id, $taxonomy) {
    $actual_terms = array();
    $terms = get_the_terms($post_id, $taxonomy);
    if (is_array($terms)) {
        foreach ( $terms as $term ) {
            $actual_terms[] = $term->name;
        }
    }
    return join(',' , $actual_terms);
}

/**
 * Get contact url
 * @param <type> $contact_id
 * @return <type>
 */
function rolo_contact_url($contact_id) {
    return get_permalink($contact_id);
}

/**
 * Get contact full name
 * @param <type> $contact_id
 * @return <type>
 */
function rolo_contact_name($contact_id) {
    return apply_filters('rolo_contact_name', rolo_contact_first_name($contact_id) . ' ' . rolo_contact_last_name($contact_id) );
}

/**
 * Get contact first name
 * @param <type> $contact_id
 * @return <type>
 */
function rolo_contact_first_name($contact_id) {
    return _rolo_get_field($contact_id, 'first_name');
}

/**
 * Get contact last name
 * @param <type> $contact_id
 * @return <type>
 */
function rolo_contact_last_name($contact_id) {
    return _rolo_get_field($contact_id, 'last_name');
}

/**
 * Get contact email link
 * @param <type> $contact_id
 * @return <type>
 */
function rolo_contact_email_link($contact_id) {
    return apply_filters('rolo_email_link', 'mailto:' . _rolo_get_field($contact_id, 'email'));
}

/**
 * Get contact email
 * @param <type> $contact_id
 * @return <type>
 */
function rolo_contact_email($contact_id) {
    return _rolo_get_field($contact_id, 'email');
}

/**
 * Get contact mobile phone
 * @param <type> $contact_id
 * @return <type>
 */
function rolo_contact_mobile_phone($contact_id) {
    return _rolo_get_field($contact_id, 'mobile_phone');
}

/**
 * Get contact home phone
 * @param <type> $contact_id
 * @return <type>
 */
function rolo_contact_home_phone($contact_id) {
    return _rolo_get_field($contact_id, 'home_phone');
}

/**
 * Get contact work Phone
 * @param <type> $contact_id
 * @return <type>
 */
function rolo_contact_work_phone($contact_id) {
    return _rolo_get_field($contact_id, 'work_phone');
}

/**
 * Get contact fax
 * @param <type> $contact_id
 * @return <type>
 */
function rolo_contact_fax($contact_id) {
    return _rolo_get_field($contact_id, 'fax');
}

/**
 * Photo url
 * @param <type> $contact_id
 * @return <type>
 */
function rolo_contact_photo_url($contact_id) {
    return _rolo_get_field($contact_id, 'image_path');
}

/**
 * Private function used to retrieve the contact field value from custom fields
 * @global array $contact_fields
 * @param string $post_id Post whose custom field to be retrieved
 * @param string $field_name The custom field name
 * @return <type>
 */
function _rolo_get_field($post_id, $field_name) {
    global $contact_fields;
    
    //TODO The meta key should also be stored in the contact fields array
    $value = get_post_meta($post_id, $contact_fields[$field_name]['name'] . '_rolo_value', true);
    $value = ($value == "") ? $contact_fields[$field_name]['std'] : $value;
    return apply_filters($contact_fields[$field_name]['filter'], $value);
}

function wt_get_ID_by_page_name($page_name) {
	global $wpdb;
	$page_name_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".$page_name."'");
	return $page_name_id;
}


/**
 * Identifies taxonomy type
 *
 * Use to identify the item type and do something.
 * Example: if ( rolo_type_is( 'contact' ) ) { do something }	
 *
 * @credits: Justin Tadlock: http://wordpress.org/support/topic/281899
 */
function rolo_type_is( $type, $_post = null ) {
	if ( empty( $type ) )
		return false;

	if ( $_post )
		$_post = get_post( $_post );
	else
		$_post =& $GLOBALS['post'];

	if ( !$_post )
		return false;

	$r = is_object_in_term( $_post->ID, 'type', $type );

	if ( is_wp_error( $r ) )
		return false;

	return $r;
}

/**
 * Get the page number
 */
function get_page_number() {
    if (get_query_var('paged')) {
        print ' | ' . __( 'Page ' , 'rolopress') . get_query_var('paged');
    }
}


/**
 * For tag lists on tag archives: Returns other tags except the current one (redundant)
 */
function tag_ur_it($glue) {
    $current_tag = single_tag_title( '', '',  false );
    $separator = "\n";
    $tags = explode( $separator, get_the_tag_list( "", "$separator", "" ) );
    foreach ( $tags as $i => $str ) {
        if ( strstr( $str, ">$current_tag<" ) ) {
            unset($tags[$i]);
            break;
        }
    }
    if ( empty($tags) )
        return false;

    return trim(join( $glue, $tags ));
}


/**
 * Get Page ID by page title
 *
 * @param string $page_name Page title
 *
 * @Credits: http://www.web-templates.nu/2008/09/02/get-id-by-page-name/
 *
 * @since 0.2
 */
function rolo_get_ID_by_page_title($page_title)
{
	global $wpdb;
	$page_title_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_title = '".$page_title."'");
	return $page_title_id;
}


/**
 * List Taxonomies
 *
 * @param string $page_name Page title
 *
 *
 */
function rolo_list_taxonomies( $args = '' ) {
	$defaults = array(
		'show_option_all' => '', 'show_option_none' => __('No categories'),
		'orderby' => 'name', 'order' => 'ASC',
		'style' => 'list',
		'show_count' => 0, 'hide_empty' => 1,
		'use_desc_for_title' => 1, 'child_of' => 0,
		'feed' => '', 'feed_type' => '',
		'feed_image' => '', 'exclude' => '',
		'exclude_tree' => '', 'current_category' => 0,
		'hierarchical' => true, 'title_li' => __( 'Categories' ),
		'echo' => 1, 'depth' => 0,
		'taxonomy' => 'category',
		'walker' => 'Walker_Category_Checklist_Rolo'
	);

	$r = wp_parse_args( $args, $defaults );

	if ( !isset( $r['pad_counts'] ) && $r['show_count'] && $r['hierarchical'] )
		$r['pad_counts'] = true;

	if ( true == $r['hierarchical'] ) {
		$r['exclude_tree'] = $r['exclude'];
		$r['exclude'] = '';
	}

	if ( !isset( $r['class'] ) )
		$r['class'] = ( 'category' == $r['taxonomy'] ) ? 'categories' : $r['taxonomy'];

	extract( $r );

	if ( !taxonomy_exists($taxonomy) )
		return false;

	$categories = get_categories( $r );

	$output = '';
	if ( $title_li && 'list' == $style )
			$output = '<li class="' . esc_attr( $class ) . '">' . $title_li . '<ul>';

	if ( empty( $categories ) ) {
		if ( ! empty( $show_option_none ) ) {
			if ( 'list' == $style )
				$output .= '<li>' . $show_option_none . '</li>';
			else
				$output .= $show_option_none;
		}
	} else {
		if ( ! empty( $show_option_all ) ) {
			$posts_page = ( 'page' == get_option( 'show_on_front' ) && get_option( 'page_for_posts' ) ) ? get_permalink( get_option( 'page_for_posts' ) ) : home_url( '/' );
			$posts_page = esc_url( $posts_page );
			if ( 'list' == $style )
				$output .= "<li><a href='$posts_page'>$show_option_all</a></li>";
			else
				$output .= "<a href='$posts_page'>$show_option_all</a>";
		}

		if ( empty( $r['current_category'] ) && ( is_category() || is_tax() || is_tag() ) ) {
			$current_term_object = get_queried_object();
			if ( $current_term_object && $r['taxonomy'] === $current_term_object->taxonomy )
				$r['current_category'] = get_queried_object_id();
		}

		if ( $hierarchical ) {
			$depth = $r['depth'];
		} else {
			$depth = -1; // Flat.
		}
			

		$output .= walk_category_tree( $categories, $depth, $r );
	}

	if ( $title_li && 'list' == $style )
		$output .= '</ul></li>';

	$output = apply_filters( 'wp_list_categories', $output, $args );

	if ( $echo )
		echo $output;
	else
		return $output;
}

?>
