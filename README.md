# Site Natalie Mota

![Logo Natalie Mota](https://github.com/Antoine-Thomas/Nathalie-Mota/blob/main/images/logo_nathalie_mota.png)

## Description

Le site Natalie Mota est une plateforme dédiée à la photographie, mettant en avant les œuvres de l'artiste Natalie Mota. Les visiteurs peuvent explorer différentes catégories de photos, visualiser les détails de chaque photo et filtrer les images par catégorie, format et date.

## Structure du Site

1. **Home Page** : Présente une sélection de photos et des informations sur l'artiste.
2. **Galerie** : Affiche les photos selon les filtres sélectionnés.
3. **Single Photo** : Page détaillée pour chaque photo, avec informations spécifiques et images haute résolution.
4. **Contact** : Permet aux visiteurs d'envoyer des messages à l'artiste.

## Fonctionnalités

1. **Filtrage des Photos** : Filtrer les photos par catégorie, format et date.
2. **Chargement Dynamique** : Utilisation d'AJAX pour charger plus de photos sans recharger la page.
3. **Lightbox** : Effet lightbox pour visualiser les photos en grand format.
4. **Effets d'Animation** : Utilisation d'animations CSS pour une meilleure expérience utilisateur.

## Installation

1. **Pré-requis** :
   - Serveur web (Apache, Nginx, etc.)
   - PHP 7.4 ou supérieur
   - MySQL 5.6 ou supérieur
   - WordPress 5.6 ou supérieur
   - Plugin Advanced Custom Fields (ACF)

2. **Étapes d'Installation** :
   - Clonez le dépôt sur votre serveur local ou en ligne :
     ```
     git clone https://github.com/Antoine-Thomas/Nathalie-Mota.git
     ```
   - Configurez votre base de données et mettez à jour `wp-config.php` avec vos informations.
   - Installez les dépendances et plugins nécessaires.
   - Importez la base de données fournie si nécessaire.
   - Configurez les champs ACF pour les photos.

## Développement

### Chargement des Photos par AJAX

Le fichier `load_more_photos.php` contient la logique pour charger dynamiquement plus de photos lors de la navigation dans la galerie.

### Filtrage des Photos

La fonction `load_photos_by_selection` dans `functions.php` gère le filtrage des photos par catégories, formats et dates sélectionnés.

### Débogage

Pour résoudre les erreurs d'affichage des photos ou des filtres :
- Vérifiez que les catégories et formats sont correctement définis dans ACF.
- Utilisez les logs PHP pour déboguer les erreurs.
- Contrôlez les requêtes AJAX dans la console du navigateur pour d'éventuelles erreurs.

### Personnalisation

Personnalisez les effets d'animation en modifiant les fichiers CSS et JS correspondants, comme les effets de fade-in et les animations des titres dans `style.css` et `animations.js`.

## Contributions

Les contributions sont les bienvenues. Suivez ces étapes pour contribuer :
1. Fork du dépôt.
2. Créez une branche pour votre fonctionnalité (`git checkout -b feature/nouvelle-fonctionnalité`).
3. Commitez vos modifications (`git commit -am 'Ajout de nouvelle fonctionnalité'`).
4. Pushez la branche (`git push origin feature/nouvelle-fonctionnalité`).
5. Créez une Pull Request.

## Support

Pour toute question ou problème, contactez le support à support@nathaliemota.com.

## Licence

Ce projet est sous licence MIT. Consultez le fichier `LICENSE.txt` pour plus de détails.

## Liens Utiles

- [Dépôt GitHub](https://github.com/Antoine-Thomas/Nathalie-Mota)
- [Logo du Site](https://github.com/Antoine-Thomas/Nathalie-Mota/blob/main/images/logo_nathalie_mota.png)
- [Voir le Site en Ligne](https://www.motaphoto.searching-murphy.com/)

