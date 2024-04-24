<!DOCTYPE html>
  <html lang="fr">
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="shortcut icon" href="<?= SERVER_URL ?>/img/logoP.png"/>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
      <!-- Lien vers la feuille css -->
      <link href="<?= SERVER_URL ?>/css/style.css" rel="stylesheet"> 
      

      <title><?= $title ?></title>
    </head>
    <body>
      
    

      <section id="head">
        <div class="d-flex justify-content-between align-items-center">
          <div class="logo">
            <a href="<?= SERVER_URL ?>">
              <img src="<?= SERVER_URL ?>/img/logoclrnoir.png" alt="logo">
            </a>
          </div>
          <div class="mini-nav ml-auto">
            
            
            <?php if(isset($_SESSION['prenom'])) { ?>
              <a class="nav-item nav-link"  href="<?= SERVER_URL ?>/profil/">
                <img src="<?= SERVER_URL ?>/img/bonhomme.jpg" id="connexion" alt="Image" width="30px">
              </a>
            <?php } else { ?>
              <a class="nav-item nav-link"  href="<?= SERVER_URL ?>/connexion/">
                <img src="<?= SERVER_URL ?>/img/bonhomme.jpg" id="connexion" alt="Image" width="30px">
              </a>
            <?php } ?>


            <a class="nav-item nav-link"   href="<?= SERVER_URL ?>/panier/">
              <img src="<?= SERVER_URL ?>/img/panier.png" id="panier" alt="Image" width="35px">
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
                      <a class="nav-item nav-link" href="<?= SERVER_URL ?>/contact/">Contact</a>

                      <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle"  id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Espace membre
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                      <?php if(isset($_SESSION['prenom'])) { ?>
                          <a class="dropdown-item" href="<?= SERVER_URL ?>/profil/">Modifier le profil</a>
                          <a class="dropdown-item" href="<?= SERVER_URL ?>/recapitulatif-commande/">Commandes</a>
                          <a class="dropdown-item" href="<?= SERVER_URL ?>/deconnexion/">Se déconnecter</a>
                      <?php } else { ?>
                          <a class="dropdown-item" href="<?= SERVER_URL ?>/connexion/">Se connecter</a>
                          <a class="dropdown-item" href="<?= SERVER_URL ?>/inscription/">S'inscrire</a>
                      <?php } ?>
                  </div>
              </li>
                  </div>
              </div>
              
          </nav>

          <div class="form-group recherche">
            <input class="form-control" type="search" id="recherche" placeholder="Rechercher">
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