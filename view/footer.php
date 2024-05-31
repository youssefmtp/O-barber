<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="<?= SERVER_URL ?>/css/style.css" rel="stylesheet"> 
    <title><?= $title ?></title>
  </head>
  <body>
    
  
          <!-- Début du footer -->

          <br>
        
        <footer>

            <div class="contenu-footer">
                <div class="bloc footer-apropos">
                    <h3 class="titreFooter">À propos</h3>
                    <p> <a href="<?= SERVER_URL ?>/conditionsdevente/" class="linkFooter">Conditions générales de vente</a> </p>
                    <p> <a href="<?= SERVER_URL ?>/livraisonetretour/" class="linkFooter">Livraison et politque de retour</a></p> 
                    <p> <a href="<?= SERVER_URL ?>/politiquedeconfidentialite/" class="linkFooter">Politique de confidentialité</a></p> 
                    <p> <a href="<?= SERVER_URL ?>/mentionlegales/" class="linkFooter">Mentions légales</a></p>
                </div>

                <div class="bloc footer-securite">
                    <h3 class="titreFooter">Sécuriser</h3>
                    <p class="paraFooter">Vos informations sont crypter et sécuriser d'ailleur nous 
                        ne conservons aucune données bancaires.
                    </p>
                </div>

                <div class="bloc footer-livraison">
                    <h3 class="titreFooter">Livraison rapide</h3>
                    <?php if(isset($_SESSION['prenom'])){
                            echo '<p> <a href="'. SERVER_URL .'/recapitulatif-commande/" class="linkFooter">Suivre ma commande</a></p>';
                        } else {
                            echo '<p> <a href="'. SERVER_URL .'/connexion/" class="linkFooter">Suivre ma commande</a></p>';
                        }
                        
                    ?>
                        
                    
                    <p class="paraFooter"> Livrer en 48/72 heures</p>
                    <p class="paraFooter">Avec suivie de livraison</p>
                </div>

                <div class="bloc footer-question">
                    <h3 class="titreFooter">Une question ?</h3>
                    <p class="paraFooter">Téléphone : 09 00 00 00 00</p>
                    <p class="paraFooter">E-mail : support@obarber.ovh</p>
                </div>

                
                
            </div>

            <div class="divCopyright">
                <p class="paraCopyright">© 2024 O'barber Tous droits réserver.</p>
            </div>

        </footer>
        
        <!-- Fin du footer -->
            
          
  </body>
</html>