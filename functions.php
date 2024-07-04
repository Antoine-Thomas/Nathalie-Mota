<?php
/**
 * Functions File
 *
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
    wp_enqueue_script('nathalie-mota-banner', get_template_directory_uri() . '/js/banner.js', array('jquery'), null, true);

    // Localize scripts
    wp_localize_script('nathalie-mota-banner', 'nmAjax', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
    ));
}
add_action('wp_enqueue_scripts', 'nathalie_mota_enqueue_scripts');

// Charger les polices Poppins et Space Mono
function nathalie_mota_load_fonts() {
    wp_enqueue_style( 'poppins-medium', get_template_directory_uri() . '/assets/fonts/Poppins-Medium.ttf', array(), null );
    wp_enqueue_style( 'poppins-medium-italic', get_template_directory_uri() . '/assets/fonts/Poppins-MediumItalic.ttf', array(), null );
    wp_enqueue_style( 'poppins-regular', get_template_directory_uri() . '/assets/fonts/Poppins-Regular.ttf', array(), null );
    wp_enqueue_style( 'space-mono-bold-italic', get_template_directory_uri() . '/assets/fonts/SpaceMono-BoldItalic.ttf', array(), null );
    wp_enqueue_style( 'space-mono-italic', get_template_directory_uri() . '/assets/fonts/SpaceMono-Italic.ttf', array(), null );
    wp_enqueue_style( 'space-mono-regular', get_template_directory_uri() . '/assets/fonts/SpaceMono-Regular.ttf', array(), null );
    wp_enqueue_style( 'space-mono-bold', get_template_directory_uri() . '/assets/fonts/SpaceMono-Bold.ttf', array(), null );
}
add_action('wp_enqueue_scripts', 'nathalie_mota_load_fonts');


function load_photos_for_banner() {
    $directory = get_template_directory() . '/images/PhotosNMota/';
    $images = glob($directory . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
    
    // Limiter le nombre d'images à charger
    $max_images = 10; // Limitez à 10 images par exemple
    $images = array_slice($images, 0, $max_images);

    // Filtrer les images de paysage
    $landscape_images = array_filter($images, function($image) {
        list($width, $height) = getimagesize($image);
        return $width > $height; // Filtrer les images de paysage
    });

    $image_urls = array_map(function($image) {
        return get_template_directory_uri() . '/images/PhotosNMota/' . basename($image);
    }, $landscape_images);

    echo json_encode($image_urls);
    wp_die();
}


add_action('wp_ajax_load_photos_for_banner', 'load_photos_for_banner');
add_action('wp_ajax_nopriv_load_photos_for_banner', 'load_photos_for_banner');

// Inclure d'autres fichiers nécessaires
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
    $content = preg_replace('/<img(.*?)\/?>/i', '<img$1 loading="lazy" />', $content);
    return $content;
}
add_filter('the_content', 'add_lazy_loading_to_images');
add_filter('post_thumbnail_html', 'add_lazy_loading_to_images');
add_filter('get_avatar', 'add_lazy_loading_to_images');
add_filter('widget_text', 'add_lazy_loading_to_images');


