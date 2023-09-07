<?php
session_start();

if (!isset($_SESSION['Connecte']) || $_SESSION['Connecte'] !== true) {
   
 $messageNonConnecter = "Vous devez être connecté pour accéder à cette page.";

}

if (isset($_POST['submitPPV'])) { 
    header("Location: ppv.php");
    exit;
}
if (isset($_POST['submitResultat'])) {
    header("Location: resultat.php");
    exit;
}

if (isset($_POST['submitRoster'])) {
    header("Location: roster.php");
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
    <title>Accueil</title>
</head>
<body class="bodyAccueil">
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
    
        <section class="Accueil-Section-Fieldset">
            <fieldset class="Accueil-Fieldset">
                <h1>BIENVENUE</h1>
                <p>Liste Des PPV ici:</p>
                <form method="POST">
                    <div>
                        <button type="submit" name="submitPPV">PPV</button>
                    </div>
                </form>
                <p>Résultats Des PPV ici:</p>
                <form method="POST">
                    <div>
                        <button type="submit" name="submitResultat">Résultats</button>
                    </div>
                </form>
                <p>Roster ici:</p>
                <form method="POST">
                    <div>
                        <button type="submit" name="submitRoster">Roster</button>
                    </div>
                </form>
            </fieldset>
        </section>';

</body>
</html>