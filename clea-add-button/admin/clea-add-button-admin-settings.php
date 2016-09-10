<?php
/**
 *
 * Les champs et sections à mettre dans la page de réglages de l'extension
 * Attention ce fichier doit absolument étre encodé en UTF8 si on veut des accents. 
 * 
 * 
 * @link       	
 * @since      	0.3.0
 *
 * @package    clea-add-button
 * @subpackage clea-add-button/admin
 * Text Domain: clea-add-button
 */

/**********************************************************************

* THE SECTIONS

**********************************************************************/

function clea_add_button_settings_sections_val() {

	$sections = array(
		array(
			'section_name' 	=> 'section-1', 
			'section_title'	=>  __( 'Section One àçéèîùö', 'clea-add-button' ), 
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
		array(
			'field_id' 		=> 'field-1-5', 
			'label'			=> __( 'Field 5 : date picker', 'clea-add-button' ), 
			'field_callbk'	=> 'clea_add_button_settings_field_callback', 
			'menu_slug'		=> 'my-plugin', 
			'section_name'	=> 'section-1',
			'type'			=> 'date-picker',
			'helper'		=> __( 'jj/mm/aaaa', 'clea-presentation' ),
			'default'		=> '',
		),
		array(
			'field_id' 		=> 'field-1-6', 
			'label'			=> __( 'Field 6 : email', 'clea-add-button' ), 
			'field_callbk'	=> 'clea_add_button_settings_field_callback', 
			'menu_slug'		=> 'my-plugin', 
			'section_name'	=> 'section-1',
			'type'			=> 'email',
			'helper'		=> __( 'aaaa@rrrr.ddd', 'clea-presentation' ),
			'default'		=> '',
		),
		array(
			'field_id' 		=> 'field-1-7', 
			'label'			=> __( 'Field 7 : url', 'clea-add-button' ), 
			'field_callbk'	=> 'clea_add_button_settings_field_callback', 
			'menu_slug'		=> 'my-plugin', 
			'section_name'	=> 'section-1',
			'type'			=> 'url',
			'helper'		=> __( 'http:// ou https://', 'clea-presentation' ),
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