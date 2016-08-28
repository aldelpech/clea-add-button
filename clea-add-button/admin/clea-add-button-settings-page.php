<?php
/**
 *
 * Créer une page de settings pour l'extension

 *
 * @link       	
 * @since      	0.2.0
 *
 * @package    clea-add-button
 * @subpackage clea-add-button/includes
 * Text Domain: clea-add-button
 */

//  Based on Anna's gist https://gist.github.com/annalinneajohansson/5290405
// http://codex.wordpress.org/Settings_API

/**********************************************************************

* to set the title of the setting page see -- clea_add_button_options_page()
* to set the sections see -- clea_add_button_settings_sections_val()
* to set the fields see -- clea_add_button_settings_fields_val()

**********************************************************************/

// create the settings page and it's menu
add_action( 'admin_menu', 'clea_add_button_admin_menu' );

// set the content of the admin page
add_action( 'admin_init', 'clea_add_button_admin_init' );


function clea_add_button_admin_menu() {
	
    add_options_page( 
		__('Options de Clea Add Button', 'clea-add-button' ),	// page title (H1)	
		__('Add Button', 'clea-add-button' ),						// menu title
		'manage_options', 										// required capability
		'my-plugin', 											// menu slug (unique ID)
		'clea_add_button_options_page' );						// callback function
}

function clea_add_button_admin_init() {
  
  	register_setting( 'my-settings-group', 'my-plugin-settings' );
	
	$set_sections = clea_add_button_settings_sections_val() ;
 
	// add_settings_section
	foreach( $set_sections as $section ) {
		
		add_settings_section( 
			$section[ 'section_name' ], 
			$section[ 'section_title' ] ,
			$section[ 'section_callbk' ], 
			$section[ 'menu_slug' ]
		);
		
	}	

	$set_fields = clea_add_button_settings_fields_val() ;
	
	// add the fields
	foreach ( $set_fields as $section_field ) {

		foreach( $section_field as $field ){

			add_settings_field( 
				$field['field_id'], 
				$field['label'], 
				$field['field_callbk'],  
				$field['menu_slug'], 
				$field['section_name'],
				$field
			);
		}

	}	
}


/**********************************************************************

* The actual page

**********************************************************************/
function clea_add_button_options_page() {
?>
  <div class="wrap">
      <h2><?php _e('My Plugin Options', 'clea-add-button'); ?></h2>
      <form action="options.php" method="POST">
        <?php settings_fields('my-settings-group'); ?>
        <?php do_settings_sections('my-plugin'); ?>
        <?php submit_button(); ?>
      </form>
  </div>
<?php }


function section_1_callback() {
	_e( 'Some help text regarding Section One goes here.', 'clea-add-button' );
}
function section_2_callback() {
	_e( 'Some help text regarding Section Two goes here.', 'clea-add-button' );
}


function field_1_1_callback( $arguments ) {
	
	$settings = (array) get_option( 'my-plugin-settings' );
	$field = "field_1_1";
	$value = esc_attr( $settings[$field] );
	
	echo "<input type='text' name='my-plugin-settings[$field]' value='$value' />";
	echo "<hr /><pre>";
	print_r( $arguments ) ;
	echo "</pre><hr />";	
}

function field_1_2_callback() {
	
	$settings = (array) get_option( 'my-plugin-settings' );
	$field = "field_1_2";
	$value = esc_attr( $settings[$field] );
	
	echo "<input type='text' name='my-plugin-settings[$field]' value='$value' />";
}
function field_2_1_callback() {
	
	$settings = (array) get_option( 'my-plugin-settings' );
	$field = "field_2_1";
	$value = esc_attr( $settings[$field] );
	
	echo "<input type='text' name='my-plugin-settings[$field]' value='$value' />";
}
function field_2_2_callback() {
	
	$settings = (array) get_option( 'my-plugin-settings' );
	$field = "field_2_2";
	$value = esc_attr( $settings[$field] );
	
	echo "<input type='text' name='my-plugin-settings[$field]' value='$value' />";
}
/*
* INPUT VALIDATION:
* */
function clea_add_button_settings_validate_and_sanitize( $input ) {
	$settings = (array) get_option( 'my-plugin-settings' );
	
	if ( $some_condition == $input['field_1_1'] ) {
		$output['field_1_1'] = $input['field_1_1'];
	} else {
		add_settings_error( 'my-plugin-settings', 'invalid-field_1_1', 'You have entered an invalid value into Field One.' );
	}
	
	if ( $some_condition == $input['field_1_2'] ) {
		$output['field_1_2'] = $input['field_1_2'];
	} else {
		add_settings_error( 'my-plugin-settings', 'invalid-field_1_2', 'You have entered an invalid value into Field One.' );
	}
	
	// and so on for each field
	
	return $output;
}

/**********************************************************************

* THE SECTIONS

**********************************************************************/

function clea_add_button_settings_sections_val() {

	$sections = array(
		array(
			'section_name' 	=> 'section-1', 
			'section_title'	=>  __( 'Section One', 'clea-add-button' ), 
			'section_callbk'=> 'section_1_callback', 
			'menu_slug'		=> 'my-plugin' ,								
		),
		array(
			'section_name' 	=> 'section-2',
			'section_title'	=>  __( 'Section Two', 'clea-add-button' ),
			'section_callbk'=> 'section_2_callback' ,
			'menu_slug'		=> 'my-plugin'
			),
	);	
	
	return $sections ;
	
}

/**********************************************************************

* THE FIELDS

**********************************************************************/
function clea_add_button_settings_fields_val() {



	$section_1_fields = array (
		array(
			'field_id' 		=> 'field-1-1', 							
			'label'			=> __( 'Field One', 'clea-add-button' ), 	
			'field_callbk'	=> 'field_1_1_callback', 					
			'menu_slug'		=> 'my-plugin', 							
			'section_name'	=> 'section-1',
			'type'			=> 'text',
			'helper'		=> __( 'help 1', 'clea-presentation' ),
			'default'		=> ''			
		),	
		array(
			'field_id' 		=> 'field-1-2',
			'label'			=> __( 'Field Two', 'clea-add-button' ),
			'field_callbk'	=> 'field_1_2_callback', 
			'menu_slug'		=> 'my-plugin', 
			'section_name'	=> 'section-1'
		),
	);
	
	$section_2_fields = array (
		array(
			'field_id' 		=> 'field-2-1', 
			'label'			=> __( 'Field One', 'clea-add-button' ), 
			'field_callbk'	=> 'field_2_1_callback', 
			'menu_slug'		=> 'my-plugin', 
			'section_name'	=> 'section-2'			
		),
		array(
			'field_id' 		=> 'field-2-2', 
			'label'			=> __( 'Field Two', 'clea-add-button' ), 
			'field_callbk'	=> 'field_2_2_callback', 
			'menu_slug'		=> 'my-plugin', 
			'section_name'	=> 'section-2'
		),
	);
	

	$section_fields = array(
		'section-1'	=> $section_1_fields,
		'section-2' => $section_2_fields
	) ;	

	
	
	return $section_fields ;
}
