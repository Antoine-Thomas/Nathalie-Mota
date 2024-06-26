<?php
/**
 * Header Template
 *
 * @package WordPress
 * @subpackage Nathalie Mota
 * @since 1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="keywords" content="photographe événementiel, photographe event, nathalie mota, photo format hd" />
    <meta name="description" content="Nathalie Mota - Site personnel pour la vente de mes photos en impression HD.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

    <script src="https://kit.fontawesome.com/57bf6f7049.js" crossorigin="anonymous"></script>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <!-- Header -->
    <header id="header" class="header">
        <div class="container-header">
            <a id="logo" href="<?php echo esc_url(home_url('/')); ?>" aria-label="Page d'accueil de Nathalie Mota">
                <img src="<?php echo get_template_directory_uri(); ?>/images/logo_nathalie_mota.png" alt="Logo <?php echo esc_attr(get_bloginfo('name')); ?>">
            </a>
            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false" title="Menu">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
            </button>
            <nav id="navigation" class="main-menu">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'primary',
                        'menu_class'     => 'main-menu-nav',
                    )
                );
                ?>
            </nav>
        </div>
    </header>

    <!-- Burger Menu Container -->
    <div class="burger-menu-container">
        <span class="close-menu"></span>
        <nav class="menu-nav">
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'primary',
                    'menu_class'     => 'menu-nav-items',
                )
            );
            ?>
        </nav>
    </div>

    <?php
    // Inclure la popup-contact.php
    get_template_part('popup-contact');
    ?>

    <?php wp_footer(); ?>
</body>

</html>

