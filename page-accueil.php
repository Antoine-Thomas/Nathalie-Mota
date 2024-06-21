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
                    <?php 
                    $photos = get_banner_images(); // Récupérer les images de la bannière
                    
                    if (!empty($photos)) : ?>
                        <?php 
                        $random_index = array_rand($photos); // Choisir un index aléatoire
                        $random_photo = $photos[$random_index]['photo']; // Récupérer l'URL de l'image aléatoire
                        ?>
                        <div class="photo-banner" style="background-image: url('<?php echo esc_url($random_photo); ?>');">
                            <!-- Contenu de la photo -->
                            <div class="banner-content">
                                <div class="title-hero">
                                   PHOTOGRAPHE EVENT
                                </div>
                            </div>
                        </div>
                    <?php else : ?>
                        <p>Aucune image de bannière trouvée.</p>
                    <?php endif; ?>
                </div>
            </div>
        </section>
   



       

        <!-- Dropdown Filters -->
        <section class="filter-area">
            <form method="post">
                <!-- Dropdown box for Categories -->
                <div class="filter-box filter-box-left" id="filtre-categorie">
                    <label class="filter-label" for="categorie_id"></label>
                    <select name="categorie_id" id="categorie_id" autocomplete="categorie">
                        <option value="">CATEGORIES</option>
                        <?php
                        $terms = get_terms(array(
                            'taxonomy' => 'categorie',
                            'hide_empty' => false,
                        ));
                        foreach ($terms as $term) {
                            echo '<option value="' . $term->term_id . '">' . $term->name . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <!-- Dropdown box for Formats -->
                <div class="filter-box filter-box-center" id="filtre-format">
                    <label class="filter-label" for="format_id"></label>
                    <select name="format_id" id="format_id" autocomplete="format">
                        <option value="">FORMATS</option>
                        <?php
                        $terms = get_terms(array(
                            'taxonomy' => 'format',
                            'hide_empty' => false,
                        ));
                        foreach ($terms as $term) {
                            echo '<option value="' . $term->term_id . '">' . $term->name . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <!-- Dropdown box for Date Order -->
                <div class="filter-box filter-box-right" id="filtre-date">
                    <label class="filter-label" for="date"></label>
                    <select name="date" id="date" autocomplete="off">
                        <option>TRIER PAR</option>
                        <option value="asc">NOUVEAUTES</option>
                        <option value="desc">PLUS ANCIENS</option>
                    </select>
                </div>
            </form>
        </section>

        <div class="photo-grid-container"></div> <!-- Conteneur pour les photos -->

        <section class="photos">
            <div class="container">
                <!-- Vos autres contenus de la section photos -->
            </div>

            <!-- Bouton "Charger plus" -->
            <div id="load-more-container">
                <button id="load-more" class="load-more">Charger plus</button>
            </div>
        </section>
    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
?>



