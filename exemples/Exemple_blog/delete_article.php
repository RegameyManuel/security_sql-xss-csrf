<?php
// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=blog', "admin", "Afpa1234");
$id = $_GET['id'];

// Préparation et exécution de la requête de suppression
$query = $pdo->prepare("DELETE FROM article WHERE id = ?");
$result = $query->execute([$id]);

if ($result) {
    echo "Article supprimé avec succès.";
} else {
    echo "Erreur lors de la suppression de l'article.";
}
?>
<!-- Bouton de retour à la page d'accueil -->
<form action="index.php" method="get">
    <button type="submit">Retour à l'accueil</button>
</form>