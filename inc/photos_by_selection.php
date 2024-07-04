<?php
function nathalie_mota_load_photos_by_selection() {
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $photos_per_page = isset($_POST['photos_per_page']) ? intval($_POST['photos_per_page']) : 8;
    $date_order = isset($_POST['date_order']) ? sanitize_text_field($_POST['date_order']) : 'DESC';

    $args = array(
        'post_type'      => 'photo',
        'posts_per_page' => $photos_per_page,
        'paged'          => $page,
        'orderby'        => 'date',
        'order'          => $date_order,
    );

    if (!empty($_POST['categorie_id'])) {
        $args['tax_query'][] = array(
            'taxonomy' => 'categorie',
            'field'    => 'term_id',
            'terms'    => intval($_POST['categorie_id']),
        );
    }

    if (!empty($_POST['format_id'])) {
        $format_id = intval($_POST['format_id']);
        $args['tax_query'][] = array(
            'taxonomy' => 'format',
            'field'    => 'term_id',
            'terms'    => $format_id,
        );
    }

    $photo_query = new WP_Query($args);

    if ($photo_query->have_posts()) {
        while ($photo_query->have_posts()) {
            $photo_query->the_post(); ?>

            <!-- Code HTML pour afficher chaque photo -->

        <?php }
        wp_reset_postdata();
    } else {
        // Aucune photo trouvée
    }

    wp_die();
}

add_action('wp_ajax_load_photos_by_selection', 'nathalie_mota_load_photos_by_selection');
add_action('wp_ajax_nopriv_load_photos_by_selection', 'nathalie_mota_load_photos_by_selection');