<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un article</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <header>
        <h1>Ajouter un article</h1>
    </header>
    <div class="container">
        <form action="save_article.php" method="post">
            <div class="form-group">
                <label for="titre">Titre :</label>
                <input type="text" name="titre" id="titre" required>
            </div>
            <div class="form-group">
                <label for="contenu">Contenu :</label>
                <textarea name="contenu" id="contenu" required></textarea>
            </div>
            <input type="submit" value="Enregistrer">
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
