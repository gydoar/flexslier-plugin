<?php
/*
Plugin Name: Flexslider plugin
Plugin URI: https://github.com/gydoar/flexslier-plugin
Description: Plugin creado con Flexslider para WordPress
Version: 1.0
Author: ANDRES DEV
Author URI: https://andres-dev.com
License: GPL2
*/

function post_type_flexslider() {

   
  register_post_type( 'flexslider',
	
  array( 'labels' => array(
    'name' => __( 'Flexslider', 'andres-dev' ), 
    'singular_name' => __( 'Flexslider', 'andres-dev' ), 
    'all_items' => __( 'Todos los sliders', 'andres-dev' ), 
    'add_new' => __( 'Agregar nuevo', 'andres-dev' ), 
    'add_new_item' => __( 'Agregar nuevo slider', 'andres-dev' ), 
    'edit' => __( 'Editar', 'andres-dev' ), 
    'edit_item' => __( 'Editar slider', 'andres-dev' ),
    'new_item' => __( 'Nuevo slider', 'andres-dev' ), 
    'view_item' => __( 'Ver slider', 'andres-dev' ), 
    'search_items' => __( 'Buscar slider', 'andres-dev' ), 
    'not_found' => __( 'No se encontraron resultados', 'andres-dev' ), 
    'not_found_in_trash' => __( 'No se encontró nada en la Papelera', 'andres-dev' ), 
    ), 
    'public' => true,
    'menu_position' => 2, 
    'menu_icon' => 'dashicons-images-alt', 
    'supports' => array( 'title', 'thumbnail')
    ) /* Fin de las opciones */
  ); /* Fin del registro post type */
 
    
}

add_action('init', 'post_type_flexslider');