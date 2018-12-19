<?php
/**
 * Controleur : valider une fiche de frais d'un visiteur
 * UC = "validerFrais"
 * 
 * @author Alexandre Leclercq 
 */
 $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

 switch($action){
    case 'choixVisiteur':
        $lstVisiteur = $pdo->getListeVisiteur(); 
        $mois = getMois(date('d/m/Y'));
        $numAnnee = substr($mois, 0, 4);
        $numMois = substr($mois, 4, 2);
        include 'espace_comptable/vues/v_choixVisiteur.php';
        break;
    case 'afficherFrais':
        $lstVisiteur = $pdo->getListeVisiteur(); 
        $mois = getMois(date('d/m/Y'));
        $numAnnee = substr($mois, 0, 4);
        $numMois = substr($mois, 4, 2);
        include 'espace_comptable/vues/v_choixVisiteur.php';
        //J'utilise la session pour les variables qui font être réutiliser par la suite
        $_SESSION['lstVisiteur'] = filter_input(INPUT_POST, 'lstVisiteur' , FILTER_SANITIZE_STRING);
        $_SESSION['lstMois'] = filter_input(INPUT_POST, 'lstMois' , FILTER_SANITIZE_STRING);
        $lstFraisForfait = $pdo->getLesFraisForfait($_SESSION['lstVisiteur'] , $_SESSION['lstMois']);
        $lstFraisHorsForfait = $pdo->getLesFraisHorsForfait($_SESSION['lstVisiteur'], $_SESSION['lstMois']);
        
        include 'espace_comptable/vues/v_corrigerFraisForfait.php';
        include 'espace_comptable/vues/v_corrigerFraisHorsForfait.php';
        include 'espace_comptable/vues/v_validationFicheFrais.php';
        break;
    case 'corrigerFraisForfait':
        
        $lesIdFrais = $pdo->getLesIdFrais();
        foreach($lesIdFrais as $unId){
            $lesFrais[$unId["idfrais"]] = filter_input(INPUT_POST, ''.$unId["idfrais"].'' , FILTER_SANITIZE_STRING);
        }
        try{
            $pdo->majFraisForfait($_SESSION['lstVisiteur'] , $_SESSION['lstMois'] , $lesFrais);
        }catch(Exception $e){
                ajouterErreur("Une erreur est survenue lors de la modication, voici le message d'erreur : ".$e->getMessage().""); 
                include 'vues/v_erreur.php'; 
        }
        header("Location: http://localhost/index.php?uc=validerFrais&action=afficherFrais");
        break;
    case 'validationFicheFrais':

        $pdo->majEtatFicheFrais($_SESSION['lstVisiteur'] , $_SESSION['lstMois'], $etat);
        break;
 }
 ?>