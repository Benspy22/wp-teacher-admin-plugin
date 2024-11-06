# Gestion Administrative Enseignants

## Description du plugin

### Objectif
Le plugin "Gestion Administrative Enseignants" a pour objectif de faciliter la gestion des notes, la planification des cours et le suivi des compétences des élèves pour les enseignants.

### Fonctionnalités principales
- **Gestion des notes** : Création, modification, suppression et visualisation des notes des élèves.
- **Planning des cours** : Planification des cours avec un calendrier interactif.
- **Suivi des compétences** : Suivi des compétences des élèves avec validation et progression.
- **Exports et rapports** : Export des données en PDF et génération de rapports.

### Technologies utilisées
- WordPress
- PHP
- JavaScript (jQuery)
- FullCalendar
- Chart.js
- Bootstrap

## Installation

### Prérequis
- WordPress 5.0 ou supérieur
- PHP 7.0 ou supérieur
- MySQL 5.6 ou supérieur

### Étapes d'installation
1. Téléchargez le plugin depuis le dépôt GitHub ou le répertoire des plugins WordPress.
2. Décompressez le fichier ZIP téléchargé.
3. Téléversez le dossier `wp-teacher-admin-plugin` dans le répertoire `wp-content/plugins` de votre installation WordPress.
4. Activez le plugin depuis le menu "Plugins" de l'admin WordPress.

### Configuration initiale
1. Accédez au menu "Gestion Enseignants" dans l'admin WordPress.
2. Configurez les paramètres initiaux tels que les classes, les matières et les compétences.

## Guide d'utilisation

### Gestion des notes
1. Accédez à "Gestion Enseignants" > "Notes".
2. Utilisez le formulaire pour ajouter ou modifier des notes.
3. Visualisez les notes dans le tableau avec des filtres dynamiques et des colonnes triables.
4. Exportez les notes en PDF si nécessaire.

### Planning des cours
1. Accédez à "Gestion Enseignants" > "Planning".
2. Utilisez le calendrier interactif pour planifier les cours.
3. Ajoutez ou modifiez des cours via le formulaire.
4. Utilisez les filtres pour visualiser les cours par classe ou période.

### Suivi des compétences
1. Accédez à "Gestion Enseignants" > "Compétences".
2. Utilisez le tableau de bord pour visualiser la progression des compétences par élève.
3. Validez les compétences via le formulaire de validation.
4. Exportez le livret de compétences en PDF et générez des rapports.

### Exports et rapports
1. Utilisez les boutons d'export pour générer des PDF des notes, du planning et des compétences.
2. Accédez aux rapports pour visualiser les statistiques et les historiques.

## Structure du projet

### Organisation des fichiers
- `wp-teacher-admin.php` : Fichier principal du plugin.
- `includes/` : Contient les classes de gestion des notes, du planning et des compétences.
- `templates/` : Contient les templates pour les interfaces utilisateur.
- `assets/css/` : Contient les fichiers CSS.
- `assets/js/` : Contient les fichiers JavaScript.

### Description des composants
- **WP_Teacher_Admin** : Classe principale du plugin.
- **Notes_Manager** : Classe de gestion des notes.
- **Planning_Manager** : Classe de gestion du planning.
- **Competences_Manager** : Classe de gestion des compétences.

### Base de données
- `wp_teacher_grades` : Table pour les notes.
- `wp_teacher_courses` : Table pour les cours.
- `wp_teacher_skills` : Table pour les compétences.

## Développement

### Comment contribuer
1. Forkez le dépôt GitHub.
2. Créez une branche pour votre fonctionnalité (`git checkout -b feature/ma-fonctionnalité`).
3. Commitez vos modifications (`git commit -m 'Ajout de ma fonctionnalité'`).
4. Poussez votre branche (`git push origin feature/ma-fonctionnalité`).
5. Créez une Pull Request.

### Standards de code
- Respectez les standards de codage de WordPress.
- Utilisez des commentaires pour documenter votre code.
- Testez vos modifications avant de les soumettre.

### Guide de commit
- Utilisez des messages de commit clairs et concis.
- Préfixez vos commits avec des mots-clés tels que `Ajout`, `Correction`, `Mise à jour`.

## Crédits et Licence
- **Auteur** : Benjamin Debruijne
- **Licence** : GPL v2 ou supérieur

Ce plugin est open-source et sous licence GPL v2. Vous êtes libre de l'utiliser, de le modifier et de le distribuer sous les mêmes termes.