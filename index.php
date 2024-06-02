<?php
/**
 * Index Template
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
            <div class="container">
                <h1>Bienvenue sur le site de Nathalie Mota</h1>
                <p>Découvrez ses magnifiques photos de mariage, concerts, et bien plus encore.</p>
            </div>
        </section>

        <!-- Section manquante -->
        <section class="featured-section">
            <div class="container">
                <h2>Section manquante</h2>
                <!-- Ajoutez votre contenu ici -->
            </div>
        </section>

        <section class="photos">
            <div class="container">
                <h2>Nos dernières photos</h2>
                <div id="photo-grid" class="photo-grid" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 0; border-top: 1px solid #FFFFFF;">
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
                                    <div class="photo-thumbnail">
                                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" style="width: 564px; height: 495px; border: 1px solid #FFFFFF;" />
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endwhile;
                        // Script pour définir le nombre total de photos
                        echo '<script>var totalPhotos = ' . $photo_query->found_posts . ';</script>';
                    else : ?>
                        <p>Aucune photo disponible pour le moment.</p>
                    <?php endif;
                    wp_reset_postdata();
                    ?>
                </div>
                <!-- Bouton "Charger plus" -->
                <div id="load-more-container" style="padding: 20px 0;">
                    <button id="load-more" class="load-more" style="width: 272px; height: 50px; padding: 8px 15px; gap: 10px; border-radius: 2px 0px 0px 0px; border: 1px solid #FFFFFF;">Charger plus</button>
                </div>
            </div>
        </section>
    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
?>




