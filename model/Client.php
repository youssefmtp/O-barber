<?php
/**
 * /model/Client.php
 * Définition de la class Client
 *
 * @author Y.Ennour
 * @date 07/2023
 */

 class Client {
    /*
    * Attributs
    */
    private int $idClient, $telephone, $cp;
    private string $nom, $prenom, $genre, $mail, $adresse, $ville, $mdp;
    private datetime $dateNaissance;



    /*
    * Constructeur
    */
    public function __construct(int $unId, string $unNom, string $unPrenom, string $unGenre, datetime $uneDateNaissance, string $unMail, string $uneAdresse, 
    string $uneVille, int $unCp, int $unTelephone, string $unMdp) {
        $this->idClient = $unId;
        $this->nom = $unNom;
        $this->prenom = $unPrenom;
        $this->genre = $unGenre;
        $this->dateNaissance = $uneDateNaissance;
        $this->mail = $unMail;
        $this->adresse = $uneAdresse;
        $this->ville = $uneVille;
        $this->cp = $unCp;
        $this->telephone = $unTelephone;
        $this->mdp = $unMdp;
    }


    // Accesseur 
    public function  getId():int {
        return $this->idClient;
    }

    public function setId(int $unId) {
        $this->idClient = $unId;
    }

    public function  getNom():string {
        return $this->nom;
    }

    public function setNom(string $unNom) {
        $this->nom = $unNom;
    }

    public function  getPrenom():string {
        return $this->prenom;
    }

    public function setPrenom(string $unPrenom) {
        $this->prenom = $unPrenom;
    }

    public function  getGenre():string {
        return $this->genre;
    }

    public function setGenre(string $unGenre) {
        $this->genre = $unGenre;
    }

    public function  getDateNaissance():datetime {
        return $this->dateNaissance;
    }

    public function setDateNaissance(datetime $uneDateNaissance) {
        $this->dateNaissance = $uneDateNaissance;
    }

    public function getMail():string {
        return $this->mail;
    }

    public function setMail(string $unMail) {
        $this->mail = $unMail;
    }

    public function  getAdresse():string {
        return $this->adresse;
    }

    public function setAdresse(string $uneAdresse) {
        $this->adresse = $uneAdresse;
    }

    public function  getVille():string {
        return $this->ville;
    }

    public function setVille(string $uneVille) {
        $this->ville = $uneVille;
    }

    public function  getCp():int {
        return $this->cp;
    }

    public function setCp(int $unCp) {
        $this->cp = $unCp;
    }

    public function  getTelephone():int {
        return $this->telephone;
    }

    public function setTelephone(int $unTelephone) {
        $this->telephone = $unTelephone;
    }

    public function  getMdp():string {
        return $this->mdp;
    }

    public function setMdp(string $unMdp) {
        $this->mdp = $unMdp;
    }

}
?>