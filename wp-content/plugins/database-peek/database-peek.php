<?php
/*
Plugin Name: Database Peek
Plugin URI: http://www.albert.nu/stuff/wordpress/plugins/database-peek/
Description: Display the contents of your WordPress database
Version: 1.2
Author: Albert Bertilsson
Author URI: http://www.albert.nu/
*/

/*
Copyright 2012 Albert Bertilsson (email : abbe_something@hotmail.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

require_once( dirname( __FILE__) . '/integrate.php');
require_once( dirname( __FILE__) . '/settings.php');
require_once( dirname( __FILE__) . '/statistics.php');


if (!class_exists("ABDatabasePeek")) {
	class ABDatabasePeek {

		public static $footer_msg = 'Database Peek version 1.2 Developed by Albert Bertilsson in 2012';
		public static $no_access_msg = 'You do not have sufficient permissions to access this page.';
			
		private $wp_ms_tables = array('blogs', 'blog_versions', 'registration_log', 'signups',
							'site', 'sitecategories', 'sitemeta', 'users', 'usermeta');

		private $wp_ms_sitetables = array('commentmeta', 'comments', 'links', 'options',
							'postmeta', 'posts', 'terms', 'term_relationships',
							'term_taxonomy');

		private $wp_sitetables = array('commentmeta', 'comments', 'links', 'options',
							'postmeta', 'posts', 'terms', 'term_relationships',
							'term_taxonomy', 'usermeta', 'users');

		private $wp_sitetables_ids = array('commentmeta' => 'meta_id', 'comments' => 'comment_ID',
							'links' => 'link_id', 'options' => 'option_id',
							'postmeta' => 'meta_id', 'posts' => 'ID',
							'terms' => 'term_id', 'term_taxonomy' => 'term_taxonomy_id',
							'usermeta' => 'umeta_id', 'users' => 'ID');

		private $wp_sitetables_fks = array(
							'commentmeta' => array ('comment_id' => 'comments'),
							'comments' => array ('comment_post_ID' => 'posts', 'comment_parent' => 'comments', 'user_id' => 'users'),
							'postmeta' => array ('post_id' => 'posts' ),
							'posts' => array ('post_author' => 'users', 'post_parent' => 'posts' ),
							'term_relationships' => array ('term_taxonomy_id' => 'term_taxonomy'),
							'term_taxonomy' => array ('term_id' => 'terms'),
							'usermeta' => array ('user_id' => 'users'));
		
		private $blog_ids = array();

		private $option_group = 'ABDatabasePeek';


		function __construct() {
			global $wpdb;
			if (is_multisite()) {
				$table = $wpdb->base_prefix . $this->wp_ms_tables[0];
				$rows = $wpdb->get_results( "select blog_id from $table" );
				foreach ($rows as $r) {
					$this->blog_ids[] = $r->blog_id;
				}
			}
		}


		function create_menus() {
			add_management_page('Database Peek', 'Database Peek', 'manage_options', 'ab-database-peek',
							 array($this,'main_page'));
		}

		
		function table_base($table, $destination) {
			global $wpdb;

			if (!$this->is_wp_ms_table($destination))
				if (preg_match('#(' . $wpdb->base_prefix . '\d*_).*#', $table, $matches))
					return $matches[1];
			
			return $wpdb->base_prefix;
		}
		
		function get_table_blog_id($table) {
			global $wpdb;
			
			if (is_multisite()) {
				if ($this->is_wp_ms_table($table)) {
					if (preg_match('#' . $wpdb->base_prefix . '(\d*)_.*#', $table, $matches))
						return intval($matches[1]);
					else
						return 0;
				}
			} else {
				if($this->is_wp_site_table($table))
					return 0;
			}

			return -1;
		}
		
		function get_table_blog_name($table) {
			global $wpdb;
			
			$blogid = $this->get_table_blog_id($table);
			if (is_multisite()) {
				return get_blog_option($blogid, 'blogname');
			} else {
				return get_bloginfo('name');
			}

			return '?';
		}
		
		function table_id($table) {
			global $wpdb;
			
			foreach ($this->wp_sitetables_ids as $key => $id) {
				if (is_multisite()) {
					$pattern = '#' . $wpdb->base_prefix . '\d*_' . $key . '#';
					if (preg_match($pattern, $table))
						return $id;
				}
				
				if ($wpdb->base_prefix . $key == $table)
					return $id;
			}
			
			return '';
		}
		
		
		function table_fks($table) {
			global $wpdb;
			
			foreach ($this->wp_sitetables_fks as $key => $fks) {
				if (is_multisite()) {
					$pattern = '#' . $wpdb->base_prefix . '\d*_' . $key . '#';
					if (preg_match($pattern, $table))
						return $fks;
				}

				if ($wpdb->base_prefix . $key == $table)
					return $fks;
			}
			
			return array();
		}
		
		
		function is_wp_table($table) {
			if($this->is_wp_site_table($table))
				return true;
			
			if (is_multisite() && $this->is_wp_ms_table($table))
				return true;
			
			return false;
		}

		
		function is_wp_ms_table($table) {
			global $wpdb;
			
			if (!is_multisite()) return false;

			foreach ($this->wp_ms_tables as $t) {
				if ($wpdb->base_prefix . $t == $table || $t == $table)
					return true;
			}
				
			return false;
		}

		
		public static function show_table_link($table, $row = -1) {
			$url = admin_url('admin.php?page=ab-database-peek');

			$url = add_query_arg('table', $table, $url);
			
			if ($row == -1)
				$url = remove_query_arg('row', $url);
			else
				$url = add_query_arg('row', $row, $url);
			
			return $url;
		}

		function is_wp_site_table($table) {
			global $wpdb;

			if ($this->is_wp_current_site_table($table))
				return true;
			
			if (is_multisite() && $this->show_all()) {
				foreach ($this->wp_ms_sitetables as $t) {
					$pattern = '#' . $wpdb->base_prefix . '(\d+)_' . $t . '#';
					if (preg_match($pattern, $table, $matches)) {
						if (in_array($matches[1], $this->blog_ids))
							return true;
					}
				}
			}
			
			return false;
		}

		
		function is_wp_current_site_table($table) {
			global $wpdb;

			$tables = $this->wp_sitetables;
			if (is_multisite()) $tables = $this->wp_ms_sitetables;
			
			foreach ($tables as $t)
				if ($wpdb->prefix . $t == $table)
					return true;
				
			return false;
		}
		
		
		function show_table($table) {
			if ($this->show_all()) return true;
			
			if ($this->is_wp_current_site_table($table)) return true;
			
			return false;
		}
		
		
		function show_all() {
			if (is_multisite())
				return is_super_admin();
			else
				return true;
		}
		
				
		function check_table_parameter() {
			if (!isset($_GET['table'])) return false;
			
			global $wpdb;
			
			$rows = $wpdb->get_results( "show tables" );
			$col = $wpdb->get_col_info('name', 0);
			foreach ($rows as $row) {
				if ($_GET['table'] == $row->$col) return true;
			}
			
			return false;
		}
		
		
		function check_column_parameter($param) {
			if (!isset($_GET['table'])) return false;
			if (!isset($_GET[$param])) return false;
			
			global $wpdb;
			
			$table = $_GET['table'];
			$rows = $wpdb->get_results( "select * from $table where 1 = 0" );
			$col_names = $wpdb->get_col_info('name');
			foreach ($col_names as $n) {
				if ($_GET[$param] == $n) return true;
			}
			
			return false;
		}
		
		
		function main_page() {
			
			//must check that the user has the required capability 
			if (!current_user_can('manage_options')) {
				wp_die( __(ABDatabasePeek::$no_access_msg) );
			}
			
			$table = false;
			if ($this->check_table_parameter()) $table = true;
			
			global $wpdb;
			?>
			<div class="wrap">
			<div id="icon-tools" class="icon32"></div>
			<h2>Database Peek</h2>
			<br>
			<?php
			if ($table && isset($_GET['row'])) {
				$this->show_row($_GET['table'], $_GET['row']);
			}
			else {
				if ($table) {
					$this->display_table($_GET['table']);
				}
				else {
					if (isset($_GET['statistics']) && $this->show_table($_GET['statistics'])) {
						$statistics = new ABDatabasePeekStatistics();
						$statistics->display($_GET['statistics']);
					}
					else {
						$this->list_tables();
					}
				}
			}
			
			
			?>
			<br>
			<div class="info">
			<?php _e(ABDatabasePeek::$footer_msg); ?>
			</div>
			
			</div>
			<?php
		}
	
		
		
		function show_row($table, $row) {

			if (!$this->show_table($table)) return false;
			
			global $wpdb;
			
			$tid = $this->table_id($table);
			$rows = $wpdb->get_results( "select * from $table where $tid = $row" );
			$url = admin_url('admin.php?page=ab-database-peek');
			$turl = $this->show_table_link($table);
			?>
			<h3>
			<a href="<?php echo $url; ?>"><?php _e('Tables') ?></a> &gt;
			<a href="<?php echo $turl; ?>"><?php echo $table; ?></a> &gt;
			<?php echo "$tid = $row"; ?>
			</h3>
			<?php
			if (count($rows) == 0) :
				echo _("$tid = $row could not be found!");
				echo '<br>';
			else:
			?>
			<table class="widefat">
			<thead><tr>
			<th><?php _e('Field'); ?></th>
			<th><?php _e('Value'); ?></th>
			</tr></thead>
			<tbody>
			<?php
			$col_names = $wpdb->get_col_info('name');
			$col_links = $this->get_fk_col_links($table, $col_names);
			foreach ($rows as $r) {
				$count = 0;
				foreach ($r as $value) {
					if ($count % 2 == 0)
						echo '<tr class="alternate">';
					else
						echo '<tr>';

					$cn = $col_names[$count];
					echo "<td>$cn</td>";
					$this->get_cell_formatted($value, $col_links, $col_names[$count], 500);
					echo '</tr>';
					$count++;
				}
			}
			?>
			</tbody></table>
			<?php
			endif;
			
			foreach ($this->wp_sitetables_fks as $key => $fks) {
				foreach ($fks as $k => $fk) {
					$b = $this->table_base($table, $fk);
					if ($b . $fk == $table)
						$this->show_fk_table($b . $key, $k, $row);
				}
			}
		}
		
		
		
		function get_fk_col_links($table, $col_names) {
			$col_links = array();

			foreach ($col_names as $n) {
				if ($this->is_wp_site_table($table) || $this->is_wp_ms_table($table)) {
					$fks = $this->table_fks($table);
					if (isset($fks[$n])) {
						$b = $this->table_base($table, $fks[$n]);
						$u = $this->show_table_link($b . $fks[$n]);
						$col_links[$n] = $u;
					}
					
					if ($this->table_id($table) == $n) {
						$u = $this->show_table_link($table);
						$col_links[$n] = $u;
					}
				}
			}
			
			return $col_links;
		}
		

		
		function get_cell_formatted($value, $col_links, $name, $length = 50) {
			$fk = '';

			if (strlen($value) > $length)
				$value = substr($value, 0, $length) . ' ' . '...';
			$value = esc_html($value);

			if (isset($col_links[$name])) {
				$fk = $col_links[$name];
				$fk = add_query_arg('row', $value, $fk);
			}

			if (empty($fk))
				echo "<td>$value</td>";
			else
				echo "<td><a href=\"$fk\">$value</a></td>";
		}
		
		
		
		function show_fk_table($table, $fk, $value) {

			if (!$this->show_table($table)) return false;
			
			global $wpdb;
			
			$limit = 25;
			
			$url = admin_url('admin.php?page=ab-database-peek');
			$turl = $this->show_table_link($table);

			$rows = $wpdb->get_results( "select * from $table where $fk = $value limit 0, $limit" );
			if ($wpdb->num_rows < 1) return;
			?>
			<br/>
			<h4>
			<a href="<?php echo $url; ?>"><?php _e('Tables') ?></a> >
			<a href="<?php echo $turl; ?>"><?php echo $table; ?></a> &gt;
			<?php echo "$fk = $value"; ?>
			</h4>

			<table class="widefat">
			<thead style="vertical-align: bottom;"><tr>
			<?php
			$col_names = $wpdb->get_col_info('name');
			$col_links = $this->get_fk_col_links($table, $col_names);
			foreach ($col_names as $n) {
				echo '<th>';
				
				if (count($col_names) > 5)
					for ($i = 0 ; $i < strlen($n) ; $i++)
						echo substr($n, $i, 1) . '<br>';
				else
					echo $n;
					
				echo '</th>';
			}
			?>
			</tr></thead>
			<tbody>
			<?php
			$count = 0;
			foreach ($rows as $row) {
				if ($count % 2 == 0)
					echo '<tr class="alternate">';
				else
					echo '<tr>';
				
				$i = 0;
				foreach ($row as $r) {
					$this->get_cell_formatted($r, $col_links, $col_names[$i]);
					$i++;
				}
				echo '</tr>';
				$count++;
			}
			?>
			</tbody></table>
			<?php
		}
		
		
		function display_table($table) {

			if (!$this->show_table($table)) return false;
			
			global $wpdb;
			
			$pagenum = isset( $_GET['pagenum'] ) ? absint( $_GET['pagenum'] ) : 1;

			$limit = ABDatabasePeekSettings::option_pagesize();
			
			$offset = ( $pagenum - 1 ) * $limit;
			
			$url = admin_url('admin.php?page=ab-database-peek');
			$stats = add_query_arg('statistics', $table, $url);
			?>
			<h3>
			<a href="<?php echo $url; ?>"><?php _e('Tables') ?></a> >
			<?php echo $table; ?>
			<a href="<?php echo $stats; ?>" class="button-secondary"><?php _e('Statistics') ?></a>
			</h3>

			<form method="get" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
				<?php
				foreach ($_GET as $k => $v) {
					if ($k != 'filter' && $k != 'match')
						echo "<input type=\"hidden\" name=\"$k\" value=\"$v\">";
				}
				?>

				<select name="filter">
				<?php
				$rows = $wpdb->get_results( "select * from $table where 1 = 0" );
				$col_names = $wpdb->get_col_info('name');
				foreach ($col_names as $n) {
					$selected = '';
					if (isset($_GET['filter']) && $_GET['filter'] == $n) $selected = 'selected';
					echo "<option value=\"$n\" $selected>$n</option>";
				}
				?>
				</select>
				<input type="text" name="match" maxlength="50" size="10" class="regular-text" value="<?php if( isset($_GET['match']) ) echo $_GET['match']; ?>">
				<input type="submit" class="button-primary" value="Filter">
			</form>

			<?php
			$filter = '';
			$match = '';
			if (isset($_GET['filter']) && $this->check_column_parameter('filter') && isset($_GET['match'])) {
				//$filter = 'where ' . $_GET['filter'] . ' like "%%' . $_GET['match'] . '%%"';
				$filter = 'where ' . $_GET['filter'] . ' like %s';
				$match = '%' . $_GET['match'] . '%';
			}
			
			$total = $wpdb->get_var( $wpdb->prepare( "select count(*) from $table $filter", $match ) );
			$tabletotal = $wpdb->get_var( "select count(*) from $table" );
			$num_of_pages = ceil( $total / $limit );
			$page_links = paginate_links( array(
				'base' => add_query_arg( 'pagenum', '%#%' ),
				'format' => '',
				'prev_text' => __( '&laquo;', 'aag' ),
				'next_text' => __( '&raquo;', 'aag' ),
				'total' => $num_of_pages,
				'current' => $pagenum
			) );
			 
			if ( $page_links ) {
				echo '<div class="tablenav"><div class="tablenav-pages" style="margin: 1em 0">' . $page_links . ' ' . $total . ' / ' . $tabletotal . '</div></div>';
			} else {
				echo '<br>';
			}

			$orderby = '';
			if (isset( $_GET['sort'] ) && $this->check_column_parameter('sort')) $orderby = 'order by ' . $_GET['sort'];
			if (isset( $_GET['desc'] ) ) $orderby .= ' desc';
			
			$rows = $wpdb->get_results( $wpdb->prepare( "select * from $table $filter $orderby limit $offset, $limit", $match ) );
	
			?>

			<table class="widefat">
			<thead style="vertical-align: bottom;"><tr>
			<?php
			$col_names = $wpdb->get_col_info('name');
			$col_links = $this->get_fk_col_links($table, $col_names);
			foreach ($col_names as $n) {
				echo '<th>';

				$sort = add_query_arg('sort', $n, $_SERVER["REQUEST_URI"]);
				if (isset( $_GET['sort'] ) && $_GET['sort'] == $n) {
					if (isset($_GET['desc']))
						$sort = remove_query_arg('desc', $sort);
					else
						$sort = add_query_arg('desc', '', $sort);
				}
				else
					$sort = remove_query_arg('desc', $sort);

				echo "<a href=\"$sort\">";
				if (isset( $_GET['sort'] ) && $_GET['sort'] == $n) echo '<strong>';
				if (count($col_names) > 5)
					echo str_replace('_', '_<br>', $n);
				else
					echo $n;
					
				if (isset( $_GET['sort'] ) && $_GET['sort'] == $n) echo '</strong>';
				echo '</a>';
				echo '</th>';
			}
			?>
			</tr></thead>
			<tbody>
			<?php
			$turl = $this->show_table_link($table);
			$count = 0;
			foreach ($rows as $row) {
				if ($count % 2 == 0)
					echo '<tr class="alternate">';
				else
					echo '<tr>';
				
				$i = 0;
				foreach ($row as $r) {
					$this->get_cell_formatted($r, $col_links, $col_names[$i]);

					$i++;
				}
				echo '</tr>';
				$count++;
			}
			?>
			</tbody></table>
			<?php
			
			if ( $page_links ) {
				echo '<div class="tablenav"><div class="tablenav-pages" style="margin: 1em 0">' . $page_links . ' ' . $total . ' / ' . $tabletotal . '</div></div>';
			}

		}


		function list_tables() {
			global $wpdb;
			
			$rows = $wpdb->get_results( "show tables" );
			$col = $wpdb->get_col_info('name', 0);
			$trow = 0;
	
			?>
			<h3><?php _e('Tables') ?></h3>
			<small><?php if(is_multisite() && is_super_admin()) _e('Multisite installation detected'); ?></small>
			<table class="widefat">
			<thead><tr>
			<th><?php _e('Name') ?></th>
			<th><?php _e('Blog') ?></th>
			<th><?php _e('Type') ?></th>
			<th><?php _e('#') ?></th>
			</tr></thead>
			<tbody>
			<?php
			
			//Multi-site tables (if super-admin)
			$count = 0;
			if ($this->show_all()) {
				foreach ($rows as $row) {
					$table = $row->$col;
					if ($this->is_wp_ms_table($table)) {
						if ($count % 2 == 0)
							echo '<tr class="alternate">';
						else
							echo '<tr>';
							
						$url = $this->show_table_link($table);
						echo "<td><a href=\"$url\">$table</a></td>";
						$blogname = $this->get_table_blog_name($table);
						echo "<td>$blogname</td>";
						$type = _('Multi-Site');
						echo "<td>$type</td>";
						$rowcount = $wpdb->get_var( "select count(*) from $table");
						$stats = add_query_arg('statistics', $table, $url);
						echo "<td><a href=\"$stats\">$rowcount</a></td>";
						echo '</tr>';
					
						$count++;
						$trow += $rowcount;
					}
				}
			}
	
			//Site tables (if not super-admin only current site tables)
			foreach ($rows as $row) {
				$table = $row->$col;
				if ($this->is_wp_site_table($table) && $this->show_table($table)) {
					if ($count % 2 == 0)
						echo '<tr class="alternate">';
					else
						echo '<tr>';

					$url = $this->show_table_link($table);
					echo "<td><a href=\"$url\">$table</a></td>";
					$blogname = $this->get_table_blog_name($table);
					echo "<td>$blogname</td>";
					$type = _('Site');
					if ($this->is_wp_current_site_table($table))
						$type = '<strong>' . _('Current site') . '</strong>';
					echo "<td>$type</td>";
					$rowcount = $wpdb->get_var( "select count(*) from $table");
					$stats = add_query_arg('statistics', $table, $url);
					echo "<td><a href=\"$stats\">$rowcount</a></td>";
					echo '</tr>';
				
					$count++;
					$trow += $rowcount;
				}
			}
			
			//Other tables (if super-admin)
			if ($this->show_all()) {
				foreach ($rows as $row) {
					$table = $row->$col;
					if (!$this->is_wp_table($table)) {
						if ($count % 2 == 0)
							echo '<tr class="alternate">';
						else
							echo '<tr>';

						$url = $this->show_table_link($table);
						echo "<td><a href=\"$url\">$table</a></td>";
						echo "<td>?</td>";
						$type = _('Other');
						echo "<td>$type</td>";
						$rowcount = $wpdb->get_var( "select count(*) from $table");
						$stats = add_query_arg('statistics', $table, $url);
						echo "<td><a href=\"$stats\">$rowcount</a></td>";
						echo '</tr>';
					
						$count++;
						$trow += $rowcount;
					}
				}
			}
			?>
			</tbody>
			<tfoot><tr>
			<th><?php echo $count; ?></th><th></th><th></th><th><?php echo $trow; ?></th>
			</tr></tfoot>
			</table>
			<?php
		}
	}
	
}



$ab_database_peek_settings = new ABDatabasePeekSettings();

if (isset($ab_database_peek_settings)) {
	if (is_admin()) {
		add_action('admin_menu', array($ab_database_peek_settings,'create_menus'));
		add_action( 'admin_init', array($ab_database_peek_settings,'register_mysettings') );
	}
}



$ab_database_peek_integrate = new ABDatabasePeekIntegrate();

if (isset($ab_database_peek_integrate)) {
	if (is_admin()) {
		$ab_database_peek_integrate->integrate();
	}
}



$ab_database_peek = new ABDatabasePeek();

if (isset($ab_database_peek)) {
	if (is_admin()) {
		add_action('admin_menu', array($ab_database_peek,'create_menus'));
	}
}
