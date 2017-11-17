<?php

	if(!defined('ABSPATH')) exit; //Don't run if accessed directly


	/**
	 *
	 * @package wpblogroll
	 *
	 * create custom post type
	 *
	*/
	
function blogroll_posttype() {
	$labels = array(
 		'name' => 'blogroll',
    	'singular_name' => 'blogroll link',
    	'add_new' => 'Add New Link',
    	'add_new_item' => 'Add New Link',
    	'edit_item' => 'Edit Link',
    	'new_item' => 'New Link',
    	'all_items' => 'All Links',
    	'view_item' => 'View Link',
    	'search_items' => 'Search Links',
    	'not_found' =>  'No Links Found',
    	'not_found_in_trash' => 'No Links found in Trash', 
    	'parent_item_colon' => '',
    	'menu_name' => 'Blogroll',
    );
	
    //register post type
	register_post_type( 'blogroll', array(
		'labels' => $labels,
		'has_archive' => true,
 		'public' => true,
		'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'thumbnail','page-attributes' ),
		'exclude_from_search' => false,
		'capability_type' => 'post',
		'rewrite' => array( 'slug' => 'links' ),
		)
	);
}

?>