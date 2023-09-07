<?php
session_start();

if (!isset($_SESSION['Connecte']) || $_SESSION['Connecte'] !== true) {
    $messageNonConnecter = "Vous devez être connecté pour accéder à cette page.";
}

include_once "Class/DbConnect.php";
include_once "Class/DataBase.php";
include_once "Class/Formulaire.php";

$dbConnect = new DbConnect();

$resultatsTousPPV = $dbConnect->readAll('ppv');
$resultatsPPV = [];

if (isset($_POST['submitAnnee'])) {
    $annee = $_POST['year'];
    $resultatsPPV = $dbConnect->PPVParAnnee($annee);
}

$resultatsTousCatcheurs = $dbConnect->Catcheur();
$resultatsPPVCatcheurs = [];

if (isset($_POST['submitCatcheur'])) {
    $selectedCatcheur = explode(' ', $_POST['catcheur']);
    $prenom = $selectedCatcheur[0];
    $nom = $selectedCatcheur[1];
    $resultatsPPVCatcheurs = $dbConnect->PPVParCatcheurs($prenom, $nom);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <title>PPV</title>
</head>
<body class="bodyPPV">
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
    if (isset($annee))  {
        echo Formulaire::FormulaireAnnee($annee);
    } else {
        echo Formulaire::FormulaireAnnee(null);
    }
   
    ;
    echo Formulaire::FormulaireCatcheur($resultatsTousCatcheurs);

    if (!empty($resultatsPPVCatcheurs)) {
        echo '<div class="row">';
        foreach ($resultatsPPVCatcheurs as $ppv) {
            echo '<div class="col-md-4 mb-4">';
            echo '<div class="card">';
            echo '<img src="' . $ppv['affiche_ppv'] . '" class="card-img-top" alt="Affiche PPV">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $ppv['nom_ppv'] . '</h5>';
            echo '<p class="card-text">Date : ' . $ppv['date_ppv'] . '</p>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
    } elseif (!empty($resultatsPPV)) {
        echo '<div class="row">';
        foreach ($resultatsPPV as $ppv) {
            echo '<div class="col-md-4 mb-4">';
            echo '<div class="card">';
            echo '<img src="' . $ppv['affiche_ppv'] . '" class="card-img-top" alt="Affiche PPV">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $ppv['nom_ppv'] . '</h5>';
            echo '<p class="card-text">Date : ' . $ppv['date_ppv'] . '</p>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo '<div class="row">';
        foreach ($resultatsTousPPV as $ppv) {
            echo '<div class="col-md-4 mb-4">';
            echo '<div class="card">';
            echo '<img src="' . $ppv['affiche_ppv'] . '" class="card-img-top" alt="Affiche PPV">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $ppv['nom_ppv'] . '</h5>';
            echo '<p class="card-text">Date : ' . $ppv['date_ppv'] . '</p>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
    }
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
 </body>
</html>