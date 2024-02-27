<?php
// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=blog', "admin", "Afpa1234");

// Récupération et filtrage des données
$id = $_POST['id'];
$titre = $_POST['titre'];
$contenu = $_POST['contenu'];

// Préparation de la requête de mise à jour
$query = $pdo->prepare("UPDATE article SET titre = ?, contenu = ? WHERE id = ?");
$result = $query->execute([$titre, $contenu, $id]);

if ($result) {
    echo "Article mis à jour avec succès.";
} else {
    echo "Erreur lors de la mise à jour de l'article.";
}
?>
<!-- Bouton de retour à la page d'accueil -->
<form action="index.php" method="get">
    <button type="submit">Retour à l'accueil</button>
</form>