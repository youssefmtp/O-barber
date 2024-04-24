<?php
$title = 'Connexion | O\'Barber';
include 'header.php';
?>


    <!-- Début de la Page Connexion-->
    <div class="container-fluid d-flex justify-content-center maDiv">
        <form name="form-connexion" method="post" action="<?= SERVER_URL?>/login/" > 
                
            <fieldset>
                <legend class="laLegend">Identifiant du compte </legend>

                <div class="container text-center">
                    <div class="row justify-content-start">
                        <!-- identifiant de l'utilisateur -->
                        <div class="col-12">
                            <div class="form-group">
                                <input type="text" class="form-control" id="identifiant" name="identifiant" size="30" placeholder="Identifiant">  
                            </div>                        
                        </div>

                        <!-- mdp de l'utilisateur -->
                        <div class="col-12">
                            <div class="form-group">
                                <input type="password" class="form-control" id="lemdp" name="lemdp" size="30" placeholder="Mot de passe" >  
                                <span id="msgFormErreurConnexion"> </span>   
                                
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

            <section class="container-fluid d-flex justify-content-center">
                <div class="divInline">
                    <button type="btn" class="btn btn-outline-dark btnInscriptionPc"> <a class="leLienInscription" href="<?= SERVER_URL ?>/inscription/"> CRÉER UN COMPTE  </a></button> 
                    <button type="submit" id="envoyer-form" class="btn btn-dark">SE CONNECTER</button>
                </div>
            </section>
                



        </form>
    </div>
    <!-- Fin de la Page Connexion-->



<?php
include 'footer.php';
?>