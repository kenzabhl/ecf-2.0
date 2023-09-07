<?php
session_start();

if (!isset($_SESSION['Connecte']) || $_SESSION['Connecte'] !== true) {
    $messageNonConnecter = "Vous devez être connecté pour accéder à cette page.";
}


include_once "Class/DbConnect.php";
include_once "Class/DataBase.php";
include_once "Class/Formulaire.php";

$dbConnect = new DbConnect();
$resultatsTousCatcheurs = $dbConnect->Catcheur();
$resultatsTousPPV = $dbConnect->readAll('ppv');

function AfficheResultat($ppvNom) {
    $dbConnect = new DbConnect();
    return $dbConnect->AfficheResultat($ppvNom); 
}

$ppvNom = ""; 

if (isset($_POST['submitPPV'])) {
    if (isset($_POST['ppv'])) {
        $ppvNom = $_POST['ppv']; 
        $resultats = AfficheResultat($ppvNom);
    
    }
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <title>Resultat</title>
</head>
<body class="bodyResultat">
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
    echo Formulaire::FormulaireResultatPPV($resultatsTousPPV);

    $resultats = AfficheResultat($ppvNom);
} if (isset($_POST['ppv'])) {
        echo '<section class="resultat-ppv">';
        echo'<fieldset class="Resultat-Fieldset"';

    foreach ($resultats as $resultat) {
        echo '<h1>' . $resultat['nom_match'] . '</h1>';
        echo '<h5>' . $resultat['resultat_final'] . '</h5>';
    }
    echo '</section>';
    echo'</fieldset>';
}
?>
    </body>
</html>