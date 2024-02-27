<?php
// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=blog', "admin", "Afpa1234");

// Récupération des données du formulaire
$titre = $_POST['titre'];
$contenu = $_POST['contenu'];
$id_utilisateur = 1; // Supposons que l'utilisateur est déjà authentifié et a l'ID 1
$id_categorie = 1; // Supposons une catégorie par défaut

// Préparation de la requête d'insertion
$query = $pdo->prepare("INSERT INTO article (titre, contenu, id_utilisateur, id_categorie) VALUES (?, ?, ?, ?)");
$result = $query->execute([$titre, $contenu, $id_utilisateur, $id_categorie]);

if ($result) {
    echo "Article ajouté avec succès.";
} else {
    echo "Erreur lors de l'ajout de l'article.";
}
?>
<!-- Bouton de retour à la page d'accueil -->
<form action="index.php" method="get">
    <button type="submit">Retour à l'accueil</button>
</form>