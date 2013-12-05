<?php if( !current_user_can( 'read' ) ) wp_redirect( get_bloginfo( 'url' ) . '/wp-admin/' ); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://www.w3.org/2006/03/hcard">
<title><?php rolopress_document_title(); ?></title>

<meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<?php rolopress_head(); // rolopress head hook ?>
<?php wp_head(); // wordpress head hook ?>

</head>

<body class="<?php rolopress_body_class() ?>">

<?php rolopress_before_wrapper(); // hook antes do wrapper // before wrapper hook ?> 

<div class="wrapper-header">
	<div class="wrapper-header-content">

			<div class="logo-header">
				<a class="a-logo-header" href="<?php echo home_url(); ?>"></a>
			</div><!-- .logo-header -->
			<div class="busca-header">
				<form id="searchform" method="get" action="<?php bloginfo('url') ?>">
					<?php
						if (isset($_GET['s'])) {
							$s = $_GET['s'];
						} else {
							$s = '';
						}
					?>
                    <input id="s" name="s" type="text" value="<?php echo wp_specialchars(stripslashes($s), true) ?>" size="20" tabindex="1" placeholder="Buscar" />
                    <input id="searchsubmit" name="searchsubmit" type="submit" value="" tabindex="2" />
                </form>
			</div><!--  .busca-header -->

	</div><!-- .wrapper-header-content -->
</div><!-- .wrapper-header -->

<div id="wrapper" class="hfeed">

	<?php rolopress_before_header(); // hook antes do header // before header hook ?>

	<div id="header">
			<?php rolopress_header(); // Header hook ?>
		<div id="masthead">
		
			<div id="access">
				<div class="skip-link"><a href="#main" title="<?php _e( 'Skip to main', 'rolopress' ) ?>"><?php _e( 'Skip to main', 'rolopress' ) ?></a></div>
			</div><!-- #access -->
				
		</div><!-- #masthead -->	
	</div><!-- #header -->
	<?php rolopress_after_header(); ?>  