<?php
get_header(); ?>

<div class="content">
    <h1><?php the_title(); ?></h1>

    <!-- Afficher le contenu principal -->
    <div class="main-content">
        <?php
        while ( have_posts() ) :
            the_post();
            the_content();
        endwhile;
        ?>
    </div>

    <!-- Afficher les champs ACF -->
    <div class="acf-fields">
        <p><strong>Type:</strong> <?php the_field('type'); ?></p>
        <p><strong>Référence:</strong> <?php the_field('reference'); ?></p>
    </div>

    <!-- Afficher les termes de taxonomie -->
    <div class="taxonomy-terms">
        <h2>Catégories</h2>
        <ul>
            <?php
            $terms = get_the_terms( get_the_ID(), 'categorie' );
            if ( $terms && ! is_wp_error( $terms ) ) :
                foreach ( $terms as $term ) {
                    echo '<li>' . esc_html( $term->name ) . '</li>';
                }
            endif;
            ?>
        </ul>
    </div>

    <div class="taxonomy-terms">
        <h2>Formats</h2>
        <ul>
            <?php
            $terms = get_the_terms( get_the_ID(), 'format' );
            if ( $terms && ! is_wp_error( $terms ) ) :
                foreach ( $terms as $term ) {
                    echo '<li>' . esc_html( $term->name ) . '</li>';
                }
            endif;
            ?>
        </ul>
    </div>
</div>

<?php get_footer(); ?>
