<?php
/**
 * Header Functions
 *
 * Functions used in the header area
 *
 * @package RoloPress
 * @subpackage Functions
 */
 
/**
 * Display RoloPress version in meta
 *
 * @since 1.2
 */
function rolo_meta_data() {
	$theme_data = get_theme_data(ROLOPRESS_DIR . '/style.css');
	echo '<meta name="template" content="'.$theme_data['Title'] .  ' ' . $theme_data['Version'].'" />' . "\r";
}
add_action ('wp_head','rolo_meta_data');

/**
 * Loads standard CSS files
 *
 * @since 1.2
 */
function rolo_css_standard() {
	echo '<link rel="stylesheet" type="text/css" href="' . ROLOPRESS_CSS . '/reset.css" media="screen,projection,print" />' . "\n";
	echo '<link rel="stylesheet" type="text/css" href="' . ROLOPRESS_CSS . '/rebuild.css" media="screen,projection,print" />' . "\n";
	echo '<link rel="stylesheet" type="text/css" href="' . ROLOPRESS_CSS . '/wp.css" media="screen,projection,print" />' . "\n";
	echo '<link rel="stylesheet" type="text/css" href="' . ROLOPRESS_CSS . '/screen.css" media="screen,projection,print" />' . "\n";
	echo '<link rel="stylesheet" type="text/css" href="' . ROLOPRESS_CSS . '/jcaption.css" media="screen,projection,print" />' . "\n";
	echo '<link rel="stylesheet" type="text/css" href="' . ROLOPRESS_CSS . '/widgets.css" media="screen,projection,print" />' . "\n";
	echo '<link rel="stylesheet" type="text/css" href="' . ROLOPRESS_CSS . '/uni-form.css" media="screen,projection,print" />' . "\n";
	echo '<link rel="stylesheet" type="text/css" href="' . ROLOPRESS_CSS . '/tooltipster.css" media="screen,projection,print" />' . "\n";

	//echo '<link rel="stylesheet" type="text/css" href="' . ROLOPRESS_CSS . '/extras.css" media="screen,projection,print" />' . "\n";
}
add_action ('wp_head','rolo_css_standard');

/**
 * Define CSS file for layout
 *
 * @since 1.2
 */
function rolo_css_theme_layout() {
	$options = get_option('rolopress_layout_options');
	$layout = $options[theme_layout];
	echo '<link rel="stylesheet" type="text/css" href="' . ROLOPRESS_CSS_LAYOUTS . "/" . $layout . '.css" media="screen,projection" />' . "\r";
}
add_action ('wp_head','rolo_css_theme_layout');

/**
 * Define Child CSS file
 *
 * @since 1.2
 */
function rolo_css_child() {
	echo '<link rel="stylesheet" type="text/css" href="' . ROLOPRESS_CHILD_CSS . '" media="screen,projection,print" />' . "\n";
}
add_action ('wp_head','rolo_css_child');

/**
 * Use default print.css if no child version exists
 *
 * Looks in child directory for print.css
 * uses default print.css if none exists
 *
 * @since 1.2
 */
function rolo_css_print() {
	$custom_print_css = ROLOPRESS_CHILD_DIR . '/print.css'; // here's the file we look for

	if (file_exists($custom_print_css)) {
		echo '<link rel="stylesheet" type="text/css" href="' . ROLOPRESS_CHILD_URL . '/print.css" media="print" />' . "\r";
	} else {
		echo '<link rel="stylesheet" type="text/css" href="' . ROLOPRESS_CSS . '/print.css" media="print" />' . "\r";
	}
}
add_action ('wp_head','rolo_css_print');

/**
 * Adicionando Google Font: Source Sans
 */
function rolo_font_print() {
	echo "<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic' rel='stylesheet' type='text/css'>" . "\r";
}
add_action ('wp_head','rolo_font_print');


/**
 * Allows for hiding of widget areas when printing
 *
 * @since 1.2
 */
function rolo_css_widget_areas() {
	$options = get_option('rolopress_main_options');

	$rolo_print_primary = $options[print_primary];
	$rolo_print_secondary = $options[print_secondary];
	$rolo_print_contact_under_main = $options[print_contact_under_main];
	$rolo_print_company_under_main = $options[print_company_under_main];
	
	if ($rolo_print_primary != "on") { echo '<link rel="stylesheet" type="text/css" href="' . ROLOPRESS_CSS_PRINT . '/hide-primary.css" media="print" />' . "\r";};
	if ($rolo_print_secondary != "on") { echo '<link rel="stylesheet" type="text/css" href="' . ROLOPRESS_CSS_PRINT . '/hide-secondary.css" media="print" />' . "\r";};
	if ($rolo_print_contact_under_main != "on") { echo '<link rel="stylesheet" type="text/css" href="' . ROLOPRESS_CSS_PRINT . '/hide-contact-under-main.css" media="print" />' . "\r";};
	if ($rolo_print_company_under_main != "on") { echo '<link rel="stylesheet" type="text/css" href="' . ROLOPRESS_CSS_PRINT . '/hide-company-under-main" media="print" />' . "\r";};
}
add_action ('wp_head','rolo_css_widget_areas');

/**
 * Displays Javascript disabled warning if user is logged in.
 *
 * @since 0.1
 */
function rolopress_js_disabled() {

    if (is_user_logged_in() ) { // only display if user is logged in ?>
<noscript>
	<p class="error"><?php echo __('JavaScript is disabled. For RoloPress to work properly,', 'rolopress') . " <a href=\"http://rolopress.com/forums/topic/inline-editing-not-working\">". __('please enable JavaScript.', 'rolopress') . "</a>";?></p>
</noscript>
<?php }
}
add_action('rolopress_before_wrapper', 'rolopress_js_disabled');

/**
 * Create default menu
 *
 * Assembles menu and places before wrapper
 * @since 1.4
 */
function rolopress_default_top_menu() {
	$url = home_url();
	echo "<div id=\"menu\"><div class=\"wrapper-menu\">";
	echo "<ul id=\"menu-default-menu\" class=\"menu\">";
	echo "<li id=\"menu-item\" class=\"menu-item-contatos\"><a class=\"menu-in\" title=\"Contatos\" href=\"".$url."/type/contact\"></a></li>";
	echo "<li id=\"menu-item\" class=\"menu-item-instituicoes\"><a class=\"menu-in\" title=\"Instituições\" href=\"".$url."/type/company\"></a></li>";
	echo "<li id=\"menu-item\" class=\"menu-item-add-contatos\"><a class=\"menu-in\" title=\"Adicionar Contato\" href=\"".$url."/add-contact\"></a></li>";
	echo "<li id=\"menu-item\" class=\"menu-item-add-instituicoes\"><a class=\"menu-in\" title=\"Adicionar Instituição\" href=\"".$url."/add-company\"></a></li>";
	echo "<li id=\"menu-item\" class=\"menu-item-busca-avancada\"><a class=\"menu-in\" title=\"Busca Avançada\" href=\"".$url."/busca-avancada\"></a></li>";
	echo "<li id=\"menu-item\" class=\"menu-item-faq\"><a class=\"menu-in\" title=\"FAQ\" href=\"".$url."/perguntas-frequentes-faq\"></a></li>";
	echo "</ul>";
	rolopress_default_top_menu_right(); // call function to create right side of menu.
	echo "</div></div>";
};
add_action('rolopress_before_wrapper', 'rolopress_default_top_menu');

/**
 * Create default menu
 *
 * Assembles menu and places before wrapper
 * @since 1.4
 *
function rolopress_default_top_menu() { 
	echo "<div id=\"menu\"><div class=\"wrapper-menu\">";
	wp_nav_menu( array( 'menu' => 'default-menu') ); // display menu built in Appearance > Menus
	rolopress_default_top_menu_right(); // call function to create right side of menu.
	echo "</div>";
};
add_action('rolopress_before_wrapper', 'rolopress_default_top_menu');*/


/**
 * Create the right side of default menu
 *
 * called in rolopress_default_top_menu() 
 * @since 1.4
 */
function rolopress_default_top_menu_right() { ?>

        <ul class="menu_item sub_menu alignright default_menu default_menu_right">
            <?php global $user_ID, $user_identity, $user_level, $current_user ?>
			
            <li><?php wp_loginout(home_url( '/wp-admin/' )); ?></li>
            <li class="icon-logout"></li>
            
            <?php if ( $user_level >= 1 ) : ?>
                <li class="profile-user"><a title="settings" href="<?php echo get_edit_user_link() ?>"><span><?php _e('Profile', 'rolopress') ?></span></a></li>
				<li class="icon-user"></li>
            <?php endif // $user_level >= 1 ?>
                                   
            <li class="name-user">
			<?php
				if ( is_user_logged_in() ) {
				get_currentuserinfo();
				echo _e('Hello ', 'rolopress') . $current_user->display_name;
				}
			?>
			</li>
        </ul>
</div><!-- .wrapper-menu -->
<?php
}
?>