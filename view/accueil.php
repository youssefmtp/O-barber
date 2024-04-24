<?php
$title = 'Accueil | O\'Barber';
include 'header.php';
?>

<br><br><br>
<!-- Début de la page -->
<div class="container image-produit">   
            <img src="<?= SERVER_URL ?>/img/imageBarbier.png" alt="imageBarbier">
            <h1>Prenez soin de votre barbe tel un barbier</h1>
            <p> Sur notre site, vous trouverez une sélection de produits qui sauront vous satisfaire. 
                Nous proposons des huiles spécialement conçues pour favoriser la croissance de votre barbe, ainsi que 
                des huiles qui la rendront douce et agréable. 

            </p>  
            <div style="clear:both"></div>
        </div>

        <!-- Saut de ligne -->
        <br> <br> <br>

        <!-- Début affichage de certains produits -->
        <div class="container text-center">
            <div class="row">
                <div class="col produit">
                    <h1 > Nos produits. </h1> <br>
                    <p> Pour bien entretenir votre barbe voici nos essentiels et pour plus de produits <br>
                        n'hésitez pas à vous sur notre page <a href="<?= SERVER_URL ?>/produits/"> "Nos produits". </a> </p>
                </div>
            </div>
        </div>

        

        <br>
        
        <!-- Disposition des images -->
        <div class="container text-center">
            <div class="row align-items-center">
                <div class="card col affichageProduits2" style="width: 15rem;">
                    <a href="<?= SERVER_URL ?>/produits/details/1/">
                        <img src ="<?= SERVER_URL ?>/img/huile2.png" class="card-img-top affichageProduitsImg" alt="Huile pour barbe" >
                    </a>
                    <div class="titre-produit">
                        <a href="<?= SERVER_URL ?>/produits/details/1/">
                            <p> MaxBarber - Huile Croissa... </p>
                        </a>
                    </div>

                    <div class="tailleEtoile">
                        <img src ="<?= SERVER_URL ?>/img/etoile-avis.png" alt="Etoile">
                        <a href="#"> 0 avis</a>
                    </div>

                    <a href="#">
                        <p class="ajoutPanier" onclick="ajouterAuPanier(1)">Ajouter au panier 29,90€ </p>
                    </a>
                </div>

                <div class="card col affichageProduits2" style="width: 15rem;" >
                    <a href="<?= SERVER_URL ?>/produits/details/2/">
                        <img src ="<?= SERVER_URL ?>/img/poussebarbe2.png" alt="Rouleau pousse barbe" class="card-img-top affichageProduitsImg">
                    </a>
                    <div class="titre-produit"> 
                        <a href="<?= SERVER_URL ?>/produits/details/2/">
                            <p>BeardRoller - Rouleau Pous... </p>
                        </a>
                    </div>

                    <div class="tailleEtoile">
                        <img src ="<?= SERVER_URL ?>/img/etoile-avis.png" alt="Etoile">
                        <a href="#"> 0 avis</a>
                    </div>
                    
                    <a href="#">
                    <p class="ajoutPanier" onclick="ajouterAuPanier(2)">Ajouter au panier 31,90€ </p>
                    </a>
                </div>
                
                <div class="card col affichageProduits2" style="width: 15rem;">
                    <a href="<?= SERVER_URL ?>/produits/details/3/">
                        <img src ="<?= SERVER_URL ?>/img/brosseobarber.jpg" alt="Brosse pour barbe" class="card-img-top affichageProduitsImg">
                    </a>
                    <div class="titre-produit">  
                        <a href="<?= SERVER_URL ?>/produits/details/3/">
                            <p>O'barber - Brosse Pour Barbe</p>
                        </a>
                    </div>

                    <div class="tailleEtoile">
                        <img src ="<?= SERVER_URL ?>/img/etoile-avis.png" alt="Etoile">
                        <a href="#"> 0 avis</a>
                    </div>
                    <a href="#">
                        <p class="ajoutPanier" onclick="ajouterAuPanier(3)" >Ajouter au panier 9,90€</p>
                    </a>
                </div>

                <div class="card col affichageProduits2" style="width: 15rem;">
                    <a href="<?= SERVER_URL ?>/produits/details/4/">
                        <img src ="<?= SERVER_URL ?>/img/rasoir.jpg" alt="Rasoir" class="card-img-top affichageProduitsImg">
                    </a>
                    <div class="titre-produit">  
                        <a href="<?= SERVER_URL ?>/produits/details/4/">
                            <p>O'barber - Rasoir Avec Lame</p>
                        </a>
                    </div>

                    <div class="tailleEtoile">
                        <img src ="<?= SERVER_URL ?>/img/etoile-avis.png" alt="Etoile">
                        <a href="#"> 0 avis</a>
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
            <h1 > The bestseller. </h1> <br>

            <img src ="<?= SERVER_URL ?>/img/huile.jpg" alt="Image" width="1050px" class="imageCentre">
            <h3 class="text-labonnerecette"> <strong> La Bonne Recette </strong> </h3>
            <p class="text-labonnerecette2">Tester notre huile validé par tous les barbier de France,<br>
                vous serait surpris de son efficacité.    
            </p>
            <a href="<?= SERVER_URL ?>/produits/details/1/">
                <p class="btn-jeDecouvre">Je découvre</p>
            </a>
        </div>
        <br><br>
        <div class="container affichageBestseller2">
            
            <img src ="<?= SERVER_URL ?>/img/poussebarbe.png" alt="Image" width="1050px" class="imageCentre">
            <h3 class="text-beardroller"><strong> Beard-Roller </strong></h3>
            <p class="text-beardroller2">Le Beard-Roller est l'outil révolutionnaire qui permettra de <br>
                stimuler les poiles même les plus endormis.    
            </p>

            <a href="<?= SERVER_URL ?>/produits/details/2/">
                <p class="btn-jeDecouvre2">Je découvre</p>
            </a>

        </div>  
        <!-- Fin affichage des bestseller -->

        <br><br>
        <script src="<?= SERVER_URL ?>/js/recherche.js"></script>
        
<?php

include 'footer.php';
?>