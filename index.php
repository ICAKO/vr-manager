<?php
/*
 * Plugin Name: VR Manager
 */
 
 define( 'ARA_VR_MANAGER_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
 define( 'ARA_VR_MANAGER_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
 
 // Register Custom Post Type
 require_once 'inc/cpt.php';
 
 // Functions
 require_once 'inc/functions.php';
