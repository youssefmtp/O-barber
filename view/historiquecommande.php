<?php
$title = 'Mes Commande | O\'Barber';
include 'header.php';
?>

    <link href="<?= SERVER_URL ?>/css/historiquecmd.css" rel="stylesheet"> 

    <div class="container col-3">
        <h4 class="titreHCmd">Mes commandes</h4>
    </div>

    <?php 

    foreach($lesCmds as $uneCmd){

        echo '
            <div class="container col-5 contenuHCmd ">
                <p class="lblStatutHCmd">STATUT DE LA COMMANDE : </p>

                <p class="lblStatut"> '. $uneCmd->getLibelle() .' le '. $uneCmd->getDateActuelle()->format('d/m/Y').' </p>



                <div class="trait2"></div>';

                
                    foreach($uneCmd->getLesPhotos() as $uneP){
                        echo '<img src="'.$uneP->getPhotoProd() .'" class="imgProdCmd" alt="Image de remplacement">';

                    }
                    

                echo ' <div class="trait2"></div>

                <div class="divInfoCmd">
                    <div class="divISCmd">
                        <p class="lblHCmd">N°Commande : </p> 
                        <p class="lblRCmd">'. $uneCmd->getRefCommande().'</p>
                    </div>
                    
                    
                    <div class="divISCmd">
                        <p class="lblHCmd">Date commande : </p> 
                        <p class="lblRCmd">'. $uneCmd->getDateCmd()->format('d/m/Y').'</p>
                    </div>
                    
                </div>

                <div class="divVoirCmd">
                    <a href="/detailcommande/' . $uneCmd->getRefCommande() .'/">VOIR LA COMMANDE</a>
                </div>
            </div> 
            
            
            <script src="/js/commande.js"></script>
            ';

    }

    ?>





<?php

include 'footer.php';
?>