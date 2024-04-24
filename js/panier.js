function majQuantite(index, nvlQte){

    console.log(index);
    console.log(nvlQte);

    fetch('refresh/'+  index + '/' +  nvlQte + '/',{
        method: 'GET'
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Réponse du serveur non valide');
        }
        location.reload(true);
    })
    .catch(error => console.error('Erreur :', error));
}








function ajouterAuPanier(idProduit){


    var qte = 1;
    var qteChoisie = document.getElementById('quantite-produit2');
    
    
    if(qteChoisie !== null){
        var choix = qteChoisie.selectedIndex;


        if(1 < qteChoisie.options[choix].value ){
            qte = qteChoisie.options[choix].value;
            console.log(qteChoisie.options[choix].value);
        }
    }

    

    fetch('ajouter-panier/' + idProduit + '/' + qte + '/', {
        method: 'GET'
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Réponse du serveur non valide');
        }

        // Rediriger vers la page du panier
        window.location.href = '/panier/';
    })
    .catch(error => console.error('Erreur :', error));
}

function supprimerDuPanier(index){
    fetch('supprimer-panier/' + index + '/', {
        method: 'GET'
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Réponse du serveur non valide');
        }

        // Rediriger vers la page du panier pour vider l'url
        window.location.href = '/panier/';
    })
    .catch(error => console.error('Erreur :', error));
}

