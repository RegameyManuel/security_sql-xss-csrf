Voici un exemple de script SQL pour créer une base de données nommée `blog` dans MariaDB, incluant trois tables : `utilisateur`, `article`, et `categorie`. Ce script définit une structure de base pour chaque table avec des champs clés pour un blog typique. Notez que vous devrez peut-être ajuster les types de données et les contraintes selon vos besoins spécifiques.

```sql
-- Création de la base de données
CREATE DATABASE IF NOT EXISTS blog;
USE blog;

-- Création de la table 'utilisateur'
CREATE TABLE IF NOT EXISTS utilisateur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    date_inscription DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Création de la table 'categorie'
CREATE TABLE IF NOT EXISTS categorie (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) UNIQUE NOT NULL,
    description TEXT
);

-- Création de la table 'article'
CREATE TABLE IF NOT EXISTS article (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    contenu TEXT NOT NULL,
    date_publication DATETIME DEFAULT CURRENT_TIMESTAMP,
    id_utilisateur INT,
    id_categorie INT,
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id) ON DELETE SET NULL,
    FOREIGN KEY (id_categorie) REFERENCES categorie(id) ON DELETE SET NULL
);
```

Ce script SQL effectue les opérations suivantes :
- **Crée** la base de données `blog` si elle n'existe pas déjà.
- Sélectionne la base de données `blog` pour les opérations suivantes.
- **Crée** une table `utilisateur` avec des champs pour l'ID (clé primaire auto-incrémentée), le nom, le prénom, l'email (unique), le mot de passe, et la date d'inscription.
- **Crée** une table `categorie` avec des champs pour l'ID (clé primaire auto-incrémentée), le nom (unique), et une description.
- **Crée** une table `article` avec des champs pour l'ID (clé primaire auto-incrémentée), le titre, le contenu, la date de publication, et des clés étrangères vers les tables `utilisateur` et `categorie`.

Assurez-vous de revoir et d'ajuster ce script selon vos besoins, notamment en ce qui concerne la sécurité du stockage des mots de passe (il est recommandé d'utiliser un hachage sécurisé) et les contraintes de relations entre les tables (par exemple, `ON DELETE CASCADE` ou `ON DELETE SET NULL` selon la logique de votre application).