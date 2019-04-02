<?php 

/**
 * Vue de la page de validation de frais 
 * @author Alexandre Leclercq
 * @version 1.0.0 GIT <GSBApplication>
 */

?>

<div id="corrigerFraisForfait">
    <h3>Fiche de <strong><?php echo $leVisiteur[0]["nom"].' '.$leVisiteur[0]["prenom"] ?></strong></h3>

    <?php if(empty($lstFraisForfait)){
                echo '<h4 style="color: grey; font-size: 30px">Pas de frais forfait</h4>';
            }else{?>
    <h2>Valider la fiche de frais</h2>
    <div style = "width: 50%">
        <form action="index.php?uc=validerFrais&action=corrigerFraisForfait" method="post" role="form">
            <div class="form-group">
            <?php 
                foreach($lstFraisForfait as $unFrais){
                    $libelle = $unFrais['libelle'];
                    $idFrais = $unFrais['idfrais'];
                    $quantite = $unFrais['quantite'];
                    ?><label for=""><?php echo $libelle ?></label>
                    <input class="form-control" type="text" name="<?php echo $idFrais ?>" id="idFrais" 
                           size="10" maxlength="5" value="<?php echo $quantite;?>"><?php
            }
                      
            ?>
            
            </div>
            <button class="btn btn-success" type="submit">Corriger</button>
            <button class="btn btn-danger" > Réinitialiser</button>
        </form>
        
    </div>
    <?php }?>
</div>