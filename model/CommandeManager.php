<?php
/**
 * /model/CommandeManager.php
 * 
 * Définition de la class CommandeManager
 * Class qui gère les interactions entre les commandes de l'application
 * et ceux de la bdd
 *
 * @author Y.Ennour
 * @date 10/2023
 */


    class CommandeManager {
    
    private static ?\PDO $cnx = null;
    private static array $lesCmds = array();
    private static array $lesProds = array();
    private static Commande $laCommande;
    private static array $lesPhotos = array();
    private static datetime $dateCmd;



    /**
     * récupère dans la bbd tous les info de la commande en fonction de la référence  
     *
     * @return Commande
     */
    public static function getCmdByRef($refCmd): Commande
    {
        try{
            if(self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }


            $sql = 'Select ref, idClient, idTransporteur, adLivraison, cpLivraison, villeLivraison';
            $sql .= ' From commande C';
            $sql .= ' Where ref = :ref';
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':ref', $refCmd, PDO::PARAM_INT);
            $stmt->execute();
            
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            while($row = $stmt->fetch()) {

                self::$laCommande = new Commande($row->ref, $row->idClient, $row->idTransporteur, $row->adLivraison, $row->cpLivraison, $row->villeLivraison);
            }
            unset($cnx);
        } catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }
        
        return self::$laCommande;
    }

    /**
     * récupère dans la bbd la date de commande en fonction de la référence  
     *
     * @return DateTime
     */
    public static function getDateCmdByRef($refCmd): DateTime
    {
        try{
            if(self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }


            $sql = 'Select dateChangement';
            $sql .= ' From commande C';
            $sql .= ' Join changement_statut CS On C.ref = CS.refCommande';
            $sql .= ' Where ref = :ref And idStatut = (Select MIN(idStatut) From changement_statut)';
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':ref', $refCmd, PDO::PARAM_INT);
            $stmt->execute();
            
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            while($row = $stmt->fetch()) {

                self::$dateCmd = new DateTime($row->dateChangement);
            }
            unset($cnx);
        } catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }
        
        return self::$dateCmd;
    }

    /**
     * récupère dans la bbd tous les produits la de commande en fonction de la référence  
     *
     * @return array
     */
    public static function getProduitCmdByRef($refCmd): array
    {
        try{
            if(self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }


            $sql = 'Select id, refProd, marque, libelle, resume, description, photoProd, qteEnStock, prix, seuilAlerte, idSousCateg, D.quantite';
            $sql .= ' From detail_commande D';
            $sql .= ' Join produit P On D.idProduit = P.id';
            $sql .= ' Where refCommande = :ref';
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':ref', $refCmd, PDO::PARAM_INT);
            $stmt->execute();
            
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            while($row = $stmt->fetch()) {

                self::$lesProds[] = new Detail_Prod($row->id, $row->refProd, $row->marque, $row->libelle, $row->resume, $row->description, $row->photoProd, $row->qteEnStock, $row->prix, $row->seuilAlerte, $row->idSousCateg, $row->quantite);
            }
            unset($cnx);
        } catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }
        
        return self::$lesProds;
    }



    /**
     * récupère dans la bbd toutes la ref et la dateLivraison 
     * de toutes les commandes en fonction du client  
     *
     * @return array
     */
    public static function getInfoCmdByClient($idClient): array
    {
        try{
            if(self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }



            


            $sql = 'Select C.ref, CS.dateChangement As dateCmd, CH.dateChangement As dateActuelle, ST.libelle, photoProd
                    From commande C
                        Join changement_statut CS ON C.ref = CS.refCommande
                        Join changement_statut CH ON C.ref = CH.refCommande
                        Join statut ST ON CH.idStatut = ST.id
                        Join detail_commande DC ON C.ref = DC.refCommande
                        Join produit P ON DC.idProduit = P.id
                    Where idClient = :idClient
                    And CS.dateChangement IN (Select dateChangement From changement_statut CHS
                                              Join statut Sa On CHS.idStatut = Sa.id 
                                              Where CHS.idStatut = CS.idStatut and libelle = "En cours de préparation")
                    And CH.dateChangement = (Select MAX(dateChangement) From changement_statut Where refCommande = C.ref)
                    ORDER By ST.libelle DESC';
            

            
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idClient', $idClient, PDO::PARAM_INT);

            $stmt->execute();
            
            $stmt->setFetchMode(PDO::FETCH_OBJ);

            $lesCmdsR = array();
            
            
            while ($row = $stmt->fetch()) {
                $refCommande = $row->ref;
                $libelle = $row->libelle;
                $dateCmd = new DateTime($row->dateCmd);
                $dateActuelle = new DateTime($row->dateActuelle);
                $photoProd = new Prod($row->photoProd);
    
                // Si la commande n'est pas déjà dans le tableau, l'ajouter
                if (!isset($lesCmdsR[$refCommande])) {
                    $lesCmdsR[$refCommande] = new Cmd($refCommande, $dateCmd, $dateActuelle, $libelle, array($photoProd));
                } else {
                    // Ajouter la photo à la commande existante
                    $lesCmdsR[$refCommande]->setLesPhotos($photoProd);
                }
            }
            
            unset($cnx);
        } catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }
        
        return $lesCmdsR;
    } 



    public static function getInfoCmdAndImgByClient($idClient): array
    {
        try {
            if (self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            $sql = 'SELECT C.refCommande, dateLivraison, dateChangement, photoProd
                    FROM commande C
                    JOIN changement_statut CS ON C.refCommande = CS.refCommande
                    JOIN detail_commande DC ON C.refCommande = DC.refCommande
                    JOIN produit P ON DC.idProduit = P.id
                    WHERE C.idClient = :idClient
                    AND CS.idStatut = 3';

            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idClient', $idClient, PDO::PARAM_INT);

            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_OBJ);

            $cmdsWithImages = array();

            while ($row = $stmt->fetch()) {
                $refCmd = $row->refCommande;
                $dateLivraison = new DateTime($row->dateLivraison);
                $dateChangement = new DateTime($row->dateChangement);
                $photoProd = $row->photoProd;

                // Si la commande n'est pas déjà dans le tableau, l'ajouter
                if (!isset($cmdsWithImages[$refCmd])) {
                    $cmdsWithImages[$refCmd] = new Cmd($refCmd, $dateLivraison, $dateChangement, array($photoProd));
                } else {
                    // Ajouter la photo à la commande existante
                    $cmdsWithImages[$refCmd]->addPhoto($photoProd);
                }
            }

            unset($cnx);

        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }

        return array_values($cmdsWithImages);
    }


    /**
     * récupère dans la bbd toutes la ref et la dateLivraison 
     * de toutes les commandes en fonction du client  
     *
     * @return array
     */
    public static function getImgCmdByClient($refCmd, $idClient): array
    {
        try{
            if(self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }


            $sql = 'Select photoProd
                    From produit P
                    Join detail_commande DC ON P.id = DC.idProduit
                    Join commande C ON DC.refCommande = C.refCommande
                    Where idClient = :idClient
                    And C.refCommande = :refCommande';
            

            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':refCommande', $refCmd, PDO::PARAM_INT);
            $stmt->bindParam(':idClient', $idClient, PDO::PARAM_INT);

            $stmt->execute();
            
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            
            
            while($row = $stmt->fetch()) { 
                self::$lesPhotos[] = $row->photoProd;
            }
            
            unset($cnx);
        } catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }
        
        return self::$lesPhotos;
    }

    /**
     * insére dans la bdd la nouvelle cmd pour le client
     */
    public static function addCommande(string $adLiv, string $cpLiv, string $villeLiv, int $idCli)
    {
        try{

            if(self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }            

            $sql = 'INSERT INTO `commande` (`adLivraison`, `cpLivraison`, `villeLivraison`, `idClient`)';
            $sql .= ' Values (:adLiv, :cpLiv, :villeLiv, :idCli)';

            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':adLiv', $adLiv, PDO::PARAM_STR);
            $stmt->bindParam(':cpLiv', $cpLiv, PDO::PARAM_STR);
            $stmt->bindParam(':villeLiv', $villeLiv, PDO::PARAM_STR);
            $stmt->bindParam(':idCli', $idCli, PDO::PARAM_INT); 

            $stmt->execute();

            $sql2= 'select MAX(ref) From commande where idClient = :idCli';
            $stmt2 = self::$cnx->prepare($sql2);
            $stmt2->bindParam(':idCli', $idCli, PDO::PARAM_INT); 
            $stmt2->execute();

            $result = $stmt2->fetch(PDO::FETCH_ASSOC);

            $_SESSION['newRef'] = $result['MAX(ref)'];


            unset($cnx);
        } catch(PDOException $e){
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * insére dans la bdd le nouveau detail cmd pour le client
     */
    public static function addDetailCommande(int $refCmd, int $idProd, int $qte)
    {
        try{

            if(self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }            

            $sql = 'INSERT INTO `detail_commande` (`refCommande`, `idProduit`, `quantite`)';
            $sql .= ' Values (:refCmd, :idProd, :qte)';

            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':refCmd', $refCmd, PDO::PARAM_INT);
            $stmt->bindParam(':idProd', $idProd, PDO::PARAM_INT);
            $stmt->bindParam(':qte', $qte, PDO::PARAM_INT);

            $stmt->execute();

            unset($cnx);
        } catch(PDOException $e){
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * insére dans la bdd le nouveau statut cmd
     */
    public static function addStatutCommande(int $refCmd)
    {
        try{

            if(self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }            

            $sql = 'INSERT INTO `changement_statut` (`idStatut`, `refCommande`, `dateChangement`)';
            $sql .= ' Values ((Select id from statut where libelle = "En cours de préparation"), :refCmd, NOW())';

            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':refCmd', $refCmd, PDO::PARAM_INT);

            $stmt->execute();

            unset($cnx);
        } catch(PDOException $e){
            die('Erreur : ' . $e->getMessage());
        }
    }


    /**
     * vide le panier actuelle
     */
    public static function viderPanier()
    {
        unset($_SESSION['panier']);
    }

}