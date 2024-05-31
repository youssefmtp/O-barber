<!DOCTYPE html>
  <html lang="fr">
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="shortcut icon" href="<?= SERVER_URL ?>/img/logoP.png"/>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet" />
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
      <link href="<?= SERVER_URL ?>/css/style.css" rel="stylesheet"> 
      

      <title><?= $title ?></title>
    </head>
    <body>
      
    

      <section id="head">
        <div class="d-flex justify-content-between align-items-center">
          <div class="logo">
            <a href="<?= SERVER_URL ?>">
              <img src="<?= SERVER_URL ?>/img/logoobarber4.png" alt="logo">
            </a>
          </div>
          <div class="mini-nav ml-auto">
            
            
            <?php if(isset($_SESSION['prenom'])) { ?>
              <a class="nav-item nav-link"  href="<?= SERVER_URL ?>/profil/">
                <i class="fa-regular fa-user iconHeader" id="connexion"> </i>
              </a>
            <?php } else { ?>
              <a class="nav-item nav-link"  href="<?= SERVER_URL ?>/connexion/">
                <i class="fa-regular fa-user iconHeader" id="connexion"> </i>
              </a>
            <?php } ?>


            <a class="nav-item nav-link" href="<?= SERVER_URL ?>/panier/">
              <i class="fa-solid fa-cart-shopping iconHeader" id="panier"></i>
            </a>
            

          </div>
        </div>
      </section>

          <!-- Début du nav  Accueil -->
          <nav class="navbar navbar-expand-lg navbar-light bg-transparent">
              <div class="container justify-content-center ">
                  <div class="navbar-nav">
                  
                    <a class="nav-item nav-link " href="<?= SERVER_URL ?>">Accueil </a>
                    <a class="nav-item nav-link" href="<?= SERVER_URL ?>/produits/">Nos Produits</a>
                    <?php
                    if(isset($_SESSION['idRole']) & !empty($_SESSION['idRole'])){
                      if($_SESSION['idRole'] == 1){
                        echo '<a class="nav-item nav-link" href="'. SERVER_URL .'/clients/">Les Clients</a>';
                      } else {
                        echo '<a class="nav-item nav-link" href="'. SERVER_URL .'/contact/">Contact</a>';
                      }
                    } else {
                      echo '<a class="nav-item nav-link" href="'. SERVER_URL .'/contact/">Contact</a>';
                    }
                      
                    ?>


                      <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle"  id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Espace membre
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                      <?php if(isset($_SESSION['prenom'])) { 
                          if($_SESSION['idRole'] == 1){
                            echo '
                            <a class="dropdown-item" href="'. SERVER_URL .'/profil/">Modifier le profil</a>
                            <a class="dropdown-item" href="'. SERVER_URL .'/deconnexion/">Se déconnecter</a> ';
                          } else {
                            echo '
                            <a class="dropdown-item" href="'. SERVER_URL .'/profil/">Modifier le profil</a>
                            <a class="dropdown-item" href="'. SERVER_URL .'/recapitulatif-commande/">Commandes</a>
                            <a class="dropdown-item" href="'. SERVER_URL .'/deconnexion/">Se déconnecter</a> ';
                          }
                          
                           } else { 
                          echo'<a class="dropdown-item" href="'. SERVER_URL .'/connexion/">Se connecter</a>
                          <a class="dropdown-item" href="'. SERVER_URL .'/inscription/">S\'inscrire</a> ';
                           } ?>
                  </div>
              </li>
                  </div>
              </div>
              
          </nav>

          <div class="form-group recherche">
            <input class="form-control inputRecherche" type="search" id="recherche" placeholder="Rechercher">
            <ul id="listeProduit" class="suggestions-liste"></ul> 
          </div>  

          
      <!-- Lien qui inclus la bibliotheque jsquery -->
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="/js/recherche.js"></script>
      <script src="/js/panier.js"></script>
            
    </body>
  </html>