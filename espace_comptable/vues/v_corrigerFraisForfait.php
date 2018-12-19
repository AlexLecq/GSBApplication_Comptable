<?php 

/**
 * Vue de la page de validation de frais 
 * @author Alexandre Leclercq
 * @version 1.0.0 GIT <GSBApplication>
 */

?>

<div id="corrigerFraisForfait">
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
        </form>
    </div>
    
</div>