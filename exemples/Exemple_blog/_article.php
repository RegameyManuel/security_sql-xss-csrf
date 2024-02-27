<?php
// Connexion à la base de données
// Remplacez les valeurs ci-dessous par vos propres informations de connexion
$pdo = new PDO('mysql:host=localhost;dbname=blog', "admin", "Afpa1234");

// Sélectionner tous les articles
$query = $pdo->query('SELECT * FROM article');
$articles = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des articles</title>
</head>
<body>
    <h2>Articles</h2>
    <?php foreach ($articles as $article): ?>
        <h3><?php echo htmlspecialchars($article['titre']); ?></h3>
        <p><?php echo nl2br(htmlspecialchars($article['contenu'])); ?></p>
        <!-- Ajouter les liens pour modifier et supprimer -->
        <a href="edit_article.php?id=<?php echo $article['id']; ?>">Modifier</a>
        <a href="delete_article.php?id=<?php echo $article['id']; ?>" onclick="return confirm('Êtes-vous sûr ?');">Supprimer</a>
    <?php endforeach; ?>
    <a href="add_article.php">Ajouter un article</a>
</body>
</html>
