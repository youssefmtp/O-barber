<?php
/**
 * /model/Categorie.php
 * Définition de la class Categorie
 *
 * @author Y.Ennour
 * @date 10/2023
 */

 class Categorie {
    /*
    * Attributs
    */
    private int $id;
    private string $nom;



    /*
    * Constructeur
    */
    public function __construct(int $unId, string $unNom) {
        $this->id = $unId;
        $this->nom = $unNom;
    }


    // Accesseur 
    public function  getId():int {
        return $this->id;
    }

    public function setId(int $unId) {
        $this->id = $unId;
    }

    public function  getNom():string {
        return $this->nom;
    }

    public function setNom(string $unNom) {
        $this->nom = $unNom;
    }


}