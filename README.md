# ArcadiaZoo

**ArcadiaZoo** est une application web complète dédiée à la gestion des activités du zoo Arcadia. Elle permet une gestion efficace des habitats, des animaux, des services et des avis du zoo, offrant ainsi une solution intégrée pour toutes les opérations du zoo.

## Fonctionnalités

- **Gestion des habitats** : Ajouter, supprimer et mettre à jour les informations sur les habitats du zoo.
- **Gestion des animaux** : Ajouter, supprimer et mettre à jour les informations sur les animaux, y compris leur état de santé, leur nourriture et leur habitat.
- **Gestion des services** : Configurer et gérer les différents services offerts par le zoo.
- **Gestion des avis** : Permettre aux visiteurs de laisser des avis sur le zoo, avec modération par le personnel du zoo.
- **Statistiques de consultation** : Suivi des interactions des visiteurs avec les animaux, via un système de "J'aime" enregistré dans MongoDB.

## Technologies Utilisées

### Frontend

- **HTML**
- **CSS**
- **JavaScript**
- **Bootstrap** : Framework CSS pour le développement rapide et réactif.

### Backend

- **PHP** : Langage de programmation côté serveur utilisé pour la logique d'application et les interactions avec la base de données.
- **MySQL** : Système de gestion de base de données relationnelle pour stocker les données sur les animaux, les avis, les contacts, les services et les utilisateurs.
- **MongoDB** : Base de données non relationnelle utilisée pour stocker les statistiques de consultation des animaux.

## Structure du Projet

ArcadiaZoo/
│
├── actions/ # Scripts PHP pour les actions (ajout, suppression, modification)
├── config/ # Configuration du projet (base de données, paramètres)
├── node_modules/ # Dépendances Node.js pour la gestion des statistiques
├── public/ # Fichiers publics accessibles (Pages PHP, CSS, JS, images)
├── vendor/ # Dépendances PHP via Composer
├── views/ # includes/ # Dossier pour les fichiers communs (header, footer)
├── composer.json # Dépendances PHP via Composer
├── composer.lock # Fichier de verrouillage des dépendances PHP
├── mongodb_connexion.php # Script de connexion à MongoDB
├── package.json # Dépendances Node.js
├── package-lock.json # Fichier de verrouillage des dépendances Node.js
├── procfile # Configuration pour déploiement Heroku
├── README.md # Ce fichier
├── server.js # Serveur Node.js pour la gestion des statistiques
└── structure.txt # Structure de la base de données

## Backend

### MySQL

La base de données relationnelle MySQL est utilisée pour stocker et gérer les données structurées :

- **Table `animals`** : Contient les informations sur les animaux.
- **Table `avis`** : Contient les avis des visiteurs.
- **Table `contact`** : Contient les informations de contact.
- **Table `services`** : Contient les détails des services offerts.
- **Table `users`** : Contient les informations des utilisateurs (administrateurs, employés, vétérinaires).

### MongoDB

La base de données non relationnelle MongoDB est utilisée pour les statistiques de consultation des animaux :

- **Collection `animalviews`** : Stocke les comptages de "J'aime" pour chaque animal. Les données sont mises à jour en temps réel lorsque les visiteurs interagissent avec les boutons "J'aime".

### Node.js

Le serveur Node.js, configuré avec Express, écoute sur le port 4000 pour gérer les requêtes liées aux statistiques et interagir avec MongoDB.

### PHP

Les scripts PHP gèrent les opérations côté serveur, y compris l'interaction avec la base de données MySQL pour la gestion des informations sur les animaux, les avis, et les services.

## Installation

Si vous souhaitez tester l'application en local, voici les étapes à suivre :

1. Clonez le dépôt :

https://github.com/ovis02/ArcadiaZoo.git

Verifiez bien que vous etes sur la branche test

Installer les dépendences php et Node.js

## Déploiement

Le projet est entièrement fonctionnel et déployé sur Heroku : https://arcazoo-40aeb8b73b17.herokuapp.com/

Mohammad Aowis
Développeur Web
© 2024 Mohammad Aowis
