<?php
/**
 * Template Name: Single Photo
 *
 * @package Nathalie Mota
 */

get_header(); ?>


    <div class="single-photo-content">
     
            <!-- Afficher la photo principale -->
            <div class="photo-display">
                <?php if (get_field('photo')) : ?>
                    <img src="<?php echo esc_url(get_field('photo')['url']); ?>" alt="<?php echo esc_attr(get_field('photo')['alt']); ?>">
                <?php endif; ?>
            </div>

            <!-- Afficher les détails de la photo -->
            <div class="photo-details frame-33">
                <p class="title"><?php the_field('titre'); ?></p>
                <?php if ($reference = get_field('reference')) : ?>
                    <p class="reference">Référence : <?php echo esc_html($reference); ?></p>
                <?php endif; ?>
                
                <!-- Utilisation de get_the_terms pour récupérer la taxonomie catégorie -->
                <?php
                $categories = get_the_terms(get_the_ID(), 'categorie');
                if ($categories && !is_wp_error($categories)) :
                    $category_names = array();
                    foreach ($categories as $category) {
                        $category_names[] = $category->name;
                    }
                    $category_list = join(', ', $category_names);
                ?>
                    <p class="categorie">Catégorie : <?php echo esc_html($category_list); ?></p>
                <?php endif; ?>
                
                <p class="format">FORMAT : <?php the_field('format'); ?></p>
                <p class="type">Type : <?php the_field('type'); ?></p>
                <p class="date">ANNÉE : <?php the_field('date'); ?></p>
            </div>
        </div>

        <!-- Ligne de séparation -->
        <div class="line line-3"></div>
        <div class="cette-photo">Cette photo vous intéresse?</div>
        
        <!-- Bouton de contact -->
       
           <!-- Bouton de contact simplifié -->
<button class="open-popup load-more2" data-reference="<?php echo esc_attr(get_field('reference')); ?>">
    Contact
</button>

 

        <!-- Préview -->
        <?php
        // Récupérer le post précédent et suivant
        $prev_post = get_previous_post();
        $next_post = get_next_post();

        // Définir les URLs des pages précédente et suivante
        $url_page_precedente = $prev_post ? get_permalink($prev_post) : '#';
        $url_page_suivante = $next_post ? get_permalink($next_post) : '#';
        ?>

        <!-- Carré de prévisualisation et flèches de navigation -->
        <div class="navigation-container">
            <div class="next-page-preview">
                <!-- Afficher un aperçu de la page suivante en petit carré -->
                <div class="page-preview ">
                    <img src="" alt="" class="preview-image">
                </div>
            </div>
            <!-- Flèches de navigation -->
            <div class="navigation-arrows">
                <a href="#" class="navigation-arrow left-arrow" data-prev-page-url="<?php echo esc_url($url_page_precedente); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/fleche-gauche.png" alt="Flèche gauche">
                </a>
                <a href="#" class="navigation-arrow right-arrow" data-next-page-url="<?php echo esc_url($url_page_suivante); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/fleche-droite.png" alt="Flèche droite">
                </a>
            </div>
        </div>

        <div class="line line-4"></div>
        <div class="aussi">Vous aimerez AUSSI</div>

         <!-- Ajouter les photos de la même catégorie -->
         <section class="photos">
            <div class="container">
                <div id="photo-grid2" class="photo-grid2">
                    <?php
                    // Récupérer la catégorie de la photo courante
                    $current_photo_categories = get_the_terms(get_the_ID(), 'categorie');
                    $current_photo_category_ids = array();

                    if ($current_photo_categories && !is_wp_error($current_photo_categories)) {
                        foreach ($current_photo_categories as $category) {
                            $current_photo_category_ids[] = $category->term_id;
                        }
                    }

                    // Query custom post type 'photo' pour afficher des photos aléatoires de la même catégorie
                    $args = array(
                        'post_type' => 'photo',
                        'posts_per_page' => 2, // Afficher 2 photos
                        'orderby' => 'rand', // Trier aléatoirement
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'categorie',
                                'field'    => 'term_id',
                                'terms'    => $current_photo_category_ids,
                            ),
                        ),
                    );

                    $photo_query = new WP_Query($args);

                    if ($photo_query->have_posts()) :
                        while ($photo_query->have_posts()) : $photo_query->the_post();
                          
                    ?>
                            <div class="photo-item">
                                <?php if (get_field('photo')) : ?>
                                    <?php $image = get_field('photo'); ?>
                                    <div class="photo-thumbnail <?php echo ($image['height'] > $image['width']) ? 'portrait' : 'landscape'; ?>">
                                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                        <div class="lightbox">
                                            <div class="lightbox-content">
                                                <a href="<?php the_permalink(); ?>" class="lightbox-icon eye-icon" title="Voir le détail de la photo"></a>
                                                <a href="#" class="lightbox-icon fullscreen-icon" data-image="<?php echo esc_url($image['url']); ?>" title="Afficher en plein écran"></a>
                                                <div class="lightbox-category"><?php echo get_the_term_list(get_the_ID(), 'categorie', '', ''); ?></div>
                                                <?php
                                                // Récupération et affichage de la référence
                                                $reference = get_field('reference');
                                                if ($reference) {
                                                    echo '<div class="lightbox-title">' . esc_html($reference) . '</div>';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                    <?php endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
          
        </section>
    </div> <!-- Fermeture de la div single-photo-content -->


<?php get_footer(); ?>




