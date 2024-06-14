<?php
/**
 * Functions File
 *
 * @package Nathalie Mota
 */

/**
 * Register Navigation Menus.
 */
function nathalie_mota_register_menus() {
    register_nav_menus( array(
        'primary' => esc_html__( 'Menu principal', 'nathalie-mota' ),
    ) );
}
add_action( 'init', 'nathalie_mota_register_menus' );

/**
 * Ajoute la classe "open-popup" au lien de menu "Contact".
 *
 * @param array   $atts Les attributs du lien de menu.
 * @param WP_Post $item L'objet représentant l'élément de menu.
 * @param array   $args Les arguments de la requête de menu.
 * @return array Les attributs modifiés du lien de menu.
 */
function ajouter_classe_open_popup($atts, $item, $args) {
    if ($item->title === 'Contact') {
        $atts['class'] = 'open-popup';
        $atts['href'] = '#'; // Ajoutez un lien vide pour éviter la redirection.
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'ajouter_classe_open_popup', 10, 3);

/**
 * Enqueue scripts and styles.
 */
function nathalie_mota_enqueue_scripts() {
    // Enqueue le fichier de style principal.
    wp_enqueue_style('nathalie-mota-style', get_stylesheet_uri());

    // Enqueue le script personnalisé principal.
    wp_enqueue_script('nathalie-mota-script', get_template_directory_uri() . '/assets/script.js', array('jquery'), '1.0', true);

    // Enqueue le script du carrousel.
    wp_enqueue_script('nathalie-mota-modal', get_template_directory_uri() . '/assets/modal.js', array('jquery'), null, true);
      // Enqueue le script du carrousel.
    //  wp_enqueue_script('nathalie-mota-modal', get_template_directory_uri() . '/assets/loadMorephotos.js', array('jquery'), null, true);//

    wp_enqueue_script('nathalie-mota-modal', get_template_directory_uri() . '/assets/banner.js', array('jquery'), null, true);
    // Localize the script with new data.
    wp_localize_script('nathalie-mota-modal', 'nmAjax', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
    ));
}
add_action('wp_enqueue_scripts', 'nathalie_mota_enqueue_scripts');

// Inclure les fichiers de fonctions.
//require_once get_template_directory() . '/custom-taxonomies.php';//
//require_once get_template_directory() . '/taxonomy-options.php';//:
require_once get_template_directory() . '/dropbox.php';
require_once get_template_directory() . '/loadmore.php';
require_once get_template_directory() . '/carrousel.php';
require_once get_template_directory() . '/banner.php';


?>

