<?php

if (!class_exists("ABDatabasePeekSettings")) {
	class ABDatabasePeekSettings {

		private $option_group = 'ABDatabasePeek';


		function create_menus() {
			add_options_page('Database Peek', 'Database Peek', 'manage_options', 'ab-database-peek',
							 array($this,'settings_page'));
							 
			add_filter('plugin_action_links', array($this, 'add_settings_link'), 10, 2 );
		}

		function add_settings_link($links, $file) {
			if (strstr($file, 'database-peek')) {
				$settings = __("Settings");
				$url = admin_url('options-general.php?page=ab-database-peek');
				$settings_link = "<a href=\"$url\">$settings</a>";
				array_unshift($links, $settings_link);
			}
			
			return $links;
		}

		function register_mysettings() { // whitelist options
			register_setting( $this->option_group, 'ABDatabasePeek-pagesize' );
			register_setting( $this->option_group, 'ABDatabasePeek-integrate' );
		}

		
		function settings_page() {

			//must check that the user has the required capability 
			if (!current_user_can('manage_options')) {
				wp_die( __(ABDatabasePeek::$no_access_msg) );
			}

			if (isset($_GET['settings-updated'])) {
				?>
				<div class="updated"><p><strong>
				<?php _e('Settings saved.' ); ?>
				</strong></p></div><?php
			}
			
			?>
			<div class="wrap">
			<div id="icon-options-general" class="icon32"></div>
			<h2>Database Peek Settings</h2>
			<form method="POST" action="options.php">
				<?php
				settings_fields( $this->option_group );
				do_settings_sections( $this->option_group );
				?>
				<table class="form-table"><tbody>
					<tr valign="top">
						<th scope="row">
							<label for="pagesize">Rows per page</label>
						</th>
						<td>
							<input type="text" id="ABDatabasePeek-pagesize" maxlength="5" size="10" name="ABDatabasePeek-pagesize" value="<?php echo $this->option_pagesize(); ?>" class="regular-text" />
							<span class="description">For table display (default = 100)</span>
						</td>
					</tr>

					<tr valign="top">
						<th scope="row">
							<label for="integrate">Integrate</label>
						</th>
						<td>
							<input type="checkbox" id="ABDatabasePeek-integrate" name="ABDatabasePeek-integrate" value="1" <?php if ($this->option_integrate()) echo 'checked'; ?> />
							<span class="description">Display "Examine" links in admin UI.</span>
						</td>
					</tr>
				</tbody></table>
				<p class="submit">
					<input type="submit" name="submit" id="submit" class="button-primary" value="Save Changes">
				</p>
			</form>
			<div class="info">
			<?php _e(ABDatabasePeek::$footer_msg); ?>
			</div>
			</div>
			<?php
		}
		
		
		public static function option_pagesize() {
			return ABDatabasePeekSettings::get_numeric_option('ABDatabasePeek-pagesize', 1, 100);
		}
		
		
		public static function option_integrate() {
			return ABDatabasePeekSettings::get_boolean_option('ABDatabasePeek-integrate', true);
		}
		
		
		static function get_numeric_option($name, $min, $default) {
			$value = get_option($name);
			if (empty($value)) $value = $default;

			if (is_numeric($value))
				$value = (int)$value;
			
			if ($value < $min) $value = $min;
			
			return $value;
		}
		
		
		static function get_boolean_option($name, $default) {
			$value = get_option($name, $default);

			return $value == '1';
		}
		
	}
	
}
