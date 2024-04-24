<?php
/**
 * /model/Produit.php
 * Définition de la class Produit
 *
 * @author Y.Ennour
 * @date 07/2023
 */

 class Produit {
    /*
    * Attributs
    */
    private int $id, $qteEnStock, $idSousCateg;
    private string $refProd, $marque, $libelle, $resume, $description, $photoProd;
    private float $prix;



    /*
    * Constructeur
    */
    public function __construct(int $unId, string $uneRefProd, string $uneMarque, string $unLibelle, string $unResume, string $uneDescription, string $unePhotoProd, 
    int $uneQteEnStock, float $unPrix, int $unIdSousCateg) {
        $this->id = $unId;
        $this->refProd = $uneRefProd;
        $this->marque = $uneMarque;
        $this->libelle = $unLibelle;
        $this->resume = $unResume;
        $this->description = $uneDescription;
        $this->photoProd = $unePhotoProd;
        $this->qteEnStock = $uneQteEnStock;
        $this->prix = $unPrix;
        $this->idSousCateg = $unIdSousCateg;
    }


    // Accesseur 
    public function  getId():int {
        return $this->id;
    }

    public function setId(int $unId) {
        $this->id = $unId;
    }

    public function  getRefProd():string {
        return $this->refProd;
    }

    public function setRefProd(string $uneRefProd) {
        $this->refProd = $uneRefProd;
    }

    public function  getMarque():string {
        return $this->marque;
    }

    public function setMarque(string $uneMarque) {
        $this->marque = $uneMarque;
    }

    public function  getLibelle():string {
        return $this->libelle;
    }

    public function setLibelle(string $unLibelle) {
        $this->libelle = $unLibelle;
    }

    public function  getResume():string {
        return $this->resume;
    }

    public function setResume(string $unResume) {
        $this->resume = $unResume;
    }

    public function  getDescription():string {
        return $this->description;
    }

    public function setDescription(string $uneDescription) {
        $this->description = $uneDescription;
    }

    public function  getPhotoProd():string {
        return $this->photoProd;
    }

    public function setPhotoProd(string $unePhotoProd) {
        $this->photoProd = $unePhotoProd;
    }

    public function  getQteEnStock():int {
        return $this->qteEnStock;
    }

    public function setQteEnStock(int $uneQteEnStock) {
        $this->qteEnStock = $uneQteEnStock;
    }

    public function  getPrix():float {
        return $this->prix;
    }

    public function setPrix(float $unPrix) {
        $this->prix = $unPrix;
    }

    public function  getIdSousCateg():int {
        return $this->idSousCateg;
    }

    public function setIdSousCateg(int $unIdSousCateg) {
        $this->idSousCateg = $unIdSousCateg;
    }

}



class Prod extends Produit {
    /*
    * Attributs
    */
    private int $idProduit;
    private string $photoProd;



    /*
    * Constructeur
    */
    public function __construct(string $unePhoto) {
        $this->photoProd = $unePhoto;
    }


    // Accesseur 
    public function  getPhotoProd():string {
        return $this->photoProd;
    }

    public function setPhotoProd(string $unePhoto) {
        $this->photoProd = $unePhoto;
    }


}

?>