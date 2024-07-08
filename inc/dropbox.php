<?php
/**
 * Template Name: dropbox 
 *
 * @package Nathalie Mota
 */

 function load_photos_by_selection() {
    
    $categorie_ids = isset($_POST['categorie_id']) ? array_map('intval', (array) $_POST['categorie_id']) : array();
    $format_ids = isset($_POST['format_id']) ? array_map('intval', (array) $_POST['format_id']) : array();
    $date_order = isset($_POST['date_order']) ? sanitize_text_field($_POST['date_order']) : 'DESC';
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $photos_per_page = isset($_POST['photos_per_page']) ? intval($_POST['photos_per_page']) : 8;

    $offset = ($page - 1) * $photos_per_page;
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => $photos_per_page,
        'offset' => $offset,
        'orderby' => 'date',
        'order' => $date_order,
    );

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

    if (!empty($categorie_ids) || !empty($format_ids)) {  
        $args['tax_query'] = $tax_query;
    }

    $photos_query = new WP_Query($args);

    ob_start();
    if ($photos_query->have_posts()) {
        echo '<div class="photo-grid">';
        while ($photos_query->have_posts()) {
            $photos_query->the_post();
            $photo = get_field('photo');
            $numero_reference = get_field('reference');

            echo '<div class="photo-item">';
            if ($photo) {
                $image = wp_get_attachment_image_src($photo['ID'], 'full');
                echo '<div class="photo-thumbnail ' . ($image[2] > $image[1] ? 'portrait' : 'landscape') . '">';
                echo '<img src="' . esc_url($image[0]) . '" alt="' . esc_attr(get_the_title()) . '" />';
                echo '<div class="lightbox" style="display: none;">';
                echo '<div class="lightbox-content">';
                
                if ($numero_reference) {
                    echo '<div class="lightbox-title">' . esc_html($numero_reference) . '</div>';
                }
                
                echo '<a href="' . get_permalink() . '" class="lightbox-icon eye-icon" title="Voir le détail de la photo"></a>';
                echo '<a href="#" class="lightbox-icon fullscreen-icon" data-id="1" title="Afficher en plein écran"></a>';

                $categories = get_the_terms(get_the_ID(), 'categorie');
                if ($categories && !is_wp_error($categories)) {
                    $category_list = array();
                    foreach ($categories as $category) {
                        $category_list[] = '<span class="non-clickable">' . esc_html($category->slug) . '</span>';
                    }
                    echo '<div class="lightbox-category">' . implode(', ', $category_list) . '</div>';
                }
                
                echo '</div></div></div>';
            }
            echo '</div>';
        }
        echo '</div>';
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
?>
