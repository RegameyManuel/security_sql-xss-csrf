<?php
// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=blog', "admin", "Afpa1234");
$id = $_GET['id'];

/*
// Récupération de l'article à modifier
$query = $pdo->prepare("SELECT * FROM article WHERE id = ?");
$query->execute([$id]);
$article = $query->fetch();
*/

// Construction de la requête SQL de manière non sécurisée
$query = "SELECT * FROM article WHERE id = " . $id; // Très risqué et non recommandé!
// Exécution de la requête
$article = $pdo->query($query)->fetch();




if (!$article) {
    echo "Article introuvable.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un article</title>
</head>
<body>
    <h2>Modifier un article</h2>
    <form action="update_article.php" method="post">
        <input type="hidden" name="id" value="<?php echo $article['id']; ?>">
        <label for="titre">Titre :</label>
        <input type="text" name="titre" id="titre" value="<?php echo htmlspecialchars($article['titre']); ?>" required>
        <br>
        <label for="contenu">Contenu :</label>
        <textarea name="contenu" id="contenu" required><?php echo htmlspecialchars($article['contenu']); ?></textarea>
        <br>
        <input type="submit" value="Mettre à jour">
    </form>
    <!-- Bouton de retour à la page d'accueil -->
    <form action="index.php" method="get">
        <button type="submit">Retour à l'accueil</button>
    </form>
</body>
</html>
