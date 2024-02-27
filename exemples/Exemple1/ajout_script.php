<?php 
	$nom = $_POST["nom"];
	$prenom = $_POST["prenom"];
	$ville = $_POST["ville"];

	$db = new PDO("mysql:host=localhost; dbname=hotel; charset=utf8", "admin", "Afpa1234");

	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$sql = "insert into client (cli_nom, cli_prenom, cli_ville) values ('$nom', '$prenom', '$ville')";

	echo "<pre>$sql</pre>";

	$requete = $db->query($sql);

	// $requete = $db->prepare("insert into liens (titre, url, description) values (:t, :u, :d)");
	// $requete->bindParam(":t", $titre);
	// $requete->bindParam(":u", $url);
	// $requete->bindParam(":d", $description);
	// $requete->execute();

	//header("Location: liste.php");
?>

<a href="index.php">retour à la liste</a>