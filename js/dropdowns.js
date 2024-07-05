(function($) {
    $(document).ready(function() {
        const dropdowns = document.querySelectorAll('.custom-dropdown');

        // Fonction pour initialiser les dropdowns
        function initializeDropdowns() {
            dropdowns.forEach(function(dropdown) {
                const titleBox = dropdown.querySelector('.title_filter_box');
                const optionsList = dropdown.querySelector('.list_items_filter');
                const iconSpan = titleBox.querySelector('.span_icon_filter');
                const hiddenInput = dropdown.querySelector('input[type="hidden"]');

                // Gestion de l'ouverture/fermeture de la liste au clic
                titleBox.addEventListener('click', function() {
                    optionsList.classList.toggle('menu_open');
                    iconSpan.classList.toggle('span_icon_filter_rotate');
                });

                // Gestion de la sélection d'une option
                const listItems = optionsList.querySelectorAll('.list_item');
                listItems.forEach(function(item) {
                    item.addEventListener('click', function() {
                        const selectedValue = item.textContent;
                        const selectedDataValue = item.getAttribute('data-value');

                        // Supprimer la classe .list_item_selected des éléments précédemment sélectionnés
                        optionsList.querySelectorAll('.list_item_selected').forEach(function(item) {
                            item.classList.remove('list_item_selected');
                        });

                        // Ajouter la classe .list_item_selected à l'élément cliqué
                        item.classList.add('list_item_selected');

                        // Mettre à jour la valeur sélectionnée dans le titre
                        titleBox.querySelector('.selected-value').textContent = selectedValue;

                        // Mettre à jour la valeur du champ caché avec l'ID sélectionné
                        hiddenInput.value = selectedDataValue;

                        // Fermer la liste déroulante après la sélection
                        optionsList.classList.remove('menu_open');
                        iconSpan.classList.remove('span_icon_filter_rotate');

                        // Appeler une fonction pour charger les photos selon la sélection
                        loadPhotosBySelection();
                    });
                });
            });
        }

        // Initialiser les dropdowns
        initializeDropdowns();
    });

    // Fonction pour charger les photos selon la sélection
    function loadPhotosBySelection() {
        // Votre logique pour charger les photos
    }
})(jQuery);
