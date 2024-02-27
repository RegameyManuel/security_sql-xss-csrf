<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppression d'article</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <header>
        <h1>Suppression d'article</h1>
    </header>
    <div class="container">
        <?php
        // Connexion à la base de données
        $pdo = new PDO('mysql:host=localhost;dbname=blog', "admin", "Afpa1234");
        $id = $_GET['id'];

        // Préparation et exécution de la requête de suppression
        $query = $pdo->prepare("DELETE FROM article WHERE id = ?");
        $result = $query->execute([$id]);

        if ($result) {
            echo "<p>Article supprimé avec succès.</p>";
        } else {
            echo "<p>Erreur lors de la suppression de l'article.</p>";
        }
        ?>
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
