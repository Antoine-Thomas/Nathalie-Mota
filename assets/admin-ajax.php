<?php
// Load WordPress
define('WP_USE_THEMES', false);
require_once('wp-load.php');

// Handle AJAX request
if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
    // Load appropriate function based on action
    switch($_REQUEST['action']) {
        case 'load_more_photos':
            nathalie_mota_load_more_photos();
            break;
        // Add more cases for other AJAX actions as needed
        default:
            // Handle unknown action
            break;
    }
}

// Function to load more photos
function nathalie_mota_load_more_photos() {
    // Your code here to load more photos
    // Example:
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $photos_per_page = isset($_POST['photos_per_page']) ? intval($_POST['photos_per_page']) : 8;

    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => $photos_per_page,
        'paged' => $page,
        'order' => 'ASC'
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
                                <a href="#" class="lightbox-icon fullscreen-icon" data-id="1" title="Afficher en plein écran"></a>
                                <div class="lightbox-category"><?php echo get_the_term_list( get_the_ID(), 'categorie', '', ', ' ); ?></div>
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

    wp_die();
}
