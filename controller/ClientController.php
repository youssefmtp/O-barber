<?php 
/**
 * /controller/ClientController.php
 * 
 * Contrôleur pour les clients
 *
 * @author Y.Ennour
 * @date 06/2023
 */

class ClientController extends Controller {

    /**
     * Action qui contrôle la connexion
     * params : tableau des paramètres
     */
    public static function seconnecter($params){

        $message = '';

        if(isset($_POST['identifiant']) && !empty($_POST['identifiant']) && isset($_POST['lemdp']) && !empty($_POST['lemdp'])){
            $identifiant = self::nettoyer($_POST['identifiant']);
            $mdp = self::nettoyer($_POST['lemdp']);

            $message = ClientManager::testerConnexion($identifiant, $mdp);


        }else {
            $message = 'Veuillez remplir tous les champs';
        }

        // appelle la vue
        $view = ROOT.'/view/connexion.php';
        $params = array();
        $params['message'] = $message;
        self::render($view, $params);
    }

    /**
     * Action qui contrôle la deconnexion
     * params : tableau des paramètres
     */
    public static function deconnexion($params){
        // appelle la vue
        $view = ROOT.'/view/deconnexion.php';
        $params = array();
        self::render($view, $params);
    }

    public static function nettoyer($data){
        // A COMPLETER
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public static function inscription($params){
        $message = '';
        if(isset($_POST['prenom']) && !empty($_POST['prenom']) && isset($_POST['nom']) && !empty($_POST['nom']) 
        && isset($_POST['date-naissance']) && !empty($_POST['date-naissance']) && isset($_POST['genre-select']) 
        && !empty($_POST['genre-select']) && isset($_POST['codepostal']) && !empty($_POST['codepostal']) 
        && isset($_POST['adresse-mail']) && !empty($_POST['adresse-mail']) && isset($_POST['mdp']) && !empty($_POST['mdp']) 
        && isset($_POST['numtel']) && !empty($_POST['numtel']) && isset($_POST['mdp-confirm']) && !empty($_POST['mdp-confirm'])){
            $prenom = self::nettoyer($_POST['prenom']);
            $nom = self::nettoyer($_POST['nom']);
            $datenaissance = new DateTime(self::nettoyer($_POST['date-naissance']));
            $genreselect = self::nettoyer($_POST['genre-select']);
            $codepostal = self::nettoyer($_POST['codepostal']);
            $adressemail = self::nettoyer($_POST['adresse-mail']);
            $mdp = self::nettoyer($_POST['mdp']);
            $numtel = self::nettoyer($_POST['numtel']);
            $mdpconfirm = self::nettoyer($_POST['mdp-confirm']);

            if($mdp === $mdpconfirm){

            // Hash le mot de passe avec Bcrypt, via un coût de 12
            $cost = ['cost' => 10];
            $mdpHash = password_hash($mdp, PASSWORD_BCRYPT, $cost);

            // Met en minuscule l'email
            $adressemail = strtolower($adressemail);

            // Met en majuscule la première lettre du prénom
            if(strpos($prenom, "-") !== false) {
                $prenoms = explode('-', $prenom);
                foreach ($prenoms as &$lePrenom) {
                  $lePrenom = ucfirst($lePrenom);
                }
                $prenom = implode('-', $prenoms);
            } else {
                $prenom = ucfirst($prenom);
            }

            // Met en majuscule le nom de famille
            $nom = strtoupper($nom);

                ClientManager::addClient($prenom, $nom, $datenaissance, $genreselect, $codepostal, $adressemail, $mdpHash, $numtel);
                
            } else {
                $message = 'Les mots de passe ne sont pas identiques';
            }
            
        } else {
            $message = 'Veuillez remplir tous les champs';
        }

        // appelle la vue
        $view = ROOT.'/view/inscription.php';
        $params = array();
        $params['message'] = $message;
        self::render($view, $params);
    }

    public static function edit($params){
        
        $prenom = self::nettoyer($_POST['prenom-utilisateur']);
        // Met en majuscule la première lettre du prénom
        if(strpos($prenom, "-") !== false) {
            $prenoms = explode('-', $prenom);
            foreach ($prenoms as &$lePrenom) {
              $lePrenom = ucfirst($lePrenom);
            }
            $prenom = implode('-', $prenoms);
        } else {
            $prenom = ucfirst($prenom);
        }

        $nom = self::nettoyer($_POST['nom-utilisateur']);
        // Met en majuscule le nom de famille
        $nom = strtoupper($nom);
        
        $mail = self::nettoyer($_POST['mail-utilisateur']);
        $mail = strtolower($mail);

        $numtel = self::nettoyer($_POST['num-utilisateur']);
        $adresse = self::nettoyer($_POST['adresse-utilisateur']);
        $codePostal = self::nettoyer($_POST['cp-utilisateur']); 
        $ville = self::nettoyer($_POST['ville-utilisateur']);
        $mdp = self::nettoyer($_POST['mdp']);
        $mdpconfirm = self::nettoyer($_POST['cfm-mdp']);

        if ($mdp === $mdpconfirm ){
            $leMdp = $mdp;
        }
        ClientManager::editInfo($prenom, $nom, $mail, $numtel, $adresse, $codePostal, $ville, $leMdp);
        
        
    
    // appelle la vue
    $view = ROOT.'/view/profil.php';
    $params = array();
    self::render($view, $params);
    }
}
?>