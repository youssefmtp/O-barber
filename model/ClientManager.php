<?php
/**
 * /model/ClientManager.php
 * 
 * Définition de la class ClientManager
 * Class qui gère les interactions entre les clients de l'application
 * et ceux de la bdd
 *
 * @author Y.Ennour
 * @date 07/2023
 */

    class ClientManager {
    
    private static ?\PDO $cnx = null;
    private static Client $unClient;
    private static array $lesClients = array();


    public static function testerConnexion(string $mail, string $mdp){
        try{
            if(self::$cnx == null) {
               self::$cnx = DbManager::getConnexion();
            }

            $message = '';

            $sql = 'Select idClient, nom, prenom, genre, dateNaissance, mail, telephone, adresse, cp, ville, mdp';
            $sql .= ' From client';
            $sql .= ' Where mail = :mail';

            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
            $stmt->execute();

            $row = $stmt->fetch();

            if($row !== false){
                $id = $row['idClient'];
                $nom = $row['nom'];
                $prenom = $row['prenom'];
                $genre = $row['genre'];
                $dateNaissance = $row['dateNaissance'];
                $mail = $row['mail'];
                $telephone = $row['telephone'];
                $adresse = $row['adresse'];
                $cp = $row['cp'];
                $ville = $row['ville'];
                $mdpHash = $row['mdp'];

                if(password_verify($mdp, $mdpHash)){
                    $_SESSION['idClient'] = $id;
                    $_SESSION['nom'] = $nom;
                    $_SESSION['prenom'] = $prenom;
                    $_SESSION['genre'] = $genre;
                    $_SESSION['dateNaissance'] = $dateNaissance;
                    $_SESSION['mail'] = $mail;
                    $_SESSION['telephone'] = $telephone;
                    $_SESSION['adresse'] = $adresse;
                    $_SESSION['cp'] = $cp;
                    $_SESSION['ville'] = $ville;
                    $_SESSION['mdpHash'] = $mdpHash;
                    
                    header('Location: '.SERVER_URL);
                    

                } else {
                    // Message d'erreur de connexion
                    $message = 'L\'adresse e-mail ou le mot de passe est incorrect';
                } 
            } else {
                // Message d'erreur de connexion
                $message = 'L\'adresse e-mail ou le mot de passe est incorrect';
            }



            unset($cnx);
        } catch(PDOException $e){
            die('Erreur : ' . $e->getMessage());
        }

        
        return $message;
        
    }

    public static function addClient(string $prenom, string $nom, datetime $datenaissance, string $genreselect, int $codepostal, string $adressemail, string $mdpHash, int $numtel){

        try{

            if(self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            $datenaissance = $datenaissance->format('Y-m-d');
            
            

            $sql = 'INSERT INTO `client` (`nom`, `prenom`, `genre`, `dateNaissance`, `mail`, `telephone`,`cp`, `mdp`)';
            $sql .= ' Values (:nom, :prenom, :genre, :dateNaissance, :mail, :telephone, :cp, :mdp)';

            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
            $stmt->bindParam(':genre', $genreselect, PDO::PARAM_STR);
            $stmt->bindParam(':dateNaissance', $datenaissance, PDO::PARAM_LOB);
            $stmt->bindParam(':mail', $adressemail, PDO::PARAM_STR);
            $stmt->bindParam(':telephone', $numtel, PDO::PARAM_INT);
            $stmt->bindParam(':cp', $codepostal , PDO::PARAM_INT); 
            $stmt->bindParam(':mdp', $mdpHash , PDO::PARAM_STR); 

            $stmt->execute();

            $_SESSION['nom'] = $nom;
            $_SESSION['prenom'] = $prenom;
            $_SESSION['genre'] = $genreselect;
            $_SESSION['dateNaissance'] = $datenaissance;
            $_SESSION['mail'] = $adressemail;
            $_SESSION['telephone'] = $numtel;
            $_SESSION['cp'] = $codepostal;
            $_SESSION['mdpHash'] = $mdpHash;

            header('Location: '.SERVER_URL.'/bienvenue/');


        unset($cnx);
        } catch(PDOException $e){
            die('Erreur : ' . $e->getMessage());
        }

    }


    public static function editInfo($prenomUtilisateur, $nomUtilisateur, $mailUtilisateur, $numUtilisateur, $adresseUtilisateur, $cpUtilisateur, $villeUtilisateur, $leMdp) {
        try {
            if (self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }
    
            $id = $_SESSION['idClient'];
            $prenom = $_SESSION['prenom'];
            $nom = $_SESSION['nom'];
            $adresseMail = $_SESSION['mail'];
            $num = $_SESSION['telephone'];
            $adresse = $_SESSION['adresse'];
            $cp = $_SESSION['cp'];
            $ville = $_SESSION['ville'];
            $mdp = $_SESSION['mdpHash'];
    
            // Création de la requête SQL de mise à jour
            $sql = 'UPDATE client SET ';
            $updatesInfo = []; // Tableau pour stocker les mises à jour
    
            if (isset($prenomUtilisateur) && !empty($prenomUtilisateur) && $prenom != $prenomUtilisateur) {
                $updatesInfo[] = 'prenom = :prenom';
            }
    
            if (isset($nomUtilisateur) && !empty($nomUtilisateur) && $nom != $nomUtilisateur) {
                $updatesInfo[] = 'nom = :nom';
            }
    
            if (isset($mailUtilisateur) && !empty($mailUtilisateur) && $adresseMail != $mailUtilisateur) {
                $updatesInfo[] = 'mail = :mail';
            }
    
            if (isset($numUtilisateur) && !empty($numUtilisateur) && $num != $numUtilisateur) {
                $updatesInfo[] = 'telephone = :telephone';
            }
    
            if (isset($adresseUtilisateur) && !empty($adresseUtilisateur) && $adresse != $adresseUtilisateur) {
                $updatesInfo[] = 'adresse = :adresse';
            }
    
            if (isset($cpUtilisateur) && !empty($cpUtilisateur) && $cp != $cpUtilisateur) {
                $updatesInfo[] = 'cp = :cp';
            }
    
            if (isset($villeUtilisateur) && !empty($villeUtilisateur) && $ville != $villeUtilisateur) {
                $updatesInfo[] = 'ville = :ville';
            }
    
            if (isset($leMdp) && !empty($leMdp) && isset($leMdpHash)) {
                $mdpHash = password_hash($leMdp, PASSWORD_BCRYPT, ['cost' => 10]);
                if ($mdp != $mdpHash) {
                    $updatesInfo[] = 'mdp = :mdp';
                }
            }
    
            if (!empty($updatesInfo)) {
                $sql .= implode(', ', $updatesInfo) . ' WHERE idClient = :idClient';
                $stmt = self::$cnx->prepare($sql);
    
                // Liaison des paramètres
                if (in_array('prenom = :prenom', $updatesInfo)) {
                    $stmt->bindParam(':prenom', $prenomUtilisateur, PDO::PARAM_STR);
                }
                if (in_array('nom = :nom', $updatesInfo)) {
                    $stmt->bindParam(':nom', $nomUtilisateur, PDO::PARAM_STR);
                }
                if (in_array('mail = :mail', $updatesInfo)) {
                    $stmt->bindParam(':mail', $mailUtilisateur, PDO::PARAM_STR);
                }
                if (in_array('telephone = :telephone', $updatesInfo)) {
                    $stmt->bindParam(':telephone', $numUtilisateur, PDO::PARAM_INT);
                }
                if (in_array('adresse = :adresse', $updatesInfo)) {
                    $stmt->bindParam(':adresse', $adresseUtilisateur, PDO::PARAM_STR);
                }
                if (in_array('cp = :cp', $updatesInfo)) {
                    $stmt->bindParam(':cp', $cpUtilisateur, PDO::PARAM_STR);
                }
                if (in_array('ville = :ville', $updatesInfo)) {
                    $stmt->bindParam(':ville', $villeUtilisateur, PDO::PARAM_STR);
                }
                if (in_array('mdp = :mdpHash', $updatesInfo)) {
                    $stmt->bindParam(':mdpHash', $mdpHash, PDO::PARAM_STR);
                }
                var_dump($sql);
                var_dump($updatesInfo);
    
                $stmt->bindParam(':idClient', $id, PDO::PARAM_INT);
                $stmt->execute();

                $_SESSION['nom'] = $nomUtilisateur;
                $_SESSION['prenom'] = $prenomUtilisateur;
                $_SESSION['mail'] = $mailUtilisateur;
                $_SESSION['telephone'] = $numUtilisateur;
                
                $_SESSION['adresse'] = $adresseUtilisateur;
                $_SESSION['cp'] = $cpUtilisateur;
                $_SESSION['ville'] = $villeUtilisateur;
                $_SESSION['mdpHash'] = $mdpHash;
            }
    
            header('Location: '.SERVER_URL.'/profil/');
            unset(self::$cnx);
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

}

?>