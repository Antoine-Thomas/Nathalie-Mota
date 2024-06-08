<?php
/**
 * Template pour la popup de contact
 *
 * @package WordPress
 * @subpackage nathalie-mota theme
 */
?>

<div class="popup-overlay hidden">
    <div class="popup-contact">
        <div class="popup-title__container">
            <?php for ($i = 0; $i < 6; $i++): ?>
                <img class="popup-decor" src="<?php echo get_stylesheet_directory_uri() . '/images/contact.png'; ?>" alt="Décoration de la popup">
            <?php endfor; ?>
            <span class="close-popup"></span> <!-- Ajout du bouton de fermeture -->
        </div>
        <div class="popup-informations">
            <?php
            // On insère le formulaire de demandes de renseignements
            echo do_shortcode('[fluentform id="3"]');
            ?>
        </div>
    </div>
</div>


