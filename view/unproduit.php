<?php
$title = $unProduit->getLibelle() .' | O\'Barber';
include 'header.php';
?>

<!-- Début de la page -->
<br><br><br><br>
    <div class="container divUnProd">

        <div class="row"> 
            
        <div class="col-5 divImgUnP">
            <img class="imageDuProduit"  src ="<?= SERVER_URL .'/' . $unProduit->getPhotoProd()?>" alt="<?= $unProduit->getLibelle() ?>"> 
            
        </div>

        <div class="col-7 divInfoUnProd"> 

            <h3> <?= $unProduit->getMarque() .' - '. $unProduit->getLibelle() ?></h3>

            <div class="tailleEtoile2">
                <img src ="<?= SERVER_URL ?>/img/etoile-avis.png" alt="Etoile">
                <a href="#"> 0 avis</a>
            </div>
            <p class="lePrix2"> <?= number_format($unProduit->getPrix(), 2)  ?>€  </p>  

            <p class="paraResume">  <?= $unProduit->getResume()  ?>  </p>  
            <?php    
            $qte =  $unProduit->getQteEnStock();
            $qteMax = 8;
            $i = 1;

            if($qte > 0){
                echo '<!-- Sélection la quantite -->
                <label for="quantite-produit2" class="lblQteUnP">Quantité : </label>
                <select name="quantite-produit2" id="quantite-produit2">';
                while($i <= $qteMax){
                echo' <option value="'. $i .'">'. $i .'</option>';
                $i++;
                }

                echo '</select>';
            } else {
                echo '<p> Rupture de stock </p>';
            }
            

            ?>

            
            <a href="#"> <p class="ajoutPanier2" onclick="ajouterAuPanier(<?=  $unProduit->getId() ?>)">  AJOUTER AU PANIER </p></a>
            
            

            
        </div>
        </div>
                
        <div style="clear:both"></div>
    </div>
            
    <!-- Lien vers le footer -->

            <br><br>



<?php
include 'footer.php';
?>