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
            $reference = get_field('reference');
            
            // Vérifier si la référence existe et n'est pas vide
            if ($reference) {
                // Échapper la référence pour l'affichage dans le champ input_text du Fluent Form
                $escaped_reference = esc_attr($reference);
            }

            // Construire le shortcode avec la référence
            if ($reference) {
                $shortcode_with_reference = '[fluentform id="3" ref="' . $escaped_reference . '"]';
            } else {
                $shortcode_with_reference = '[fluentform id="3"]';
            }

            // Afficher le formulaire en utilisant le shortcode avec la référence
            echo do_shortcode($shortcode_with_reference);
            ?>
        </div>
    </div>
</div>


<script>
jQuery(document).ready(function($) {
    // Récupérer la référence PHP et échapper pour JavaScript
    var referenceValue = "<?php echo esc_js($reference); ?>";
    
    // Utiliser une classe spécifique pour cibler uniquement le formulaire Fluent Form
    var inputRefPhoto = document.querySelector('.fluentform .ff-el-input--content input[name="ref"]');
    
    if (inputRefPhoto && referenceValue) {
        inputRefPhoto.value = referenceValue;
    }
});


</script>











