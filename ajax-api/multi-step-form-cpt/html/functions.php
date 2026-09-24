<?php
// ****************************************
// Functions - Child Site Settings

function astra_child_enqueue_scripts() {
	// Enqueue custom CSS file
	wp_enqueue_style( 'astra-child-style', get_stylesheet_directory_uri() . '/custom-styles.css', array(), filemtime(get_stylesheet_directory().'/custom-styles.css'));

	// Enqueue custom JavaScript file
	wp_enqueue_script( 'astra-child-script', get_stylesheet_directory_uri() . '/assets/js/custom-js.js', array( 'jquery' ), filemtime(get_stylesheet_directory().'/assets/js/custom-js.js'), true );

	// ... other scripts

	// Localize the AJAX URL
	wp_localize_script('astra-child-script', 'customScriptData', array(
		'ajaxurl' => admin_url('admin-ajax.php'),
	));
}
add_action( 'wp_enqueue_scripts', 'astra_child_enqueue_scripts', 99 );

require_once 'inc/functions-cpt.php';
require_once 'inc/functions-custom.php';
require_once 'inc/functions-ajax-post.php';
// ... other includes
