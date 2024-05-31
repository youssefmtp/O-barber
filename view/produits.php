<?php
$title = 'Nos produits | O\'Barber';
include 'header.php';
?>

    <div class="container js-filter">
        <div class="js-filter-form">
            
            <div class="row justify-content-center" >
                <div class="col-4 text-center">
                    <select class="triCategorie" id="triCategorie1" name="triCategorie1">
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

                <div class="col-4 text-center">
                    <select class="triCategorie" id="triCategorie2" name="triCategorie2">
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

                <div class="col-4 text-center">
                    <select class="triCategorie" id="triCategorie3" name="triCategorie3">
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

        <?php

            if(isset($_SESSION['idRole'])){
                if($_SESSION['idRole'] == 1){

                    echo '<div class="divNewProd" id="idRole" data-idrole="' . htmlspecialchars($_SESSION['idRole']) . '">
                        <a href="'.SERVER_URL .'/nouveau-produit/" class="linkNewProd"/> <p class="paraNewProd" id="plusIcon"><i class="fas fa-solid fa-plus iconPlus"></i></p> </a>
                    </div>';
                }
            }
        ?>

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