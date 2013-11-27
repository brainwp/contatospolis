<?php

if (!class_exists("ABDatabasePeekIntegrate")) {
	class ABDatabasePeekIntegrate {
		
		function integrate() {
			if (!ABDatabasePeekSettings::option_integrate()) return;
		
			add_action( 'post_row_actions', array($this,'add_post_row_action'), 10, 2);
			add_filter( 'page_row_actions', array($this,'add_post_row_action'), 10, 2);
			add_filter( 'comment_row_actions', array($this,'add_comment_row_action'), 10, 2);
			add_filter( 'media_row_actions', array($this,'add_post_row_action'), 10, 2);
			add_filter( 'tag_row_actions', array($this,'add_tag_row_action'), 10, 2);
			add_filter( 'user_row_actions', array($this,'add_user_row_action'), 10, 2);
			add_filter( 'get_sample_permalink_html', array($this, 'link_to_examine'));
		}

		function link_to_examine( $content ) {
			global $post;
			global $wpdb;
			
			$link = "";

			$examine = _('Examine');
			$url = ABDatabasePeek::show_table_link($wpdb->posts, $post->ID);			
			$link = "<span id=\"examine-post-btn\"><a href=\"$url\" class=\"button\">$examine</a></span>";

			return $content . $link;
		}

		function add_post_row_action($actions, $post){
			global $wpdb;
		
			$examine = _('Examine');
			$url = ABDatabasePeek::show_table_link($wpdb->posts, $post->ID);			
			$actions['examine'] = "<a href=\"$url\">$examine</a>";
			
			return $actions;
		}

		
		function add_comment_row_action($actions, $comment){
			global $wpdb;
		
			$examine = _('Examine');
			$url = ABDatabasePeek::show_table_link($wpdb->comments, $comment->comment_ID);			
			$actions['examine'] = "<a href=\"$url\">$examine</a>";
			
			return $actions;
		}

		
		function add_tag_row_action($actions, $tag){
			global $wpdb;
		
			$examine = _('Examine');
			$url = ABDatabasePeek::show_table_link($wpdb->terms, $tag->term_id);			
			$actions['examine'] = "<a href=\"$url\">$examine</a>";
			
			return $actions;
		}

		
		function add_user_row_action($actions, $user){
			global $wpdb;
		
			$examine = _('Examine');
			$url = ABDatabasePeek::show_table_link($wpdb->users, $user->ID);			
			$actions['examine'] = "<a href=\"$url\">$examine</a>";
			
			return $actions;
		}

		
	}
}