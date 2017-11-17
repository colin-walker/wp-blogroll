<?php

	if(!defined('ABSPATH')) exit; //Don't run if accessed directly


	/**
	 *
	 * @package wpblogroll
	 *
	 * create blogroll meta box
	 *
	*/
	
	function br_custom_meta() {
		add_meta_box(
			'br_meta',
			'Link URL',
			'br_meta_callback',
			'blogroll', 
			'normal',
			'high'
		);
	}


	function br_meta_callback() {
		wp_nonce_field( 'save_post', 'br_nonce' );
		echo '<p><label for="link-url">LINK URL</label><br />';
		echo '<input type="text" id="link-url" name="link-url" value="" size="40"></p>';
		echo '<p><label for="feed-url">FEED URL</label><br />';
		echo '<input type="text" id="feed-url" name="feed-url" value="" size="40"></p>';
	}
	
	
?>
