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
            </section>
          
                <!-- Dropdown Filters -->
        <section class="filter-area swiper-container">
            <form class="flexrow swiper-wrapper" method="post">
                <!-- Left dropdown box -->
                <div class="filterleft swiper-slide flexrow">
                    <div id="filtre-categorie" class="select-filter flexcolumn">   
                        <span class="categorie_id-down dashicons dashicons-arrow-down select-close"></span>
                        <label class="filter-label custom-label" for="categorie_id"><p>CATÉGORIES</p></label>

                        <select class="option-filter" name="categorie_id" id="categorie_id">
                            <option id="categorie_0" value=""></option>
                            <option id="categorie_47" value="47">Réception</option>
                            <option id="categorie_112" value="112">Concert</option>
                            <option id="categorie_48" value="48">Mariage</option>
                            <option id="categorie_49" value="49">Télévision</option>
                        </select>
                    </div>
                </div>

                <!-- Right dropdown boxes -->
                <div class="filterright swiper-slide flexrow">
                    <div id="filtre-format" class="select-filter flexcolumn">      
                        <span class="format_id-down dashicons dashicons-arrow-down select-close"></span>
                        <label class="filter-label custom-label" for="format_id"><p>FORMATS</p></label>
                        <select class="option-filter" name="format_id" id="format_id"> 
                            <option id="format_0" value=""></option>
                            <option id="format_54" value="54">paysage</option>
                            <option id="format_53" value="53">portrait</option>
                        </select>
                    </div>
                    <div id="filtre-date" class="select-filter flexcolumn">       
                        <span class="date-down dashicons dashicons-arrow-down select-close"></span>
                        <label class="filter-label custom-label" for="date"><p>TRIER PAR</p></label>
                        <select class="option-filter" name="date" id="date">
                            <option value=""></option>
                            <option value="desc">nouveauté</option>
                            <option value="asc">Les plus anciens</option>
                        </select>
                    </div>
                </div>        
            </form>
      
        </section>


        <section class="photos">
            <div class="container">
                
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




