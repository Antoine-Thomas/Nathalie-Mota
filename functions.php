<?php
/**
 * Functions File
 * @package Nathalie Mota
 */

function nathalie_mota_register_menus() {
    register_nav_menus( array(
        'primary' => esc_html__( 'Menu principal', 'nathalie-mota' ),
    ) );
}
add_action( 'init', 'nathalie_mota_register_menus' );

function ajouter_classe_open_popup($atts, $item, $args) {
    if ($item->title === 'Contact') {
        $atts['class'] = 'open-popup';
        $atts['href'] = '#'; // Ajoutez un lien vide pour éviter la redirection.
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'ajouter_classe_open_popup', 10, 3);

function nathalie_mota_enqueue_scripts() {
    // Enqueue styles
    wp_enqueue_style('nathalie-mota-style', get_template_directory_uri() . '/css/style.css');
    wp_enqueue_style('nathalie-mota-querymedia', get_template_directory_uri() . '/css/querymedia.css');
  

    // Enqueue scripts
    wp_enqueue_script('jquery');
    wp_enqueue_script('nathalie-mota-script', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.0', true);
    wp_enqueue_script('nathalie-mota-modal', get_template_directory_uri() . '/js/modal.js', array('jquery'), null, true);

    // Localize scripts
    wp_localize_script('nathalie-mota-script', 'nmAjax', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
    ));
}
add_action('wp_enqueue_scripts', 'nathalie_mota_enqueue_scripts');

// Charger les polices Poppins et Space Mono
function nathalie_mota_load_fonts() {
    // Charger les polices Poppins en format WOFF2
    wp_enqueue_style( 'poppins-medium', get_template_directory_uri() . '/assets/fonts/Poppins-Medium.woff2', array(), null );
    wp_enqueue_style( 'poppins-medium-italic', get_template_directory_uri() . '/assets/fonts/Poppins-MediumItalic.woff2', array(), null );
    wp_enqueue_style( 'poppins-regular', get_template_directory_uri() . '/assets/fonts/Poppins-Regular.woff2', array(), null );

    // Charger les polices Space Mono en format WOFF2
    wp_enqueue_style( 'space-mono-bold-italic', get_template_directory_uri() . '/assets/fonts/SpaceMono-BoldItalic.woff2', array(), null );
    wp_enqueue_style( 'space-mono-italic', get_template_directory_uri() . '/assets/fonts/SpaceMono-Italic.woff2', array(), null );
    wp_enqueue_style( 'space-mono-regular', get_template_directory_uri() . '/assets/fonts/SpaceMono-Regular.woff2', array(), null );
    wp_enqueue_style( 'space-mono-bold', get_template_directory_uri() . '/assets/fonts/SpaceMono-Bold.woff2', array(), null );
}
add_action('wp_enqueue_scripts', 'nathalie_mota_load_fonts');


// Inclure d'autres fichiers API REST nécessaires
require_once get_template_directory() . '/inc/dropbox.php';
require_once get_template_directory() . '/inc/loadmore.php';
require_once get_template_directory() . '/inc/carrousel.php';
require_once get_template_directory() . '/inc/banner.php';

// Ajouter support WebP
function add_webp_support($mimes) {
    $mimes['webp'] = 'images/webp';
    return $mimes;
}
add_filter('mime_types', 'add_webp_support');

// Lazy loading des images
function add_lazy_loading_to_images($content) {
    if (is_feed() || is_preview()) {
        return $content;
    }
    if (false !== strpos($content, 'loading="lazy"')) {
        return $content;
    }
    // Correction de l'expression régulière pour éviter l'erreur
    $content = preg_replace('/<img(.*?)\/?>/i', '<img$1 loading="lazy" />', $content);
    return $content;
}
add_filter('the_content', 'add_lazy_loading_to_images');
add_filter('post_thumbnail_html', 'add_lazy_loading_to_images');
add_filter('get_avatar', 'add_lazy_loading_to_images');
add_filter('widget_text', 'add_lazy_loading_to_images');





