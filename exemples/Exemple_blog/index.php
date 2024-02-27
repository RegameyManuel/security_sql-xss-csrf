<?php
session_start();

// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=blog', "admin", "Afpa1234");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Vérification de la connexion de l'utilisateur
if (isset($_POST['email']) && isset($_POST['mot_de_passe'])) {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    try {
        // Construction de la requête SQL de manière non sécurisée
        $query = "SELECT * FROM utilisateur WHERE email = '$email' AND mot_de_passe = '$mot_de_passe'";

        // Exécution de la requête
        $result = $pdo->query($query);
        if ($result) {
            $utilisateur = $result->fetch();

            if ($utilisateur) {
                // Connexion réussie
                $_SESSION['utilisateur_id'] = $utilisateur['id'];
                $_SESSION['utilisateur_nom'] = $utilisateur['nom'];
                echo "<p>Connexion réussie</p>";
            } else {
                // Échec de la connexion
                throw new Exception("Erreur de connexion");
            }
        }
    } catch (Exception $e) {
        echo "<p>" . $e->getMessage() . "</p>";
    }
}

if (isset($_SESSION['utilisateur_id'])) {
    // L'utilisateur est connecté
    echo "<p>Bonjour, " . htmlspecialchars($_SESSION['utilisateur_nom']) . "!</p>";
    echo "<a href='logout.php'>Se déconnecter</a>";
    echo "<hr>";
    echo "<a href='add_article.php'>Ajouter un article</a>";
    echo "<hr>";

    // Affichage des articles
    $query = "SELECT article.id, article.titre, utilisateur.nom AS auteur FROM article JOIN utilisateur ON article.id_utilisateur = utilisateur.id";
    foreach ($pdo->query($query) as $article) {
        echo "<div>";
        echo "<h2>" . htmlspecialchars($article['titre']) . "</h2>";
        echo "<p>Écrit par: " . htmlspecialchars($article['auteur']) . "</p>";
        echo "<a href='edit_article.php?id=" . $article['id'] . "'>Éditer</a> | ";
        echo "<a href='delete_article.php?id=" . $article['id'] . "' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer cet article ?\");'>Supprimer</a>";
        echo "</div><hr>";
    }
} else {
    // Formulaire de connexion
    echo "<form action='index.php' method='post'>";
    echo "<label for='email'>Email :</label>";
    echo "<input type='email' id='email' name='email' required>";
    echo "<label for='mot_de_passe'>Mot de passe :</label>";
    echo "<input type='password' id='mot_de_passe' name='mot_de_passe' required>";
    echo "<input type='submit' value='Se connecter'>";
    echo "</form>";
}
?>
