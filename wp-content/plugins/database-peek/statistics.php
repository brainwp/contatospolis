<?php

if (!class_exists("ABDatabasePeekStatistics")) {
	class ABDatabasePeekStatistics {
	
		function display($table) {
			$url = admin_url('admin.php?page=ab-database-peek');
			$content = add_query_arg('table', $table, $url);
			?>
			<h3>
			<a href="<?php echo $url; ?>"><?php _e('Tables') ?></a> >
			<?php echo $table; ?>
			<a href="<?php echo $content; ?>" class="button-secondary"><?php _e('Contents') ?></a>
			</h3>
			<?php
			
			global $wpdb;
			
			$tabletotal = $wpdb->get_var( "select count(*) from $table" );
			$rows = $wpdb->get_results( "select * from $table where 1 = 0" );
			$col_names = $wpdb->get_col_info('name');

			echo '<br><h4>Columns</h4>';
			foreach ($col_names as $n) {
				echo "<a href=\"#$n\">$n</a><br>";
			}
			echo '<br>';
				
			foreach ($col_names as $n) {
				echo "<a name=\"$n\">&nbsp;</a>";
				echo "<h3>$n</h3>";
				$rows = $wpdb->get_results( $wpdb->prepare( "select $n v, count(*) c from $table group by $n having c > 1 order by c desc limit 0, 10" ) );
				if (count($rows) > 0 ) {
					?>
					<h4>Most common values</h4>
					<table class="widefat">
					<thead>
						<tr><th>Count</th><th>Value</th></tr>
					</thead>
					<tbody></tbody>
					<?php
					foreach ($rows as $row) {
						echo "<tr><td>$row->c</td><td>$row->v</td></tr>";
					}
					?>
					</tbody>
					</table>
					<br>
					<?php
				}


				echo "<strong>Distinct values:</strong> ";
				$res = $wpdb->get_var( "select count(distinct $n) from $table" );
				$percent = round(100 * $res / $tabletotal, 2);
				echo "$res ($percent%)<br>";


				echo "<strong>Average:</strong> ";
				$res = $wpdb->get_var( "select avg($n) from $table" );
				$res = round($res, 2);
				echo "$res<br>";


				echo "<strong>Total:</strong> ";
				$res = $wpdb->get_var( "select sum($n) from $table" );
				$res = round($res, 2);
				echo "$res<br>";


				echo "<strong>Average length:</strong> ";
				$res = $wpdb->get_var( "select avg(length($n)) from $table" );
				$res = round($res, 2);
				echo "$res<br>";


				echo "<strong>Nulls:</strong> ";
				$res = $wpdb->get_var( "select count(*) from $table where $n is null" );
				$percent = round(100 * $res / $tabletotal, 2);
				echo "$res ($percent%)<br>";


				echo "<strong>Empty:</strong> ";
				$res = $wpdb->get_var( "select count(*) from $table where $n = ''" );
				$percent = round(100 * $res / $tabletotal, 2);
				echo "$res ($percent%)<br>";


				echo '<br><br>';
			}
		}
		
	}
}