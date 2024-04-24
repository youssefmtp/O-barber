<?php
$title = 'Inscription | O\'Barber';
include 'header.php';
?>

    <!-- formulaire d'incription-->
    <div class="container-fluid d-flex justify-content-center">
        <form name="form-inscription" method="post" action="<?= SERVER_URL ?>/inscription/new/" > 
            <fieldset>
                <legend>Information du compte </legend>

                <div class="container text-center">
                    <div class="row justify-content-start">
                        <!-- prenom de l'utilisateur -->
                        <div class="col-6">
                            <div class="form-group">
                                <input type="text" class="form-control" id="prenom" name="prenom" size="30" placeholder="Prénom *" >
                                <span id="msgFormPrenom"></span>   
                            </div>                        
                        </div>

                        <!-- nom de l'utilisateur -->
                        <div class="col-6">
                            <div class="form-group">
                                <input type="text" class="form-control" id="nom" name="nom" size="30" placeholder="Nom de famille *" >
                                <span id="msgFormNom"></span>  
                            </div>
                        </div>

                        <!-- date de naissance de l'utilisateur -->
                        <div class="col-6">
                            <div class="form-group">
                                <input type="date" class="form-control" id="date-naissance" name="date-naissance" size="30" min="1900-01-01"  max="2023-04-08" >
                                <span id="msgFormDateNaissance"></span>    
                            </div> 
                        </div>

                        <!-- genre de l'utilisateur -->    
                        <div class="col-6">
                            <section class="container-fluid genre">
                                <select name="genre-select" id="genre-select" >
                                    <option value="" id="leGenre">Genre *</option>
                                    <option value="homme">Homme</option>
                                    <option value="femme">Femme</option>
                                </select>
                            </section>
                            <span id="msgFormGenre"></span>  
                        </div>

                        <!-- code postal de l'utilisateur -->
                        <div class="col-6">
                            <div class="form-group">
                                <input type="text" class="form-control" id="codepostal" name="codepostal" size="30" placeholder="Code postal *" >
                                <span id="msgFormCodePostal"></span>  
                            </div>
                        </div>
                    </div>
                </div>

            </fieldset>

            <!-- Identifiant du compte -->

            <fieldset>

                <legend>Identifiant du compte </legend>

                <div class="container text-center">
                    <div class="row justify-content-start">
                        <!-- adresse mail de l'utilisateur -->
                        <div class="col-6">
                            <div class="form-group">
                                <input type="email" class="form-control" id="adresse-mail" name="adresse-mail" size="30" placeholder="Adresse mail *" oninput="checkInput()">  
                                <span id="msgFormMail"></span>   
                            </div>
                        </div>

                        <!-- mot de passe de l'utilisateur -->
                        <div class="col-6">
                            <div class="form-group">
                                <input type="password" class="form-control" id="mdp" name="mdp" size="30" placeholder="Mot de passe *" >
                                <span id="msgFormMdp"></span>     
                            </div>
                        </div>

                        <!-- num de tel de l'utilisateur -->
                        <div class="col-6">
                            <div class="form-group">
                                <input type="tel" class="form-control" id="numtel" name="numtel" size="30" placeholder="Numéro de téléphone *" >
                                <span id="msgFormNum"></span>     
                            </div> 
                        </div> 

                        <!-- confirmation du mot de passe de l'utilisateur -->
                        <div class="col-6">
                            <div class="form-group">
                                <input type="password" class="form-control" id="mdp-confirm" name="mdp-confirm" size="30" placeholder="Confirmation du mot de passe *" >
                                <span id="msgFormConfMdp"></span>   
                            </div> 
                        </div> 
                    </div>
                </div>



            </fieldset>

            <section class="container-fluid d-flex justify-content-end">
                <div>
                    <button type="submit" id="envoyer-form" class="btn btn-dark" >Valider</button>  
                </div>
                <?php
                if(isset($message)) {
                    $msg = $message;
                    echo "<p class='erreur-message'>$message</p>";
                }
                ?>                
            </section>
                



        </form>
    </div>





<?php
include 'footer.php';
?>