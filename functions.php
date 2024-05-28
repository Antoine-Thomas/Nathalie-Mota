<?php
/**
 * Functions File
 *
 * @package Nathalie Mota
 */

// Enqueue styles and scripts
function nathalie_mota_enqueue_scripts() {
    // Enqueue main stylesheet
    wp_enqueue_style( 'nathalie-mota-style', get_stylesheet_uri() );
    // Enqueue custom script
    wp_enqueue_script( 'nathalie-mota-script', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'nathalie_mota_enqueue_scripts' );

// Register navigation menus
function nathalie_mota_register_menus() {
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary Menu', 'nathalie-mota' ),
    ) );
}
add_action( 'init', 'nathalie_mota_register_menus' );

// Custom excerpt length
function nathalie_mota_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'nathalie_mota_custom_excerpt_length' );

// Add custom image sizes
function nathalie_mota_add_image_sizes() {
    add_image_size( 'featured-image', 1200, 600, true );
}
add_action( 'after_setup_theme', 'nathalie_mota_add_image_sizes' );

// Custom pagination for archive pages
function nathalie_mota_pagination() {
    global $wp_query;

    $big = 999999999; // need an unlikely integer

    echo paginate_links( array(
        'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format'    => '?paged=%#%',
        'current'   => max( 1, get_query_var('paged') ),
        'total'     => $wp_query->max_num_pages,
        'prev_text' => '&laquo;',
        'next_text' => '&raquo;',
    ) );
}
?>
