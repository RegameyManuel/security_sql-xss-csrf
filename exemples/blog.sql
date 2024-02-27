DROP DATABASE IF EXISTS blog;

-- Création de la base de données
CREATE DATABASE blog;
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


-- Insertion des utilisateurs
INSERT INTO utilisateur (nom, prenom, email, mot_de_passe) VALUES
('Dupont', 'Bernard', 'bernard.dupont@email.com', 'password123'),
('Al-Jabr', 'Sophia', 'sophia.jabr@email.com', 'password456'),
('Hernandez', 'Alia', 'alia.hernandez@email.com', 'password789');

-- Insertion des catégories
INSERT INTO categorie (nom, description) VALUES
('Technologie', 'Tout sur les dernières innovations technologiques'),
('Voyage', 'Conseils et astuces pour les voyageurs'),
('Cuisine', 'Recettes et conseils culinaires'),
('Sport', 'Actualités et articles sur le sport'),
('Mode', 'Les dernières tendances de la mode');

-- Insertion des articles
INSERT INTO article (titre, contenu, id_utilisateur, id_categorie) VALUES
('Les dernières innovations en tech', 'Contenu de l''article sur la technologie...', 1, 1),
('Comment préparer son sac de voyage', 'Contenu de l''article sur le voyage...', 2, 2),
('Recette du gâteau au chocolat', 'Contenu de l''article sur la cuisine...', 3, 3),
('Les bienfaits du sport sur la santé', 'Contenu de l''article sur le sport...', 1, 4),
('Comment rester à la mode en 2024', 'Contenu de l''article sur la mode...', 2, 5),
('Nouveautés high-tech à ne pas manquer', 'Contenu de l''article sur la technologie...', 3, 1),
('Découvrir le monde en 10 étapes', 'Contenu de l''article sur le voyage...', 1, 2),
('Votre routine sportive pour l''été', 'Contenu de l''article sur le sport...', 2, 4);

