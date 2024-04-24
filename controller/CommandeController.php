<?php 
/**
 * /controller/CommandeController.php
 * 
 * Contrôleur pour les commandes
 *
 * @author Y.Ennour
 * @date 12/2023
 */

class CommandeController extends Controller {

    public static function nettoyer($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    /**
     * Action qui affiche la page Commande
     * params : tableau des paramètres
     */
    public static function show($params){

        if(isset($_SESSION['id'])) {

            // Filtre les variables GET pour enlever les caractères indésirables
            $idClient = self::nettoyer($_SESSION['id']);

            $lesCmds = CommandeManager::getInfoCmdByClient($idClient);

            
         
        } 
        

        // appelle la vue
        $view = ROOT.'/view/historiquecommande.php';

        $params = array();
        $params = [
            'lesCmds' => $lesCmds
        ];
        
        self::render($view, $params);
    }

}