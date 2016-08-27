<?php
/**
 *
 * charger le bon text domain (internationalisation)
 *
 *
 * @link       	https://github.com/aldelpech/clea-add-button
 * @since      	0.1.0
 *
 * @package    clea-add-button
 * @subpackage clea-presentation/includes
 * Text Domain: clea-add-button
 */

add_action( 'plugins_loaded', 'clea_add_button_load_plugin_textdomain' );
 
function clea_add_button_load_plugin_textdomain() {
	
    load_plugin_textdomain( 'clea-add-button', FALSE, CLEA_ADD_BUTTON_BASENAME . '/languages/' );
	
}
