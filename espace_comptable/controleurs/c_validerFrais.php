<?php

/**
 * Page de validation de frais
 * UC = "validerFrais"
 * 
 * @author Alexandre Leclercq 
 */

 $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

 switch($action){
    case 'choixVisiteur':
        $lstVisiteur = $pdo->getListeVisiteur();
        //$pdo->getLesMoisDisponibles($idVisiteur);
        include 'espace_comptable/vues/v_choixVisiteur.php';
        break;
    case 'corrigerFrais':
        include 'espace_comptable/vues/v_corrigerFrais.php';
        break;
 }