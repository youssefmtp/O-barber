<?php
/**
 * /model/SousCategorie.php
 * Définition de la class SousCategorie
 *
 * @author Y.Ennour
 * @date 10/2023
 */

 class SousCategorie {
    /*
    * Attributs
    */
    private int $id, $idCateg;
    private string $libelle;



    /*
    * Constructeur
    */
    public function __construct(int $unId, string $unLibelle, int $unIdCateg) {
        $this->id = $unId;
        $this->libelle = $unLibelle;
        $this->idCateg = $unIdCateg;
    }


    // Accesseur 
    public function  getId():int {
        return $this->id;
    }

    public function setId(int $unId) {
        $this->id = $unId;
    }

    public function  getLibelle():string {
        return $this->libelle;
    }

    public function setLibelle(string $unLibelle) {
        $this->libelle = $unLibelle;
    }

    public function  getIdCateg():int {
        return $this->idCateg;
    }

    public function setIdCateg(int $unIdCateg) {
        $this->idCateg = $unIdCateg;
    }


}