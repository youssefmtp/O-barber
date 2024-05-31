<?php
$title = 'Réinitialisation du mot de passe | O\'Barber';
include 'header.php';
?>

    <link href="<?= SERVER_URL ?>/css/resetmdp.css" rel="stylesheet">


    <!-- Début de la Page Reset mdp -->
    <div class="container-fluid d-flex justify-content-center">
        <form name="form-connexion" method="post" action="<?= SERVER_URL?>/newpassword/" > 
                
            <fieldset>
                <legend class="laLegend">Nouveau mot de passe </legend>

                <div class="container text-center">
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <div class="form-group">
                                <input type="password" class="form-control" id="mdp" name="mdp" size="30" placeholder="Nouveau mot de passe">  
                            </div>                        
                        </div>

                        <div class="col-8 mt-3">
                            <div class="form-group">
                                <input type="password" class="form-control" id="mdpConfirmer" name="mdpConfirmer" size="30" placeholder="Confirmation du mot de passe" >  
                                <span id="msgFormErreurConnexion"> </span>
                                
                                <input type="text" hidden class="form-control" id="id" name="id" value="<?php if(isset($_GET['id'])){ echo $_GET['id']; } ?>">  
                                
                                <?php
                                if(isset($message)) {
                                    $msg = $message;
                                    echo "<p class='erreur-message'>$message</p>";
                                }
                                ?>
                            </div>
                    </div>
                </div>
            </fieldset>

            
            <div class="envoyerInfo">
                <button type="submit" id="envoyer-form" class="btn btn-primary btnNewPassword">Modifier</button>
            </div>

        </form>
    </div>
    <!-- Fin de la Page Reset mdp -->



<?php
include 'footer.php';
?>