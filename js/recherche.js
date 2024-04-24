var champRecherche = document.getElementById('recherche');
var listeSuggestions = document.getElementById('listeProduit');
var valeurRecherche = '';
var estVide = false;

champRecherche.addEventListener('input', function() {
    valeurRecherche = champRecherche.value.trim();
    

    if (valeurRecherche === '') {
        // Si le champ de recherche est vide, effacer la liste des suggestions
        listeSuggestions.innerHTML = '';
    } else {
        
        // Utiliser fetch pour effectuer la requête AJAX
        fetch('recherche/' + valeurRecherche + '/')
        .then(response => response.json())
        .then(suggestions => afficherSuggestions(suggestions))
        .catch(error => console.error('Erreur :', error));
    }
});


// Récupérer le paramètre de recherche de l'URL
var urlSearchParams = new URLSearchParams(window.location.search);
var rechercheParam = urlSearchParams.get('search');


// Vérifier si le paramètre de recherche n'est pas vide
if (rechercheParam !== null && rechercheParam.trim() !== '') {
    // La valeur de recherche n'est pas vide, appeler chargerProduitsParRecherche
    chargerProduitsParRecherche(rechercheParam);
}
// Ajouter l'écouteur d'événements pour la touche "Entrée"
champRecherche.addEventListener('keydown', (e) => {
    if (e.key === 'Enter') {
  
        // Si l'utilisateur appuie sur la touche "Entrée", effectuer la recherche
        valeurRecherche = champRecherche.value.trim();
        listeSuggestions.innerHTML = '';

        var url = window.location.pathname;
        if (url !== '/produits/') {
            // Rediriger vers la page 'produits/' avec le paramètre de recherche
            window.location.assign('/produits/?search=' + encodeURIComponent(valeurRecherche));
            console.log(valeurRecherche);
        } else {
            // Si déjà sur la page 'produits/', charger les produits par recherche
            chargerProduitsParRecherche(valeurRecherche);
        }
    }
});

function chargerProduitsParRecherche(valeurRecherche) {
    console.log('Recherche en cours avec la valeur :', valeurRecherche);

    // Utilisez fetch pour effectuer la requête AJAX pour charger les produits en fonction de la recherche
    fetch('produitRechercher/' + valeurRecherche + '/')
        .then(response => response.json())
        .then(produits => afficherProduits(produits))
        .catch(error => console.error('Erreur :', error));
}

function afficherSuggestions(suggestions) {
  // Effacer les suggestions précédentes
  listeSuggestions.innerHTML = '';

  if (!Array.isArray(suggestions)) {
    console.error('Réponse non valide :', suggestions);
    return;
  }

  // Créer un conteneur pour les suggestions
  const suggestionsContainer = document.createElement('div');
  suggestionsContainer.classList.add('suggestions-container');

  suggestions.forEach(suggestion => {
    const li = document.createElement('li');
    li.classList.add('suggestion');
    li.textContent = suggestion.libelle;
    li.addEventListener('click', () => {
      // Définir la suggestion sélectionnée dans le champ de saisie
      champRecherche.value = suggestion.libelle;
      // Effacer les suggestions
      listeSuggestions.innerHTML = '';
      document.getElementById('listeProduit').innerHTML = '';


      var url = window.location.pathname;
        if (url !== '/produits/') {
            // Rediriger vers la page 'produits/' avec le paramètre de recherche
            window.location.assign('/produits/?search=' + encodeURIComponent(valeurRecherche));
            console.log(valeurRecherche);
        } else {
          
            // Si déjà sur la page 'produits/', charger les produits par recherche
            chargerProduitsParRecherche(valeurRecherche);
        }
        
    });

    suggestionsContainer.appendChild(li);
  });

  // Ajouter box-sizing: border-box pour éviter le décalage
  suggestionsContainer.style.boxSizing = 'border-box';

  // Ajouter le conteneur des suggestions à votre liste de suggestions
  listeSuggestions.appendChild(suggestionsContainer);
}

// Fermer les suggestions en cliquant en dehors du champ de saisie et de la liste des suggestions
document.addEventListener('click', (e) => {
  if (e.target !== champRecherche && e.target !== listeSuggestions) {
    listeSuggestions.innerHTML = '';
  }
});

// Éviter la fermeture des suggestions lors du clic à l'intérieur du champ de saisie ou de la liste des suggestions
champRecherche.addEventListener('click', (e) => {
  e.stopPropagation();
});





function afficherProduits(produits) {

  var container = document.querySelector('.js-filter-content');
  
  // Vider le contenu du conteneur
  while (container.firstChild) {
      container.removeChild(container.firstChild);
  }

  // Vérifier si des produits ont été retournés
  if (produits && produits.length > 0) {
      // Paginer les données
      var debutIndex = (pageCourante - 1) * produitParPage;
      var finIndex = debutIndex + produitParPage;
      var produitsPage = produits.slice(debutIndex, finIndex);

      var compteur = produitsPage.length;
      var row = document.createElement('div');
      row.className = 'row justify-content-center';
      container.appendChild(row);

      produitsPage.forEach((unProduit, index) => {
        var produitDiv = document.createElement('div');
        produitDiv.className = 'card col-3 affichageProduits';

        produitDiv.innerHTML = `
            <a href="/produits/details/${unProduit.id}/"> <img src="/page/${unProduit.photoProd}" alt="${unProduit.libelle}" class="affichageProduitsImg"> </a>

            <div class="titre-produit">
                <a href="/produits/details/${unProduit.id}/" class="linkLi" > <p>${getTitreProduit(unProduit)}</p> </a>
            </div>

            <div class="tailleEtoile">
                <img src="/img/etoile-avis.png" alt="Etoile" class="tailleEtoileImg">
                <a href="#" class="linkAvis">0 avis</a>
            </div>

            <a href="/produits/ajouter-panier/${unProduit.id}/" > <p class="ajoutPanier">Ajouter au panier ${Number(unProduit.prix).toFixed(2)}€</p> </a>
          </div> `;

          row.appendChild(produitDiv);

          compteur++;

          if ((index + 1) % 4 === 0 || index === produitsPage.length - 1) {
              row = document.createElement('div');
              row.className = 'row justify-content-center';
              container.appendChild(row);
          }
      });

      totalProduits = produits.length;
      afficherPagination(Math.ceil(totalProduits / produitParPage), pageCourante);
  } else {
      // Afficher un message d'erreur
      estVide = true;
      var errorMessage = document.createElement('p');
      errorMessage.textContent = 'Aucun résultat trouvé pour votre saisie.';
      errorMessage.classList.add('erreur-message'); 
      container.appendChild(errorMessage);
      console.error('La requête ne comporte aucun élément à afficher.');
  }
}