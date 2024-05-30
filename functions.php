<?php
/**
 * Functions File
 *
 * @package Nathalie Mota
 */

/**
 * Enqueue les styles et scripts
 */
function nathalie_mota_enqueue_scripts() {
    // Enqueue le fichier de style principal
    wp_enqueue_style( 'nathalie-mota-style', get_stylesheet_uri() );

    // Enqueue le script personnalisé
    wp_enqueue_script( 'nathalie-mota-script', get_template_directory_uri() . '/assets/script.js', array('jquery'), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'nathalie_mota_enqueue_scripts' );

/**
 * Enregistre les menus de navigation
 */
function nathalie_mota_register_menus() {
    register_nav_menus( array(
        'primary' => esc_html__( 'Menu principal', 'nathalie-mota' ),
    ) );
}
add_action( 'init', 'nathalie_mota_register_menus' );

/**
 * Ajoute des tailles d'images personnalisées
 */
function nathalie_mota_add_image_sizes() {
    add_image_size( 'featured-image', 1200, 600, true );
}
add_action( 'after_setup_theme', 'nathalie_mota_add_image_sizes' );


/**
 * Fonction pour traiter les requêtes Ajax
 *
 * Cette fonction est appelée lorsqu'une requête Ajax est envoyée depuis le frontend.
 */
function nathalie_mota_ajax_function() {
    // Code pour traiter la requête Ajax
    // Vous pouvez ajouter votre code ici pour traiter les requêtes Ajax
    // Par exemple, vous pouvez utiliser $_POST pour récupérer les données envoyées via Ajax
    // Et ensuite, vous pouvez effectuer le traitement nécessaire en fonction de ces données
}
add_action('wp_ajax_nopriv_nathalie_mota_ajax', 'nathalie_mota_ajax_function');
add_action('wp_ajax_nathalie_mota_ajax', 'nathalie_mota_ajax_function');


/**
 * Ajoute la classe open-popup au lien de menu "Contact"
 *
 * @param array  $atts  Les attributs du lien de menu
 * @param object $item  L'objet représentant l'élément de menu
 * @param array  $args  Les arguments de la requête de menu
 * @return array Les attributs modifiés du lien de menu
 */
function ajouter_classe_open_popup($atts, $item, $args) {
    if ($item->title === 'Contact') {
        $atts['class'] = 'open-popup';
        $atts['href'] = '#'; // Ajoutez un lien vide pour éviter la redirection
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'ajouter_classe_open_popup', 10, 3);

?>
