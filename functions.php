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

    // Localize the script with new data
    wp_localize_script( 'nathalie-mota-script', 'nmAjax', array(
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
    ) );
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


// Ajouter la prise en charge des images mises en avant
add_theme_support( 'post-thumbnails' );
/**
 * Ajoute des tailles d'images personnalisées
 */
function nathalie_mota_add_image_sizes() {
    add_image_size( 'custom-thumb', 564, 495, true );
}
add_action( 'after_setup_theme', 'nathalie_mota_add_image_sizes' );

/**
 * Fonction pour traiter les requêtes Ajax
 *
 * Cette fonction est appelée lorsqu'une requête Ajax est envoyée depuis le frontend.
 */

add_action('wp_ajax_nopriv_nathalie_mota_ajax', 'nathalie_mota_ajax_function');
add_action('wp_ajax_nathalie_mota_ajax', 'nathalie_mota_ajax_function');
function nathalie_mota_load_more_photos() {
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $photos_per_page = isset($_POST['photos_per_page']) ? intval($_POST['photos_per_page']) : 8;

    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => $photos_per_page,
        'paged' => $page,
        'order' => 'ASC'
    );

    $photo_query = new WP_Query($args);
    if ($photo_query->have_posts()) :
        while ($photo_query->have_posts()) : $photo_query->the_post(); ?>
            <div class="photo-item">
                <?php if (get_field('image')): ?>
                    <?php $image = get_field('image'); ?>
                    <div class="photo-thumbnail">
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" style="width: 564px; height: 495px; border: 1px solid #FFFFFF;" />
                        <div class="lightbox">
                            <div class="lightbox-content">
                                <div class="lightbox-title"><?php the_title(); ?></div>
                                <a href="<?php the_permalink(); ?>" class="lightbox-icon eye-icon" title="Voir le détail de la photo"></a>
                                <a href="<?php echo esc_url($image['url']); ?>" class="lightbox-icon fullscreen-icon" title="Afficher en plein écran"></a>
                                <div class="lightbox-category"><?php echo get_the_term_list( get_the_ID(), 'category', '', ', ' ); ?></div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endwhile;
        wp_reset_postdata();
    else :
        echo 0; // Indicate no more posts
    endif;

    wp_die();
}
add_action('wp_ajax_load_more_photos', 'nathalie_mota_load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'nathalie_mota_load_more_photos');
add_action('wp_ajax_load_more_photos', 'nathalie_mota_load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'nathalie_mota_load_more_photos');

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
