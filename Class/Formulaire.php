<?php

class Formulaire {
    public static function FormulaireAnnee() {
        return '
        <section class="Formulaire-Annee">
            <form method="POST">
                <label for="year">PPV par année :</label>
                <select  name="year" id="year">
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                </select>
                <button type="submit" name="submitAnnee">Valider</button>
            </form>
            </section>
        ';
    }

    public static function FormulaireCatcheur($catcheurs) {
        $roster = '';
        foreach ($catcheurs as $catcheur) {
            $roster .= '<option value="' . $catcheur['prenom_catcheur'] . ' ' . $catcheur['nom_catcheur'] . '">' . $catcheur['prenom_catcheur'] . ' ' . $catcheur['nom_catcheur'] . '</option>';
        }
    
        return '
        <section class="Formulaire-Catcheur">
            <form method="POST">
                <label  for="catcheur"> Catcheur :</label>
                <select name="catcheur" id="catcheur">
                    ' . $roster . '
                </select>
                <button type="submit" name="submitCatcheur">Valider</button>
            </form>
            </section>
        ';
    }
    
    
    public static function FormulaireResultatPPV($ppvs) {
        $ppvOptions = ''; 
        foreach ($ppvs as $ppv) {
            $ppvOptions .= '<option value="' . $ppv['nom_ppv'] . '">' . $ppv['nom_ppv'] . '</option>';
        }
    
        return '
        <section class="Section-Formulaire">
            <form method="POST">
                <label  for="ppv"> PPV :</label>
                <select id="ppv7" name="ppv">
                    ' . $ppvOptions . '
                </select>
                <button  type="submit" name="submitPPV">Valider</button>
            </form>
            </section>
        ';
    }


    public static function FormulaireChampions($champions) {
        $champ = '';
        foreach ($champions as $champion) {
            $champ .= '<option value="' . $champion['id_roster'] . '">' . $champion['prenom_catcheur'] . ' ' . $champion['nom_catcheur'] . '</option>';
        }
    
        return '
        <div style="width: 100%; height: 40px; display: flex; align-items: center; justify-content: center;">
        <section class="Formulaire-Champions-Section">
            <form method="POST" class="text-center">
                <label for="champion">Champion :</label>
                <select name="champion" id="champion">
                    ' . $champ . '
                </select>
            </form>
        </div>
        </section>
    ';
    }

    public function AjoutPPV() {
        return '
        <section class="Ajout-PPV-Section">
        <fieldset class="Ajout-PPV-Fieldset">
        <legend class="Ajout-PPV-Legend"> Ajout PPV  </legend>
            <form action="" method="post">
                <label for="nomppv">Nom PPV :</label><br>
                <input type="text" name="nomppv"><br>
                <label for="dateDuPPV">Date Du PPV :</label><br>
                <input type="date" name="dateDuPPV"><br>
                <label for="afficheppv"> Affiche Du PPV :</label><br>
                <input type="url" name="afficheppv"><br>
                <button type="submit" name="submitAjoutPPV">Ajouter PPV</button>
            </form>
            </section>
            </fieldset>
            <br>
        ';
    }

    public function UpdatePPV() { 
        return '
         <section class="Update-PPV-Section">
         <fieldset class="Update-PPV-Fieldset">
        <legend class="Update-PPV-Legend">  Update PPV </legend>
            <form action="" method="post">
                <label for="UpdateIdP">Id PPV :</label><br>
                <input type="number" name="UpdateIdP"><br>
                <label for="UpdateNomPpv">Nom PPV :</label><br>
                <input type="text" name="UpdateNomPpv"><br>
                <label for="UpdateDateDuPPV">Date Du PPV :</label><br>
                <input type="date" name="UpdateDateDuPPV"><br>
                <label for="UpdateAfficheppv"> Affiche Du PPV :</label><br>
                <input type="url" name="UpdateAfficheppv"><br>
                <button type="submit" name="submitUpdatePPV">Update PPV</button>
            </form>
            </section>
            </fieldset>
            <br>
        ';
    }

    
    public function DeletePPV() {
        return '
        <section class="Delete-PPV-Section">
        <fieldset class="Delete-PPV-Fieldset">
        <legend class="Delete-PPV-Legend"> Delete PPV  </legend>
        <form action="" method="post">
        <label for="deleteIdP">Id PPV :</label><br>
        <input type="number" name="deleteIdP"><br>
        <button type="submit" name="deleteSubmitPPV"> DELETE PPV</button>
       </form>
       </section>
    </fieldset>
       <br>
      
    ';
}

public function AjoutCatcheur() {
    return '
    <section class="Ajout-Catcheur-Section">
    <fieldset class="Ajout-Catcheur-Fieldset">
    <legend class="Ajout-Catcheur-Legend"> Ajout Catcheur </legend>
        <form action="" method="post">
            <label for="prenomCatcheur"> Prénom Catcheur :</label><br>
            <input type="text" name="prenomCatcheur"><br>
            <label for="nomCatcheur"> Nom Catcheur :</label><br>
            <input type="text" name="nomCatcheur"><br>
            <label for="afficheCatcheur"> Affiche Catcheur :</label><br>
            <input type="url" name="afficheCatcheur"><br>
            <button type="submit" name="submitAjoutCatcheur">Ajouter Catcheur</button>
        </form>
        </section>
        </fieldset>
        <br>
    ';

}


public function UpdateCatcheur() {
    return '
    <section class="Update-Catcheur-Section">
    <fieldset class="Update-Catcheur-Fieldset">
    <legend class="Update-Catcheur-Legend"> Update Catcheur </legend>
    <form action="" method="post">
    <label for="UpdateIdC">Id Catcheur :</label><br>
    <input type="number" name="UpdateIdC"><br>
    <label for="UpdatePrenomCatcheur"> Prénom Catcheur :</label><br>
    <input type="text" name="UpdatePrenomCatcheur"><br>
    <label for="UpdateNomCatcheur"> Nom Catcheur :</label><br>
    <input type="text" name="UpdateNomCatcheur"><br>
    <label for="UpdateAfficheCatcheur"> Affiche Catcheur :</label><br>
    <input type="url" name="UpdateAfficheCatcheur"><br>
    <button type="submit" name="submitUpdateCatcheur">Update Catcheur</button>

</form>
</section>
</fieldset>
<br>
';

}

}