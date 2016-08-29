<?php
/**
 *
 * Enqueue styles and scripts for the admin settings page

 *
 * @link       	
 * @since      	0.2.0
 *
 * @package    clea-add-button
 * @subpackage clea-add-button/admin
 * Text Domain: clea-add-button
 */
 
add_action( 'admin_enqueue_scripts',  'clea_add_button_admin_enqueue_scripts' );


function clea_add_button_admin_enqueue_scripts( $hook ) {
	

	// to find the right name, go to the settings page and inspect it
	// the name is somewhere in the <body class="">
	// it will always begin with settings_page_
	if( 'settings_page_my-plugin' != $hook ) { 
	
        // echo "not the right page, this is : " ;
		// echo $hook ;
		return;
		
    }

    wp_enqueue_style(
        'alpha-color-picker',
        CLEA_ADD_BUTTON_DIR_URL . '/admin/css/alpha-color-picker.css', // Update to where you put the file.
        array( 'wp-color-picker' ) // You must include these here.
    );

	wp_enqueue_script(
        'alpha-color-picker',
        CLEA_ADD_BUTTON_DIR_URL . '/admin/js/alpha-color-picker.js', 
        array( 'jquery', 'wp-color-picker' ), // You must include these here.
        null,
        true
    );
	
    // This is the JS file that will contain the trigger script.
    // Set alpha-color-picker as a dependency here.
    wp_enqueue_script(
        'clea-add-button-admin-color-js',
        CLEA_ADD_BUTTON_DIR_URL . '/admin/js/clea-add-button-color-trigger.js', 
        array( 'alpha-color-picker' ),
        null,
        true
    );
	
} 