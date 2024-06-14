
<?php
// banniere

// Fonction pour récupérer une image aléatoire en fonction du format et de la catégorie "paysage"
function get_random_banner_image() {
    $args = array(
        'post_type'      => 'photo',
        'posts_per_page' => 1, // Récupérer une seule photo
        'tax_query'      => array(
            array(
                'taxonomy' => 'categorie',
                'field'    => 'slug',
                'terms'    => 'paysage', // Récupérer les photos de la catégorie "paysage"
            ),
        ),
        'orderby'        => 'rand', // Récupérer une photo aléatoire
    );

    $images = get_posts($args);

    if (empty($images)) {
        return null;
    }

    $image_url = get_field('photo', $images[0]->ID);

    if (!$image_url) {
        // Si le champ 'photo' n'est pas défini pour cette image, utiliser l'URL complète de l'attachement
        $image_url = wp_get_attachment_url($images[0]->ID, 'full');
        $image_url = site_url() . '/' . $image_url;
    }

    return $image_url;
}
add_action('wp_ajax_load_photo_banner', 'nathalie_mota_load_photo_banner');
add_action('wp_ajax_nopriv_load_photo_banner', 'nathalie_mota_load_photo_banner');