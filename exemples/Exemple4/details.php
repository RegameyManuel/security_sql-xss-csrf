<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf8">
</head>
<body>
<?php 
	$id = $_GET["id"];
	
	$db = new PDO("mysql:host=localhost;dbname=hotel", "admin", "Afpa1234");
	$requete = $db->prepare("select * from client where cli_id=:id");
	$requete->bindParam(":id", $id);
	$requete->execute();
	$ligne = $requete->fetch(PDO::FETCH_OBJ);
?>


	
		<div>id: <?=$ligne->cli_id?></div>
		<div>nom: <?=$ligne->cli_prenom?></div>
		<div>prenom: <?=$ligne->cli_nom?></div>
		<div>ville: <?=$ligne->cli_ville?></div>

		<a href="delete.php?id=<?=$ligne->cli_id?>">supprimer le client</a>


<a href="index.php">retour à la liste</a>


</body>
</html>