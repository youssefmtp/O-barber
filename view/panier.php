<?php
$title = 'Panier | O\'Barber';
include 'header.php';
?>

        <div class="container ">
            <div class="row">   
                <div class="col-8 ">
                <h4 class="titrePanier"> MON PANIER </h4>
                 <?php  if(isset($_SESSION['panier'])){  
                    
                    echo '<div class="trait"></div>';
                        $prixTotal = 0.00;
                        $qte = 1;
                        // Parcourir les produits du panier
                         foreach($_SESSION['panier'] as $index => $produit){
                            $id = $produit['id'];
                            $image =  $produit['photo'];
                            $prix =  $produit['prix'];
                            $qte = $produit['quantite'];
                            $prixTotal += ($prix * $qte); 
                            $marque =  $produit['marque'];
                            $libelle =  $produit['libelle'];
                            $quantite = $produit['qteEnStock'];
                            

                            
                            
                            echo '<div class="container divPselection"> ';
                            echo '<a href="' .SERVER_URL.'/produits/details/'.$id .'/"> <img class="imageDuProduit2" src ="' .SERVER_URL .'/'. $image . '"   alt="' . $libelle . '"> </a>';
                            echo '<h4 class="lePrix"> '. number_format($prix, 2) .' € </h4>';
                            echo '<a href="#">
                            <img class="imageCroix" src ="' .SERVER_URL.'/img/croixI.png" onclick="supprimerDuPanier('.$index .')"  alt="' . $libelle . '">
                            </a>';
                            echo '<a href="' .SERVER_URL.'/produits/details/'.$id .'/ " class="leLienA"> <p class="leTitre"> '. $marque . '  -  '. $libelle. '</p> </a>';


                            

                            echo '<label for="quantite-produit"  id="lblprod">Qté</label>';                           

                            if ($quantite > 0) {
                                echo '<select name="quantite-produit" data-index="'.$index .'" id="quantite-produit">';
                                for ($i = 1; $i <= $quantite; $i++) {
                                    echo '<option onclick="majQuantite('.$index .', '. $i .')" value="' . $i . '" ' . ($qte == $i ? "selected" : '') . '> ' . $i . '</option>';
                                }
                                echo '</select> </div>';
                            }
                            
                            
                            echo '<div style="clear:both"></div>';
                           
                            echo '<div class="trait"></div>';
                            
                            
                            
                        }
                        // number_format permet de formater les nombres : récupère "2" chiffres après la virgule
                        echo '<div> 
                                    <h4 class="sousTotal"> SOUS TOTAL '. number_format($prixTotal, 2) .' € </h4>        
                            </div>';
                            
                        ?>
                    
                </div>

                <div class="col-4 divTotal">
                    <h4 class="titrePanier"> TOTAL </h4>
                    <?php echo '<div class="trait"></div>'; 
                     echo '<div> 
                     <h5 class="totalSomme"> Sous total '. number_format($prixTotal, 2) .' € </h5> 
                     <h5 class="totalLivraison"> Livraison </h5> ';

                    if(isset($_SESSION['prenom'])) {
                     
                    echo '<a href="/commande/" class="linkAjoute">
                        <p class="ajoutCommande" >PAIEMENT</p>
                    </a>';
                    } else {
                        echo '<a href="/connexion/" class="linkAjoute">
                        <p class="ajoutCommande" > PAIEMENT</p>
                    </a>';
                    }
                    echo '</div>';

                    ?>
                </div>
                    <?php   } else { ?>
                        <div class="container text-center">
                            <div class="row">
                                <div class="col divPVide">
                                    <p class="pVide">Votre panier est vide.</p>
                                    <a href="<?= SERVER_URL ?>/produits/" class="lVide">Continuez vos achats</a>
                                </div>
                            </div>
                        </div>
                        
                    <?php  }?>
                </div>
                


            </div>       
        </div>

        <script src="/js/panier.js"></script>


<?php
include 'footer.php';
?>
