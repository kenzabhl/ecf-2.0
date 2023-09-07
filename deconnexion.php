<?php
session_start();

if (!isset($_SESSION['Connecte']) || $_SESSION['Connecte'] !== true) {
    $messageNonConnecter = "Vous devez être connecté pour accéder à cette page.";
}


if (isset($_POST['submitDeconnexion'])) {
    session_destroy();
    header("Location: connexion.php");
    exit;
}

include_once "Class/DbConnect.php";
include_once "Class/DataBase.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <title>Déconnexion</title>
</head>

<body class="bodyDeconnexion">
    <header class="header">
        <h1 class="logo"><a href="#">WWE</a></h1>
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
    <?php
    if (isset($messageNonConnecter)) {
        echo '<div style="background-color: #ff0000; color: #fff; text-align: center; padding: 10px;">' . $messageNonConnecter . '</div>';
    } else {
        echo '<section class="Message-Deconnexion-Section">';
        echo '<fieldset class="Fieldest-Message-Deconnexion">';
        echo '<h1>Merci pour votre visite, et n\'oubliez pas la suite au prochain numéro.</h1>';
        echo '<form method="POST" style="text-align: center; margin-top: 20px;">';
        echo '<button type="submit" name="submitDeconnexion">Se Déconnecter</button>';
        echo '</form>';
        echo '</fieldest>';
        echo '</section>';
    }
    ?>

</body>

</html>