	</div><!-- #wrapper -->	
	<?php rolopress_after_wrapper(); // After wrapper hook ?>
	
	<?php rolopress_before_footer(); // before footer hook ?>
	<div id="footer">
	<?php rolopress_footer(); // rolopress footer hook ?>
		<div id="colophon">
		
			<div id="site-info">
				<p><?php echo get_bloginfo( 'name' ); ?> - <?php _e('All Rights Reserved ', 'rolopress'); ?> - 2013/<?php echo the_date('Y'); ?></p>			
			</div><!-- #site-info -->

			<div id="logos-footer">
				<div class="logo-litoral"><a href="http://www.litoralsustentavel.org.br" target="_blank"></a></div>
				<div class="logo-polis"><a href="http://www.polis.org.br" target="_blank"></a></div>
			</div><!-- .logos-footer -->
            
            <div class="logo-petro-gov">
            </div><!-- .logo-petro-gov -->
			
		</div><!-- #colophon -->
	</div><!-- #footer -->

	<div class="menu-municipios">
		<h2>Busca Direta</h2>
		<ul>
			<li><a href="<?php echo home_url('/?rolo_city=sao_paulo'); ?>">São Paulo</a></li>
			<li><a href="<?php echo home_url('/?rolo_city=sao_paulo'); ?>">São Paulo</a></li>
			<li><a href="<?php echo home_url('/?rolo_city=sao_paulo'); ?>">São Paulo</a></li>
			<li><a href="<?php echo home_url('/?rolo_city=sao_paulo'); ?>">São Paulo</a></li>
			<li><a href="<?php echo home_url('/'); ?>">Peruíbe</a></li>
			<li><a href="<?php echo home_url('/'); ?>">Peruíbe</a></li>
		</ul>
	</div><!-- .menu-municipios -->

	<?php rolopress_after_footer(); // After footer hook ?>
	
<?php wp_footer(); // WordPress footer hook ?>

</body>
</html>