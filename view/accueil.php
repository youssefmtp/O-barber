<?php
$title = 'Accueil | O\'Barber';
include 'header.php';
?>

<br><br><br>
<!-- Début de la page -->
        <div class="">   
            <img class="image-produit" src="<?= SERVER_URL ?>/img/saloncoiffure2.jpg" alt="imageBarbier">
            <div class="container">
                <h1 class="titreAcc">Prenez soin de votre barbe tel un barbier</h1>
            </div>
            <p class="paraAcc"> Sur notre site, vous trouverez une sélection de produits qui sauront vous satisfaire. 
                Nous proposons des huiles spécialement conçues pour favoriser la croissance de votre barbe, ainsi que 
                des huiles qui la rendront douce et agréable.
            </p>  
        </div>

        <!-- Saut de ligne -->
        <br> <br> <br>

        <!-- Début affichage de certains produits -->
        <div class="container text-center">
            <div class="row">
                <div class="col produit">
                    <h1 class="titreSAccueil"> Nos produits. </h1> <br>
                    <p> Pour bien entretenir votre barbe voici nos essentiels et pour plus de produits <br>
                        n'hésitez pas à vous sur notre page <a href="<?= SERVER_URL ?>/produits/" class="linkNosProds"> produits. </a> </p>
                </div>
            </div>
        </div>

        

        <br>
        
        <!-- Disposition des images -->
        <div class="container text-center">
            <div class="row align-items-center">
                <div class="card col affichageProduits2">
                    <a href="<?= SERVER_URL ?>/produits/details/1/">
                        <img src ="<?= SERVER_URL ?>/img/huile2.png" class="card-img-top affichageProduitsImg" alt="Huile pour barbe" >
                    </a>
                    <div class="titre-produit">
                        <a href="<?= SERVER_URL ?>/produits/details/1/">
                            <p class="paraProdAcc"> MaxBarber - Huile Croissa... </p>
                        </a>
                    </div>

                    <div class="tailleEtoile">
                        <img src ="<?= SERVER_URL ?>/img/etoile-avis.png" alt="Etoile">
                        <a href="#" class="linkNbAvis"> 0 avis</a>
                    </div>

                    <a href="#">
                        <p class="ajoutPanier" onclick="ajouterAuPanier(1)">Ajouter au panier 29,90€ </p>
                    </a>
                </div>

                <div class="card col affichageProduits2" >
                    <a href="<?= SERVER_URL ?>/produits/details/2/">
                        <img src ="<?= SERVER_URL ?>/img/poussebarbe2.png" alt="Rouleau pousse barbe" class="card-img-top affichageProduitsImg">
                    </a>
                    <div class="titre-produit"> 
                        <a href="<?= SERVER_URL ?>/produits/details/2/">
                            <p class="paraProdAcc">BeardRoller - Rouleau Pous... </p>
                        </a>
                    </div>

                    <div class="tailleEtoile">
                        <img src ="<?= SERVER_URL ?>/img/etoile-avis.png" alt="Etoile">
                        <a href="#" class="linkNbAvis"> 0 avis</a>
                    </div>
                    
                    <a href="#">
                    <p class="ajoutPanier" onclick="ajouterAuPanier(2)">Ajouter au panier 31,90€ </p>
                    </a>
                </div>
                
                <div class="card col affichageProduits2">
                    <a href="<?= SERVER_URL ?>/produits/details/3/">
                        <img src ="<?= SERVER_URL ?>/img/brosseobarber.jpg" alt="Brosse pour barbe" class="card-img-top affichageProduitsImg">
                    </a>
                    <div class="titre-produit">  
                        <a href="<?= SERVER_URL ?>/produits/details/3/">
                            <p class="paraProdAcc">O'barber - Brosse Pour Barbe</p>
                        </a>
                    </div>

                    <div class="tailleEtoile">
                        <img src ="<?= SERVER_URL ?>/img/etoile-avis.png" alt="Etoile">
                        <a href="#" class="linkNbAvis"> 0 avis</a>
                    </div>
                    <a href="#">
                        <p class="ajoutPanier" onclick="ajouterAuPanier(3)" >Ajouter au panier 9,90€</p>
                    </a>
                </div>

                <div class="card col affichageProduits2">
                    <a href="<?= SERVER_URL ?>/produits/details/4/">
                        <img src ="<?= SERVER_URL ?>/img/rasoir.jpg" alt="Rasoir" class="card-img-top affichageProduitsImg">
                    </a>
                    <div class="titre-produit">  
                        <a href="<?= SERVER_URL ?>/produits/details/4/">
                            <p class="paraProdAcc">O'barber - Rasoir Avec Lame</p>
                        </a>
                    </div>

                    <div class="tailleEtoile">
                        <img src ="<?= SERVER_URL ?>/img/etoile-avis.png" alt="Etoile">
                        <a href="#" class="linkNbAvis"> 0 avis</a>
                    </div>

                    <a href="#">
                        <p class="ajoutPanier" onclick="ajouterAuPanier(4)" >Ajouter au panier 24,90€</p>
                    </a>
                </div>

            </div>
        </div>

        <!-- Fin affichage de certains produits -->

        <!-- Saut de ligne -->
        <br> <br> <br>

        <!-- Début affichage des bestseller -->
        <div class="container affichageBestseller">
            <h1 class="titreSAccueil"> The bestseller. </h1> <br>
        </div>
        

        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="<?= SERVER_URL ?>/img/huile2.jpg" class="d-block w-100 imgCar" alt="image">
                    <h3 class="titre-labonnerecette"> <strong> La Bonne Recette </strong> </h3>
                    <p class="text-labonnerecette2">Tester notre huile validé par tous les barbier de France,
                        vous serait surpris de son efficacité.    
                    </p>
                    <a href="<?= SERVER_URL ?>/produits/details/1/">
                        <p class="btn-jeDecouvre">Je découvre</p>
                    </a>
                </div>
                <div class="carousel-item">
                    <img src="<?= SERVER_URL ?>/img/poussebarbe4.png" class="d-block w-100 imgCar" alt="image">
                    <h3 class="titre-beardroller"><strong> Beard-Roller </strong></h3>
                    <p class="text-beardroller2">Le Beard-Roller est l'outil révolutionnaire qui permettra de
                        stimuler les poiles même les plus endormis.    
                    </p>

                    <a href="<?= SERVER_URL ?>/produits/details/2/">
                        <p class="btn-jeDecouvre2">Je découvre</p>
                    </a> 
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <!-- Fin affichage des bestseller -->

        <br><br>
        <script src="<?= SERVER_URL ?>/js/recherche.js"></script>
        
<?php

include 'footer.php';
?>