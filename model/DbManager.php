<?php

/**
 * /model/DbManager.php
 * 
 * Définition de la class DbManager
 * Class qui implémente toutes les fonctions d'accès à la base de données
 *
 * @author Y.Ennour
 * @date 07/2023
 */

// attributs techniques d'accès à la bdd
// const HOST = 'sql312.infinityfree.com'; // adresse IP de l'hôte 
// const PORT = '3306'; // 3306 ou 3307:MariaDB / 3308: MySQL
// const DBNAME = 'if0_36357325_base_site_ecommerce'; // nom de la bdd
// const CHARSET = 'utf8'; // méthode d'encodage de caractères
// const LOGIN = 'if0_36357325'; // login pour la connexion
// const MDP = 'adminObarber34';  // password pour la connexion

const HOST = '127.0.0.1'; // adresse IP de l'hôte 
const PORT = '3307'; // 3306 ou 3307:MariaDB / 3308: MySQL
const DBNAME = 'base_site_ecommerce'; // nom de la bdd
const CHARSET = 'utf8'; // méthode d'encodage de caractères
const LOGIN = 'root'; // login pour la connexion
const MDP = '';  // password pour la connexion

class DbManager {
     
    private static ?\PDO $cnx = null;
    
    /**
     * getConnexion
     * établit la connexion à la base de données
     *
     * @return void
     */
    public static function getConnexion(){
        if(self::$cnx == null){
            try {
                $dsn = 'mysql:host='. HOST.';port='.PORT.';dbname='.DBNAME.';charset='.CHARSET;
                self::$cnx = new PDO($dsn, LOGIN, MDP);
                self::$cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die('Erreur : '.$e->getMessage());            
            }
        }
        return self::$cnx;
    }
    
}