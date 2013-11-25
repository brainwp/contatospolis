<?php

/**
 * Add your custom functions here
 */

function custom_login() { ?>
    <style type="text/css">
        body.login {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/bg-admin.jpg);
			padding-top: 120px;
			overflow: hidden;
        }
		#login h1 a {
			background-image:url(<?php echo get_stylesheet_directory_uri(); ?>/img/logo-admin.png) !important;
			padding-bottom: 40px;
		}
		 body.login #login {
			padding: 30px;
			background-color: #e0eaeb;
			-webkit-border-radius: 10px;
			-moz-border-radius: 10px;
			border-radius: 10px;
		}
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'custom_login' );



?>