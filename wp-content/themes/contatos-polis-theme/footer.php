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
	<?php rolopress_after_footer(); // After footer hook ?>
	
<?php wp_footer(); // WordPress footer hook ?>

</body>
</html>