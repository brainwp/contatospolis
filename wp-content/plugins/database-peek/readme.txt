=== Database Peek ===
Contributors: albert-bertilsson
Tags: database, view, display, show, browse
Requires at least: 3.0.1
Tested up to: 3.3.1
Stable tag: 1.2

Database Peek allows admins to view the database content in a user friendly and safe way.

== Description ==

For those with a need to look at the pure contents of the WordPress database. The plugin gives admins a user friendly and safe way to display the tables of the database as well as show the detailed information of the tables and view each row of data including rows in other tables referring to the displayed row.

Functionality for filtering and sorting makes it very easy to get a good overview and find specific data. Integration with other parts of the administration tool makes it quick and easy to browse and examine various entities in the database.

This is not a replacement to having access to the WordPress database but it provides several benefits:

* Developers can get a quick way to view and verify database contents without having database access.
* Overview pages with clickable links to navigate is a lot faster than typing SQL (at least for me).
* Access to tables is verified against the current user access rights, should be safe.
* Quick access to basic table column statistics.

== Installation ==

1. Upload Database Peek to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Goto the Settings > Tools > Database Peek page in the admin gui.

== Screenshots ==

1. The table overview
2. Table listing
3. Row details

== Changelog ==

= 1.2 =
* Added statistics for tables to get a rough overview of the data in a table.
* Changed integration from using metaboxes to adding a button next to the permalink in the admin UI.
* Added link to settings from the plugin admin page.
* Added blog name column to table listing.
* Display more data in fields when displaying a single item. (Eg: post_content)
* Display nice message when single item is missing, instead of empty view.

= 1.1 =
* Fixed bug in the function that created links between tables.
* Code clean up, separate file for options.
* Added settings option to add shortcut links on edit page for pages and posts.
* Added shortcut links on listing pages for pages, posts, tags, comments and links.
* Added sums of total number of tables and rows in the footer of the table list.
* Added clickable column names to sort the display order.
* Added option to filter results by matching a value in a selected column.

= 1.0 =
* Initial Release
