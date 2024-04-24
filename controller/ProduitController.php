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
            var_dump($idProduit);
            $unProduit = ProduitManager::getProduitById($idProduit);
        
        

            if (isset($_GET['qte']) && !empty($_GET['qte'])){
                $qte = self::nettoyer($_GET['qte']);
            }


            // $produit = array(
            //     'id' =>$unProduit->getId(),
            //     'photo' =>$unProduit->getPhotoProd(),
            //     'prix' =>$unProduit->getPrix(),
            //     'marque' =>$unProduit->getMarque(),
            //     'libelle' => $unProduit->getLibelle(),
            //     'quantite' => $qte,
            //     'qteEnStock' => $unProduit->getQteEnStock()
            // ); 

            // $_SESSION['panier'][] = $produit;

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
        $index = $_GET['index'];

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
            $index = $_GET['index'];
            $nouvelleQuantite = $_GET['qte'];
        
            // Mettez à jour la quantité dans la session ou dans votre base de données, selon votre application
            $_SESSION['panier'][$index]['quantite'] = $nouvelleQuantite;
        

            header('Content-Type: application/json');

            
            echo json_encode(['success' => true]);
        }
    }



}

?>