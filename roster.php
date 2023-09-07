<?php
session_start();

if (!isset($_SESSION['Connecte']) || $_SESSION['Connecte'] !== true) {
    $messageNonConnecter = "Vous devez être connecté pour accéder à cette page.";
}


include_once "Class/DbConnect.php"; 
include_once "Class/DataBase.php";
include_once "Class/Formulaire.php";


$dbConnect = new DbConnect();
$resultatsTousCatcheurs = $dbConnect->readAllCatcheur();
$champions = $dbConnect->Champions();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <title>Roster</title>
</head>
<body class="bodyRoster">
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

    <?php
if (isset($messageNonConnecter)) {
    echo '<div style="background-color: #ff0000; color: #fff; text-align: center; padding: 10px;">' . $messageNonConnecter . '</div>';
} else {
    echo Formulaire::FormulaireChampions($champions);

    echo '<div class="catcheur-list">';
    echo '<div class="row">';
    foreach ($resultatsTousCatcheurs as $catcheur) {
        echo '<div class="col-md-4">';
        echo '<div class="card">';
        echo '<img src="' . $catcheur['affiche_catcheur'] . '" class="card-img-top" alt="' . $catcheur['prenom_catcheur'] . ' ' . $catcheur['nom_catcheur'] . '">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $catcheur['prenom_catcheur'] . ' ' . $catcheur['nom_catcheur'] . '</h5>';
        foreach ($champions as $champion) {
            if ($champion['id_roster'] === $catcheur['id_roster']) {
                echo '<span class="badge bg-success">Champion</span>';
            }
        }
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    echo '</div>';
    echo '</div>';
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
