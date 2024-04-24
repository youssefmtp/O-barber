<?php
/**
 * /model/Statut.php
 * Définition de la class Statut
 *
 * @author Y.Ennour
 * @date 12/2023
 */

 class Statut {
    /*
    * Attributs
    */
    private int $id;
    private string $libelle;



    /*
    * Constructeur
    */
    public function __construct(int $unId, string $unLibelle) {
        $this->id = $unId;
        $this->libelle = $unLibelle;
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


}

class Stat extends Statut {
    /*
    * Attributs
    */
    private string $libelle;



    /*
    * Constructeur
    */
    public function __construct(string $unLibelle) {
        $this->libelle = $unLibelle;
    }


    // Accesseur 
    public function  getLibelle():string {
        return $this->libelle;
    }

    public function setLibelle(string $unLibelle) {
        $this->libelle = $unLibelle;
    }
}