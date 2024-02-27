<?php
	session_start();
	if (!isset($_SESSION["role"]) || $_SESSION["role"]!="admin") {
		header("Location: login.php");
	}
?>
<!DOCTYPE html>
<html>

<head>
	<title></title>
	<meta charset="utf8">
</head>

<body>
	<form action="ajout_script.php" method="POST">
		<input type="text" name="nom" /> <br />
		<input type="text" name="prenom" /> <br />
		<input type="text" name="ville"> <br />
		<input type="submit" />
	</form>
</body>

</html>