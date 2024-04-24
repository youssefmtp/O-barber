<?php
/**
 * /model/ChangementStatut.php
 * Définition de la class ChangementStatut
 *
 * @author Y.Ennour
 * @date 12/2023
 */

 class ChangementStatut {
    /*
    * Attributs
    */
    private int $refCommande, $idStatut;
    private datetime $dateChangement;



    /*
    * Constructeur
    */
    public function __construct(int $uneRefCommande, int $unIdStatut, datetime $uneDateChangement) {
        $this->refCommande = $uneRefCommande;
        $this->idStatut = $unIdStatut;
        $this->dateChangement = $uneDateChangement;
    }


    // Accesseur 
    public function  getRefCommande():int {
        return $this->refCommande;
    }

    public function setRefCommande(int $uneRefCommande) {
        $this->refCommande = $uneRefCommande;
    }

    public function  getIdStatut():int {
        return $this->idStatut;
    }

    public function setIdStatut(int $unIdStatut) {
        $this->idStatut = $unIdStatut;
    }

    public function  getDateChangement():datetime {
        return $this->dateChangement;
    }

    public function setDateChangement(datetime $uneDateChangement) {
        $this->dateChangement = new DateTime($uneDateChangement);
    }


} 

class ChanStat extends ChangementStatut {
    /*
    * Attributs
    */
    private datetime $dateChangement;



    /*
    * Constructeur
    */
    public function __construct(datetime $uneDateChangement) {
        $this->dateChangement = $uneDateChangement;
    }

    public function  getDateChangement():datetime {
        return $this->dateChangement;
    }

    public function setDateChangement(datetime $uneDateChangement) {
        $this->dateChangement = new DateTime($uneDateChangement);
    }

}