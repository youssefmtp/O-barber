<?php
/**
 * /model/Commande.php
 * Définition de la class Commande
 *
 * @author Y.Ennour
 * @date 13/2023
 */

 class Commande {
    /*
    * Attributs
    */
    private int $refCommande, $idClient;
    private string $adLivraison, $cpLivraison, $villeLivraison; 
    private ?int $idTransporteur = null;

    /*
    * Constructeur
    */ 
    public function __construct(int $uneRefCommande = 0, int $unIdClient = 0, ?int $unIdTransporteur = null, string $uneAdLivraison = "Saisir une adresse", string $unCpLivraison = "Saisir un code postal", string $uneVilleLivraison = "Saisir une ville") {
        $this->refCommande = $uneRefCommande;
        $this->idClient = $unIdClient;
        $this->idTransporteur = $unIdTransporteur;
        $this->adLivraison = $uneAdLivraison;
        $this->cpLivraison = $unCpLivraison;
        $this->villeLivraison = $uneVilleLivraison;
    }


    // Accesseur 
    public function getRefCommande():int {
        return $this->refCommande;
    }

    public function setRefCommande(int $uneRefCommande) {
        $this->refCommande = $uneRefCommande;
    }

    public function  getIdClient():int {
        return $this->idClient;
    }

    public function setIdClient(int $unIdClient) {
        $this->idClient = $unIdClient;
    }

    public function  getIdTransporteur():int {
        return $this->idTransporteur;
    }

    public function setIdTransporteur(int $unIdTransporteur) {
        $this->idTransporteur = $unIdTransporteur;
    }

    public function  getDateCommande():datetime {
        return $this->dateCommande;
    }

    public function setDateCommande(datetime $uneDateCommande) {
        $this->dateCommande = $uneDateCommande;
    }

    public function  getDateLivraison():datetime {
        return $this->dateLivraison;
    }

    public function setDateLivraison(datetime $uneDateLivraison) {
        $this->dateLivraison = $uneDateLivraison;
    }

    public function  getAdLivraison():string {
        return $this->adLivraison;
    }

    public function setAdLivraison(string $uneAdLivraison) {
        $this->adLivraison = $uneAdLivraison;
    }

    public function  getCpLivraison():string {
        return $this->cpLivraison;
    }

    public function setCpLivraison(string $unCpLivraison) {
        $this->cpLivraison = $unCpLivraison;
    }

    public function  getVilleLivraison():string {
        return $this->villeLivraison;
    }

    public function setVilleLivraison(string $uneVilleLivraison) {
        $this->villeLivraison = $uneVilleLivraison;
    }


}


class Cmd extends Commande {
    /*
    * Attributs
    */
    private int $refCommande;
    private datetime $dateCmd, $dateActuelle;
    private array $photos;
    private Prod $leProd;
    private string $libelle;


    /*
    * Constructeur
    */
    public function __construct(int $uneRefCommande, datetime $uneDateCmd, datetime $uneDateActuelle, string $unLibelle, array $lesP) {
        $this->refCommande = $uneRefCommande;
        $this->dateCmd = $uneDateCmd;
        $this->dateActuelle = $uneDateActuelle;
        $this->photos = $lesP;
        $this->libelle = $unLibelle;
    }


    // Accesseur 
    public function  getRefCommande():int {
        return $this->refCommande;
    }

    public function setRefCommande(int $uneRefCommande) {
        $this->refCommande = $uneRefCommande;
    }

    public function  getLibelle():string {
        return $this->libelle;
    }

    public function setLibelle(string $unLibelle) {
        $this->libelle = $unLibelle;
    }

    public function  getDateCmd():datetime {
        return $this->dateCmd;
    }

    public function setDateCmd(datetime $uneDateCmd) {
        $this->dateCmd = new DateTime($uneDateCmd);
    }

    public function  getDateActuelle():datetime {
        return $this->dateActuelle;
    }

    public function setDateActuelle(datetime $uneDateActuelle) {
        $this->dateActuelle = $uneDateActuelle;
    }

    public function getLesPhotos(): array {
        $photoUrls = array();
        foreach ($this->photos as $prod) {
            // Utiliser la méthode getPhotoProd pour récupérer la valeur de photoProd
            $photoUrls[] = $prod;
        }
        return $photoUrls;
    }

    public function setLesPhotos(Prod $lesP) {
        $this->photos[] = $lesP;
    }

}

