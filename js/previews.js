jQuery(document).ready(function ($) {
    // Module de navigation entre les pages

    // Fonction pour mettre à jour l'image d'aperçu de la page suivante
    function updatePreviewImage() {
        const rightArrow = $('.right-arrow'); // Sélection du bouton flèche droite
        const nextPageUrl = rightArrow.data('next-page-url'); // Récupération de l'URL de la page suivante depuis les données de l'élément
        const previewImage = $('.next-page-preview .preview-image'); // Sélection de l'image d'aperçu de la page suivante

        // Vérification si nextPageUrl est défini
        if (nextPageUrl) {
            // Requête AJAX pour charger la page suivante et récupérer son contenu
            $.ajax({
                url: nextPageUrl,
                method: 'GET',
                success: function(data) {
                    const $pageContent = $(data); // Conversion de la réponse en objet jQuery
                    const nextImageUrl = $pageContent.find('.photo-display img').attr('src'); // Récupération de l'URL de l'image de la page suivante
                    if (nextImageUrl) {
                        previewImage.attr('src', nextImageUrl); // Mise à jour de l'attribut src de l'image d'aperçu avec l'URL de l'image trouvée
                    } else {
                        previewImage.attr('src', ''); // Réinitialisation de l'aperçu de l'image si aucune image trouvée
                    }
                },
                error: function(_xhr, _status, _error) {
                    previewImage.attr('src', ''); // Réinitialisation de l'aperçu de l'image en cas d'erreur lors de la requête AJAX
                }
            });
        } else {
            // Si nextPageUrl n'est pas défini, vérifier si rightArrow existe
            if (rightArrow.length > 0) {
                previewImage.attr('src', ''); // Réinitialisation de l'aperçu de l'image si aucun URL de page suivante n'est défini
            } else {
                // Sinon, ne rien faire (dernière page)
            }
        }
    }

    // Écouteur d'événement pour le clic sur la flèche gauche (page précédente)
    $('.left-arrow').on('click', function (event) {
        event.preventDefault(); // Empêcher le comportement par défaut du lien
        const prevPageUrl = $(this).data('prev-page-url'); // Récupération de l'URL de la page précédente depuis les données de l'élément
        if (prevPageUrl) {
            window.location.href = prevPageUrl; // Redirection vers l'URL de la page précédente
        }
    });

    // Écouteur d'événement pour le clic sur la flèche droite (page suivante)
    $('.right-arrow').on('click', function (event) {
        event.preventDefault(); // Empêcher le comportement par défaut du lien
        const nextPageUrl = $(this).data('next-page-url'); // Récupération de l'URL de la page suivante depuis les données de l'élément
        if (nextPageUrl) {
            window.location.href = nextPageUrl; // Redirection vers l'URL de la page suivante
        }
    });

    // Appel initial pour mettre à jour l'image d'aperçu de la page suivante au chargement de la page
    updatePreviewImage();

    // Ajout de l'écouteur d'événement passif pour les interactions tactiles
    document.addEventListener('touchstart', function() {}, { passive: true });
});
