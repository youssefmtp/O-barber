<?php
/**
 * /model/SousCategManager.php
 * 
 * Définition de la class SousCategManager
 * Class qui gère les interactions entre les SousCategs de l'application
 * et ceux de la bdd
 *
 * @author Y.Ennour
 * @date 10/2023
 */

    class SousCategorieManager {
    
    private static ?\PDO $cnx = null;
    private static SousCategorie $uneSousCateg;
    private static array $lesSousCategs = array();

    private static SousCategorie $uneSousCateg2;
    private static array $lesSousCategs2 = array();

    private static SousCategorie $uneSousCateg3;
    private static array $lesSousCategs3 = array();


    /**
     * récupère dans la bbd tous les produits de la sous catégorie huiles 
     *
     * @return array
     */
    public static function getLesProduitsHuiles(): array
    {
        try{
            if(self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }


            // Requête select qui récupère toutes les informations des produits
            // Requête select qui récupère les informations des produits
            $sql = 'Select id, libelle, idCateg';
            $sql .= ' From sous_categorie';
            $sql .= ' Where idCateg = 1';
            $stmt = self::$cnx->prepare($sql);
            $stmt->execute();
            
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            while($row = $stmt->fetch()) {

                self::$uneSousCateg = new SousCategorie($row->id, $row->libelle, $row->idCateg);

                self::$lesSousCategs[] = self::$uneSousCateg;
            }
            unset($cnx);
        } catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }
        
        return self::$lesSousCategs;
    }

    /**
     * récupère dans la bbd tous les produits de la sous catégorie rasoire 
     *
     * @return array
     */
    public static function getLesProduitsRassoires(): array
    {
        try{
            if(self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }


            // Requête select qui récupère toutes les informations des produits
            // Requête select qui récupère les informations des produits
            $sql = 'Select id, libelle, idCateg';
            $sql .= ' From sous_categorie';
            $sql .= ' Where idCateg = 2';
            $stmt = self::$cnx->prepare($sql);
            $stmt->execute();
            
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            while($row = $stmt->fetch()) {

                self::$uneSousCateg2 = new SousCategorie($row->id, $row->libelle, $row->idCateg);

                self::$lesSousCategs2[] = self::$uneSousCateg2;

            }
            unset($cnx);
        } catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }
        
        return self::$lesSousCategs2;
    }

    /**
     * récupère dans la bbd tous les produits de la sous catégorie accessoires 
     *
     * @return array
     */
    public static function getLesProduitsAccessoires(): array
    {
        try{
            if(self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }


            // Requête select qui récupère les informations des produits
            $sql = 'Select id, libelle, idCateg';
            $sql .= ' From sous_categorie';
            $sql .= ' Where idCateg = 3';
            $stmt = self::$cnx->prepare($sql);
            $stmt->execute();
            
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            while($row = $stmt->fetch()) {

                self::$uneSousCateg3 = new SousCategorie($row->id, $row->libelle, $row->idCateg);

                self::$lesSousCategs3[] = self::$uneSousCateg3;
            }
            unset($cnx);
        } catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }
        
        return self::$lesSousCategs3;
    }

}

?>