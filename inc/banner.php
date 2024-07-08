<?php
// functions.php ou un fichier inclut dans votre thème ou plugin

// Ajoutez une action WordPress pour traiter la demande AJAX
add_action('wp_ajax_get_banner_images', 'get_banner_images');
add_action('wp_ajax_nopriv_get_banner_images', 'get_banner_images');

function get_banner_images() {
    // Ajoutez des en-têtes pour indiquer de ne pas mettre en cache cette requête
    nocache_headers();

    $paysage_term = get_term_by('slug', 'paysage', 'format');

    if ($paysage_term) {
        $paysage_term_id = $paysage_term->term_id;

        $args = array(
            'post_type' => 'photo',
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'format',
                    'field' => 'term_id',
                    'terms' => $paysage_term_id,
                ),
            ),
        );

        $photo_query = new WP_Query($args);
        $image_urls = array();

        if ($photo_query->have_posts()) {
            while ($photo_query->have_posts()) {
                $photo_query->the_post();
                $photo = get_field('photo');

                if ($photo) {
                    $image_url = wp_get_attachment_image_src($photo['ID'], 'full');
                    $image_urls[] = $image_url[0]; // Ajoutez seulement l'URL de l'image à la liste
                }
            }

            wp_reset_postdata();
        }
    } else {
        // Le terme "paysage" n'a pas été trouvé dans la taxonomie "format"
    }

    echo json_encode($image_urls); // Renvoyer les URLs sous forme de JSON pour AJAX
    wp_die(); // Terminer le traitement AJAX
}
?>
