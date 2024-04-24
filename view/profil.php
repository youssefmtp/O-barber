<?php
$title = 'Mon Compte | O\'Barber';
include 'header.php';
?>

<?php 
    $prenom = $_SESSION['prenom'];
    $nom = $_SESSION['nom'];
    $adresseMail = $_SESSION['mail'];
    $num = $_SESSION['telephone'];
    $adresse = $_SESSION['adresse'];
    $cp = $_SESSION['cp'];
    $ville = $_SESSION['ville'];
?>

        <form name="form-profil" method="post" action="<?= SERVER_URL?>/edit/">
            <fieldset> 
                <legend class="pTitre">Profil </legend>
                
                <div class="row justify-content dec"> <!-- Utilisez la classe justify-content pour centrer horizontalement la rangée -->
                    <div class="col-md-5">
                        <div class="form-group form-inline ">
                            <label for="prenom-utilisateur">Prénom : </label>
                            <input id="prenom-utilisateur" name="prenom-utilisateur" size="30" class="form-control ml-2" type="text" value="<?php echo $prenom; ?>">
                        </div>
                        <span style="text-align:center" id="msgFormPrenom"></span>
                    </div>

                    <div class="col-md-5 ">
                        <div class="form-group form-inline">
                            <label for="nom-utilisateur">Nom : </label>
                            <input id="nom-utilisateur" name="nom-utilisateur" size="30" class="form-control ml-2" type="text" value="<?php echo $nom; ?>">
                        </div>
                        <span style="text-align:center" id="msgFormNom"></span>
                    </div>
                </div>


                <div class="row justify-content dec"> <!-- Utilisez la classe justify-content pour centrer horizontalement la rangée -->
                    <div class="col-md-5">
                        <div class="form-group form-inline ">
                            <label for="mail-utilisateur">Adresse mail : </label>
                            <input id="mail-utilisateur" name="mail-utilisateur" size="26" class="form-control ml-2" type="mail" value="<?php echo $adresseMail; ?>">
                        </div>
                        <span style="text-align:center" id="msgFormMail"></span>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group form-inline">
                            <label for="num-utilisateur">Numéro de téléphone : </label>
                            <input id="num-utilisateur" name="num-utilisateur" size="17" class="form-control ml-2" type="text" value="0<?php echo intval($num); ?>">
                        </div>
                        <span style="text-align:center" id="msgFormNum"></span>
                    </div>
                </div>


                <div class="row justify-content dec"> <!-- Utilisez la classe justify-content-center pour centrer horizontalement la rangée -->
                    <div class="col-md-5">
                        <div class="form-group form-inline ">
                            <label for="adresse-utilisateur">Adresse postal : </label>
                            <input id="adresse-utilisateur" name="adresse-utilisateur" size="25" class="form-control ml-2" type="text" value="<?php echo $adresse; ?>">
                        </div>
                        <span style="text-align:center" id="msgFormAdresse"></span>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group form-inline">
                            <label for="cp-utilisateur">Code postal : </label>
                            <input id="cp-utilisateur" name="cp-utilisateur" size="25" class="form-control ml-2" type="text" value="<?php echo $cp; ?>">
                        </div>
                        <span style="text-align:center" id="msgFormCodePostal"></span>
                    </div>
                </div>

                <div class="row justify-content dec"> <!-- Utilisez la classe justify-content  pour centrer horizontalement la rangée -->
                    <div class="col-md-6">
                        <div class="form-group form-inline ">
                            <label for="ville-utilisateur">Ville : </label>
                            <input id="ville-utilisateur" name="ville-utilisateur" size="33" class="form-control ml-2" type="text" value="<?php echo $ville; ?>">
                        </div>
                        <span style="text-align:center" id="msgFormVille"></span>
                    </div>
                </div>

                
                <div class="row justify-content dec"> <!-- Utilisez la classe justify-content pour centrer horizontalement la rangée -->
                    <div class="col-md-5">
                        <div class="form-group form-inline ">
                            <label for="mdp">Nouveau mot de passe : </label>
                            <input id="mdp" name="mdp" size="18" class="form-control ml-2" type="password" value="">
                        </div>
                        <span style="text-align:center" id="msgFormMdp"></span>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group form-inline">
                            <label for="cfm-mdp">Confirmer le mot de passe : </label>
                            <input id="cfm-mdp" name="cfm-mdp"  size="14" class="form-control ml-2" type="password" value="">
                        </div>
                        <span style="text-align:center" id="msgFormConfMdp"></span>
                    </div>
                </div>

                
                <section class="container-fluid d-flex justify-content-center">
                    <div>
                        <button type="submit" id="envoyer-form" class="btn btn-dark">Modifier mes informations</button>
                    </div>
                </section>

            </fieldset> 
        </form>

<?php
include 'footer.php';
?>