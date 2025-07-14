# 🎵 WebMusic - Projet PHP

Ce projet est un site web musical étudiant développé en PHP avec une base de données MySQL.  
Il permet de rechercher des musiques, artistes, albums, etc.

# Problème : 
    - ne fonctionne pas sur Linux pour des problèmes de casse sur les namespaces, les noms de classes ou certains répertoires
        -> En cours de correction
---

## 📦 Prérequis

Avant de commencer, assurez-vous d’avoir installé sur votre machine :

- [PHP (>= 8.0)](https://www.php.net/)
- [Composer](https://getcomposer.org/)
- [MySQL ou MariaDB](https://www.mysql.com/) (installé via XAMPP, MAMP, WAMP ou directement)
- Un serveur web local (ex: PHP server, XAMPP, etc.)
- [phpMyAdmin](https://www.phpmyadmin.net/)

---

## 🚀 Installation du projet

1. **Clonez le projet :**

```bash
git clone https://github.com/MaxencePeq/WebMusic.git
cd webmusic
```

2. **Installez les dépendances PHP avec Composer :**

```bash
composer install
composer du
(Si erreur de droit de lancement) : chmod +x bin/run-serveur.sh

```

---

## 🛠️ Configuration de la base de données

### 1. Créez la base de données

- Lancez **phpMyAdmin** (ou un autre outil MySQL).
- Créez une nouvelle base de données nommée `webmusic`.

> Vous pouvez choisir un autre nom, mais pensez à bien le reporter dans `.mypdo.ini`.

---

### 2. Importez les données

- Dans **phpMyAdmin**, sélectionnez la base `webmusic`.
- Cliquez sur **"Importer"**, puis sélectionnez le fichier `import.sql` fourni dans le projet.
- Validez : les tables et données seront créées automatiquement.

---

## 🔐 Configuration de la connexion MySQL

Le fichier `.mypdo.ini` contient les identifiants de connexion à la base de données **en local**.

1. **Copiez le fichier d’exemple :**

```bash
cp .mypdo.ini.example .mypdo.ini
```

2. **Éditez le fichier `.mypdo.ini` selon votre configuration MySQL :**

```ini
dbname = webmusic
user = root
password = root
```

> Par défaut :
> - Sur XAMPP/WAMP : `user = root` / `password = ` (vide)
> - Sur MAMP : `user = root` / `password = root`

---

## 💻 Lancer le site localement

Lancez un serveur PHP dans le dossier `public/` :

```bash
composer start
```

Ensuite, ouvrez [http://localhost:8000](http://localhost:8000) dans votre navigateur.

---

## 📚 Fichiers importants

| Fichier/Dossier         | Rôle                                         |
|-------------------------|----------------------------------------------|
| `public/`               | Contient les pages web accessibles           |
| `src/`                  | Contient les entités, collections, etc.      |
| `.mypdo.ini`            | Connexion locale à la base MySQL             |
| `import.sql`            | Script d’import de la base de données        |

---

## ❗ Important

- **Ne pas versionner le fichier `.mypdo.ini`** (il est ignoré par `.gitignore`).
- Chaque utilisateur doit créer et configurer ce fichier **en local**.

---

## 🙋‍♂️ Besoin d’aide ?

Si vous avez une erreur du type :
```
Uncaught PDOException: SQLSTATE[HY000] [1045] Access denied for user...
```
Cela signifie que vos identifiants dans `.mypdo.ini` sont incorrects. Vérifiez bien :

- Le nom d’utilisateur (`user`)
- Le mot de passe (`password`)
- Le nom de la base (`dbname`)