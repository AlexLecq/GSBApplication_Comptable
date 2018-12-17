<?php

/**
 * Page de validation de frais
 * UC = "validerFrais"
 * 
 * @author Alexandre Leclercq 
 */

 $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
 

$lstVisiteur = $pdo->getListeVisiteur(); 
$mois = getMois(date('d/m/Y'));
$numAnnee = substr($mois, 0, 4);
$numMois = substr($mois, 4, 2);
include 'espace_comptable/vues/v_choixVisiteur.php';
 

 switch($action){
    case 'afficherFrais':
        $idVisiteur = filter_input(INPUT_POST, 'lstVisiteur' , FILTER_SANITIZE_STRING);
        $lstMois = filter_input(INPUT_POST, 'lstMois' , FILTER_SANITIZE_STRING);
        $lstFraisForfait = $pdo->getLesFraisForfait($idVisiteur , $lstMois);
        $lstFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $lstMois);
        include 'espace_comptable/vues/v_corrigerFraisForfait.php';
        include 'espace_comptable/vues/v_corrigerFraisHorsForfait.php';
        break;
    case 'corrigerFrais':
        break;
 }