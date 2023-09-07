<?php
session_start();

if (!isset($_SESSION['Connecte']) || $_SESSION['Connecte'] !== true) {
    $messageNonConnecter = "Vous devez être connecté pour accéder à cette page.";
}

include_once "Class/DbConnect.php";
include_once "Class/DataBase.php";
include_once "Class/Formulaire.php";

$dbConnect = new DbConnect();
$formulaire = new Formulaire();

if (isset($_POST['submitAjoutPPV'])) {
    $nomppv = $_POST['nomppv'];
    $dateppv = $_POST['dateDuPPV'];
    $afficheppv = $_POST['afficheppv'];
    
    $dbConnect->InsertPPV($nomppv, $dateppv, $afficheppv);
}

if (isset($_POST['submitUpdatePPV'])) {
    $idP = $_POST['UpdateIdP'];
    $updatenomppv = $_POST['UpdateNomPpv'];
    $updatedateppv = $_POST['UpdateDateDuPPV'];
    $uptdateafficheppv = $_POST['UpdateAfficheppv'];
    
    $dbConnect->UpdatePPV($idP, $updatenomppv, $updatedateppv, $uptdateafficheppv);
}

if (isset($_POST['deleteSubmitPPV'])) {
    $idDeleteP = $_POST['deleteIdP'];
    $dbConnect->DeletePPV($idDeleteP);
}

if (isset($_POST['submitAjoutCatcheur'])) {
    $prenomCatcheur = $_POST['prenomCatcheur'];
    $nomCatcheur = $_POST['nomCatcheur'];
    $afficheCatcheur = $_POST['afficheCatcheur'];
    
    $dbConnect->InsertCatcheur($prenomCatcheur, $nomCatcheur, $afficheCatcheur);
}

if (isset($_POST['submitUpdateCatcheur'])) {
    $idC = $_POST['UpdateIdC'];
    $updatePrenomCatcheur = $_POST['UpdatePrenomCatcheur'];
    $updateNomCatcheur = $_POST['UpdateNomCatcheur'];
    $updateAfficheCatcheur = $_POST['UpdateAfficheCatcheur'];
    
    $dbConnect->UpdateCatcheur($idC, $updatePrenomCatcheur, $updateNomCatcheur, $updateAfficheCatcheur);
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <title>Option</title>
</head>
<body class="bodyOption">
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
    echo '<div class="Div-Option">';
    echo $formulaire->AjoutPPV();
    echo '</div>';

    echo '<div class="Div-Option">';
    echo $formulaire->UpdatePPV();
    echo '</div>';

    echo '<div class="Div-Option">';
    echo $formulaire->DeletePPV();
    echo '</div>';

    echo '<div class="Div-Option">';
    echo $formulaire->AjoutCatcheur();
    echo '</div>';

    echo '<div class="Div-Option">';
    echo $formulaire->UpdateCatcheur();
    echo '</div>';
}
?>
    </body>
</html>