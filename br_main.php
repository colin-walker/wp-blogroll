<?php

  if( !defined('ABSPATH') ) exit; //Don't run if accessed directly


/**
 *  WP Blogroll
 *
 *  @package wpblogroll
 *
 *  Plugin Name: WP Blogroll
 *
 *
 *  Description: Blogroll using custom post type
 *
 *  Version: 0.1
 *
 *  Author: Colin Walker
 *
*/


	add_action( 'plugins_loaded', 'blogroll_plugin' );

	function blogroll_plugin() {
		require_once('includes/br_post_type.php');
		require_once('includes/br_meta_box.php');
		require_once('includes/br_save_custom_fields.php');
		require_once('includes/br_shortcode.php');
	}

	add_action( 'init', 'blogroll_posttype' );
	add_action( 'add_meta_boxes', 'br_custom_meta' );
	add_action( 'save_post', 'br_save_url' );
	add_shortcode( 'blogroll', 'blogroll_shortcode' );

?>