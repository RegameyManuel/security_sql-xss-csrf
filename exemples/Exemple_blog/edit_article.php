<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un article</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <header>
        <h1>Modifier un article</h1>
    </header>
    <div class="container">
        <?php
        // Connexion à la base de données
        $pdo = new PDO('mysql:host=localhost;dbname=blog', "admin", "Afpa1234");
        $id = $_GET['id'];

        // Construction de la requête SQL de manière non sécurisée
        $query = "SELECT * FROM article WHERE id = " . $id; // Très risqué et non recommandé!
        // Exécution de la requête
        $article = $pdo->query($query)->fetch();

        if (!$article) {
            echo "<p>Article introuvable.</p>";
            exit;
        }
        ?>

        <form action="update_article.php" method="post" class="form-article">
            <input type="hidden" name="id" value="<?php echo $article['id']; ?>">
            <div class="form-group">
                <label for="titre">Titre :</label>
                <input type="text" name="titre" id="titre" value="<?php echo htmlspecialchars($article['titre']); ?>" required>
            </div>
            <div class="form-group">
                <label for="contenu">Contenu :</label>
                <textarea name="contenu" id="contenu" required><?php echo htmlspecialchars($article['contenu']); ?></textarea>
            </div>
            <input type="submit" value="Mettre à jour">
        </form>
        <!-- Bouton de retour à la page d'accueil -->
        <form action="index.php" method="get">
            <button type="submit">Retour à l'accueil</button>
        </form>
    </div>
    <footer>
        <p>Mon Blog © 2024</p>
    </footer>
</body>
</html>
