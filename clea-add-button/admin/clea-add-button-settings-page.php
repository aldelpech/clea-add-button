<?php
/**
 *
 * Créer une page de settings pour l'extension

 *
 * @link       	
 * @since      	0.2.0
 *
 * @package    clea-add-button
 * @subpackage clea-add-button/admin
 * Text Domain: clea-add-button
 */

//  Based on Anna's gist https://gist.github.com/annalinneajohansson/5290405
// http://codex.wordpress.org/Settings_API


/**********************************************************************
* DEBUG ?
***********************************************************************/

define('ENABLE_DEBUG', false );	// if true, the script will echo debug data

/**********************************************************************

* to set the title of the setting page see -- clea_add_button_options_page()
* to set the section rendering see -- clea_add_button_settings_section_callback( $args  )
* to set the array of sections see -- clea_add_button_settings_sections_val()
* to set the fields rendering see -- clea_add_button_settings_field_callback( $arguments  )
* to set the array of fields see -- clea_add_button_settings_fields_val()

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
  
	if( false == get_option( 'my-plugin-settings' ) ) {  
		add_option( 'my-plugin-settings' );
	}
	
	register_setting( 'my-settings-group', 'my-plugin-settings' ) ;
	
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

	<?php
	// for development only
	if ( ENABLE_DEBUG ) {

		$colors = clea_add_button_get_current_colors() ;
		echo "<hr /><p>Arguments</p><pre>";
		print_r( $colors ) ;	
		echo "</pre><hr />";
	
		echo "<hr /><p>Arguments</p><pre>";
		print_r( $arguments ) ;	
		echo "</pre><hr />";
		echo "<hr /><p>Options</p><pre>";
		print_r( $settings ) ;	
		echo "</pre><hr />";
	}  
	?>

	</div>
<?php }

/**********************************************************************

* Section callback

**********************************************************************/

function clea_add_button_settings_section_callback( $args  ) {
	
	$sect_descr = array(

		'section-1' 	=> __( 'Text regarding Section One goes here.', 'clea-presentation' ),
		'section-2' 	=> __( 'Text regarding Section Two goes here.', 'clea-presentation' )
	);		

	$description = $sect_descr[ $args['id'] ] ;
	printf( '<span class="section-description">%s<span>', $description );

	if ( ENABLE_DEBUG ) {
		
		if ( is_plugin_active( CLEA_ADD_BUTTON_DIR_PATH . 'query-monitor-extension-checking-variables/query-monitor-check-var.php' ) ) {
		  	
			console( $args );	
			
		} 

	}
}

/**********************************************************************

* Field callback

**********************************************************************/

function clea_add_button_settings_field_callback( $arguments  ) {


	$settings = (array) get_option( "my-plugin-settings" );
	$field = $arguments[ 'field_id' ] ;
	
	// for development only
	if ( ENABLE_DEBUG ) {
		
		echo "<hr /><p>Arguments</p><pre>";
		print_r( $arguments ) ;	
		echo "</pre><hr />";
		echo "<hr /><p>Options</p><pre>";
		print_r( $settings ) ;	
		echo "</pre><hr />";
	}
		
	// set a $options array with the field id as it's key
	if ( !empty( $settings ) ) {
		foreach ( $settings as $key => $option ) {
			$options[$key] = $option;
		}
	}	
	
	// now check if $options[ $field ] is set
	if( isset( $options[ "$field" ] ) ) {
			$value = $settings[ $field ] ;
	} else {
			// set the value to the default value
			$value = $arguments[ 'default' ] ;
	}	

	// If there is a help text and / or description
	printf( '<span class="field_desc">' ) ;
	
    if( isset( $arguments['helper'] ) && $helper = $arguments['helper'] ){

		printf( '<span class="helper" data-descr="%2$s"><img src="%1$s/images/question-mark.png" class="alignleft" id="helper" alt="help" data-pin-nopin="true"></span>',CLEA_ADD_BUTTON_DIR_URL, $helper ) ;
    }
	
	// If there is a description
    if( isset( $arguments['label'] ) && $description = $arguments['label'] ){
        printf( ' %s', $description ); // Show it
    }

	printf( '</span>' ) ;

	$name = 'my-plugin-settings['. $field . ']' ;

	switch( $arguments['type'] ){
		
		case 'text' : 
			printf( '<input type="text" id="%3$s" name="%2$s" value="%1$s" />', esc_attr( $value ), $name, $field );
			break ;
		case 'textarea' : 
			printf( '<textarea name="%2$s" id="%3$s" rows="4" cols="80" value="%1$s">%1$s</textarea>', esc_textarea( $value ), $name, $field );
			break ;
		case 'select': // If it is a select dropdown

		if( ! empty ( $arguments['options'] ) && is_array( $arguments['options'] ) ){
			
			printf( '<select id="%2$s" name="%1$s">', $name, $field );
			foreach( $arguments['options'] as $item ) {
				$selected = ( $value	 == $item ) ? 'selected="selected"' : '';
				echo "<option value='$item' $selected>$item</option>";
			}
			echo "</select>";	
			
			} else {
				echo __( 'Indiquer les options dans la définition du champs', 'clea-add-button' ) ;
			}
			break;
		case 'checkbox' : 
			printf( '<input type="hidden" name="%1$s" id="%2$s" value="0" />', $name, $field ) 	;
			$checked = '' ;
			if( $value ) { $checked = ' checked="checked" ' ; }
			printf( ' <input %3$s id="%2$s" name="%1$s" type="checkbox" />', $name, $field, $checked ) ;
			break ;
		case 'radio' : // radio buttons
			if( ! empty ( $arguments['options'] ) && is_array( $arguments['options'] ) ){
				
				echo "<span class='radio'>" ;
				foreach( $arguments['options'] as $key => $label ){
					
					$items[] = $label ;
				}

				foreach( $arguments['options'] as $item) {
					$checked = ( $value == $item ) ? 'checked' : '';
					printf( '<label><input type="radio" value="%2$s" name="%1$s" %3$s> %2$s</label><br />', $name, $item, $checked );
				}
				echo "</span>" ;
			}
			break ;
		case 'wysiwig' :
		
			// sanitize data for the wp_editor
			$content = wp_kses_post( $value ) ;
			
			$args = array(
				'textarea_name' => $name
			) ;
			
			wp_editor( $content, $field, $args );		
			break ;	
		case 'color' :
	
			// get the colors used by the theme
			$current_colors = clea_presentation_get_current_colors() ;
			$data_palette = "";
			
			// the color palette must be a string with colors and | separator
			// "#222|#444|#00CC22|rgba(72,168,42,0.4)" would be ok
			foreach ( $current_colors as $color ) {
				
				$data_palette .= $color . '|' ;
				
			}
			
			$data_palette = rtrim( $data_palette, '|' ) ;
			
			
			// uses https://github.com/BraadMartin/components/tree/master/alpha-color-picker
			printf( '<input type="text" class="alpha-color-picker" name="%2$s" value="%1$s" data-palette="%5$s" data-default-color="%4$s" data-show-opacity="true" />', sanitize_text_field( $value ), $name, $field, $arguments['default'], $data_palette  ) ;
			break ;				
		default : 
			printf( esc_html__( 'This field is type <em>%s</em> and could not be rendered.', 'clea-add-button' ), $arguments['type']  );
			
	}
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

* find the colors used in the website's theme

**********************************************************************/
function clea_add_button_get_current_colors() {

	// to get all the current theme data in an array
	$mods = get_theme_mods();

	$color = array() ;
	
	foreach ( $mods as $key => $values ) {
		
		if ( !is_array( $values ) ) {
			
			if ( is_string( $values ) && trim( $values ) != '' ) {
				
				$hex = sanitize_hex_color_no_hash( $values ) ;
				
				if ( trim( $hex ) != '' ) {
					
					$color[ $key ] = $hex ;

				}

			}
		} 
	}

	// remove duplicate colors
	$colors = array_unique( $color ) ;
	
	return $colors ;
	
}

/**********************************************************************

* THE SECTIONS

**********************************************************************/

function clea_add_button_settings_sections_val() {

	$sections = array(
		array(
			'section_name' 	=> 'section-1', 
			'section_title'	=>  __( 'Section One', 'clea-add-button' ), 
			'section_callbk'=> 'clea_add_button_settings_section_callback', 
			'menu_slug'		=> 'my-plugin' ,								
		),
		array(
			'section_name' 	=> 'section-2',
			'section_title'	=>  __( 'Section Two', 'clea-add-button' ),
			'section_callbk'=> 'clea_add_button_settings_section_callback' ,
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
			'field_callbk'	=> 'clea_add_button_settings_field_callback', 					
			'menu_slug'		=> 'my-plugin', 							
			'section_name'	=> 'section-1',
			'type'			=> 'text',
			'helper'		=> __( 'help 1-1', 'clea-presentation' ),
			'default'		=> ''			
		),	
		array(
			'field_id' 		=> 'field-1-2',
			'label'			=> __( 'Field Two : textarea', 'clea-add-button' ),
			'field_callbk'	=> 'clea_add_button_settings_field_callback', 
			'menu_slug'		=> 'my-plugin', 
			'section_name'	=> 'section-1',
			'type'			=> 'textarea',
			'helper'		=> __( 'help 1-2', 'clea-presentation' ),
			'default'		=> ''			
		),
		array(
			'field_id' 		=> 'field-1-3', 
			'label'			=> __( 'Field three : select', 'clea-add-button' ), 
			'field_callbk'	=> 'clea_add_button_settings_field_callback', 
			'menu_slug'		=> 'my-plugin', 
			'section_name'	=> 'section-1',
			'type'			=> 'select',
			'helper'		=> __( 'help 1-3', 'clea-presentation' ),
			'default'		=> '',
			'options'		=> array(
								__( 'Choix 1', 'clea-add-button' ) ,
								__( 'Choix 2', 'clea-add-button' )	,
								__( 'Choix 3', 'clea-add-button' )
							),				
		),
		array(
			'field_id' 		=> 'field-1-4', 
			'label'			=> __( 'Field four : checkbox', 'clea-add-button' ), 
			'field_callbk'	=> 'clea_add_button_settings_field_callback', 
			'menu_slug'		=> 'my-plugin', 
			'section_name'	=> 'section-1',
			'type'			=> 'checkbox',
			'helper'		=> __( 'help 1-4', 'clea-presentation' ),
			'default'		=> '',
		),
	);
	
	$section_2_fields = array (
		array(
			'field_id' 		=> 'field-2-1', 
			'label'			=> __( 'Field One : radio', 'clea-add-button' ), 
			'field_callbk'	=> 'clea_add_button_settings_field_callback', 
			'menu_slug'		=> 'my-plugin', 
			'section_name'	=> 'section-2',
			'type'			=> 'radio',
			'helper'		=> __( 'help 2-1', 'clea-presentation' ),
			'default'		=> '',
			'options'		=> array(
								__( 'Choix 1', 'clea-add-button' ) ,
								__( 'Choix 2', 'clea-add-button' )	,
								__( 'Choix 3', 'clea-add-button' )
							),			
		),
		array(
			'field_id' 		=> 'field_2_2', 	// The field id may not use 
			'label'			=> __( 'Field Two : wysiwig', 'clea-add-button' ), 
			'field_callbk'	=> 'clea_add_button_settings_field_callback', 
			'menu_slug'		=> 'my-plugin', 
			'section_name'	=> 'section-2',
			'type'			=> 'wysiwig',
			'helper'		=> __( 'help 2-2', 'clea-presentation' ),
			'default'		=> ''			
		),
		array(
			'field_id' 		=> 'field-2-3', 
			'label'			=> __( 'Field three : color', 'clea-add-button' ), 
			'field_callbk'	=> 'clea_add_button_settings_field_callback', 
			'menu_slug'		=> 'my-plugin', 
			'section_name'	=> 'section-2',
			'type'			=> 'color',
			'helper'		=> __( 'help 2-3', 'clea-presentation' ),
			'default'		=> 'rgba(0,0,0,0.85)'			
		),
	);
	

	$section_fields = array(
		'section-1'	=> $section_1_fields,
		'section-2' => $section_2_fields
	) ;	

	
	
	return $section_fields ;
}
