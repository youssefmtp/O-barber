<?php
$title = 'Nos produits | O\'Barber';
include 'header.php';
?>

    <div class="container js-filter">
        <div class="js-filter-form">
            
            <div class="row justify-content-center" >
                <div class="col-4 text-center huiles">
                    <select class="triCategorie" id="triCategorie1" style="width:auto" name="triCategorie1">
                        <option value="" hidden>Huiles</option>
                        <?php
                        $afficheId = false;
                        foreach($lesProduitsHuiles as $unProduit){
                            if(!$afficheId){
                                echo '<option value="idCateg='. $unProduit->getIdCateg() .'">Tous</option>';
                                $afficheId = true;
                            }
                            echo '<option value="id='. $unProduit->getId() .'">'. $unProduit->getLibelle() .'</option>';
                        } ?>
                    </select>
                </div>

                <div class="col-4 text-center rassoires">
                    <select class="triCategorie" id="triCategorie2" style="width:auto" name="triCategorie2">
                        <option value="" hidden>Rassoires</option>
                        <?php
                        $afficheId = false;
                        foreach($lesProduitsRassoires as $unProduit){
                            if(!$afficheId){
                                echo '<option value="idCateg='. $unProduit->getIdCateg() .'">Tous</option>';
                                $afficheId = true;
                            }
                            echo '<option value="id='. $unProduit->getId() .'">'. $unProduit->getLibelle() .'</option>';
                        } ?>
                    </select>
                </div>

                <div class="col-4 text-center accessoires">
                    <select class="triCategorie" id="triCategorie3" style="width:auto" name="triCategorie3">
                        <option value="" hidden>Accessoires</option>
                        
                        <?php
                        $afficheId = false;
                        foreach($lesProduitsAccessoires as $unProduit){
                            if(!$afficheId){
                                echo '<option value="idCateg='. $unProduit->getIdCateg() .'">Tous</option>';
                                $afficheId = true;
                            }
                            echo '<option value="id='. $unProduit->getId() .'">'. $unProduit->getLibelle() .'</option>';
                        } ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="container js-filter-content">
            <!-- Affichage des produits -->
        </div>


        <div class="container text-center pagination">
             <!-- Affichage pagination -->
        </div>
    </div>
        

    

<?php


echo '<script src="/js/triProduit.js"></script>';

echo '<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>';

include 'footer.php';
?>