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
    private static array $lesPhotos = array();

 


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

}