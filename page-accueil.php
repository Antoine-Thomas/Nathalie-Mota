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
                    <select name="format_id" id="format_id" autocomplete="format" >
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
                        <option value="desc">TRIER PAR</option>
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

