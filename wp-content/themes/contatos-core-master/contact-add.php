<?php
/**
 * Template Name: Contact: Add
 *
 * Add Contact page.
 *
 * @package RoloPress
 * @subpackage Template
 */

if ( current_user_can('publish_posts') ) { // only display if user has proper permissions
	rolo_add_contact();
} else {
	rolo_permission_message();
}
					
get_header(); ?>
	
	<?php rolopress_before_container(); // Before container hook ?>
	<div id="container">
	
		<?php rolopress_before_main(); // Before main hook ?>
		<div id="main">
			
				<?php rolo_pageheader();?>
				
				<?php 
				?>	
			
				<form id="contact-add" class="uniForm inlineLabels" method="post" action="">
    <div id="errorMsg">
        <h3>Mandatory fields are not filled.</h3>
    </div>

    <fieldset class="inlineLabels">

		<div class="ctrlHolder first_name mandatory">
            <label for="rolo_contact_first_name">
<em>*</em>Primeiro Nome			</label>
			

            <input type="text" class="textInput first_name" tabindex="1000" size="55" value="" name="rolo_contact_first_name" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABHklEQVQ4EaVTO26DQBD1ohQWaS2lg9JybZ+AK7hNwx2oIoVf4UPQ0Lj1FdKktevIpel8AKNUkDcWMxpgSaIEaTVv3sx7uztiTdu2s/98DywOw3Dued4Who/M2aIx5lZV1aEsy0+qiwHELyi+Ytl0PQ69SxAxkWIA4RMRTdNsKE59juMcuZd6xIAFeZ6fGCdJ8kY4y7KAuTRNGd7jyEBXsdOPE3a0QGPsniOnnYMO67LgSQN9T41F2QGrQRRFCwyzoIF2qyBuKKbcOgPXdVeY9rMWgNsjf9ccYesJhk3f5dYT1HX9gR0LLQR30TnjkUEcx2uIuS4RnI+aj6sJR0AM8AaumPaM/rRehyWhXqbFAA9kh3/8/NvHxAYGAsZ/il8IalkCLBfNVAAAAABJRU5ErkJggg==&quot;); padding-right: 0px; background-repeat: no-repeat; background-attachment: scroll; background-position: right center; cursor: auto;">
        </div>
		<div class="ctrlHolder last_name mandatory">
            <label for="rolo_contact_last_name">
<em>*</em>Último Nome			</label>
			

            <input type="text" class="textInput last_name" tabindex="1001" size="55" value="" name="rolo_contact_last_name">
        </div>

    </fieldset>
   <div class="buttonHolder">
      <input type="hidden" value="add_contact" name="rp_add_contact">
      <button tabindex="1038" class="submitButton" id="add_contact" name="submit" type="submit">Adicionar Contato</button>
   </div>
</form>

		</div><!-- #main -->
		<?php rolopress_after_main(); // After main hook ?>
		
	</div><!-- #container -->
	<?php rolopress_after_container(); // After container hook ?>
		
<?php get_sidebar(); ?>	
<?php get_footer(); ?>