<?php 

/**
 * /controller/ViewController.php
 * 
 * Contrôleur pour les pages de vue uniquement
 *
 * @author Y.Ennour
 * @date 06/2023
 */

class ViewController extends Controller {

    
    /**
     * Action qui affiche la page d'accueil
     * params : tableau des paramètres
     */
    public static function accueil($params){

        // appelle la vue
        $view = ROOT.'/view/accueil.php';
        $params = array();
        self::render($view, $params);
    }

    /**
     * Action qui affiche la page d'erreur
     * params : tableau des paramètres
     */
    public static function erreur($params){

        // appelle la vue
        $view = ROOT.'/view/erreur.php';
        $params = array();
        self::render($view, $params);
    }

    /**
     * Action qui affiche la page contact
     * params : tableau des paramètres
     */
    public static function contact($params){

        // appelle la vue
        $view = ROOT.'/view/contact.php';
        $params = array();
        self::render($view, $params);
    }

    /**
     * Action qui affiche la page connexion
     * params : tableau des paramètres
     */
    public static function connexion($params){

        // appelle la vue
        $view = ROOT.'/view/connexion.php';
        $params = array();
        self::render($view, $params);
    }

    /**
     * Action qui affiche la page inscription
     * params : tableau des paramètres
     */
    public static function inscription($params){

        // appelle la vue
        $view = ROOT.'/view/inscription.php';
        $params = array();
        self::render($view, $params);
    }

    /**
     * Action qui affiche la page panier
     * params : tableau des paramètres
     */
    public static function panier($params){

        // appelle la vue
        $view = ROOT.'/view/panier.php';
        $params = array();
        self::render($view, $params);
    }


    /**
     * Action qui affiche la page de bienvenue
     * params : tableau des paramètres
     */
    public static function bienvenue($params){
        if(isset($_SESSION['mail'])) {
            // appelle la vue
            $view = ROOT.'/view/bienvenue.php';
            $params = array();
            self::render($view, $params);

        } else {
            header('Location: '.SERVER_URL.'/connexion/');
        }
    }

    /**
     * Action qui affiche la page profil
     * params : tableau des paramètres
     */
    public static function profil($params){
        if(isset($_SESSION['mail'])) {
            // appelle la vue
            $view = ROOT.'/view/profil.php';
            $params = array();
            self::render($view, $params);
        } else {
            header('Location: '.SERVER_URL.'/connexion/');
        }
    }


    /**
     * Action qui affiche la page historique commande
     * params : tableau des paramètres
     */
    public static function mescommande($params){

        if(isset($_SESSION['mail'])) {

            // appelle la vue
            $view = ROOT.'/view/historiquecommande.php';
            $params = array();
            self::render($view, $params);

        } else {
            header('Location: '.SERVER_URL.'/connexion/');
        }
    }

    /**
     * Action qui affiche la page nouveau produit
     * params : tableau des paramètres
     */
    public static function newproduit($params){
        if(isset($_SESSION['mail'])) {
            if($_SESSION['idRole'] == 1){
                $lesSousCategs = SousCategorieManager::getLesSousCategs();

                // appelle la vue
                $view = ROOT.'/view/nouveauproduit.php';
                $params = array();
                $params = [
                    'lesSousCategs' => $lesSousCategs
                ];
                self::render($view, $params);
            } else {
                header('Location: '.SERVER_URL.'/erreur/');
            }
        } else {
            header('Location: '.SERVER_URL.'/connexion/');
        }
    } 

    /**
     * Action qui affiche la page des conditions générales de ventes
     * params : tableau des paramètres
     */
    public static function conditionsdevente($params){

        // appelle la vue
        $view = ROOT.'/view/conditionsgenerale.php';
        $params = array();
        self::render($view, $params);
    }

    /**
     * Action qui affiche la page de livraison et politque de retour
     * params : tableau des paramètres
     */
    public static function livraisonetretour($params){

        // appelle la vue
        $view = ROOT.'/view/livraisonEtRetour.php';
        $params = array();
        self::render($view, $params);
    }

    /**
     * Action qui affiche la page politique de confidentialité
     * params : tableau des paramètres
     */
    public static function politiqueConfidentialite($params){

        // appelle la vue
        $view = ROOT.'/view/politiqueDeConfidentialite.php';
        $params = array();
        self::render($view, $params);
    }

    /**
     * Action qui affiche la page mention légales
     * params : tableau des paramètres
     */
    public static function mentionLegales($params){

        // appelle la vue
        $view = ROOT.'/view/mentionLegal.php';
        $params = array();
        self::render($view, $params);
    }

}