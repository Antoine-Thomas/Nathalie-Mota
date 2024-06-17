# Site Natalie Mota

![Logo Natalie Mota](https://github.com/Antoine-Thomas/Nathalie-Mota/blob/main/images/logo_nathalie_mota.png)

## Description

Le site Natalie Mota est une plateforme dédiée à la photographie, mettant en avant les œuvres de l'artiste Natalie Mota. Le site permet aux visiteurs de parcourir différentes catégories de photos, de visualiser les détails de chaque photo et de filtrer les photos par catégorie, format et date.

## Structure du Site

1. **Home Page** : La page d'accueil présente une sélection de photos et des informations sur l'artiste.
2. **Galerie** : Une page de galerie où les photos sont affichées en fonction des filtres sélectionnés.
3. **Single Photo** : Une page détaillée pour chaque photo, affichant les informations spécifiques et les images en haute résolution.
4. **Contact** : Une page de contact permettant aux visiteurs d'envoyer des messages à l'artiste.

## Fonctionnalités

1. **Filtrage des Photos** : Les visiteurs peuvent filtrer les photos par catégorie, format et date.
2. **Chargement Dynamique des Photos** : Utilisation de l'AJAX pour charger plus de photos sans recharger la page.
3. **Lightbox** : Un effet lightbox pour visualiser les photos en grand format.
4. **Effets d'Animation** : Des animations CSS pour améliorer l'expérience utilisateur.

## Installation

1. **Pré-requis** :
   - Serveur web (Apache, Nginx, etc.)
   - PHP 7.4 ou supérieur
   - MySQL 5.6 ou supérieur
   - WordPress 5.6 ou supérieur
   - Advanced Custom Fields (ACF) Plugin

2. **Étapes d'Installation** :
   - Cloner le dépôt du site sur votre serveur local ou en ligne :
     ```sh
     git clone https://github.com/Antoine-Thomas/Nathalie-Mota.git
     ```
   - Configurer votre base de données et mettre à jour le fichier `wp-config.php` avec vos informations de base de données.
   - Installer les dépendances et plugins nécessaires.
   - Importer le fichier de base de données fourni (le cas échéant).
   - Configurer les champs ACF pour les photos.

## Développement

### Chargement des Photos par AJAX

Le fichier `load_more_photos.php` contient la logique pour charger dynamiquement plus de photos lors de la navigation dans la galerie.

### Filtrage des Photos

La fonction `load_photos_by_selection` dans `functions.php` gère le filtrage des photos selon les catégories, formats et dates sélectionnés par l'utilisateur.

### Debugging

Si vous rencontrez des erreurs lors de l'affichage des photos ou des filtres, vérifiez les points suivants :
- Assurez-vous que les catégories et formats sont correctement définis dans ACF.
- Utilisez les logs PHP pour déboguer les erreurs.
- Vérifiez les requêtes AJAX dans la console du navigateur pour les éventuelles erreurs.

### Personnalisation

Pour personnaliser les effets d'animation, modifiez les fichiers CSS et JS correspondants. Par exemple, les effets de fade-in et les animations des titres peuvent être trouvés dans `style.css` et `animations.js`.

## Contributions

Les contributions sont les bienvenues. Veuillez suivre les étapes suivantes pour contribuer :
1. Forker le dépôt.
2. Créer une branche pour votre fonctionnalité (`git checkout -b feature/nouvelle-fonctionnalité`).
3. Committer vos modifications (`git commit -am 'Ajout de nouvelle fonctionnalité'`).
4. Pousser la branche (`git push origin feature/nouvelle-fonctionnalité`).
5. Créer une Pull Request.

## Support

Pour toute question ou problème, veuillez contacter le support à support@nathaliemota.com.

## Licence

Ce projet est sous licence MIT. Voir le fichier `LICENSE.txt` pour plus de détails.

## Liens Utiles

- [Dépôt GitHub](https://github.com/Antoine-Thomas/Nathalie-Mota)
- [Logo du Site](https://github.com/Antoine-Thomas/Nathalie-Mota/blob/main/images/logo_nathalie_mota.png)
- [Voir le Site en Ligne](https://www.motaphoto.searching-murphy.com/)
