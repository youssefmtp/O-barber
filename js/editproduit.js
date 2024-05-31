function supprimerProd(idProduit){
    fetch('supprimer-produit/' + idProduit + '/', {
        method: 'GET'
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Réponse du serveur non valide');
        }

        suppressionReussi();

        // Rediriger vers la page des produits après la suppression
        window.location.href = '/produits/';
    })
    .catch(error => console.error('Erreur :', error));
}


function suppressionReussi(){
    alert('La suppression a été effectuée avec succès.');
}

const urlParams = new URLSearchParams(window.location.search);
    
    
if (urlParams.has('maj') && urlParams.get('maj') === '1') {
    alert('Le produit a été modifié avec succès.');
}