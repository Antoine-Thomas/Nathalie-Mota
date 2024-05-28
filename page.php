<?php
/**
 * The template for displaying all single pages
 *
 * @package WordPress
 * @subpackage Nathalie Mota
 * @since 1.0
 */

get_header();
?>

<main id="site-content" role="main">

    <?php

    while ( have_posts() ) :
        the_post();

        get_template_part( 'template-parts/content', 'page' );

        // If comments are open or there is at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) {
            comments_template();
        }

    endwhile;
    ?>

</main><!-- #site-content -->

<?php
get_footer();
