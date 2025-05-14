# Contrôle Symfony - Gestion de Parcours

Ce projet permet la gestion de parcours d'apprentissage pour des utilisateurs (conseillers et candidats), avec authentification, dépôt de rendus, messages, et tableaux de bord personnalisés.

## ✅ Fonctionnalités réalisées

### 🧱 Entités créées

- [x] **User**
- [x] **Ressource**
- [x] **Message**
- [x] **Parcours**
- [x] **Etape**
- [x] **Rendu**

### 🔐 Sécurité

- [x] Authentification via Symfony Security
- [x] Enregistrement d’un utilisateur
- [x] Seul un **conseiller** peut :
  - [x] Créer un parcours
  - [x] Créer une étape
  - [x] Créer une ressource
  - [NOK] Se déclarer accompagnant d’un candidat

### ⚙️ CRUD (Create Read Update Delete)

- [x] Ressource
- [x] Message
- [x] Parcours
- [x] Etape
- [NOK] Rendu

### ✉️ Messages

- [x] L’émetteur d’un message est automatiquement le **user connecté**

### 📊 Tableau de bord d’un parcours

- [x] Un parcours affiche ses **étapes**
- [x] Une étape affiche ses **ressources** associées (avec lien de téléchargement)
- [x] Une étape affiche le **dernier rendu** du user connecté
- [NOK] Un **mini formulaire** permet le **dépôt d’un rendu**
- [NOK] Si un message est lié à un rendu, un **lien vers ce message** est proposé
- [NOK] Le parcours affiché est **lié à l’utilisateur connecté** (accompagnant ou candidat)

---

## 👥 Comptes de démonstration

Pour tester rapidement les différentes interfaces, deux comptes sont à disposition :

| Rôle            | Email                      | Mot de passe |
|-----------------|----------------------------|--------------|
| 🛠 Conseiller | conseiller@root.fr           | azertyuiop     |
| 👤 candidat     | candidat@root.fr            | azertyuiop      |


## Technologies
Ce projet utilise plusieurs technologies modernes pour créer une expérience interactive:

<table align="center"> <tbody> <tr> <td align="center"> <img width="75" src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/60/Symfony2.svg/langfr-280px-Symfony2.svg.png" alt="Symfony" /> <p>Symfony</p> </td> </tr> </tbody> </table>

### 1. Cloner le projet
   
Ouvrez votre terminal et exécutez la commande suivante pour cloner le dépôt :

```git clone https://github.com/Souyyy/ControleSymfony/```

### 2. Accéder au répertoire
Naviguez dans le dossier du projet :

```cd ControleSymfony```

### 3. Installer les dépendances
Installez toutes les dépendances nécessaires au projet :

```composer install```

Cette étape peut prendre quelques minutes selon votre connexion internet.

### 3.1 Installer la BDD

Créez une base de donnée nommé `userlogin_symfony`, et importer le fichier SQL

### 4. Lancer l'application

Démarrez le serveur de développement :

```symfony serve```
