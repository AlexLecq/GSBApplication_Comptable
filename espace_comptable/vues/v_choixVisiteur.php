
<?php 

/**
 * Vue de la page de validation de frais 
 * @author Alexandre Leclercq
 * @version 0.1.0 GIT <GSBApplication>
 */

?>

<div id="choixVisiteur">
    <h2>Validation de fiche de frais</h2>
    <div class="row">
        <div class="col-md-4">
            <h3>Sélectionner un Visiteur : </h3>
            <form action="index.php?uc=validerFrais&action=choixVisiteur" method="post">
            <div class="form-group">
                <label for="unVisiteur"> Visiteur :<?php ?></label>
                <select class="form-control" onchange="if(this.value != 0){ var select = this.value; this.form.submit();}" name="unVisiteur" id="lstVisiteur">
                    <?php 
                        for($i = 0 ; $i < sizeof($lstVisiteur) ; $i++){
                            if($i == 0){
                                ?><option  selected value="<?php echo $lstVisiteur[$i]["id"] ?> "> <?php echo $lstVisiteur[$i]['nom'] .' '. $lstVisiteur[$i]['prenom'] ?></option> <?php
                            }else{
                              ?><option  value="<?php echo $lstVisiteur[$i]["id"] ?> "> <?php echo $lstVisiteur[$i]['nom'] .' '. $lstVisiteur[$i]['prenom'] ?></option> <?php 
                            }
                        }
                    ?>
                </select>
            </div>
            </form>

            <form action="index.php?uc=validerFrais&action=afficherFrais" method="post">
            <div class="form-group">
                <label for="unMois">Mois :</label>
                <select class="form-control" name="unMois" id="lstMois">
                        <?php
                            $i = 0;
                        
                            $moisActuelle = getMois(date('d/m/Y'));
                            $numAnneeActuelle = substr($moisActuelle, 0, 4);
                            $numMoisActuelle = substr($moisActuelle, 4, 2);
                            ?><option id="optMois" selected value=<?php echo $moisActuelle ?>> <?php echo $numMoisActuelle .'/'.$numAnneeActuelle ?> </option><?php

                            foreach($tabDate as $key => $value){
                                
                                $mois = $value['mois'];
                                $numAnnee = $value['numAnnee'];
                                $numMois = $value['numMois'];

                                if($numAnnee < $key[$i - 1]['numAnnee'] || $numMois < $key[$i -1]['numMois']){
                                    ?><option id="optMois" selected value=<?php echo $mois ?>> <?php echo $numMois .'/'.$numAnnee ?> </option><?php
                                }else{
                                    ?><option id="optMois" value=<?php echo $mois ?>> <?php echo $numMois .'/'.$numAnnee ?> </option><?php
                                }
                                $i++;
                            }
                                
                            
                        ?>
                         
                </select>
            </div>
                <input class="btn btn-success" type="submit" value="Valider">
            </form>
            
        </div>
        <div class="col-md-4">
            
        </div>

    </div>
</div>