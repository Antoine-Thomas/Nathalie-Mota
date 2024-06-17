<?php
/**
 * Template pour la popup de contact
 *
 * @package WordPress
 * @subpackage nathalie-mota theme
 */
?>
<!-- Popup de Contact -->
<div class="popup-overlay hidden visible">
    <div class="popup-contact">
        <div class="popup-title__container">
            <?php for ($i = 0; $i < 6; $i++): ?>
                <img class="popup-decor" src="<?php echo get_stylesheet_directory_uri() . '/images/contact.png'; ?>" alt="Décoration de la popup">
            <?php endfor; ?>
            <span class="close-popup"></span> <!-- Ajout du bouton de fermeture -->
        </div>
        <div class="popup-informations">
            <!-- Insérer la référence dans le shortcode du formulaire -->
            <?php
            // Récupération de la référence depuis ACF
            $reference = get_field('field_refren');

            // Construire le shortcode avec la référence
            $shortcode_with_reference = '[fluentform id="3" subject="' . esc_attr($reference) . '"]';

            // Afficher le formulaire en utilisant le shortcode avec la référence
            echo do_shortcode($shortcode_with_reference);
            ?>
        </div>
    </div>
</div>




