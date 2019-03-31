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
        $leVisiteur = $pdo->getUnVisiteur($idVisiteur);
        $resultForfait = $pdo->getLesFraisForfait($idVisiteur , $moisFiche);
        $resultHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur , $moisFiche);
        include 'espace_comptable/vues/v_choixFicheValide.php';
        include 'espace_comptable/vues/v_afficheFicheFrais.php';
        break;
 }

 ?>