<?php
function nathalie_mota_load_more_photos() {
    if (isset($_POST['page']) && isset($_POST['photos_per_page'])) {
        $page = intval($_POST['page']);
        $photos_per_page = intval($_POST['photos_per_page']);
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

   

                <div class="photo-item">
                    <?php if (get_field('photo')) : ?>
                        <?php $image = get_field('photo'); ?>
                        <?php $image_size_class = ($image['height'] > $image['width']) ? 'portrait' : 'landscape'; ?>

                        <div class="photo-thumbnail <?php echo $image_size_class; ?>">
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                            <div class="lightbox">
                                <div class="lightbox-content">
                                    <a href="<?php the_permalink(); ?>" class="lightbox-icon eye-icon" title="Voir le détail de la photo"></a>
                                    <a href="#" class="lightbox-icon fullscreen-icon" data-id="<?php echo get_the_ID(); ?>" title="Afficher en plein écran"></a>
                                    <div class="lightbox-category"><?php echo get_the_term_list(get_the_ID(), 'categorie', '', ', '); ?></div>
                                    <?php $reference = get_field('reference');
                                    if ($reference) {
                                        echo '<div class="lightbox-title">' . esc_html($reference) . '</div>';
                                    } ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

            <?php }
            wp_reset_postdata();
        } else {
            echo '<div class="end-of-results">Vous avez atteint la fin des résultats</div>';
        }
    }

    wp_die();
}

add_action('wp_ajax_load_more_photos', 'nathalie_mota_load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'nathalie_mota_load_more_photos');
?>

