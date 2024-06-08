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
                 <p class="reference">Référence : <?php the_field('reference'); ?></p>
                 <p class="categorie">Catégorie : <?php the_field('categorie'); ?></p>
                 <p class="format">FORMAT : <?php the_field('format'); ?></p>
                 <p class="type">Type : <?php the_field('type'); ?></p>
                 <p class="annee">ANNÉE : <?php the_field('date'); ?></p>
             </div>
         </div>
 
         <!-- Ligne de séparation -->
         <div class="line line-3"></div>
         <div class="cette-photo">Cette photo vous intéresse?</div>
         <div class="line line-4"></div>
         <div class="aussi">Vous aimerez AUSSI</div>
 
         <!-- Ajouter les photos de la même catégorie -->
       
 
     </div> <!-- Fermeture de la div single-photo-content -->
 </div>
 
 <?php get_footer('single-photo-page'); ?>





