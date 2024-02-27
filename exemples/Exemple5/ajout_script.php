<?php 
session_start();
if (!isset($_SESSION["role"]) || $_SESSION["role"]!="admin") {
	header("Location: login.php");
}
	$nom = $_POST["nom"];
	$prenom = $_POST["prenom"];
	$ville = $_POST["ville"];

	$db = new PDO("mysql:host=localhost; dbname=hotel; charset=utf8", "admin", "Afpa1234");

	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//$sql = "insert into client (cli_nom, cli_prenom, cli_ville) values ('$nom', '$prenom', '$ville')";

	//echo "<pre>$sql</pre>";

	//$requete = $db->query($sql);

	$requete = $db->prepare("insert into client (cli_nom, cli_prenom, cli_ville) values (:c, :p, :v)");
	$requete->bindParam(":c", $nom);
	$requete->bindParam(":p", $prenom);
	$requete->bindParam(":v", $ville);
	$requete->execute();

?>

<a href="index.php">retour à la liste</a>