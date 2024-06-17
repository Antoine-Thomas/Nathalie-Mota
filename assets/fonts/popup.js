jQuery(document).ready(function($) {
    // Ecoute du clic sur le bouton "Contact"
    $('.open-popup').on('click', function(e) {
        e.preventDefault(); // Empêche le comportement par défaut du lien

        // Récupération des données des attributs data- du bouton
        var reference = $(this).data('reference');
        var photoId = $(this).data('photo-id');

        // Insérer le numéro de référence dans l'élément de la popup
        $('#popup-reference-number').text(reference);

        // Afficher la popup
        $('.popup-overlay').removeClass('hidden');
    });

    // Fermeture de la popup lorsqu'on clique sur le bouton de fermeture
    $('.close-popup').on('click', function() {
        $('.popup-overlay').addClass('hidden'); // Cache la popup
    });
});



