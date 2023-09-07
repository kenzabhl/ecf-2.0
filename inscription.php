<?php
session_start();

include_once "Class/DbConnect.php";
include_once "Class/DataBase.php";

if (isset($_POST['submitInscription'])) {
    $pseudo = $_POST['pseudo'];
    $password = $_POST['password'];

    $dbConnect = new DbConnect();
    $dbConnect->Inscription($pseudo, $password);

    header("Location: connexion.php"); 
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <title>Inscription</title>
</head>
<body class="bodyInscription">
<header class="header">
        <h1 class="logo"><a href="https://www.wwe.com/">WWE</a></h1>
        <ul class="main-nav">
            <li><a href="connexion.php">Connexion</a></li>
            <li><a href="accueil.php">Accueil</a></li>
            <li><a href="ppv.php">PPV</a></li>
            <li><a href="resultat.php">Résultat</a></li>
            <li><a href="roster.php">Roster</a></li>
            <li><a href="option.php">Option</a></li>
            <li><a href="deconnexion.php">Déconnexion</a></li>
        </ul>
    </header>

    <section class="Inscription-Section">
        <fieldset class="Inscription-Fieldset">
        <h1>Inscription</h1>
        <form method="POST">
            <div>
                <label for="pseudo">Pseudo:</label><br>
                <input type="text" name="pseudo">
            </div>
            <div>
                <label for="password">Mot de passe:</label><br>
                <input type="password" name="password">
            </div>
            <div>
    <button type="submit" name="submitInscription">S'inscrire</button>
    </div>
        </form>
    </div>
    </fieldest>
    </section>
</body>
</html>