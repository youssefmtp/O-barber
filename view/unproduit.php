<?php
$title = $unProduit->getLibelle() .' | O\'Barber';
include 'header.php';
?>

<!-- Début de la page -->
<br><br><br>
    <div class="container image-produit2">
            
        <div class="col-11">
            <img class="imageDuProduit"  src ="<?= SERVER_URL .'/' . $unProduit->getPhotoProd()?>" alt="<?= $unProduit->getLibelle() ?>"> 
            <h3> <?= $unProduit->getMarque() .' - '. $unProduit->getLibelle() ?></h3>

            <div class="tailleEtoile2">
                <img src ="<?= SERVER_URL ?>/img/etoile-avis.png" alt="Etoile">
                <a href="#"> 0 avis</a>
            </div>
            <p class="lePrix2"> <?= number_format($unProduit->getPrix(), 2)  ?> €  </p>  

            <p >  <?= $unProduit->getResume()  ?>  </p>  
            <?php    
            $qte =  $unProduit->getQteEnStock();
            $qteMax = 5;
            $i = 1;

            if($qte > 0){
                echo '<!-- Sélection la quantite -->
                <label for="quantite-produit2">Quantité : </label>
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

            
            <a href="#"  > <p class="ajoutPanier2" onclick="ajouterAuPanier(<?=  $unProduit->getId() ?>)">  AJOUTER AU PANIER </p></a>
           
            

            
            
            
                
        </div>
        <div style="clear:both"></div>
    </div>
            
    <!-- Lien vers le footer -->





<?php
include 'footer.php';
?>