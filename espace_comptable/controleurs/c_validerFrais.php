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
    
    /**
     * Permet d'afficher la fiche de frais du visiteur concerné
     * Forfait et Hors Forfait 
     */
    case 'afficherFrais':
        $lstVisiteur = $pdo->getListeVisiteur(); 
        $tabDate = $pdo->getLesMoisDisponibles($_SESSION['unVisiteur']);
        include 'espace_comptable/vues/v_choixVisiteur.php';
        $leVisiteur = $pdo->getUnVisiteur($_SESSION['unVisiteur']);
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
            redirectTo('validerFrais' , 'afficherFrais', 2000);
            ajouterMessage("Vos modifications ont été prises en compte");
            include 'espace_comptable/vues/v_message.php';
        }catch(Exception $e){
                ajouterErreur("Une erreur est survenue lors de la modication, voici le message d'erreur : ".$e->getMessage().""); 
                include 'vues/v_erreur.php'; 
        }
        break;


        /**
         * Permet la correction des frais hors forfait
         */
    case 'corrigerFraisHorsForfait':
        if(isset($_POST['refuser']))
        {
            $pdo->majLibelleFraisHorsForfait($_POST['refuser']);
            redirectTo("validerFrais" , "afficherFrais", 2000);
            ajouterMessage("Ce frais hors forfait a été refusé ");
            include 'espace_comptable/vues/v_message.php';
        }
        elseif(isset($_POST['report']))
        {
                        /**
             * Si la fiche de frais du mois suivant est absente
             * Alors , on créer la fiche de frais du mois suivant et on associe la ligne de frais hors forfait
             * Sinon on Update la ligne de frais hors forfait en l'associant à la fiche du mois suivant
             * 
             */
            $moisSuivant = dateSuivante($_SESSION['unMois']);
            $idVisiteur = $_SESSION['unVisiteur'];

            $resultFraisHors = $pdo->getLesFraisHorsForfait($idVisiteur , $_SESSION['unMois']);
            $libelle = ''; 
            $date = '';
            $montant = '';

            foreach($resultFraisHors as $key => $unFrais)
            {
                if($unFrais['id'] == $_POST['report'])
                {
                    $libelle = $unFrais['libelle'];
                    $date = $unFrais['date'];
                    $montant = $unFrais['montant'];
                    break;
                }
            }

            if(empty($pdo->getLesInfosFicheFrais($idVisiteur , $moisSuivant)))
            {
                $pdo->creeNouvellesLignesFrais($idVisiteur, $moisSuivant);
                $pdo->creeNouveauFraisHorsForfait($idVisiteur,$moisSuivant,$libelle,$date,$montant);
                redirectTo('validerFrais' , 'afficherFrais' , 3000);
                ajouterMessage("Une nouvelle fiche de frais vient de se créer pour le mois suivant. \n Vous pourrez y retrouver le frais hors forfait.");
                include 'espace_comptable/vues/v_message.php';
            }
            else
            {    
                $pdo->creeNouveauFraisHorsForfait($idVisiteur,$moisSuivant,$libelle,$date,$montant); 
                redirectTo('validerFrais' , 'afficherFrais' , 3000);
                ajouterMessage("Votre demande de report s'est déroulé avec succès  \n Vous pourrez y retrouver le frais hors forfait.");
                include 'espace_comptable/vues/v_message.php';
            }
            $pdo->supprimerFraisHorsForfait($_POST['report']);
        }
        break;
    /**
     * Action permettant la validation de la fiche après vérification
     */
    case 'validationFicheFrais':
        try{
            $pdo->majEtatFicheFrais($_SESSION['unVisiteur'] , $_SESSION['unMois'], 'VA');
            redirectTo('validerFrais','afficherFrais', 2000);
            ajouterMessage("La fiche a été correctement validé ! ");
            include 'espace_comptable/vues/v_message.php';
        }catch(Exception $e){
            ajouterErreur($e->getMessage());
            include 'vues/v_erreurs.php';
        }
        break;
 }
 ?>