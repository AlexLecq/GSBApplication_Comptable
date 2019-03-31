<?php 

/**
 * Vue de l'affichage des fiches validées
 * @author Alexandre Leclercq
 * @version 0.1.0 GIT <GSBApplication>
 */

?>

<div id="afficheFicheFrais">
    <div style = "width: 50%">
        <form action="index.php?uc=suiviPaiement&action=corrigerFraisForfait" method="post" role="form">
            <div class="form-group">
            <h3>Fiche de <strong><?php echo $leVisiteur[0]["nom"].' '.$leVisiteur[0]["prenom"] ?></strong></h3>
            <h2>Frais Forfaitisés</h2>
            <?php 
                      foreach($resultForfait as $unFrais){
                            $libelle = $unFrais['libelle'];
                            $idFrais = $unFrais['idfrais'];
                            $quantite = $unFrais['quantite'];
                            ?><p style="font-size: 22px"><strong><?php echo $libelle ?></strong><?php echo ' : '.$quantite.' €' ?></p><?php

                      }  
            ?>
            
            </div>
        
        <div id="friasHorsForfait">
        <h2>Frais Hors Forfait</h2>
        <?php 
            if(empty($resultHorsForfait)){
                echo '<h4 style="color: grey">Pas de frais hors forfait</h4>';
            }else{
                foreach($resultHorsForfait as $unFrais){
                    $libelle = $unFrais['libelle'];
                    $date = $unFrais['date'];
                    $montant = $unFrais['montant'];
                    ?><p style="font-size: 22px"><strong><?php echo $libelle ?></strong><?php echo ' : '.$montant.' €'.'  ( le '.$date.' )' ?></p><?php
              }  
            }
                      
            ?>
        </div>
            <button class="btn btn-success" type="submit">Mise en Paiement</button>
        </form>
    </div>
</div>