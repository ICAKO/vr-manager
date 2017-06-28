<?php

/**
 * Register a VR Sites post type.
 */
 
function ara__register_posttype__vrmanager() {
	$labels = array(
		'name'               => _x( 'VR Sites', 'post type general name', 'vrmanager' ),
		'singular_name'      => _x( 'VR Sites', 'post type singular name', 'vrmanager' ),
		'menu_name'          => _x( 'VR Sites', 'admin menu', 'vrmanager' ),
		'name_admin_bar'     => _x( 'VR Sites', 'add new on admin bar', 'vrmanager' ),
		'add_new'            => _x( 'Add New', 'book', 'vrmanager' ),
		'add_new_item'       => __( 'Add New VR Site', 'vrmanager' ),
		'new_item'           => __( 'New VR Site', 'vrmanager' ),
		'edit_item'          => __( 'Edit VR Site', 'vrmanager' ),
		'view_item'          => __( 'View VR Site', 'vrmanager' ),
		'all_items'          => __( 'All VR Sites', 'vrmanager' ),
		'search_items'       => __( 'Search VR Sites', 'vrmanager' ),
		'parent_item_colon'  => __( 'Parent VR Site:', 'vrmanager' ),
		'not_found'          => __( 'No VR Sites found.', 'vrmanager' ),
		'not_found_in_trash' => __( 'No VR Sites found in Trash.', 'vrmanager' )
	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'Description.', 'vrmanager' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'vrmanager' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon'			 => 'dashicons-admin-site',
		'supports'           => array( 'title', 'thumbnail' )
	);

	register_post_type( 'vrmanager', $args );
}

add_action( 'init', 'ara__register_posttype__vrmanager' );