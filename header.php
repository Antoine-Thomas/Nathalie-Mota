<?php
/**
 * The header
 *
 * @package Nathalie Mota
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> >
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <meta name="keywords" content="photographe événementiel, photographe event, nathalie mota, photo format hd"/>
    <meta name="description" content="Nathalie Mota - Site personnel pour la vente de mes photos en impression HD.">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

    <!-- Récupération des icones -->
    <script src="https://kit.fontawesome.com/57bf6f7049.js" crossorigin="anonymous"></script>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?> 
    <header id="header" class="header">
        <div class="container-header">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="Page d'accueil de Nathalie Mota">
                <img src="<?php echo get_template_directory_uri(); ?>/images/logo_nathalie_mota.png" 
                alt="Logo <?php echo esc_attr( bloginfo( 'name' ) ); ?>">
            </a>
            <nav id="navigation" class="main-menu">
                <ul>
                    <!-- Ajoutez vos liens personnalisés ici -->
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">ACCUEIL</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/a-propos' ) ); ?>">A PROPOS</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>">CONTACT</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="banner">
        <div class="banner-content">
            <h1 class="title-hero">Photographe event</h1>
        </div>
    </div>
<?php wp_footer(); ?>
</body>
</html>



