<?php

/**
 * /view/bienvenue.php
 * 
 * Page de bienvenue
 *
 * @author Y.ENNOUR
 * @date 07/2023
 */

$title = 'Bienvenue | O\'Barber';
include 'header.php';

?> 



    <h3 class="sucess inscription"> Inscription réussit </h3>
    <p class="para-inscription"> Bienvenue <?= $_SESSION['prenom']?>, vous pouvez continuer vos achats en vous rendant 
    <br> sur notre page  <a class="lesLiens" href="<?= SERVER_URL ?>/produits/"> produits. </a> </p>
       

<?php 
    include 'footer.php'; 
?>