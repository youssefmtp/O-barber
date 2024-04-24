<?php

/**
* /autoload.php
* Charge les class
* 
*
* @author Y.Ennour
* @date 06/2023
*/

    require_once ROOT.'/model/DbManager.php';
    require_once ROOT.'/model/Produit.php';
    require_once ROOT.'/model/ProduitManager.php';
    require_once ROOT.'/model/Utilisateur.php';
    require_once ROOT.'/model/UtilisateurManager.php';
    require_once ROOT.'/model/Categorie.php';  
    require_once ROOT.'/model/CategorieManager.php';
    require_once ROOT.'/model/SousCategorie.php'; 
    require_once ROOT.'/model/SousCategorieManager.php';
    require_once ROOT.'/model/Commande.php'; 
    require_once ROOT.'/model/CommandeManager.php';  
    require_once ROOT.'/model/Statut.php'; 
    require_once ROOT.'/model/StatutManager.php';  
    require_once ROOT.'/model/ChangementStatut.php';  

    require_once ROOT.'/controller/Controller.php';

    

?>