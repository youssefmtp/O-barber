<?php
$title = 'Détail de la commande | O\'Barber';
include 'header.php';
?>

    <link href="<?= SERVER_URL ?>/css/detailcommande.css" rel="stylesheet"> 

    <div class="container divG">
        <div class="divDetail">
            <h5>DÉTAILS DE LA COMMANDE</h5> 
            <p class="lblDetail" class="lblDetail">Merci pour votre commande ! Vérifiez les informations ci-dessous.</p>
        </div>

        <div class="divDetail">
            <p class="lblDetail">N° DE COMMANDE : <?= $refCmd ?></p>
            <?= '<p class="lblDetail"> DATE DE COMMANDE : ' . $dateCmd->format('d/m/Y') .'</p>'; ?>
        </div>

        <div class="divDetail">

            <h5>Adresse de livraison :</h5> 

            <div class="trait"></div>

            <?php
            echo '<p class="lblDetail">' . $leCli->getPrenom() .' ' . $leCli->getNom() . '</p>'; 

            echo '<p class="lblDetail">' . $laCmd->getAdLivraison() .'</p>';
            echo '<p class="lblDetail">' . $laCmd->getCpLivraison() .'</p>';
            echo '<p class="lblDetail">' . $laCmd->getVilleLivraison() .'</p>';
                
            echo '<p class="lblDetail">0' . $leCli->getTelephone() . '</p>'; ?>
        </div>

        <div class="divDetail">

        <?php
            $nbProd = 0;
            $nbProd = count($produitCmd);

            echo '
                <div class="divInfo"> 
                    <h5>Informations sur les produits</h5> 
                    <p class="paraDetail">'. $nbProd .' articles</p>
                </div>
            ';
        ?>


            <div class="trait"></div>

            <div class="row">

                <?php
                        $prixTotal = 0;
                        
                        foreach($produitCmd as $unP){
                            $prixTotal += ($unP->getPrix() * $unP->getQte());
                            

                            
                            echo '<div class="divDetailProd col-3">';
                            echo '<a href="/produits/details/'. $unP->getId() .'/"> <img src="/page/'. $unP->getPhotoProd() .'" alt="'. $unP->getLibelle().'" class="imgDetailProd" > </a>';

                            // limite le nombre de caractères du libellé à 30
                            $libelleCourt = substr($unP->getLibelle(), 0, 30);
                            
                            echo '<a href="/produits/details/'. $unP->getId() .'/" class="linkDetail">';
                                echo '<p class="lblDetail" class="linkDetail">' . $unP->getMarque() . ' - ' . $libelleCourt . '...</p>';
                            echo '</a>';
                                
                            echo '</div>';
                        }
                    
                ?>
            </div>
        </div>


        <div class="divDetail">
            <h5>Total commande</h5> 

            <div class="trait"></div>

            <?php
            echo '<p class="lblDetail">Sous-total :  '. number_format($prixTotal, 2) .' €</p>';
            echo '<p class="lblDetail">Livraison : 3.50 €</p>';

            echo '<div class="trait"></div>';

            // number_format permet de formater les nombres : récupère "2" chiffres après la virgule 

            echo '<p class="lblDetail">Total : '. number_format(($prixTotal + 3.5), 2)  .' €</p>';

            ?>
        </div>
    </div>



<?php
include 'footer.php';
?>