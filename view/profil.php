<?php
$title = 'Mon Compte | O\'Barber';
include 'header.php';
?>

<link href="<?= SERVER_URL ?>/css/profil.css" rel="stylesheet"> 

<?php 
    $prenom = $_SESSION['prenom'];
    $nom = $_SESSION['nom'];
    $adresseMail = $_SESSION['mail'];
    $num = $_SESSION['telephone'];

    if(isset($_SESSION['adresse'])){
        $adresse = $_SESSION['adresse'];
    }


    if(isset($_SESSION['ville'])){
        $ville = $_SESSION['ville'];
    }

    
    $cp = $_SESSION['cp'];

?>
        <?php

            if(isset($message)){
                echo '<div class="divMess">
                        <p class="alert alert-danger messAlerte">'. $message . '</p>
                    </div>';

            }

        ?>

        <form name="form-profil" method="post" action="<?= SERVER_URL?>/edit/">
            <fieldset> 
                <legend class="pTitre">Profil </legend>
                <div class="container divProfil">
                
                <div class=" ">
                
                    <div class="row"> 
                        <div class="col-6">
                            <div class="form-group ">
                                <label class="lblProfil" for="prenom-utilisateur">Prénom : </label>
                                <input id="prenom-utilisateur" name="prenom-utilisateur" class="form-control iptProfil" type="text" value="<?php echo $prenom; ?>">
                            </div>
                            <span style="text-align:center" id="msgFormPrenom"></span>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label class="lblProfil" for="nom-utilisateur">Nom : </label>
                                <input id="nom-utilisateur" name="nom-utilisateur" class="form-control iptProfil" type="text" value="<?php echo $nom; ?>">
                            </div>
                            <span style="text-align:center" id="msgFormNom"></span>
                        </div>
                    </div>


                    <div class="row mt-2"> 
                        <div class="col-6">
                            <div class="form-group ">
                                <label class="lblProfil" for="mail-utilisateur">Adresse mail : </label>
                                <input id="mail-utilisateur" name="mail-utilisateur" class="form-control iptProfil" type="mail" value="<?php echo $adresseMail; ?>">
                            </div>
                            <span style="text-align:center" id="msgFormMail"></span>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label class="lblProfil" for="num-utilisateur">Numéro de téléphone : </label>
                                <input id="num-utilisateur" name="num-utilisateur" class="form-control iptProfil" type="text" value="0<?php echo intval($num); ?>">
                            </div>
                            <span style="text-align:center" id="msgFormNum"></span>
                        </div>
                    </div>


                    <div class="row mt-2"> 
                        <div class="col-6">
                            <div class="form-group ">
                                <label class="lblProfil" for="adresse-utilisateur">Adresse postal : </label>
                                <input id="adresse-utilisateur" name="adresse-utilisateur" class="form-control iptProfil" type="text" value="<?php if(isset($adresse)){ echo $adresse; } ?>">
                            </div>
                            <span style="text-align:center" id="msgFormAdresse"></span>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label class="lblProfil" for="cp-utilisateur">Code postal : </label>
                                <input id="cp-utilisateur" name="cp-utilisateur" class="form-control iptProfil" type="text" value="<?php echo $cp; ?>">
                            </div>
                            <span style="text-align:center" id="msgFormCodePostal"></span>
                        </div>
                    </div>

                    <div class="row mt-2"> 
                        <div class="col-md-10">
                            <div class="form-group">
                                <label class="lblProfil" for="ville-utilisateur">Ville : </label>
                                <input id="ville-utilisateur" name="ville-utilisateur" class="form-control iptProfil" type="text" value="<?php if(isset($ville)){ echo $ville; } ?>">
                            </div>
                            <span style="text-align:center" id="msgFormVille"></span>
                        </div>
                    </div>

                    
                    <div class="row mt-2"> 
                        <div class="col-6">
                            <div class="form-group ">
                                <label class="lblProfil" for="mdp">Nouveau mot de passe : </label>
                                <input id="mdp" name="mdp" class="form-control iptProfil" type="password" value="">
                            </div>
                            <span style="text-align:center" id="msgFormMdp"></span>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label class="lblProfil" for="cfm-mdp">Confirmer le mot de passe : </label>
                                <input id="cfm-mdp" name="cfm-mdp"  class="form-control iptProfil" type="password" value="">
                            </div>
                            <span style="text-align:center" id="msgFormConfMdp"></span>
                        </div>
                    </div>

                </div>
                </div>

                
                
                <div class="container divBtn"> 
                    <button type="submit" id="envoyer-form" class="btn btnModifier">Modifier mes informations</button>
                </div>
                

            </fieldset> 
        </form>

<?php
include 'footer.php';
?>