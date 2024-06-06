
<?php
/**
 * Template Name: Accueil
 *
 * @package Nathalie Mota
 */

get_header();
?>
<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <section class="hero">
            <!-- Banner -->
            <div class="banner">
                <div class="banner-content">
                    <h1 class="title-hero">Photographe event</h1>
                </div>
            </div>
        </section>

       <?php
// Fonction pour récupérer le chemin de l'image à partir de l'ID de l'image
function get_image_url_from_id($image_id) {
    $image_url = wp_get_attachment_url($image_id);
    return $image_url;
}

?>

<!-- Dropdown Filters -->
<section class="filter-area swiper-container">
    <form class="flexrow swiper-wrapper" method="post">
        <!-- Left dropdown box -->
        <div class="filterleft swiper-slide flexrow">
            <div id="filtre-categorie" class="select-filter flexcolumn">
                <span class="categorie_id-down dashicons dashicons-arrow-down select-close"></span>
                <label class="filter-label custom-label" for="categorie_id"><p>CATÉGORIES</p></label>
                <select class="option-filter" name="categorie_id" id="categorie_id">
                    <option value=""></option>
                    <!-- Autres options -->
                    <?php
                    $terms = get_terms(array(
                        'taxonomy' => 'categorie',
                        'hide_empty' => false,
                    ));
                    foreach ($terms as $term) {
                        $image_id = get_field('image', 'categorie_' . $term->term_id);
                        $image_url = get_image_url_from_id($image_id);
                        echo '<option id="categorie_' . $term->term_id . '" value="' . $term->term_id . '" data-image="' . $image_url . '">' . $term->name . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>

        <!-- Right dropdown boxes -->
        <div class="filterright swiper-slide flexrow">
            <div id="filtre-format" class="select-filter flexcolumn">
                <span class="format_id-down dashicons dashicons-arrow-down select-close"></span>
                <label class="filter-label custom-label" for="format_id"><p>FORMATS</p></label>
                <select class="option-filter" name="format_id" id="format_id">
                    <option value=""></option>
                    <!-- Autres options -->
                    <?php
                    $terms = get_terms(array(
                        'taxonomy' => 'format',
                        'hide_empty' => false,
                    ));
                    foreach ($terms as $term) {
                        $image_id = get_field('image', 'format_' . $term->term_id);
                        $image_url = get_image_url_from_id($image_id);
                        echo '<option id="format_' . $term->term_id . '" value="' . $term->term_id . '" data-image="' . $image_url . '">' . $term->name . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div id="filtre-date" class="select-filter flexcolumn">
                <span class="date-down dashicons dashicons-arrow-down select-close"></span>
                <label class="filter-label custom-label" for="date"><p>TRIER PAR</p></label>
                <select class="option-filter" name="date" id="date">
                    <option value=""></option>
                    <option value="desc">Nouveauté</option>
                    <option value="asc">Les plus anciens</option>
                </select>
            </div>
        </div>
    </form>
</section>


        <section class="photos">
            <div class="container">
                <div id="photo-grid" class="photo-grid">
                    <?php
                    // Query custom post type 'photo'
                    $args = array(
                        'post_type' => 'photo',
                        'posts_per_page' => 8, // Afficher les 8 premières photos
                        'paged' => 1, // Afficher la première page
                        'order' => 'ASC' // Ordre ascendant
                    );

                    $photo_query = new WP_Query($args);

                    if ($photo_query->have_posts()) :
                        while ($photo_query->have_posts()) : $photo_query->the_post(); ?>
                            <div class="photo-item">
                                <?php if (get_field('image')): ?>
                                    <?php $image = get_field('image'); ?>
                                    <div class="photo-thumbnail <?php echo ($image['height'] > $image['width']) ? 'portrait' : 'landscape'; ?>">
                                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                        <div class="lightbox">
                                            <div class="lightbox-content">
                                                <div class="lightbox-title"><?php the_title(); ?></div>
                                                <a href="<?php the_permalink(); ?>" class="lightbox-icon eye-icon" title="Voir le détail de la photo"></a>
                                                <a href="#" class="lightbox-icon fullscreen-icon" data-id="1" title="Afficher en plein écran"></a>
                                                <div class="lightbox-category"><?php echo get_the_term_list(get_the_ID(), 'category', '', ', '); ?></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
            </div>

            <!-- Bouton "Charger plus" -->
            <div id="load-more-container">
                <button id="load-more" class="load-more">Charger plus</button>
            </div>
        </section>
    </main><!-- #main -->
</div><!-- #primary -->

<script>
    // Collez votre code JavaScript ici
</script>

<?php
get_footer();
?>
