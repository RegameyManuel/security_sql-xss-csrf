<?php 
	session_start();
	if (!isset($_SESSION["role"]) || $_SESSION["role"]!="admin") {
		header("Location: login.php");
	}

	$id = $_GET["id"];

	$db = new PDO("mysql:host=localhost; dbname=hotel; charset=utf8", "admin", "Afpa1234");

	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//$sql = "insert into client (cli_nom, cli_prenom, cli_ville) values ('$nom', '$prenom', '$ville')";

	//echo "<pre>$sql</pre>";

	//$requete = $db->query($sql);

	$requete = $db->prepare("delete from client where cli_id=:id");
	$requete->bindParam(":id", $id);
	$requete->execute();

?>

<a href="index.php">retour à la liste</a>