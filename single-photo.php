<?php
/**
 * Template Name: single photo
 *
 * @package Nathalie Mota
 */
 get_header(); ?>

 <div class="main-container">
     <div class="single-photo-content">
       
         <div class="photo-main">
             <!-- Afficher la photo principale -->
             <div class="photo-display">
                 <?php if ( get_field('photo') ) : ?>
                     <img src="<?php echo esc_url( get_field('photo')['url'] ); ?>" alt="<?php echo esc_attr( get_field('photo')['alt'] ); ?>">
                 <?php endif; ?>
             </div>
 
             <!-- Afficher les détails de la photo -->
             <div class="photo-details frame-33">
                 <p class="title"><?php the_field('titre'); ?></p>
                 <?php if ($reference = get_field('reference')) : ?>
        <p class="reference">Référence : <?php echo esc_html($reference); ?></p>
    <?php endif; ?>
                 <p class="categorie">Catégorie : <?php the_field('categorie'); ?></p>
                 <p class="format">FORMAT : <?php the_field('format'); ?></p>
                 <p class="type">Type : <?php the_field('type'); ?></p>
                 <p class="date">ANNÉE : <?php the_field('date'); ?></p>
             </div>
         </div>
 
         <!-- Ligne de séparation -->
         <div class="line line-3"></div>
         <div class="cette-photo">Cette photo vous intéresse?</div>
        <!-- Bouton de contact -->
<!-- Bouton de contact -->
<!-- Bouton de contact -->
<div id="reference">
    <button href="#" class="open-popup load-more2" data-reference="<?php echo esc_attr(get_field('reference')); ?>">Contact</button>
</div>

         <div class="line line-4"></div>
         <div class="aussi">Vous aimerez AUSSI</div>
 
         <!-- Ajouter les photos de la même catégorie -->
         <section class="photos">
            <div class="container">
                <div id="photo-grid2" class="photo-grid2">
                    <?php
                    // Query custom post type 'photo'
                    $args = array(
                        'post_type' => 'photo',
                        'posts_per_page' => 2, // Afficher les 8 premières photos
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
                                                <div class="lightbox-category"><?php echo get_the_term_list(get_the_ID(), 'categorie', '', ''); ?></div>
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
 
     </div> <!-- Fermeture de la div single-photo-content -->
 </div>
 
 <?php get_footer('single-photo-page'); ?>





