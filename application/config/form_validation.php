<?php 
if( ! defined('BASEPATH') ) exit('No direct script access allowed');


$config = array(

	'tractor_put' => array(
			array( 'field'=>'patente_tractor', 'label'=>'Patente Tractor','rules'=>'trim|required'),
			array( 'field'=>'year', 'label'=>'Año','rules'=>'trim|required|min_length[4]' ),
			
		),

	'rol_put' => array(
			array( 'field'=>'descripcion', 'label'=>'Descripcion','rules'=>'trim|required'),
		),

	'persona_post' => array(
			array( 'field'=>'cuit_cuil', 'label'=>'cuit/cuil','rules'=>'numeric|required|is_unique[persona.cuit_cuil]'),
			
		),

	'persona_put' => array(
			array( 'field'=>'cuit_cuil', 'label'=>'cuit/cuil','rules'=>'numeric'),
			
		),

	'lugarcarga_post' => array(
			array( 'field'=>'descripcion', 'label'=>'Descripcion','rules'=>'trim|required'),
			array( 'field'=>'latitud', 'label'=>'Latitud','rules'=>'trim|required'),
			array( 'field'=>'logitud', 'label'=>'Logitud','rules'=>'trim|required')
		),
	'destino_post' => array(
			array( 'field'=>'descripcion', 'label'=>'Descripcion','rules'=>'trim|required'),
			array( 'field'=>'persona_autorizada', 'label'=>'Nombre de Persona autorizada','rules'=>'min_length[3]'),
			array( 'field'=>'apellido_autorizada', 'label'=>'Apellido de Persona autorizada','rules'=>'min_length[3]'),
			array( 'field'=>'latitud', 'label'=>'Latitud','rules'=>'trim|required'),
			array( 'field'=>'logitud', 'label'=>'Logitud','rules'=>'trim|required')
		)


	


);



?>