<?php 
/**
 * /controller/UtilisateurController.php
 * 
 * Contrôleur pour les Utilisateurs
 *
 * @author Y.Ennour
 * @date 06/2023
*/


// Inclure les fichiers PHPMailer
require_once ROOT.'/PHPMailer/src/Exception.php';
require_once ROOT.'/PHPMailer/src/PHPMailer.php';
require_once ROOT.'/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


 

class UtilisateurController extends Controller {

    /**
     * Action qui contrôle la connexion
     * params : tableau des paramètres
     */
    public static function seconnecter($params){

        $message = '';

        if(isset($_POST['identifiant']) && !empty($_POST['identifiant']) && isset($_POST['lemdp']) && !empty($_POST['lemdp'])){
            $identifiant = self::nettoyer($_POST['identifiant']);
            $mdp = self::nettoyer($_POST['lemdp']);

            $message = UtilisateurManager::testerConnexion($identifiant, $mdp);


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

                UtilisateurManager::addUtilisateur($prenom, $nom, $datenaissance, $genreselect, $codepostal, $adressemail, $mdpHash, $numtel);
                
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

        if(isset($_SESSION['id'])) {


            $message = '';
        
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


            if(empty($mdp) && empty($mdpconfirm)){
                UtilisateurManager::editInfo($prenom, $nom, $mail, $numtel, $adresse, $codePostal, $ville, $leMdp);

            } 

            if ($mdp === $mdpconfirm ){
                $leMdp = $mdp;

                UtilisateurManager::editInfo($prenom, $nom, $mail, $numtel, $adresse, $codePostal, $ville, $leMdp);

            }else {
                $message = 'Les mots de passe ne sont pas identiques';
            }


            
            
        
            // appelle la vue
            $view = ROOT.'/view/profil.php';
            $params = array();
            $params = [
                'message' => $message
            ];

            self::render($view, $params);

        } else {
            header('Location: '.SERVER_URL.'/connexion/');
        }
    }


    public static function showClient($params){
        
        $lesClients = UtilisateurManager::getLesClients();

        // appelle la vue
        $view = ROOT.'/view/clients.php';

        $params = array();
        $params = [
            'lesClients' => $lesClients
        ];
        
        self::render($view, $params);
    } 

    public static function deleteUser($params){

        $message = '';

        if (isset($_GET['id'])) {
            $id = self::nettoyer($_GET['id']);
            UtilisateurManager::deleteUtilisateur($id);
        }
    
        
    } 

    public static function resetPasswordUser($params){

        $message = '';

        if (isset($_GET['id'])) {

            $idClient = self::nettoyer($_GET['id']);

            $client = UtilisateurManager::getClientById($idClient);

            $lesClients = UtilisateurManager::getLesClients();

            // Créer une instance de PHPMailer
            $mail = new PHPMailer();

            // Configurer les paramètres SMTP
            $mail->isSMTP();
            $mail->Host = 'pro3.mail.ovh.net';
            $mail->Port = 587;

            $mail->SMTPAuth = 1;                        

            if($mail->SMTPAuth){
            $mail->SMTPSecure = 'tls';               
            $mail->Username   =  'support@obarber.ovh';   
            $mail->Password   =  'BTSsio2024%';        
            }
            $mail->CharSet = 'UTF-8';


            $mail->setFrom('support@obarber.ovh', 'O\'barber'); // expéditeur
            $mail->addAddress($client->getMail(), $client->getPrenom()); // destinataire

            $mail->isHTML(true);
            $mail->Subject = 'Réinitialisez votre mot de passe pour O\'barber.';

            $message = '<html>
            <head>
            </head>
            <body>
            <p style="color: black;">Bonjour,</p>
        

            <p style="color: black;">Cliquez sur ce lien pour réinitialiser votre mot de passe Planity pour le compte ' . $client->getMail() .'</p>
            
            
            <a href="https://obarber.wuaze.com/clients/changePassword/' . $client->getId() . '/" style="color: black;">Réinitialiser mon mot de passe </a>


            <p style="color: black;"style="color: black;">Cordialement,<br>
            L\'équipe O\'barber</p>
        
        
            <p style="color: #585859; font-size: 15px;">Ceci est un email automatique, merci de ne pas répondre.</p>
            </body>
            </html>';

            $mail->Body = $message;

            // Envoyer le message
            $mail->send();
                
            

            $messageConf = "Un mail de demande de réinitialisation du mot de passe a été envoyé.";


            // appelle la vue
            $view = ROOT.'/view/clients.php';

            $params = array();
            $params = [
                'messageConf' => $messageConf,
                'lesClients' => $lesClients
            ];
            
            self::render($view, $params);
   
        }
        
    }

    

    public static function changePasswordUser($params){
        $message = '';

        if (isset($_GET['id'])) {

            // appelle la vue
            $view = ROOT.'/view/resetmdp.php';

            $params = array();
            $params = [
                'message' => $message
            ];

            self::render($view, $params);   
        }
    }

    /**
     * Action qui contrôle la connexion
     * params : tableau des paramètres
     */
    public static function newpassword($params){

        $message = '';

        if(isset($_POST['id']) && !empty($_POST['id'])){
            $id = self::nettoyer($_POST['id']);
        } else {
            $id = self::nettoyer($_SESSION['idNewPassword']);
        }

        

        if(isset($id) && !empty($id) && isset($_POST['mdp']) && !empty($_POST['mdp']) && isset($_POST['mdpConfirmer']) && !empty($_POST['mdpConfirmer'])){

            $_SESSION['idNewPassword'] = $id; 
            $mdp = self::nettoyer($_POST['mdp']);
            $mdpConfirmer = self::nettoyer($_POST['mdpConfirmer']);
            
            if($mdp === $mdpConfirmer){
                $message = UtilisateurManager::editPassword($id, $mdp);
                unset($_SESSION['idNewPassword']);
            } else {
                $message = "Les mots de passe ne sont pas identiques.";
            }

        }else {
            $message = 'Veuillez remplir tous les champs';
        }

        // appelle la vue
        $view = ROOT.'/view/resetmdp.php';
        $params = array();
        $params['message'] = $message;
        self::render($view, $params);
    }

    
}
?>