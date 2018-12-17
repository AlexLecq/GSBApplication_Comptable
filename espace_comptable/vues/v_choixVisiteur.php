
<?php 

/**
 * Vue de la page de validation de frais 
 * @author Alexandre Leclercq
 * @version 1.0.0 GIT <GSBApplication>
 */

?>

<div id="choixVisiteur">
    <h2>Validation de fiche de frais</h2>
    <div class="row">
        <div class="col-md-4">
            <h3>Sélectionner un Visiteur : </h3>
            <form action="index.php?uc=validerFrais&action=afficherFrais" method="post">
            <div class="form-group">
                <label for="lstVisiteur"> Visiteur :<?php ?></label>
                <select class="form-control" name="lstVisiteur" id="lstVisiteur">
                    <?php 
                        for($i = 0 ; $i < sizeof($lstVisiteur) ; $i++){
                            if($i == 0){
                                ?><option selected value="<?php echo $lstVisiteur[$i]["id"] ?> "> <?php echo $lstVisiteur[$i]['nom'] .' '. $lstVisiteur[$i]['prenom'] ?></option> <?php
                            }else{
                              ?><option value="<?php echo $lstVisiteur[$i]["id"] ?> "> <?php echo $lstVisiteur[$i]['nom'] .' '. $lstVisiteur[$i]['prenom'] ?></option> <?php 
                            }
                        }
                    ?>
                </select>
                <label for="lstMois">Mois :</label>
                <select class="form-control" name="lstMois" id="lstMois">
                        <?php 
                            
                        ?>
                         <option selected value="<?php echo $mois; ?>"><?php echo $numMois.'/'.$numAnnee; ?></option>
                </select>
            </div>
            <input class="btn btn-success" type="submit" value="Valider">
            </form>
            
        </div>
        <div class="col-md-4">
            
        </div>

    </div>
</div>