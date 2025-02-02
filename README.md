# Memory Game

## Description

Memory Game est un jeu interactif où les joueurs testent leur mémoire en associant des cartes en paires, tout en essayant d'obtenir le meilleur temps. Cette application inclut une gestion d'utilisateurs et des tableaux de classement (leaderboard).

## Fonctionnalités principales :

- Jeu de Memory avec différents niveaux de difficulté (cartes et chronomètre ajustés).
- Gestion des utilisateurs (inscription, connexion, activations/désactivations).
- Système de classement basé sur les scores des joueurs.
- Interface adaptée pour les administrateurs, avec la possibilité de gérer les utilisateurs et les scores.
- Protection empêchant la suppression d'un utilisateur avec des scores associés.

---

## Prérequis

Avant de démarrer, assurez-vous d'avoir les éléments suivants installés sur votre machine :

- PHP 8.0 ou une version plus récente.
- MySQL ou un autre système de base de données compatible.
- Composer (outil de gestion de dépendances PHP).
- Un serveur web comme Apache ou Nginx.

---

## Installation

### 1. Cloner le projet

Clonez le dépôt sur votre machine locale :

```bash
git clone [url-de-votre-dépôt]
cd memory-game
```

### 2. Importer la base de données

Importez le fichier de base de données vide nécessaire au fonctionnement du projet. Vous devez créer une base de données appelée **`memory_game`**, puis importer les données.

Exemple de commande MySQL pour importer une base de données sous Linux/MacOS :

```bash
mysql -u <username> -p memory_game < memory_game.sql
```

Sous Windows, vous pouvez utiliser un outil comme **phpMyAdmin** ou **HeidiSQL** pour importer le fichier.

---

### 3. Installer les dépendances via Composer

Assurez-vous d'avoir installé Composer (https://getcomposer.org/). Ensuite, dans le répertoire du projet, exécutez la commande suivante pour installer toutes les dépendances nécessaires :

```bash
composer install
```

### 4. Configuration des données fictives (fake data)

Pour générer des données (utilisateurs et scores fictifs), le projet utilise le package **FakerPHP**. Ce dernier doit déjà être installé via Composer.

Pour générer des données :
1. Vous devez exécuter le script prévu pour cela (à adapter selon votre projet si nécessaire).

2. Les données seront insérées dans la base de données via cette commande : 
```bash
php .\scripts\fixture.php
 ```

---

## Comptes utilisateur prédéfinis

Le projet est livré avec deux comptes prédéfinis pour des tests immédiats.

### Compte Administrateur :
- **Nom d'utilisateur :** `admin`
- **Mot de passe :** `1234`

### Compte Utilisateur :
- **Nom d'utilisateur :** `user1`
- **Mot de passe :** `1234`

L'administrateur dispose de fonctions supplémentaires telles que la gestion des utilisateurs et des scores.

---

## Règles particulières

### Suppression d'un utilisateur :
Il est **impossible de supprimer un utilisateur** si des scores sont associés à son compte. Vous devez d'abord supprimer tous les scores attribués à cet utilisateur avant de pouvoir le retirer.

Cela garantit l'intégrité des données du système.

---

## Démarrage

Après avoir terminé la configuration, lancez le projet localement :

1. Placez le projet dans le répertoire accessible par votre serveur web (par exemple, `/var/www/html` sous Linux ou le dossier `htdocs` sous XAMPP/Windows).

   Exemple avec Linux :
   ```bash
   mv memory-game /var/www/html/
   ```

2. Assurez-vous que le fichier `index.php` soit accessible à partir de votre navigateur web en accédant à `http://localhost/memory-game/`.

3. Connectez-vous avec les identifiants **admin** ou **user1** pour tester.

---

## Fonctionnalités supplémentaires pour le développement


- **Créer un administrateur supplémentaire :** En ajoutant manuellement un utilisateur dans la base de données avec `group_id = 2`, vous pouvez créer un autre compte administrateur.

---

## Technologies utilisées

- **Langage backend :** PHP 8.0
- **Base de données :** MySQL
- **Gestion des dépendances :** Composer
- **Bibliothèque pour les données :** FakerPHP
- **Front-end :**
    - Bootstrap 5 pour les styles.
    - JavaScript natif pour la logique client.

---

## Points importants

- Le projet utilise des sessions pour gérer la connexion des utilisateurs.
- Une sécurisation de base a été mise en place pour nettoyer les entrées utilisateur avec des fonctions PHP (par exemple `htmlspecialchars`, `password_hash`).
- Les administrateurs disposent d'un accès exclusif à certaines sections comme la gestion des utilisateurs et le leaderboard.

---

## Contributions

Si vous souhaitez contribuer à ce projet, veuillez créer une branche pour chaque fonctionnalité que vous ajoutez ou problème que vous corrigez. Ensuite, proposez une pull request.

---

Merci de votre intérêt pour ce projet Memory Game : profitez de l'exploration et de l'amélioration !