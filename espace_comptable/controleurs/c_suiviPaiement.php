<?php
/**
 * Controleur : valider une fiche de frais d'un visiteur
 * UC = "suiviPaiement"
 * 
 * @author Alexandre Leclercq 
 */
 $action = filter_input(INPUT_GET , 'action' , FILTER_SANITIZE_STRING);

 switch($action){

    /**
     * Permet de choisir une fiche de frais parmis celle à valider
     */
     case 'choixFicheValide':
        $_SESSION["listFiches"] = $pdo->getFicheValide();
        include 'espace_comptable/vues/v_choixFicheValide.php';
        break;

    /**
     * Permet d'afficher le détail de la fiche de frais 
     */
    case 'afficheFraisValide':
        $ficheValide = filter_input(INPUT_POST , 'uneFicheValide' , FILTER_SANITIZE_STRING);
        @list($idVisiteur, $moisFiche) = explode('-', $ficheValide);
        $_SESSION['idVisiteur'] = $idVisiteur;
        $_SESSION['moisFiche'] = $moisFiche;
        $leVisiteur = $pdo->getUnVisiteur($idVisiteur);
        $infoFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $moisFiche);
        $resultForfait = $pdo->getLesFraisForfait($idVisiteur , $moisFiche);
        $resultHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur , $moisFiche);
        include 'espace_comptable/vues/v_choixFicheValide.php';
        include 'espace_comptable/vues/v_afficheFicheFrais.php';
        break;

        /**
         * Action permettant soit la mise en paiement de la fiche, soit le remboursement de la fiche 
         */
    case 'miseEnPaiement':
        if(isset($_POST["misePaiement"]))
        {
            $pdo->majEtatFicheFrais($_SESSION['idVisiteur'], $_SESSION['moisFiche'], 'MP');
            redirectTo('suiviPaiement', 'choixFicheValide' , 2000);
            ajouterMessage("La fiche de frais à bien été mise en 'Paiement'");
            include 'espace_comptable/vues/v_message.php';
        }
        elseif(isset($_POST["remboursement"]))
        {
            $pdo->majEtatFicheFrais($_SESSION['idVisiteur'], $_SESSION['moisFiche'], 'RB');
            redirectTo('suiviPaiement', 'choixFicheValide' , 2000);
            ajouterMessage("La fiche de frais à bien été mise en 'Remboursement'");
            include 'espace_comptable/vues/v_message.php';
        }
        break;
 }

 ?>