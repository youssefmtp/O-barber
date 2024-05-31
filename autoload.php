<?php

/**
* /autoload.php
* Charge les class
* 
*
* @author Y.Ennour
* @date 06/2023
*/

    require_once ROOT.'/model/dbManager.php';
    require_once ROOT.'/model/produit.php';
    require_once ROOT.'/model/produitManager.php';
    require_once ROOT.'/model/utilisateur.php';
    require_once ROOT.'/model/utilisateurManager.php';
    require_once ROOT.'/model/categorie.php';  
    require_once ROOT.'/model/categorieManager.php';
    require_once ROOT.'/model/sousCategorie.php'; 
    require_once ROOT.'/model/sousCategorieManager.php';
    require_once ROOT.'/model/commande.php'; 
    require_once ROOT.'/model/commandeManager.php';  
    require_once ROOT.'/model/statut.php'; 
    require_once ROOT.'/model/changementStatut.php';  

    require_once ROOT.'/controller/controller.php';

    

    

?>