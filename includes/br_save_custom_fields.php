<?php

	if(!defined('ABSPATH')) exit; //Don't run if accessed directly


	/**
	 *
	 * @package wpblogroll
	 *
	 * save custom fields
	 *
	*/
	
	
	function br_save_url ( $post_id ) {

		//add conditions to prevent values from being saved to the database
		//check if nonce exists and is verified

	
		if ( !isset( $_POST[ 'br_nonce'] ) ) {
  			return;
		}

		if ( !wp_verify_nonce( $_POST['br_nonce'], 'save_post' ) ) {
  			return;
		}

		//check permission to edit post

		if ( !current_user_can( 'edit_post', $post_id ) ) {
  			return;
		}

		//prevent update on autosave - values only to be added on update or save

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
  			return;
		}	

		//if fields are empty no need to save

		if ( isset( $_POST['link-url'] ) ) {
   			$link_url = sanitize_text_field( $_POST['link-url'] );
   			add_post_meta( $post_id, 'linkurl', $link_url, true );
   		}
		if ( isset( $_POST['feed-url'] ) ) {
   			$feed_url = sanitize_text_field( $_POST['feed-url'] );
   			add_post_meta( $post_id, 'feedurl', $feed_url, true );
   		}

		$content_post = get_post($post_id);
		$content = $content_post->post_content;

		$updated_post = array();
	        $updated_post['ID'] = $post_id;
	        $updated_post['post_content'] = $content;
		remove_action('save_post', 'br_save_url');
	        wp_update_post( $updated_post );
		add_action( 'save_post', 'br_save_url' );

		return $content;
	}
