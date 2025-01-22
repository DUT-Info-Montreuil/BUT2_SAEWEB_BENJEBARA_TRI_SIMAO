# SAE Manager - Gestion de Projets Pédagogiques

Application web pour la gestion de projets pédagogiques dans un contexte scolaire. Permet aux enseignants et étudiants de collaborer sur des projets, gérer des ressources, des rendus, des soutenances et des notes.

## 🚀 Fonctionnalités

- **Authentification**  
  Connexion sécurisée pour enseignants et étudiants.
- **Gestion de Projets**  
  - Création/Édition/Suppression de projets (enseignants)
  - Attribution de responsables
  - Gestion des semestres et années
- **Collaboration**  
  - Création de groupes d'étudiants
  - Demandes de groupe entre étudiants
  - Partage de ressources (fichiers, liens)
- **Évaluations**  
  - Gestion des rendus avec dates limites
  - Planification de soutenances
  - Attribution et modification de notes
- **Tableau de bord**  
  Vue consolidée des projets avec navigation intuitive

## 🛠 Technologies

- **Backend**  
  ![PHP](https://img.shields.io/badge/PHP-8.0+-777BB4?logo=php)
  ![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?logo=mysql)
- **Frontend**  
  ![Bulma](https://img.shields.io/badge/Bulma-0.9.4-00D1B2?logo=bulma)
- **Architecture**  
  Modèle-Vue-Contrôleur (MVC)

## Configuration

Modifier les identifiants dans connexion.php :
```php
$host = 'localhost';
$dbname = 'sae';
$user = 'root'; 
$pass = 'votre_mot_de_passe';
```
## Structure des fichiers

├── Modules/
│   ├── Mod_connexion/       # Gestion authentification
│   ├── Mod_projets/         # Liste des projets
│   ├── Mod_projet/          # Détails d'un projet
│   └── ...                  # Autres modules
├── header.php               # En-tête commun
├── footer.php               # Pied de page
├── connexion.php            # Configuration BDD
└── index.php                # Routeur principal

## Comptes de test

# Enseignants:

Email: prof / Mot de passe: aze

Email: prof2 / Mot de passe: aze

# Étudiants:

Email: tom / Mot de passe: aze
Email: tom2 / Mot de passe: aze
