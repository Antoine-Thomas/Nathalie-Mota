<?php

function nathalie_mota_load_photo_carrousel() {
    $args = array(
        'post_type'      => 'photo',
        'posts_per_page' => -1,
        'order'          => 'asc'
    );

    $photo_query = new WP_Query($args);
    $photos = array();

    if ($photo_query->have_posts()) :
        while ($photo_query->have_posts()) : $photo_query->the_post();

            // Récupérer les champs ACF
            $photo = get_field('photo');
            $reference = get_field('reference');
            $image_id = wp_get_attachment_image_src($photo['ID'], 'full'); // Utiliser la taille 'full' pour les images complètes

            $image_url = $image_id[0];
            $categorie = get_the_terms(get_the_ID(), 'categorie');

            // Structure des données pour chaque photo
            $photos[] = array(
                'url' => $image_url,
                'reference' => $reference, // Utiliser le champ 'reference' au lieu du titre
                'categorie' => $categorie
            );

        endwhile;
       
        wp_reset_postdata();
    endif;

    // Retourner les données en JSON
    echo json_encode(array('photos' => $photos));
    wp_die();
}

add_action('wp_ajax_load_photo_carrousel', 'nathalie_mota_load_photo_carrousel');
add_action('wp_ajax_nopriv_load_photo_carrousel', 'nathalie_mota_load_photo_carrousel');


