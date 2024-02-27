<!-- add_article.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un article</title>
</head>
<body>
    <h2>Ajouter un article</h2>
    <form action="save_article.php" method="post">
        <label for="titre">Titre :</label>
        <input type="text" name="titre" id="titre" required>
        <br>
        <label for="contenu">Contenu :</label>
        <textarea name="contenu" id="contenu" required></textarea>
        <br>
        <input type="submit" value="Enregistrer">
        

    </form>
    <!-- Bouton de retour à la page d'accueil -->
    <form action="index.php" method="get">
        <button type="submit">Retour à l'accueil</button>
    </form>
</body>
</html>
