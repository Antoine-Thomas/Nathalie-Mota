<?php
/**
 * Template pour afficher les articles associés à la taxonomie "options"
 *
 * @package Nathalie Mota
 */

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <header class="page-header">
            <h1 class="page-title"><?php single_term_title('', true); ?></h1>
            <?php
            $term_description = term_description();
            if (!empty($term_description)) :
            ?>
                <div class="taxonomy-description"><?php echo wp_kses_post($term_description); ?></div>
            <?php endif; ?>
        </header><!-- .page-header -->

        <div class="post-list">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <?php get_template_part('template-parts/content', 'option'); ?>
                <?php endwhile; ?>
            <?php else : ?>
                <p>Aucun article trouvé pour cette taxonomie.</p>
            <?php endif; ?>
        </div><!-- .post-list -->

        <?php
        // Pagination
        the_posts_pagination(array(
            'prev_text' => 'Précédent',
            'next_text' => 'Suivant',
        ));
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
?>









