<?php

/**
 * 
 */

$uc = filter_input(INPUT_GET, 'uc', FILTER_SANITIZE_STRING);
if ($uc && !$estConnecte) {
    $uc = 'connexion';
} elseif (empty($uc)) {
    $uc = 'accueilComptable';
}

    switch ($uc) {
        case 'connexion':
            include 'controleurs/c_connexion.php';
            break;
        case 'accueilComptable':
            include 'espace_comptable/controleurs/c_accueilComptable.php';
            break;
        case 'validerFrais':
            include 'espace_comptable/controleurs/c_validerFrais.php';
            break;
        case 'suiviPaiement':
            include 'espace_comptable/controleurs/c_suiviPaiement.php';
            break;
        case 'deconnexion':
            include 'controleurs/c_deconnexion.php';
            break;
        }
