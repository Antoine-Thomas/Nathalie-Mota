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
            <div class="banner">
                <div class="banner-content">
                    <div class="photo-banner">
                        <div class="title-hero">
                            PHOTOGRAPHE EVENT
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Dropdown Filters -->
        <section class="filter-area">
            <form method="post">
                <!-- Dropdown box for Categories -->
                <div class="filter-box filter-box-left custom-dropdown">
                    <div class="title_filter_box">
                        <span class="selected-value">CATEGORIES</span>
                        <span class="span_icon_filter">&#8964;</span>
                    </div>
                    <ul class="list_items_filter">
                        <li class="list_item" data-value="categories">CATEGORIES</li>
                        <?php
                        $terms = get_terms(array(
                            'taxonomy' => 'categorie',
                            'hide_empty' => false,
                        ));
                        foreach ($terms as $term) {
                            echo '<li class="list_item" data-value="' . $term->term_id . '">' . $term->name . '</li>';
                        }
                        ?>
                    </ul>
                    <input type="hidden" name="categorie_id" id="categorie_id" value="">
                </div>

                <!-- Dropdown box for Formats -->
                <div class="filter-box filter-box-center custom-dropdown">
                    <div class="title_filter_box">
                        <span class="selected-value">FORMATS</span>
                        <span class="span_icon_filter">&#8964;</span>
                    </div>
                    <ul class="list_items_filter">
                        <li class="list_item" data-value="formats">FORMATS</li>
                        <?php
                        $terms = get_terms(array(
                            'taxonomy' => 'format',
                            'hide_empty' => false,
                        ));
                        foreach ($terms as $term) {
                            echo '<li class="list_item" data-value="' . $term->term_id . '">' . $term->name . '</li>';
                        }
                        ?>
                    </ul>
                    <input type="hidden" name="format_id" id="format_id" value="">
                </div>

                <!-- Dropdown box for Date Order -->
                <div class="filter-box filter-box-right custom-dropdown">
                    <div class="title_filter_box">
                        <span class="selected-value">TRIER PAR</span>
                        <span class="span_icon_filter">&#8964;</span>
                    </div>
                    <ul class="list_items_filter">
                        <li class="list_item" data-value="trier_par">TRIER PAR</li>
                        <li class="list_item" data-value="desc">NOUVEAUTES</li>
                        <li class="list_item" data-value="asc">PLUS ANCIENS</li>
                    </ul>
                    <input type="hidden" name="date" id="date" value="">
                </div>
            </form>
        </section>

        <!-- Conteneur pour les photos -->
        <div class="photo-grid-container"></div>

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
