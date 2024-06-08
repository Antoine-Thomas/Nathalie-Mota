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
    wp_enqueue_style('nathalie-mota-style', get_stylesheet_uri());

    // Enqueue le script personnalisé principal
    wp_enqueue_script('nathalie-mota-script', get_template_directory_uri() . '/assets/script.js', array('jquery'), '1.0', true);

    // Enqueue le script du carrousel
    wp_enqueue_script('nathalie-mota-carousel', get_template_directory_uri() . '/assets/js/carousel.js', array('jquery'), '1.0', true);

    // Localize the script with new data
    wp_localize_script('nathalie-mota-carousel', 'nmAjax', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
    ));
}
add_action('wp_enqueue_scripts', 'nathalie_mota_enqueue_scripts');

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

function add_ajaxurl_to_front_end() {
    ?>
    <script>
        var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
    </script>
    <?php
}
add_action('wp_head', 'add_ajaxurl_to_front_end');


/**
 * Ajoute des tailles d'images personnalisées
 */
function nathalie_mota_add_image_sizes() {
    add_image_size( 'custom-thumb', 564, 495, true ); // Taille actuelle pour les images en paysage
    add_image_size( 'portrait-medium', 564, 800, true ); // Nouvelle taille pour les images en portrait
}
add_action( 'after_setup_theme', 'nathalie_mota_add_image_sizes' );



/**
 * Fonction pour charger plus de photos via AJAX
 */

 function nathalie_mota_load_more_photos() {
    // Vérifie si les données POST spécifiques sont présentes
    if ( isset( $_POST['page'] ) && isset( $_POST['photos_per_page'] ) ) {
        $page = intval( $_POST['page'] );
        $photos_per_page = intval( $_POST['photos_per_page'] );

        // Utilisez l'offset pour récupérer les photos suivantes à partir de la page actuelle
        $offset = ($page - 1) * $photos_per_page;

        $args = array(
            'post_type'      => 'photo',
            'posts_per_page' => $photos_per_page, // Récupérer un nombre limité de photos
            'offset'         => $offset,
            'order'          => 'ASC',
        );

        $photo_query = new WP_Query($args);
        if ($photo_query->have_posts()) :
            while ($photo_query->have_posts()) : $photo_query->the_post(); ?>
                <div class="photo-item">
                    <?php if (get_field('image')): ?>
                        <?php $image = get_field('image'); ?>
                        <?php
                        // Déterminer la classe CSS en fonction des dimensions de l'image
                        $image_size_class = ( $image['height'] > $image['width'] ) ? 'portrait' : 'landscape';
                        ?>
                        <div class="photo-thumbnail <?php echo $image_size_class; ?>">
                            <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
                            <div class="lightbox">
                                <div class="lightbox-content">
                                    <div class="lightbox-title"><?php the_title(); ?></div>
                                    <a href="<?php the_permalink(); ?>" class="lightbox-icon eye-icon" title="Voir le détail de la photo"></a>
                                    <a href="#" class="lightbox-icon fullscreen-icon" data-id="<?php echo get_the_ID(); ?>" title="Afficher en plein écran"></a>
                                    <div class="lightbox-category"><?php echo get_the_term_list( get_the_ID(), 'category', '', ', ' ); ?></div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endwhile;
            wp_reset_postdata();
        else :
            echo 0; // Indique qu'il n'y a plus de posts
        endif;
    }

    wp_die();
}
add_action('wp_ajax_load_more_photos', 'nathalie_mota_load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'nathalie_mota_load_more_photos');


/**
 * Fonction pour charger plus de photos via AJAX
 */

function nathalie_mota_load_photo_carousel()  {
    $photo_id = isset($_POST['photo_id']) ? intval($_POST['photo_id']) : 0;

    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => -1,
        'order' => 'ASC'
    );
    $images = get_field('photo_details'); // Remplacez 'photo_details' par le nom de votre groupe de champs ACF contenant la galerie d'images

    $photo_query = new WP_Query($args);
    $photos = array();
    if ($photo_query->have_posts()) :
        while ($photo_query->have_posts()) : $photo_query->the_post();
            $image = get_field('image');
            // Récupérer les dimensions de l'image
            $width = $image['width'];
            $height = $image['height'];
            // Déterminer le format de l'image
            $format = ($width > $height) ? 'paysage' : 'portrait';
            $photos[] = array(
                'url' => $image['url'],
                'title' => get_the_title(),
                'format' => $format // Ajouter le format à l'array des images
            );
        endwhile;
        wp_reset_postdata();
    endif;

    echo json_encode(array('photos' => $photos));
    wp_die();
}
add_action('wp_ajax_load_photo_carousel', 'nathalie_mota_load_photo_carousel');
add_action('wp_ajax_nopriv_load_photo_carousel', 'nathalie_mota_load_photo_carousel');


// Récupération des requetes dans les dropboxs
function load_photos_by_selection() {
    
    // Récupération des paramètres envoyés par la requête AJAX
    $categorie_ids = isset($_POST['categorie_id']) ? array_map('intval', (array) $_POST['categorie_id']) : array();
    $format_ids = isset($_POST['format_id']) ? array_map('intval', (array) $_POST['format_id']) : array();
    $date_order = isset($_POST['date_order']) ? sanitize_text_field($_POST['date_order']) : 'DESC';
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1; // Ajouter cette ligne
    $photos_per_page = isset($_POST['photos_per_page']) ? intval($_POST['photos_per_page']) : 8;

    error_log('Catégories: ' . implode(', ', $categorie_ids));
    error_log('Formats: ' . implode(', ', $format_ids));
    error_log('Ordre: ' . $date_order);

    // Construction de la requête WP_Query en fonction des options sélectionnées
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => $photos_per_page, // Utiliser le nombre de photos par page
        'paged' => $page, // Utiliser le numéro de page
        'orderby' => 'date',
        'order' => $date_order,
    );
    // Ajout de la tax_query pour les catégories et les formats indépendamment
    $tax_query = array('relation' => 'AND');

    if (!empty($categorie_ids)) {
        $tax_query[] = array(
            'taxonomy' => 'categorie',
            'field'    => 'term_id',
            'terms'    => $categorie_ids,
            'operator' => 'IN',
        );
    }

    if (!empty($format_ids)) {
        $tax_query[] = array(
            'taxonomy' => 'format',
            'field'    => 'term_id',
            'terms'    => $format_ids,
            'operator' => 'IN',
        );
    }

    // N'ajouter tax_query que s'il y a des conditions
    if (!empty($categorie_ids) || !empty($format_ids)) {
        $args['tax_query'] = $tax_query;
    }

    $photos_query = new WP_Query($args);

    // Génération de la sortie
    ob_start();
    if ($photos_query->have_posts()) {
        echo '<div class="photo-grid">'; // Ajout de la classe photo-grid pour le style en grille
        while ($photos_query->have_posts()) {
            $photos_query->the_post();

            // Récupération des champs ACF
            $photo = get_field('photo');

            // HTML de votre modèle photo
            echo '<div class="photo-item">';
            if ($photo) {
                $image = wp_get_attachment_image_src($photo['ID'], 'full'); // Utiliser la taille 'full' pour les images complètes
                echo '<div class="photo-thumbnail ' . ($image[2] > $image[1] ? 'portrait' : 'landscape') . '">';
                echo '<img src="' . esc_url($image[0]) . '" alt="' . esc_attr(get_the_title()) . '" />';
                echo '<div class="lightbox" style="display: none;">';
                echo '<div class="lightbox-content">';
                echo '<div class="lightbox-title">' . get_the_title() . '</div>';
                echo '<a href="' . get_permalink() . '" class="lightbox-icon eye-icon" title="Voir le détail de la photo"></a>';
                echo '<a href="#" class="lightbox-icon fullscreen-icon" data-id="1" title="Afficher en plein écran"></a>';
                echo '<div class="lightbox-category">' . get_the_term_list(get_the_ID(), 'categorie', '', ', ') . '</div>';
                echo '</div></div></div>';
            }
            echo '</div>';
        }
        echo '</div>'; // Fermeture de la div photo-grid
    } else {
        echo '<p>No photos found</p>';
    }
    wp_reset_postdata();

    $response = ob_get_clean();
    echo $response;
    wp_die();
}


add_action('wp_ajax_load_photos_by_selection', 'load_photos_by_selection');
add_action('wp_ajax_nopriv_load_photos_by_selection', 'load_photos_by_selection');



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

// Inclure les fichiers php
get_template_part( 'taxonomy-options.php' );
get_template_part( 'custom-taxonomies.php' );
?>


