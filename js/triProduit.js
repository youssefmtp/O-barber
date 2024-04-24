var valeurSelectionneeElement = document.getElementById("valeurSelectionnee");
var selectElement1 = document.getElementById("triCategorie1");
var selectElement2 = document.getElementById("triCategorie2");
var selectElement3 = document.getElementById("triCategorie3");
var valeurSelectionnee = null;
var filtre = 'tous';
var produitParPage = 12;
var totalProduits = 0;
var pageCourante = 1;


var selectElements = [selectElement1, selectElement2, selectElement3];

// Ajoutez un gestionnaire d'événement "change" à chaque select
selectElements.forEach((select) => {
    select.addEventListener("change", function() {
        filtre = select.value;
        pageCourante = 1;
        triProduits(filtre, pageCourante);
    });
});


// Vérifier si le paramètre de recherche est vide
if (rechercheParam === null || rechercheParam.trim() === '') {
    // Si le paramètre de recherche est vide, appeler triProduits

    triProduits(filtre, pageCourante);
}



function afficherPagination(totalPages, pageCourante) {
    var paginationContainer = document.querySelector('.pagination');
    paginationContainer.innerHTML = '';

    if(totalPages > 0){

        // Bouton Précédent
        var prevButton = document.createElement('a');
        prevButton.href = '#';
        prevButton.textContent = '<';
        prevButton.addEventListener('click', function (event) {
            event.preventDefault();
            if (pageCourante > 1) {
                pageCourante--;
                triProduits(filtre, pageCourante);
            }
        });
        paginationContainer.appendChild(prevButton);

        for (var i = 1; i <= totalPages; i++) {
            var pageLink = document.createElement('a');
            pageLink.href = '#';
            pageLink.textContent = i;

            if (i === pageCourante) {
                pageLink.classList.add('active');
            }

            pageLink.addEventListener('click', function (event) {
                event.preventDefault();
                
                pageCourante = parseInt(event.target.textContent);
                triProduits(filtre, pageCourante);
            });

            paginationContainer.appendChild(pageLink);
        }

        // Bouton Suivant
        var nextButton = document.createElement('a');
        nextButton.href = '#';
        nextButton.textContent = '>';
        nextButton.addEventListener('click', function (event) {
            event.preventDefault();
            if (pageCourante < totalPages) {
                pageCourante++;
                
                triProduits(filtre, pageCourante);
            }
        });
        paginationContainer.appendChild(nextButton);
    }
}

function getTitreProduit(unProduit) {
    var titreLibelle = unProduit.marque + ' - ' + unProduit.libelle;
    return titreLibelle.length > 25 ? titreLibelle.substring(0, 25) + '...' : titreLibelle;
}



// Affiche le tableau trié contenant des produits avec la pagination
function triProduits(filtre, page) {
    fetch('produitFiltrer/' + filtre + '/', {
        method: 'GET'
    })
    .then(response => {
        if (!response.ok) {
            console.log('Code d\'état HTTP : ' + response.status);
            throw new Error('Erreur à l\'envoi de la requête');
        }
        return response.json();
    })
    .then(data => {
        if (data && data.length > 0) {
            // Paginer les données
            var debutIndex = (page - 1) * produitParPage;
            var finIndex = debutIndex + produitParPage;
            var produitsPage = data.slice(debutIndex, finIndex);

            var container = document.querySelector('.js-filter-content');

            // Vider le contenu du conteneur
            while (container.firstChild) {
                container.removeChild(container.firstChild);
            }

            var compteur = produitsPage.length;
            // Vider le contenu du conteneur
            container.innerHTML = ''; 

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

                    <a href="#" > <p class="ajoutPanier" onclick="ajouterAuPanier(${unProduit.id})" >Ajouter au panier ${Number(unProduit.prix).toFixed(2)}€</p> </a>
                </div> `;

                row.appendChild(produitDiv);

                compteur++;

                if ((index + 1) % 4 === 0 || index === produitsPage.length - 1) {
                    row = document.createElement('div');
                    row.className = 'row justify-content-center';
                    container.appendChild(row);
                }
            });

            totalProduits = data.length;
            console.log(page);

            afficherPagination(Math.ceil(totalProduits / produitParPage), page);

        } else {
            console.error('La requête ne comporte aucun élément à afficher.');
        }
    })
    .catch(error => {
        console.error('Erreur :', error);
    });
}
