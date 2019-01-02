<?php 

/**
 * Vue de la page de validation de frais 
 * @author Alexandre Leclercq
 * @version 1.0.0 GIT <GSBApplication>
 */

?>

<div id="corrigerFraisHorsForfait">
    <div class="panel panel-info">
        <div class="panel-heading">Descriptif des éléments hors forfait</div>
        <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th class="date">Date</th>
                    <th class="libelle">Libellé</th>  
                    <th class="montant">Montant</th>  
                    <th class="action">&nbsp;</th> 
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
                    <td> <input class="form-control" type="text" name="libelleHorsForfait" id="libelleHorsForfait" value="<?php echo $libelle ?>"> </td>
                    <td> <input class="form-control" type="text" name="montantHorsForfait" id="montantHorsForfait" value="<?php echo $montant ?>"></td>
                    <td> <button class="btn btn-success" href="index.php?uc=validerFrais&action=corrigerFrais&idFrais=<?php echo $id ?>">Corriger</button>
                         <button class="btn btn-danger" > Réinitialiser</button></td>
                </tr>
                <?php
            }
            ?>
            </tbody>  
        </table>
    </div>
</div>