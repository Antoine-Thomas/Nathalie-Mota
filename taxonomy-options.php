<?php
/**
 * Template pour générer dynamiquement les options des dropdowns à partir des taxonomies
 */

// Générer les options pour une taxonomie donnée
function generate_taxonomy_options($taxonomy) {
    $terms = get_terms(array(
        'taxonomy' => $taxonomy,
        'hide_empty' => false,
    ));

    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
        foreach ($terms as $term) {
            echo '<option value="' . esc_attr($term->term_id) . '">' . esc_html($term->name) . '</option>';
        }
    }
}


function generate_categorie_options() {
    $categories = get_terms( array(
        'taxonomy' => 'categorie',
        'hide_empty' => false,
    ) );

    if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
        foreach ( $categories as $category ) {
            $image_id = get_field('image', 'categorie_' . $category->term_id);
            $image_url = get_image_url_from_id($image_id);
            echo '<option value="' . esc_attr( $category->term_id ) . '" data-image="' . $image_url . '">' . esc_html( $category->name ) . '</option>';
        }
    }
}

function generate_format_options() {
    $formats = get_terms( array(
        'taxonomy' => 'format',
        'hide_empty' => false,
    ) );

    if ( ! empty( $formats ) && ! is_wp_error( $formats ) ) {
        foreach ( $formats as $format ) {
            $image_id = get_field('image', 'format_' . $format->term_id);
            $image_url = get_image_url_from_id($image_id);
            echo '<option value="' . esc_attr( $format->term_id ) . '" data-image="' . $image_url . '">' . esc_html( $format->name ) . '</option>';
        }
    }
}

function generate_date_options() {
    // Vous devez déterminer la source des dates à utiliser dans votre dropdown box.
    // Par exemple, vous pouvez récupérer les dates des articles ou des publications personnalisées.
    // Voici un exemple de récupération des dates des articles.
    $dates = get_posts( array(
        'posts_per_page' => -1,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'post_type'      => 'post', // Mettez ici votre type de publication personnalisé si nécessaire
        'post_status'    => 'publish',
        'fields'         => 'ids', // Récupérer uniquement les IDs pour réduire la charge de la requête
    ) );

    if ( $dates ) {
        foreach ( $dates as $date ) {
            echo '<option value="' . esc_attr( get_the_date( 'Y-m-d', $date ) ) . '">' . esc_html( get_the_date( '', $date ) ) . '</option>';
        }
    }
}
?>







