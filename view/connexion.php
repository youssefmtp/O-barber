<?php
$title = 'Connexion | O\'Barber';
include 'header.php';
?>

    <link href="<?= SERVER_URL ?>/css/connexion.css" rel="stylesheet"> 


    <!-- Début de la Page Connexion-->
    <div class="container-fluid maDiv">
        <form name="form-connexion" method="post" action="<?= SERVER_URL?>/login/" > 
                
            <fieldset>
                <legend class="laLegend">Identifiant du compte </legend>

                <div class="container text-center">
                    <div class="row justify-content-start">
                        <!-- identifiant de l'utilisateur -->
                        <div class="col-12">
                            <div class="form-group">
                                <input type="text" class="form-control inputConnexion" id="identifiant" name="identifiant" placeholder="Identifiant">  
                            </div>                        
                        </div>

                        <!-- mdp de l'utilisateur -->
                        <div class="col-12 mt-2">
                            <div class="form-group">
                                <input type="password" class="form-control inputConnexion" id="lemdp" name="lemdp" size="30" placeholder="Mot de passe" >  
                                
                                <?php
                                if(isset($message)) {
                                    echo " <div class='divMsgErr'><p class='erreurMessage'> $message </p></div>";
                                }

                                // <p </p>
                                ?>

                                
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>

            <div class="container divBtns">
                <div class="divInline">
                    <button type="button" class="btn btnInscription"> <a class="leLienInscription" href="<?= SERVER_URL ?>/inscription/"> CRÉER UN COMPTE  </a></button> 
                    <button type="submit" id="envoyer-form" class="btn btnConnexion">SE CONNECTER</button>
                </div>
            </div>
                



        </form>
    </div>
    <!-- Fin de la Page Connexion-->



<?php
include 'footer.php';
?>