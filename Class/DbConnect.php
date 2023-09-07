<?php
include 'Class/Database.php';

class DbConnect extends Database {
    private $dbConnect;    

    public function __construct() {
        $this->dbConnect = Database::dbConnect();
    }

    public function Connexion($pseudo, $password) {
        $sql = "SELECT * FROM `utilisateur` WHERE pseudo = :pseudo";
        $stmt = $this->dbConnect->prepare($sql);
        $stmt->bindValue(':pseudo', $pseudo);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return true;
        } else {
            return false;
        } 
    }
    public function Inscription($pseudo, $password) {
        $sql = "INSERT INTO `utilisateur` (`pseudo`, `password`) VALUES (:pseudo, :password)";
        $stmt = $this->dbConnect->prepare($sql);
        $stmt->bindValue(':pseudo', $pseudo);
        $stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT));
        $stmt->execute();
    }


    public function readAll($ppv) {
        $sqlSelect = "SELECT * FROM `$ppv`";
        $stmtSelect = $this->dbConnect->prepare($sqlSelect);
        $stmtSelect->execute();
        return $stmtSelect->fetchAll(PDO::FETCH_ASSOC);
    }



public function PPVParAnnee($annee) {
        
    $sql = "SELECT* FROM `ppv` WHERE YEAR(`date_ppv`) = :annee";
    $stmt = $this->dbConnect->prepare($sql);
    $stmt->bindValue(':annee', $annee, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


public function Catcheur () {
    $sql = "SELECT  `prenom_catcheur`, `nom_catcheur`, `affiche_catcheur` FROM `roster_` ";
$stmt = $this->dbConnect->prepare($sql);
$stmt->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


public function PPVParCatcheurs($prenom, $nom) {
    $sqlPPVParCatcheurs = "SELECT ppv.id_ppv, ppv.nom_ppv, ppv.date_ppv, ppv.affiche_ppv
                            FROM ppv
                            JOIN a_participe ON ppv.id_ppv = a_participe.id_ppv
                            JOIN roster_ ON a_participe.id_roster = roster_.id_roster
                            WHERE roster_.prenom_catcheur = ? AND roster_.nom_catcheur =  ?";
    $stmtPPVParCatcheurs = $this->dbConnect->prepare($sqlPPVParCatcheurs);
    $stmtPPVParCatcheurs->bindParam(1, $prenom);
    $stmtPPVParCatcheurs->bindParam(2, $nom);
    $stmtPPVParCatcheurs->execute();
    return $stmtPPVParCatcheurs->fetchAll(PDO::FETCH_ASSOC);
}



public function readAllCatcheur() {
    $sqlSelect = "SELECT * FROM `roster_` ORDER BY `prenom_catcheur` ASC";
    $stmtSelect = $this->dbConnect->prepare($sqlSelect);
    $stmtSelect->execute();
    return $stmtSelect->fetchAll(PDO::FETCH_ASSOC);
}


public function Champions() {
    $sql = "SELECT roster_.*, est_champion.id_champion
            FROM `roster_`
            LEFT JOIN `est_champion` ON roster_.id_roster = est_champion.id_roster
            WHERE est_champion.id_champion IS NOT NULL
            ORDER BY roster_.prenom_catcheur ASC";

    $stmt = $this->dbConnect->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function InsertPPV( $nomPpv, $datePpv, $affichePpv) {
    $sql = "INSERT INTO `ppv`(`nom_ppv`, `date_ppv`, `affiche_ppv`) VALUES (:nomppv, :dateppv, :afficheppv)";
    $stmt =$this->dbConnect->prepare($sql);
    $stmt->bindValue(':nomppv', $nomPpv);
    $stmt->bindValue(':dateppv', $datePpv);
    $stmt->bindValue(':afficheppv', $affichePpv);
    $stmt->execute();
}

public function UpdatePPV($idP, $updateNomPpv, $updateDatePpv, $uptdateAffichePpv) {
    $sql = "UPDATE `ppv` SET `nom_ppv` = :updatenomppv, `date_ppv` = :updatedateppv, `affiche_ppv` = :uptdateafficheppv WHERE id_ppv = :idP";
    $stmt = $this->dbConnect->prepare($sql);
    $stmt->bindValue(':idP', $idP);
    $stmt->bindValue(':updatenomppv', $updateNomPpv);
    $stmt->bindValue(':updatedateppv', $updateDatePpv);
    $stmt->bindValue(':uptdateafficheppv', $uptdateAffichePpv);
    $stmt->execute();
}

public function DeletePPV($idDeleteP) {
    $sql = "DELETE FROM `ppv` WHERE `id_ppv` = :idDeleteP";
    $stmt = $this->dbConnect->prepare($sql);
    $stmt->bindValue(':idDeleteP', $idDeleteP);
    $stmt->execute();

}

public function InsertCatcheur($prenomCatcheur, $nomCatcheur, $afficheCatcheur) {
    $sql = "INSERT INTO `roster_` (`prenom_catcheur`, `nom_catcheur`, `affiche_catcheur`) VALUES (:prenomcatcheur, :nomcatcheur, :affichecatcheur)";
    $stmt = $this->dbConnect->prepare($sql);
    $stmt->bindValue(':prenomcatcheur', $prenomCatcheur);
    $stmt->bindValue(':nomcatcheur', $nomCatcheur);
    $stmt->bindValue(':affichecatcheur', $afficheCatcheur);
    $stmt->execute();
}

public function UpdateCatcheur($idC, $updatePrenomCatcheur, $updateNomCatcheur, $updateAfficheCatcheur) {
    $sql = "UPDATE `roster_` SET `prenom_catcheur`= :updateprenomcatcheur,`nom_catcheur`= :updatenomcatcheur,`affiche_catcheur`= :updateaffichecatcheur WHERE id_roster= :idC";
    $stmt = $this->dbConnect->prepare($sql);
    $stmt->bindValue(':idC', $idC);
    $stmt->bindValue(':updateprenomcatcheur', $updatePrenomCatcheur);
    $stmt->bindValue(':updatenomcatcheur', $updateNomCatcheur);
    $stmt->bindValue(':updateaffichecatcheur', $updateAfficheCatcheur);
    $stmt->execute();

}
public function AfficheResultat($ppvNom) {
    $sql = "SELECT
        match.id_match,
        match.nom_match,
        resultat_match_.resultat_final,
        ppv.nom_ppv
    FROM
        `match`
        INNER JOIN `a_pour_resultat` ON match.id_match = a_pour_resultat.id_match
        INNER JOIN `resultat_match_` ON resultat_match_.id_resultat_match = a_pour_resultat.id_resultat_match
        INNER JOIN `a_gagne` ON resultat_match_.id_resultat_match = a_gagne.id_resultat_match
        INNER JOIN `ppv` ON a_gagne.id_ppv = ppv.id_ppv
    WHERE ppv.nom_ppv = :ppvNom";  
 
    $stmt = $this->dbConnect->prepare($sql);
    $stmt->bindValue(':ppvNom', $ppvNom, PDO::PARAM_STR);  
    $stmt->execute();
 
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
 }
 
}