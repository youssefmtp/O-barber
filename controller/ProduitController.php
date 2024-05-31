<?php 
/**
 * /controller/ProduitController.php
 * 
 * Contrôleur pour les produits
 *
 * @author Y.Ennour
 * @date 06/2023
 */

class ProduitController extends Controller {


    /**
     * Action qui affiche la page produit
     * params : tableau des paramètres
     */
    public static function show($params){

        // $categorieHuile = CategorieManager::getLesHuiles();
        // $categorieRassoire = CategorieManager::getLesRassoires();
        // $categorieAccessoire = CategorieManager::getLesAccessoires();

        
        $lesProduitsHuiles = SousCategorieManager::getLesProduitsHuiles();
        $lesProduitsRassoires = SousCategorieManager::getLesProduitsRassoires();
        $lesProduitsAccessoires = SousCategorieManager::getLesProduitsAccessoires();


        // appelle la vue
        $view = ROOT.'/view/produits.php';

        $params = array();
        $params = [
            'lesProduitsHuiles' => $lesProduitsHuiles,
            'lesProduitsRassoires' => $lesProduitsRassoires,
            'lesProduitsAccessoires' => $lesProduitsAccessoires

        ];
        
        self::render($view, $params);
    }

    public static function nettoyer($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    /**
     * Action qui affiche la page d'un produit en fonction de l'id
     * params : tableau des paramètres
     */
    public static function showUnProd($params){
        if(isset($_GET['id'])) {

            // Filtre les variables GET pour enlever les caractères indésirables
            $idProduit = self::nettoyer(filter_var($_GET['id'], FILTER_VALIDATE_INT));

            $unProduit = ProduitManager::getProduitById($idProduit);
         
        }       

        $view = ROOT.'/view/unproduit.php';
        // appelle la vue
        $params = array();
        $params = [
            'unProduit' => $unProduit
        ];
        self::render($view, $params);
    }

    /**
     * Action qui ajoute un produit au panier
     * params : tableau des paramètres
     */
    public static function add($params){
        $produit  = null;
        
        
        if (isset($_GET['id']) && !empty($_GET['id'])){
            // Filtre les variables GET pour enlever les caractères indésirables
            $idProduit = self::nettoyer($_GET['id']);
            $unProduit = ProduitManager::getProduitById($idProduit);
        
        

            if (isset($_GET['qte']) && !empty($_GET['qte'])){
                $qte = self::nettoyer($_GET['qte']);
            }

            $produitExiste = false;

        // Parcourir les produits du panier
        foreach ($_SESSION['panier'] as &$item) {
            if ($item['id'] == $unProduit->getId()) {
                // Si le produit existe déjà, accumuler les quantités
                $item['quantite'] += $qte;
                $produitExiste = true;
                break;
            }
        }

        // Si le produit n'existe pas, l'ajouter au panier
        if (!$produitExiste) {
            $produit = array(
                'id' => $unProduit->getId(),
                'photo' => $unProduit->getPhotoProd(),
                'prix' => $unProduit->getPrix(),
                'marque' => $unProduit->getMarque(),
                'libelle' => $unProduit->getLibelle(),
                'quantite' => $qte,
                'qteEnStock' => $unProduit->getQteEnStock()
            );

            $_SESSION['panier'][] = $produit;
        }
            

            // Header indiquant que la réponse est au format JSON
            header('Content-Type: application/json');
            echo json_encode($unProduit);

        }    
    }

    /**
     * Action qui supprime un produit au panier
     * params : tableau des paramètres
     */
    public static function delete($params){
        // Vérifier si l'index de l'article à supprimer est passé dans l'URL
        if (isset($_GET['index'])) {
        $index = self::nettoyer($_GET['index']);

        // Vérifier si le panier existe et si l'index est valide
        if (isset($_SESSION['panier']) && array_key_exists($index, $_SESSION['panier'])) {
        // Supprimer l'article du panier en utilisant l'index
        unset($_SESSION['panier'][$index]);

        // Réorganiser les clés du tableau pour éviter les trous
        $_SESSION['panier'] = array_values($_SESSION['panier']);

        if(count($_SESSION['panier']) == 0){
            unset($_SESSION['panier']);
        }


        }

        // Header indiquant que la réponse est au format JSON
        header('Content-Type: application/json');
        }
    
        
    }

    /**
     * Action qui affiche la page produit
     * params : tableau des paramètres
     */
    public static function showByFiltre($params){

        // si le formulaire est envoyer
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET['filtre']) && !empty($_GET['filtre'])) {
                $filtre = self::nettoyer($_GET['filtre']);

                $isIdCateg = strpos($_SERVER['REQUEST_URI'], 'idCateg') !== false;
                $isId = strpos($_SERVER['REQUEST_URI'], 'id') !== false;


                // Header indiquant que la réponse est au format JSON
                header('Content-Type: application/json');

                if ($isIdCateg) {
                    // Faire quelque chose si l'URL contient "idCateg"
                    echo ProduitManager::getProduitByCategorie($filtre);
                } elseif($isId) {
                    // Faire quelque chose si l'URL contient "id"
                    echo ProduitManager::getLesProduitsByIdFiltre($filtre);
                } else {
                    echo ProduitManager::getLesProduits();
                }

            } 
        }
        
    }




    /**
     * Action qui affiche la page produit
     * params : tableau des paramètres
     */
    public static function showRecherche($params){

        // si le formulaire est envoyer
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET['valeurRecherche']) && !empty($_GET['valeurRecherche'])) {
                $valeurRecherche = self::nettoyer($_GET['valeurRecherche']);
                

                // Header indiquant que la réponse est au format JSON
                header('Content-Type: application/json');
                
                echo ProduitManager::getRecherche($valeurRecherche);
            } 
        }
        
    }


    /**
     * Action qui affiche la page produit
     * params : tableau des paramètres
     */
    public static function showProduitRecherche($params){

        // si le formulaire est envoyer
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET['valeurRecherche']) && !empty($_GET['valeurRecherche'])) {
                $valeurRecherche = self::nettoyer($_GET['valeurRecherche']);
                

                // Header indiquant que la réponse est au format JSON
                header('Content-Type: application/json');
                
                echo ProduitManager::getProduitRecherche($valeurRecherche);
            } 
        }
        
    }

    public static function actualisePanier($params){
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $index = self::nettoyer($_GET['index']);
            $nouvelleQuantite = self::nettoyer($_GET['qte']);
        
            // Mettez à jour la quantité dans la session ou dans votre base de données, selon votre application
            $_SESSION['panier'][$index]['quantite'] = $nouvelleQuantite;
        

            header('Content-Type: application/json');

            
            echo json_encode(['success' => true]);
        }
    }


    /**
     * Action qui supprime le panier
     * params : tableau des paramètres
     */
    public static function deletePanier($params){
        unset($_SESSION['panier']);

    }

    /**
     * Action qui affiche la page de mofication du produit
     * params : tableau des paramètres
     */
    public static function edit($params){
        if($_SESSION['idRole'] == 1) {

            if(isset($_GET['id'])) {

                // Filtre les variables GET pour enlever les caractères indésirables
                $idProduit = self::nettoyer(filter_var($_GET['id'], FILTER_VALIDATE_INT));
    
                $unProduit = ProduitManager::getProduitById($idProduit); 
                $lesSousCategs = SousCategorieManager::getLesSousCategs();

                // appelle la vue
                $view = ROOT.'/view/editproduit.php';
                $params = [
                    'unProduit' => $unProduit,
                    'lesSousCategs' => $lesSousCategs
                ];
                self::render($view, $params);
            } else{
                header('Location: '.SERVER_URL.'/erreur/');
            }

        } else {
            header('Location: '.SERVER_URL.'/erreur/');
        }

    }

    /**
     * Action qui ajoute un nouveau produit
     * params : tableau des paramètres
     */
    public static function addProd($params){
        $erreur = '';
        $message = '';

        $lesSousCategs = SousCategorieManager::getLesSousCategs();

        if(isset($_POST['marque']) && !empty($_POST['marque']) && isset($_POST['refProd']) && !empty($_POST['refProd'])
            && isset($_POST['libelle']) && !empty($_POST['libelle']) && isset($_POST['prix']) && !empty($_POST['prix'])
            && isset($_POST['resume']) && !empty($_POST['resume']) && isset($_POST['description']) && !empty($_POST['description'])
            && isset($_POST['qteStock']) && !empty($_POST['qteStock']) && isset($_POST['seuilAlerte']) && !empty($_POST['seuilAlerte'])
            && isset($_POST['categorie']) && !empty($_POST['categorie'])){

            if($_FILES['photoProd']['error'] == 0){
                $marque = self::nettoyer($_POST['marque']);
                $libelle = self::nettoyer($_POST['libelle']);
                $refProd = self::nettoyer($_POST['refProd']);
                $resume = self::nettoyer($_POST['resume']);
                $description = self::nettoyer($_POST['description']);
                $prix = self::nettoyer($_POST['prix']);
                $qteStock = self::nettoyer($_POST['qteStock']);
                $seuilAlerte = self::nettoyer($_POST['seuilAlerte']);
                $categorie = self::nettoyer($_POST['categorie']);
                $photoProd = '../img/' . self::nettoyer($_FILES['photoProd']['name']);

                move_uploaded_file($_FILES['photoProd']['tmp_name'], './img/'.$_FILES['photoProd']['name']);

                ProduitManager::addProduit($refProd, $marque, $libelle, $resume, $description, $photoProd, $qteStock, $prix, $seuilAlerte, $categorie);

                $message = 'Le produit a bien été enregistré.';

            } else {
                $erreur = 'Erreur : Lors du chargement du fichier.';
            }
        } else {
            $erreur = 'Erreur : Veuillez remplir tous les champs.';

        }


        $view = ROOT.'/view/nouveauproduit.php';
        // appelle la vue
        $params = array();
        $params = [
            'erreur' => $erreur,
            'message' => $message,
            'lesSousCategs' => $lesSousCategs
        ];
        self::render($view, $params);

    }


    /**
     * Action qui supprime un produit de la bdd
     * params : tableau des paramètres
     */
    public static function deleteProd($params){

        $message = '';

        // Vérifier si l'id de l'article à supprimer est passé dans l'URL
        if (isset($_GET['idP'])) {
            $id = self::nettoyer($_GET['idP']);
            ProduitManager::deleteProduit($id);
        }
    
        
    } 

    /**
     * Action qui supprime un produit de la bdd
     * params : tableau des paramètres
     */
    public static function updateProd($params){

        

        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id = self::nettoyer($_POST['idProd']);
            $produit = ProduitManager::getProduitById($id);

            if($produit){
                $marque = self::nettoyer($_POST['marque']);
                $refProd = self::nettoyer($_POST['refProd']);
                $libelle = self::nettoyer($_POST['libelle']);
                $resume = self::nettoyer($_POST['resume']);
                $description = self::nettoyer($_POST['description']);
                $qteStock = self::nettoyer($_POST['qteStock']);
                $seuilAlerte = self::nettoyer($_POST['seuilAlerte']);
                $sousCategorie = self::nettoyer($_POST['categorie']);
    
                $prixProd = self::nettoyer($_POST['prix']);
                // récupere le prix sans "€"
                $prix = str_replace('€', '', $prixProd);
    
    
                if(isset($marque) && !empty($marque) && $produit->getMarque() != $marque){
                    ProduitManager::updateMarqueById($id, $marque);
                }
    
                if(isset($refProd) && !empty($refProd) && $produit->getRefProd() != $refProd){
                    ProduitManager::updateRefProdById($id, $refProd);
                }
    
                if(isset($libelle) && !empty($libelle) && $produit->getLibelle() != $libelle){
                    ProduitManager::updateLibelleById($id, $libelle);
                }
    
                if(isset($prix) && !empty($prix) && $produit->getPrix() != $prix){
                    ProduitManager::updatePrixById($id, $prix);
                }
    
                if(isset($resume) && !empty($resume) && $produit->getResume() != $resume){
                    ProduitManager::updateResumeById($id, $resume);
                }
    
                if(isset($description) && !empty($description) && $produit->getDescription() != $description){
                    ProduitManager::updateDescriptionById($id, $description);
                }
    
                if(isset($qteStock) && !empty($qteStock) && $produit->getQteEnStock() != $qteStock){
                    ProduitManager::updateQteStockById($id, $qteStock);
                }
    
                if(isset($seuilAlerte) && !empty($seuilAlerte) && $produit->getSeuilAlerte() != $seuilAlerte){
                    ProduitManager::updateSeuilAlerteById($id, $seuilAlerte);
                }
    
                if(isset($sousCategorie) && !empty($sousCategorie) && $produit->getIdSousCateg() != $sousCategorie){
                    ProduitManager::updateSousCategById($id, $sousCategorie);
                }
    
                if($_FILES['photoProd']['error'] == 0){
                    
                    
                    $photoProd = '../img/'. $_FILES['photoProd']['name'];
    

                    // $ancienneImage = $produit->getPhotoProd();
    
                    // // Vérifie si l'ancienne image existe 
                    // if (file_exists($ancienneImage)) {
                    //     // supprime l'ancienne image
                    //     unlink($ancienneImage);
                    // }
    

                    move_uploaded_file($_FILES['photoProd']['tmp_name'], './img/'.$_FILES['photoProd']['name']);

                    ProduitManager::updateImgById($id, $photoProd);
                }

                


                header('Location: '.SERVER_URL.'/produits/modifier/' . $id .'/?maj=1');

            } else {
                $message = 'Le produit n\'existe pas';
            }

            
        
        }
    
        
    }

}

?>