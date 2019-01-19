<?php
/**
 * Controleur : valider une fiche de frais d'un visiteur
 * UC = "validerFrais"
 * 
 * @author Alexandre Leclercq 
 */
 $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

 
 switch($action){
     /**
      * Cette option permet le choix du visiteur avec la date du jour
      */
    case 'choixVisiteur':
        $lstVisiteur = $pdo->getListeVisiteur(); 
        $_SESSION['unVisiteur'] = filter_input(INPUT_POST, 'unVisiteur' , FILTER_SANITIZE_STRING);
        $tabDate = $pdo->getLesMoisDisponibles($_SESSION['unVisiteur']);
        include 'espace_comptable/vues/v_choixVisiteur.php';
        break;

    case 'choixDate':
        $lstVisiteur = $pdo->getListeVisiteur(); 
        
        include 'espace_comptable/vues/v_choixVisiteur.php';
        break;
    
    /**
     * Permet d'afficher la fiche de frais du visiteur concerné
     * Forfait et Hors Forfait 
     */
    case 'afficherFrais':
        $lstVisiteur = $pdo->getListeVisiteur(); 
        $tabDate = $pdo->getLesMoisDisponibles($_SESSION['unVisiteur']);
        include 'espace_comptable/vues/v_choixVisiteur.php';
        //J'utilise la session pour les variables qui vont être réutiliser par la suite
        $_SESSION['unMois'] = filter_input(INPUT_POST, 'unMois' , FILTER_SANITIZE_STRING);
        $lstFraisForfait = $pdo->getLesFraisForfait($_SESSION['unVisiteur'] , $_SESSION['unMois']);
        $lstFraisHorsForfait = $pdo->getLesFraisHorsForfait($_SESSION['unVisiteur'], $_SESSION['unMois']);
        
        include 'espace_comptable/vues/v_corrigerFraisForfait.php';
        include 'espace_comptable/vues/v_corrigerFraisHorsForfait.php';
        include 'espace_comptable/vues/v_validationFicheFrais.php';
        break;
    /**
     * Action permettant la correction d'élément de la fiche de frais
     */
    case 'corrigerFraisForfait':
        $lesIdFrais = $pdo->getLesIdFrais();
        foreach($lesIdFrais as $unId){
            $lesFrais[$unId["idfrais"]] = filter_input(INPUT_POST, ''.$unId["idfrais"].'' , FILTER_SANITIZE_STRING);
        }
        try{
            $pdo->majFraisForfait($_SESSION['unVisiteur'] , $_SESSION['unMois'] , $lesFrais);
        }catch(Exception $e){
                ajouterErreur("Une erreur est survenue lors de la modication, voici le message d'erreur : ".$e->getMessage().""); 
                include 'vues/v_erreur.php'; 
        }
        break;
    /**
     * Action permettant la validation de la fiche après vérification
     */
    case 'validationFicheFrais':
        $etat = 'VA';
        try{
            $pdo->majEtatFicheFrais($_SESSION['unVisiteur'] , $_SESSION['unMois'], $etat);
        }catch(Exception $e){
            ajouterErreur($e->getMessage());
            include 'vues/v_erreurs.php';
        }
        

        break;
 }
 ?>