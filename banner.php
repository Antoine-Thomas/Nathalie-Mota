<?php

function get_banner_images() {
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
                    $image_urls[] = array(
                        'photo' => $image_url[0]
                    );
                }
            }

            wp_reset_postdata();
        }
    } else {
        // Le terme "paysage" n'a pas été trouvé dans la taxonomie "format"
    }

    return $image_urls;
}



