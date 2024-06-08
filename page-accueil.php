
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
    <form class="flexrow" method="post">
        <!-- Left dropdown box -->
        <div class="filterleft flexrow">
            <div id="filtre-categorie" class="select-filter flexcolumn">
                <span class="categorie_id-down dashicons dashicons-arrow-down select-close"></span>
                <label class="filter-label custom-label cat" for="categorie_id"><p>CATÉGORIES</p></label>
                <select class="filter-categorie" name="categorie_id" id="categorie_id">
                    <option value="">Toutes les catégories</option>
                    <!-- Options des catégories -->
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
        </div>

        <!-- Right dropdown boxes -->
        <div class="filterright flexrow">
            <div id="filtre-format" class="select-filter flexcolumn">
                <span class="format_id-down dashicons dashicons-arrow-down select-close"></span>
                <label class="filter-label custom-label form" for="format_id"><p>FORMATS</p></label>
                <select class="filter-format" name="format_id" id="format_id">
                    <option value="">Tous les formats</option>
                    <!-- Options des formats -->
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
            <div id="filtre-date" class="select-filter flexcolumn">
                <span class="date-down dashicons dashicons-arrow-down select-close"></span>
                <label class="filter-label custom-label date" for="date"><p>TRIER PAR</p></label>
                <select class="filter-date" name="date" id="date">
                    <option value="desc">Nouveauté</option>
                    <option value="asc">Les plus anciens</option>
                </select>
            </div>
        </div>
    </form>
</section>

<div class="photo-grid-container"></div> <!-- Conteneur pour les photos -->



        <section class="photos">
            <div class="container">
                <div id="photo-grid" class="photo-grid">
                  
                    
                </div>
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
