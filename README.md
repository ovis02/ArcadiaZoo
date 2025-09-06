# 🦁 Arcadia Zoo – Plateforme de Gestion et Découverte du Zoo

Arcadia Zoo est une application web complète permettant à la fois la **découverte du zoo par les visiteurs** et la **gestion interne** (employés, vétérinaires, administrateurs).  
Elle combine des **données relationnelles** (utilisateurs, animaux, habitats, services, comptes rendus,avis, contact) et des **statistiques en temps réel** (popularité des animaux via les « J’aime ») grâce à une double architecture MySQL + MongoDB.

---

## 🌍 Objectifs du projet

- Offrir une **expérience immersive** aux visiteurs (page principale, habitats + animaux,formulaire de contact,services)
- Permettre aux vétérinaires et employés de **gérer la santé et la nourriture des animaux en temps réel**
- Fournir aux administrateurs une **vision globale et centralisée**
- Promouvoir une architecture moderne combinant **bases relationnelles et non relationnelles**

---

## 🧰 Technologies utilisées

| Technologie    | Utilisation                                          |
| -------------- | ---------------------------------------------------- |
| **Symfony**    | Framework backend principal (architecture MVC)       |
| **PHP 8.2**    | Langage backend                                      |
| **MySQL**      | Base de données relationnelle (structure principale) |
| **MongoDB**    | Gestion des statistiques de popularité (likes)       |
| **HTML / CSS** | Pages publiques et dashboards                        |
| **Bootstrap**  | Mise en page responsive                              |
| **JavaScript** | Interactivité (boutons J’aime, formulaires, etc.)    |
| **XAMPP**      | Environnement local de développement                 |
| **Composer**   | Gestionnaire de dépendances Symfony                  |

---

## Identifiants de test

Rôle Email Mot de passe
Admin admin@zoo.com
admin123
Employé employe@zoo.com
employe123
Vétérinaire veterinaire@zoo.com
veterinaire123

## ⚙️ Fonctionnement de l'application

### 🗃️ Bases de données

- **MySQL** :

  - Gestion des **utilisateurs** (employé, vétérinaire, administrateur)
  - Gestion des **animaux** (prénom, race, habitat, état, nourriture, date de passage)
  - Gestion des **services, habitats et comptes rendus**

- **MongoDB** :
  - Suivi des **likes sur les animaux**
  - Génération de **statistiques de popularité en temps réel**

---

### 🔐 Bundles Symfony principaux

| Bundle               | Utilité                                   |
| -------------------- | ----------------------------------------- |
| **security-bundle**  | Gestion des rôles et authentification     |
| **maker-bundle**     | Génération rapide d’entités/contrôleurs   |
| **form + validator** | Formulaires et validation sécurisée       |
| **doctrine/orm**     | ORM pour MySQL                            |
| **twig-bundle**      | Moteur de templates (pages HTML/Twig)     |
| **mongodb/mongodb**  | Intégration MongoDB pour les statistiques |

---

## 🧭 Espaces de la plateforme

### 👤 Visiteurs

- Accueil et présentation du zoo
- Laisser un avis
- Consultation des habitats (désert, savane, jungle, marais, montagne)
- Découverte des animaux et informations détaillées
- Boutons « J’aime » pour indiquer leurs animaux préférés
- Formulaire de contact

---

### 🧑‍💼 Employés

- Gestion des messages de contact des visiteurs
- Gestion des services (ajout, modification, suppression)
- Consultation des incidents signalés
- Accès à un tableau de bord

---

### 🧑‍⚕️ Vétérinaires

- Tableau permettant la **mise à jour en direct** :
  - état de l’animal
  - nourriture proposée
  - grammage
  - date de passage
  - Enregistrement automatique dans la base MySQL

---

### 👨‍💼 Administrateurs

- Création et gestion des comptes employés et vétérinaires
- Gestion des habitats, animaux et services
- Suspension / réactivation des comptes utilisateurs
- Accès à un **dashboard statistique**

---

## 🚀 Déploiement local (XAMPP / VS Code)

```bash
# Cloner le projet
git clone https://github.com/ovis02/ArcadiaZoo.git
cd arcadiazoo

# Installer les dépendances
composer install

# Configurer les variables d'environnement dans .env.local
DATABASE_URL="mysql://root:root@127.0.0.1:3306/arcadiazoo"
MONGODB_URL="mongodb://localhost:27017"

# Créer la base de données MySQL
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load

# Lancer le serveur
symfony server:start


## ✍️ Auteur

Ce projet a été réalisé par **Mohammad Aowis** dans le cadre d’une **validation de compétences pour un dossier projet.
Il démontre la maîtrise de :
- ✅ Symfony et PHP
- ✅ MySQL + MongoDB
- ✅ Gestion des rôles et sécurité
- ✅ Intégration frontend/backend
- ✅ Lien de deploiement sur heroku :
```

## 🐳 Déploiement avec Docker (alternative professionnelle)

Ce projet Symfony peut être lancé dans un environnement **Dockerisé** pour une approche professionnelle.

### ✅ Prérequis

- Docker Desktop installé (avec WSL2 activé sur Windows)
- Un terminal (VS Code, PowerShell ou autre)

### 📁 Fichiers Docker à ajouter à la racine du projet :

- **Dockerfile** : contient la configuration du serveur PHP/Apache avec les extensions nécessaires (MySQL + MongoDB)
- **docker-compose.yml** : permet de lancer les services (Symfony, MySQL, phpMyAdmin)

### ▶️ Lancer le projet avec Docker

```bash
docker-compose up --build

```
