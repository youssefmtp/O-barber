let modal = document.getElementById('modalConfirmation');


function modalDeleteClient(idClient){

    modal.style.display = "block";

    modal.innerHTML = `

        <div class="assombriLaPage"></div>

        <div class="divModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmer suppression</h5>
                    <button type="button" class="btn-close" onclick="masquerModal()"></button>
                </div>
                <div class="modal-body">
                    <p>Êtes-vous sûr de vouloir supprimer ce client ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btnValider" onclick="deleteClient(${idClient})">Valider</button>
                    <button type="button" class="btn btn-secondary" onclick="masquerModal()">Annuler</button>
                </div>
            </div>
        </div>`;

    
    
}


function masquerModal(){
    modal.style.display = "none";
}

function deleteClient(idClient){

    masquerModal();

    fetch('supprimer-client/' + idClient + '/', {
        method: 'GET'
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Réponse du serveur non valide');
        }

        location.reload();
    })
    .catch(error => console.error('Erreur :', error));
}