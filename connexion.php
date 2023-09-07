<?php
session_start();

include_once "Class/DbConnect.php";
include_once "Class/DataBase.php";

if (isset($_POST['submitConnexion'])) {
    $pseudo = $_POST['pseudo'];
    $password = $_POST['password'];

    $dbConnect = new DbConnect();

    if ($dbConnect->Connexion($pseudo, $password)) {
        $_SESSION['Connecte'] = true;
        $_SESSION['pseudo'] = $pseudo;
        header("Location: accueil.php");
        exit;
    } else {
        $messageErreur = "Pseudo ou mot de passe incorrect.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <title>Connexion</title>
</head>

<body class=bodyConnexion>
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
    <div class="">
        <?php if (isset($_SESSION['Connecte']) && $_SESSION['Connecte'] === true) { ?>
            <section class="Message-Alerte-Section">
                <div class="card-Message-Alerte">
                    <div class="messageAlerte">
                        Vous êtes connecté en tant que <?php echo $_SESSION['pseudo']; ?>.
                    </div>
                </div>
            </section>
        <?php } else { ?>

        <section class="Connexion-Fieldset-Section">
            <fieldset class="Connexion-Fieldset">
                <h1>Connexion</h1>
                <form method="POST">
                    <div>
                        <label for="pseudo">Pseudo:</label><br>
                        <input type="text" name="pseudo" class="" required><br>
                    </div>
                    <div>
                        <label for="password">Mot de passe:</label><br>
                        <input type="password" name="password" class="" required><br>
                    </div>
                    <div>
                        <button type="submit" name="submitConnexion" class="">Se connecter</button>
                 </div>
    </div>
    </form>
    </fieldest>
        </section>
<?php } ?>
</div>
</body>

</html>