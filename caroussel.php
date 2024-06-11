<?php

/**
 * Fonction pour charger le caroussel modal
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

