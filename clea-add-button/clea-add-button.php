<?php
/**
* Plugin Name: Clea add button
* Plugin URI:  http://knowledge.parcours-performance.com
* Description: Add a custom button at the end of each post
* Author:      Anne-Laure Delpech
* Author URI:  http://knowledge.parcours-performance.com
* License:     GPL2
* Domain Path: /languages
* Text Domain: clea-add-button
* 
* @package		clea-presentation
* @version		0.2.0
* @author 		Anne-Laure Delpech
* @copyright 	Copyright (c) 2016 Anne-Laure Delpech
* @link			https://github.com/aldelpech/CLEA-presentation
* @license 		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
* @since 		0.1.0
*/
 
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/*----------------------------------------------------------------------------*
 * Path to files
 * @since 0.7.0
 *----------------------------------------------------------------------------*/

define( 'CLEA_ADD_BUTTON_FILE', __FILE__ );
define( 'CLEA_ADD_BUTTON_BASENAME', plugin_basename( CLEA_ADD_BUTTON_FILE ));
define( 'CLEA_ADD_BUTTON_DIR_PATH', plugin_dir_path( CLEA_ADD_BUTTON_FILE ));
define( 'CLEA_ADD_BUTTON_DIR_URL', plugin_dir_url( CLEA_ADD_BUTTON_FILE ));
	

/********************************************************************************
* appeler d'autres fichiers php et les exécuter
* @since 0.1
********************************************************************************/	
	
// charger des styles, fonts ou scripts correctement
require_once CLEA_ADD_BUTTON_DIR_PATH . 'includes/clea-add-button-enqueues.php'; 

// internationalisation de l'extension
require_once CLEA_ADD_BUTTON_DIR_PATH . 'includes/clea-add-button-i18n.php'; 

// Settings page for the admin
require_once CLEA_ADD_BUTTON_DIR_PATH . 'admin/clea-add-button-settings-page.php'; 

// load styles and scripts for the admin
require_once CLEA_ADD_BUTTON_DIR_PATH . 'admin/clea-add-button-admin-enqueue.php'; 

/******************************************************************************
* Actions à réaliser à l'initialisation et l'activation du plugin
* @since 0.1 
******************************************************************************/



	
function clea_add_button_activation() {

}
register_activation_hook(__FILE__, 'clea_add_button_activation');
	
/*----------------------------------------------------------------------------*
 * deactivation and uninstall
 *----------------------------------------------------------------------------*/
/* upon deactivation, wordpress also needs to rewrite the rules */
register_deactivation_hook(__FILE__, 'clea_add_button_deactivation');

function clea_add_button_deactivation() {
	
}

// register uninstaller
register_uninstall_hook(__FILE__, 'clea_add_button_uninstall');

function clea_add_button_uninstall() {    
	// actions to perform once on plugin uninstall go here
	// remove all options and custom tables
	
	$option_name = 'clea_add_button';
 
	delete_option( $option_name );
	 
	// For site options in Multisite
	delete_site_option( $option_name );  
	
}