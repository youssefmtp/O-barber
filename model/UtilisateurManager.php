<?php
/**
 * /model/UtilisateurManager.php
 * 
 * Définition de la class UtilisateurManager
 * Class qui gère les interactions entre les Utilisateurs de l'application
 * et ceux de la bdd
 *
 * @author Y.Ennour
 * @date 07/2023
 */

    // Inclure les fichiers PHPMailer
    require_once ROOT.'/PHPMailer/src/Exception.php';
    require_once ROOT.'/PHPMailer/src/PHPMailer.php';
    require_once ROOT.'/PHPMailer/src/SMTP.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    class UtilisateurManager {
    
    private static ?\PDO $cnx = null;
    private static Utilisateur $unUtilisateur;
    private static array $lesUtilisateurs = array();
   

    /**
     * récupère dans la bbd tous les info du client en fonction de l'identifiant  
     *
     * @return Utilisateur
     */
    public static function getClientById($idCli): Utilisateur
    {
        try{
            if(self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }


            $sql = 'Select id, nom, prenom, genre, dateNaissance, mail, telephone, adresse, cp, ville, mdp, idRole';
            $sql .= ' From utilisateur U';
            $sql .= ' Where id = :idCli';
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idCli', $idCli, PDO::PARAM_INT);
            $stmt->execute();
            
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            while($row = $stmt->fetch()) {

                self::$unUtilisateur = new Utilisateur($row->id, $row->nom, $row->prenom, $row->genre, new DateTime($row->dateNaissance), $row->mail, $row->adresse, $row->ville, $row->cp, $row->telephone, $row->mdp, $row->idRole);
            }
            unset($cnx);
        } catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }
        
        return self::$unUtilisateur;
    }

    public static function testerConnexion(string $mail, string $mdp){
        try{
            if(self::$cnx == null) {
               self::$cnx = DbManager::getConnexion();
            }

            $message = '';

            $sql = 'Select id, nom, prenom, genre, dateNaissance, mail, telephone, adresse, cp, ville, mdp, idRole';
            $sql .= ' From utilisateur';
            $sql .= ' Where mail = :mail';

            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
            $stmt->execute();

            $row = $stmt->fetch();

            if($row !== false){
                $id = $row['id'];
                $nom = $row['nom'];
                $prenom = $row['prenom'];
                $genre = $row['genre'];
                $dateNaissance = $row['dateNaissance'];
                $email = $row['mail'];
                $telephone = $row['telephone'];
                $adresse = $row['adresse'];
                $cp = $row['cp'];
                $ville = $row['ville'];
                $mdpHash = $row['mdp'];
                $idRole = $row['idRole'];

                if(password_verify($mdp, $mdpHash)){
                    $_SESSION['id'] = $id;
                    $_SESSION['nom'] = $nom;
                    $_SESSION['prenom'] = $prenom;
                    $_SESSION['genre'] = $genre;
                    $_SESSION['dateNaissance'] = $dateNaissance;
                    $_SESSION['mail'] = $email;
                    $_SESSION['telephone'] = $telephone;
                    $_SESSION['adresse'] = $adresse;
                    $_SESSION['cp'] = $cp;
                    $_SESSION['ville'] = $ville;
                    $_SESSION['mdpHash'] = $mdpHash;
                    $_SESSION['idRole'] = $idRole;


                    
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

    public static function addUtilisateur(string $prenom, string $nom, datetime $datenaissance, string $genreselect, int $codepostal, string $adressemail, string $mdpHash, int $numtel){

        try{

            if(self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            $datenaissance = $datenaissance->format('Y-m-d');
            
            

            $sql = 'INSERT INTO `utilisateur` (`nom`, `prenom`, `genre`, `dateNaissance`, `mail`, `telephone`,`cp`, `mdp`, `idRole`)';
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
            $_SESSION['idRole'] = 2;

            $idUtilisateur = self::$cnx->lastInsertId();
            $_SESSION['id'] = $idUtilisateur;


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
            $mail->addAddress($adressemail, $prenom); // destinataire

            $mail->isHTML(true);
            $mail->Subject = 'Bienvenue chez O\'barber !';

            $message = '<html>
            <head>
            </head>
            <body>
            <p style="color: black;">Bienvenue '.$prenom.',</p>
        

            <p style="color: black;">Nous avons le plaisir de vous compter parmis les nouveaux utilisateurs et tenons à vous remerciez pour 
            l\'intérêt que vous portez à notre marque.</p>


            <p style="color: black;"style="color: black;">Cordialement,<br>
            L\'équipe O\'barber</p>
        
        
            <p style="color: #585859; font-size: 12px;">Ceci est un email automatique, merci de ne pas répondre.</p>
            </body>
            </html>';

            $mail->Body = $message;

            // Envoyer le message
            if ($mail->send()) {
                echo 'E-mail envoyé avec succès !'; 
            } else {
                echo 'Erreur lors de l\'envoi de l\'e-mail : ' . $mail->ErrorInfo;
            }



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
    
            $id = $_SESSION['id'];
            $prenom = $_SESSION['prenom'];
            $nom = $_SESSION['nom'];
            $adresseMail = $_SESSION['mail'];
            $num = $_SESSION['telephone'];
            $adresse = $_SESSION['adresse'];
            $cp = $_SESSION['cp'];
            $ville = $_SESSION['ville'];
            $mdp = $_SESSION['mdpHash'];
    
            // Création de la requête SQL de mise à jour
            $sql = 'UPDATE utilisateur SET ';
            $updatesInfo = []; // Tableau pour stocker les mises à jour
    
            if (isset($prenomUtilisateur) && $prenom != $prenomUtilisateur) {
                $updatesInfo[] = 'prenom = :prenom';
            }
    
            if (isset($nomUtilisateur) && $nom != $nomUtilisateur) {
                $updatesInfo[] = 'nom = :nom';
            }
    
            if (isset($mailUtilisateur) && $adresseMail != $mailUtilisateur) {
                $updatesInfo[] = 'mail = :mail';
            }
    
            if (isset($numUtilisateur) && $num != $numUtilisateur) {
                $updatesInfo[] = 'telephone = :telephone';
            }
    
            if (isset($adresseUtilisateur) && $adresse != $adresseUtilisateur) {
                $updatesInfo[] = 'adresse = :adresse';
            }
    
            if (isset($cpUtilisateur) && $cp != $cpUtilisateur) {
                $updatesInfo[] = 'cp = :cp';
            }
    
            if (isset($villeUtilisateur) && $ville != $villeUtilisateur) {
                $updatesInfo[] = 'ville = :ville';
            }
    
            if (isset($leMdp) && !empty($leMdp) && isset($leMdpHash)) {
                $mdpHash = password_hash($leMdp, PASSWORD_BCRYPT, ['cost' => 10]);
                if ($mdp != $mdpHash) {
                    $updatesInfo[] = 'mdp = :mdp';
                }
            }
    
            if (!empty($updatesInfo)) {
                $sql .= implode(', ', $updatesInfo) . ' WHERE id = :id';
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
    
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();

                $_SESSION['prenom'] = $prenomUtilisateur;
                $_SESSION['nom'] = $nomUtilisateur;
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

    /**
     * récupère dans la bbd tous les info de tous les client  
     *
     * @return array
     */
    public static function getLesClients(): array
    {
        try{
            if(self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }


            $sql = 'Select id, nom, prenom, genre, dateNaissance, mail, telephone, adresse, cp, ville, mdp, idRole';
            $sql .= ' From utilisateur ';
            $stmt = self::$cnx->prepare($sql);
            $stmt->execute();
            
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            while($row = $stmt->fetch()) {

                self::$lesUtilisateurs[] = new Utilisateur($row->id, $row->nom, $row->prenom, $row->genre, new DateTime($row->dateNaissance), $row->mail, $row->adresse, $row->ville, $row->cp, $row->telephone, $row->mdp, $row->idRole);
            }
            unset($cnx);
        } catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }
        
        return self::$lesUtilisateurs;
    }

    /**
     * deleteUtilisateur
     * supprimer dans la bbd l'utilisateur dont son id est passé en param
     * @param int
     */
    public static function deleteUtilisateur(int $idUser)
    {
        try{
            if(self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            $sql = 'Delete from utilisateur';
            $sql .= ' Where id = :idUser';
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
            $stmt->execute();

            unset($cnx);
        } catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }       
    }

    public static function editPassword($id, $leMdp) {
        try {
            if (self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }
    
    
            $mdpHash = password_hash($leMdp, PASSWORD_BCRYPT, ['cost' => 10]);
            
            $sql = 'UPDATE utilisateur SET mdp = :mdp WHERE id = :id';
            $stmt = self::$cnx->prepare($sql);

            $stmt->bindParam(':mdp', $mdpHash, PDO::PARAM_STR);    
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
    
            header('Location: '.SERVER_URL.'/connexion/');
            unset(self::$cnx);
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

}

?>