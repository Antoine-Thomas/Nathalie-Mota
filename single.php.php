<?php
/**
 * The template for displaying all single posts
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

        get_template_part( 'template-parts/content', get_post_type() );

        // If comments are open or there is at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) {
            comments_template();
        }

        the_post_navigation(
            array(
                'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'twentytwentyone' ) . '</span> <span class="nav-title">%title</span>',
                'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'twentytwentyone' ) . '</span> <span class="nav-title">%title</span>',
            )
        );

    endwhile;
    ?>

</main><!-- #site-content -->

<?php
get_footer();
