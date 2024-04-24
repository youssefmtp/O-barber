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

        // appelle la vue
        $view = ROOT.'/view/bienvenue.php';
        $params = array();
        self::render($view, $params);
    }

    /**
     * Action qui affiche la page profil
     * params : tableau des paramètres
     */
    public static function profil($params){

        // appelle la vue
        $view = ROOT.'/view/profil.php';
        $params = array();
        self::render($view, $params);
    }

    /**
     * Action qui affiche la page commande
     * params : tableau des paramètres
     */
    public static function commande($params){

        // appelle la vue
        $view = ROOT.'/view/commande.php';
        $params = array();
        self::render($view, $params);
    }


    /**
     * Action qui affiche la page historique commande
     * params : tableau des paramètres
     */
    public static function mescommande($params){

        // appelle la vue
        $view = ROOT.'/view/historiquecommande.php';
        $params = array();
        self::render($view, $params);
    }


}