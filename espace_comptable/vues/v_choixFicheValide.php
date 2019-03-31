<?php 

/**
 * Vue de la page de suivi des fiches validées
 * @author Alexandre Leclercq
 * @version 0.1.0 GIT <GSBApplication>
 */

?>

<div id="choixFicheValide">
    <h2>Suivi des fiches de frais validés</h2>
    <div class="row">
        
            <form action="index.php?uc=suiviPaiement&action=afficheFraisValide" method="post" role="form">
                <div class="col-md-4">
                    <select class="form-control" name="uneFicheValide" id="lstFicheValide">

                    <?php
                        $count = 0;
                        $listFiches = $_SESSION["listFiches"];
                        //var_dump($listFiches);
                        foreach($listFiches as $key => $value)
                        {
                            ?><option  selected value="<?php echo $value["idvisiteur"].'-'.$value["mois"]; ?> " name="<?php echo $value['nom'] .' '. $value['prenom'] ?>"> <?php echo 'Fiche du mois : '.$value['mois'].' - '.$value['nom'] .' '. $value['prenom'] ?></option> <?php
                        }
                    ?>
                    </select>
                </div>    
                <div class="col-md-4">
                    <button class="btn btn-success" type="submit">Valider</button>
                </div>
            </form>
    </div>
</div>