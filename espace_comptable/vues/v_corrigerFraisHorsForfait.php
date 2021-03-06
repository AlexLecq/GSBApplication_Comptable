<?php 

/**
 * Vue de la page de validation de frais 
 * @author Alexandre Leclercq
 * @version 1.0.0 GIT <GSBApplication>
 */

?>

<div id="corrigerFraisHorsForfait">
    <?php if(empty($lstFraisHorsForfait)){
                echo '<h4 style="color: grey; font-size: 30px">Pas de frais hors forfait</h4>';
            }else{?>
    <div class="panel panel-info">
        
        <div class="panel-heading">Descriptif des éléments hors forfait</div>
        <form action="index.php?uc=validerFrais&action=corrigerFraisHorsForfait" method="post" role="form">
        <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th class="date">Date</th>
                    <th class="libelle">Libellé</th>  
                    <th class="montant">Montant</th>  
                    <th class="action">Action</th> 
                </tr>
            </thead>  
            <tbody>
            <?php
            
            foreach ($lstFraisHorsForfait as $unFraisHorsForfait) {
                $libelle = htmlspecialchars($unFraisHorsForfait['libelle']);
                $date = $unFraisHorsForfait['date'];
                $montant = $unFraisHorsForfait['montant'];
                $id = $unFraisHorsForfait['id']; ?>           
                <tr>
                    <td> <input class="form-control" type="text" name="dateHorsForfait" id="dateHorsForfait" value="<?php echo $date ?>"> </td>
                    <td> <input class="form-control" type="text" name="libelleHorsForfait" id="libelleHorsForfait<?php echo $libelle ?>" value="<?php echo $libelle ?>"> </td>
                    <td> <input class="form-control" type="text" name="montantHorsForfait" id="montantHorsForfait" value="<?php echo $montant ?>"></td>
                    <td> <button type="submit" name="refuser" value="<?php echo $id ?>">Refuser</button ><button type="submit" name="report" value="<?php echo $id ?>">Report</button></td>
                </tr>
                <?php
            }
            ?>
            </tbody>  
        </table>
        </form>
    </div>
    <?php }?>
</div>