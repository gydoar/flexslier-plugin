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



// Registrando estilos
function flx_registrar_estilos() {
    // registrar
    wp_register_style('flx_styles', plugins_url('css/flexslider.css', __FILE__));
 
    // colocar
    wp_enqueue_style('flx_styles');
}

add_action('wp_print_styles', 'flx_registrar_estilos');

// Registrando scripts
function flx_registrar_scripts() {
    if (!is_admin()) {
        // registrar
        // en esta función registramos jquery.flexslider.js y a demás la libreria jquery desde el core de WordPress
        wp_register_script('flx_script', plugins_url('js/jquery.flexslider.js', __FILE__), array( 'jquery' ));
        wp_register_script('scripts', plugins_url('js/scripts.js', __FILE__));
 
        // colocar
        wp_enqueue_script('flx_script');
        wp_enqueue_script('scripts');
    }
}

add_action('wp_print_scripts', 'flx_registrar_scripts');


//Soporte para thumbnails

add_image_size('thum-flx', 600, 280, true); // declaramos el nombre del thumbnail 'thum-flx' y su tamaño
add_theme_support( 'post-thumbnails' ); // agregamos soporte para que pueda funcionar



// Creamos la función para mostrarlo desde el frontend
function flx_funcion($type='thum-flx') {
    $args = array(
        'post_type' => 'flexslider',
        'posts_per_page' => 5
    );
    $result = '<div class="flexslider">';
    $result .= '<ul class="slides">';
 
    // el loop
    $loop = new WP_Query($args);
    while ($loop->have_posts()) {
        $loop->the_post();
 
        $the_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $type);
        $result .= '<li>';
        $result .= '<img alt="'.get_the_title().'" src="'. $the_url[0] . '" />';
        $result .= '</li>';
    }
    $result .= '</ul>';
    $result .='</div>';
    return $result;
}

// creamos un shortcode llamado [flx-shortcode] para llamarlo donde deseemos
add_shortcode('flx-shortcode', 'flx_funcion');