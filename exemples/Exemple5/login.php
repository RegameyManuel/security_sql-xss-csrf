<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $id = $_POST["identifiant"];
    $mdp = $_POST["motdepasse"];

    if ($id=="admin" && $mdp=="secret") {
        $_SESSION["role"]="admin";
    }
    else if ($id=="user" && $mdp=="user") {
        $_SESSION["role"]="user";
    }
    else {
        $_SESSION["role"] = null;
    }

    header("Location: index.php");
}
else { ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
    </head>
    <body>
        <form action="login.php" method="post">
        <input type="text" placeholder="identifiant" name="identifiant">
        <input type="text" placeholder="mot de passe" name="motdepasse">
        <input type="submit">
        </form>
    </body>
    </html>

<?php } ?>
