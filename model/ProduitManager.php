<?php
/**
 * /model/ProduitManager.php
 * 
 * Définition de la class ProduitManager
 * Class qui gère les interactions entre les produits de l'application
 * et ceux de la bdd
 *
 * @author Y.Ennour
 * @date 06/2023
 */

    class ProduitManager {
    
    private static ?\PDO $cnx = null;
    private static Produit $unProduit;
    private static array $lesProduits = array();
    private static int $id = 0;

    private static array $lesProduitsBySousCateg = array();


        /**
     * récupère dans la bbd tous les produits
     *
     * @return string
     */
    public static function getLesProduits(): string
    {
        try{
            if(self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            // Requête select qui récupère toutes les informations des produits
            $sql = 'Select id, refProd, marque, libelle, resume, description, photoProd, qteEnStock, prix, idSousCateg';
            $sql .= ' From produit';

            $stmt = self::$cnx->query($sql);

            
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                
                $data[] = $row;
            }
            unset($cnx);
        } catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }
        
        return json_encode($data);
    }

    /**
     * récupère dans la bbd tous les produits
     *
     * @return string
     */
    public static function getLesProduitsByIdFiltre($filtre): string
    {
        try{
            if(self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            // Requête select qui récupère toutes les informations des produits
            $sql = 'Select id, refProd, marque, libelle, resume, description, photoProd, qteEnStock, prix, idSousCateg';
            $sql .= ' From produit';
            $sql .= ' Where idSousCateg = :filtre';


            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':filtre', $filtre, PDO::PARAM_INT);

            $stmt->execute();
            
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            // Utiliser un tableau pour stocker les produits
            $lesProduits = [];

            while ($row = $stmt->fetch()) {
                $lesProduits[] = $row;
            }
            unset($cnx);
        } catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }
        
        return json_encode($lesProduits);
    }



    
    /**
     * getProduitById
     * récupère dans la bbd le produit
     * avec l'id passé en paramètre
     *
     * @param int
     * @return Produit
     */
    public static function getProduitById(int $idProduit): Produit
    {
        try{
            if(self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            // Requête select qui récupère toutes les informations du produit 
            $sql = 'Select id, refProd, marque, libelle, resume, description, photoProd, qteEnStock, prix, idSousCateg';
            $sql .= ' From produit';
            $sql .= ' Where id = :idProduit';
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idProduit', $idProduit, PDO::PARAM_INT);
            $stmt->execute();

            
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $row = $stmt->fetch();


            self::$unProduit = new Produit($row->id, $row->refProd, $row->marque, $row->libelle, $row->resume, $row->description, $row->photoProd, $row->qteEnStock, $row->prix, $row->idSousCateg);
            
            return self::$unProduit;
            unset($cnx);
        } catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }       
    }

    public static function getIdFiltreByLibelle(string $libelle): int
    {
        try{
            if(self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            $sql = 'Select id From sous_categorie';
            $sql .= ' Where libelle = :libelle';

            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':libelle', $libelle, PDO::PARAM_STR);
            $stmt->execute();


            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $row = $stmt->fetch();
            
            if ($row !== false) {
                self::$id = $row->id; // Accédez à la valeur par le nom de colonne 'id'
            } 

            
            return self::$id;
            unset($cnx);
        } catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }     

    }

    /**
     * getProduitByCategorie
     * récupère dans la bbd les produits 
     * en fonctions de la categorie
     * avec l'id passé en paramètre
     *
     * @param int
     * @return string
     */
    public static function getProduitByCategorie(int $idCateg): string
    {
        try{
            if(self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            // Requête select qui récupère toutes les informations du produit 
            $sql = 'Select P.id, refProd, marque, P.libelle, resume, description, photoProd, qteEnStock, prix, idSousCateg';
            $sql .= ' From produit P';
            $sql .= ' Join sous_categorie S ON P.idSousCateg = S.id';
            $sql .= ' Join categorie C ON S.idCateg = C.id'; 
            $sql .= ' Where C.id = :idCateg';
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idCateg', $idCateg, PDO::PARAM_INT);
            $stmt->execute();

            
            $stmt->setFetchMode(PDO::FETCH_OBJ);

            // Utiliser un tableau pour stocker les produits
            $lesProduits = array();

            while ($row = $stmt->fetch()) {
                $lesProduits[] = $row;
            }
            

        } catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }       
        return json_encode($lesProduits);
    }

    /**
     * getProduitRecherche
     * récupère dans la bbd le produit
     * rechercher
     * avec l'id passé en paramètre
     *
     * @param int
     * @return string
     */
    public static function getRecherche(string $recherche): string
    {
        try{
            if(self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            // Requête select qui récupère toutes les informations du produit 
            $sql = 'Select libelle';
            $sql .= ' From produit';
            $sql .= ' Where libelle LIKE :recherche';
            $sql .= ' Order By libelle ASC'; 
            $sql .= ' LIMIT 3';
            $stmt = self::$cnx->prepare($sql);

            $rechercheParam = "%$recherche%";

            $stmt->bindParam(':recherche', $rechercheParam, PDO::PARAM_STR);
            $stmt->execute();

            

            // Utiliser un tableau pour stocker les produits
            $lesProduits = array();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Limiter le nombre de caractères affichés à 25
                $libelle = (strlen($row['libelle']) > 25) ? mb_substr($row['libelle'], 0, 25) . '...' : $row['libelle'];
                $libelleLong = $row['libelle'];
            
                $lesProduits[] = ['libelle' => $libelle];
            }
            

        } catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }       
        return json_encode($lesProduits);
    }

    /**
     * getProduitRecherche
     * récupère dans la bbd le produit
     * rechercher
     * avec l'id passé en paramètre
     *
     * @param int
     * @return string
     */
    public static function getProduitRecherche(string $recherche): string
    {
        try{
            if(self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            // Requête select qui récupère toutes les informations du produit 
            $sql = 'Select id, refProd, marque, libelle, resume, description, photoProd, qteEnStock, prix, idSousCateg';
            $sql .= ' From produit';
            $sql .= ' Where libelle LIKE :recherche';
            $sql .= ' Order By libelle ASC'; 
            $stmt = self::$cnx->prepare($sql);

            $rechercheParam = "%$recherche%";

            $stmt->bindParam(':recherche', $rechercheParam, PDO::PARAM_STR);
            $stmt->execute();

            

            // Utiliser un tableau pour stocker les produits
            $lesProduits = array();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            
                $lesProduits[] = [
                    'id' => $row['id'],
                    'refProd' => $row['refProd'],
                    'marque' => $row['marque'],
                    'libelle' => $row['libelle'],
                    'resume' => $row['resume'],
                    'description' => $row['description'],
                    'photoProd' => $row['photoProd'],
                    'qteEnStock' => $row['qteEnStock'],
                    'prix' => $row['prix'],
                    'idSousCateg' => $row['idSousCateg'],
                ];
            }
            

        } catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }       
        return json_encode($lesProduits);
    }

    /**
     * getImgProduitById
     * récupère dans la bbd l'image produit
     * avec l'id passé en paramètre
     *
     * @param int
     * @return Produit
     */
    public static function getImgProduitById(int $idProduit): string
    {
        try{
            if(self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            $img ='';

            // Requête select qui récupère toutes les informations du produit 
            $sql = 'Select photoProd';
            $sql .= ' From produit';
            $sql .= ' Where id = :idProduit';
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idProduit', $idProduit, PDO::PARAM_INT);
            $stmt->execute();

            
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $row = $stmt->fetch();


            $img = $row->photoProd;
            
            return $img;
            unset($cnx);
        } catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }       
    }

}


?>