<?php
$title = 'Commande | O\'Barber';
include 'header.php';
?>

    <link href="<?= SERVER_URL ?>/css/commande.css" rel="stylesheet"> 

    <div class="container">

        <div class="divCmd">
            <h4 class="titreCmd"> Votre commande n°<?php echo $_SESSION['newRef'] ?> a été enregistrée avec succès. </h4> 

            <p >Nous vous remercions de votre achat et de votre confiance.  Vous recevrez bientôt <br> un email de confirmation avec les détails de votre commande.</p>
        </div>

    </div>



<?php
include 'footer.php';
?>