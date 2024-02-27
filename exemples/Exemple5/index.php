<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf8">
</head>
<body>
<?php 
	$db = new PDO("mysql:host=localhost;dbname=hotel", "admin", "Afpa1234");
	$requete = $db->query("select * from client");
	$tableau = $requete->fetchAll(PDO::FETCH_OBJ);
?>

<a href="ajout_form.php">Ajouter un lien</a>

	<table border="1">
	<tr>
		<th>nom</th>
		<th>prenom</th>
		<th>ville</th>
	</tr>
	<?php foreach ($tableau as $ligne): ?>
		<tr>
			<td>
				<?=htmlspecialchars($ligne->cli_nom)?>
			</td>
			<td>
				<?=$ligne->cli_prenom?>
			</td>
			<td>
				<?=$ligne->cli_ville?>
			</td>
			<td>
				<a href="details.php?id=<?=$ligne->cli_id?>" >details</a>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>




</body>
</html>