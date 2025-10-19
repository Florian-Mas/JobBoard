document.addEventListener("DOMContentLoaded", enterpriseAnnounces)


async function enterpriseAnnounces() {
    fetch('../../php/companies/Enterprise_offer.php')
        .then(response => response.json())
        .then(json => {
            if (json.success) {
                console.log(json.data);
                displayAnnounce(json.data);
            } else {
                console.error("Erreur dans la réponse:", json);
            }
        })

}



async function enterpriseRecrutments() {
    fetch('../../php/application/ReceiveApplication.php')
        .then(response => response.json())
        .then(json => {
            if (json.success) {
                console.log(json.data)
                displayRecrutments(json.data)
            } else {
                console.error("Erreur dans la réponse:", json);
            }
        })

}

function displayAnnounce(announce) {
    const jobgrid = document.getElementById('AdminGrid');
    console.log("Données reçues :", announce);
    announce.forEach(div => {
        console.log(div);
        const div2 = document.createElement('div');
        div2.innerHTML = `
                    <div class="p-card bg-white p-2 rounded px-3 border border-dark">
                        <h5 class="mt-2">${div.Titre}</h5><span
                            class="badge badge-danger py-1 mb-2">Marketing &amp; Sales</span><span
                            class="d-block mb-5" style="max-width: 100px;">${div.Description}</span>
                        <div class="d-flex justify-content-between stats">
                            <div><button type="button" class="btn btn-primary">Modifier</button>
                                <button type="button" onclick="deleteAnnounce(${div.ID})" class="btn btn-warning">Supprimer</button>
                            </div>
                        </div>
                    </div>
    `;
        const cardtext = document.getElementById('AnnounceCount')
        cardtext.textContent = "Annonce: " + announce.length;
        div2.classList.add("col-md-3");
        div2.classList.add("overflow-hidden");
        jobgrid.appendChild(div2);

    });
    enterpriseRecrutments()

}



function displayRecrutments(data) {
    const jobgrid = document.getElementById('RecrutmentsGrid');
    console.log("Données reçues :", data);
    data.forEach(div => {
        console.log(div);
        const div2 = document.createElement('div');
        div2.innerHTML = `
                    <div class="p-card bg-white p-2 rounded px-3 border border-dark">
                        <h5 class="mt-2">${div.user_prenom} ${div.user_nom}</h5><span
                        <small class="mt-2">${div.phone_number}</small><span
                            class="badge badge-danger py-1 mb-2">Marketing &amp; Sales</span><span
                            class="d-block mb-5" style="max-width: 100px;">${div.email}</span>
                        <div class="d-flex justify-content-between stats">
                            <div><button type="button" class="btn btn-primary visually-hidden">Modifier</button>
                                <button type="button" onclick="deleteAnnounce()" class="btn btn-warning visually-hidden">Supprimer</button>
                            </div>
                        </div>
                    </div>
    `;
        const cardtext = document.getElementById('AnnounceCount')
        cardtext.textContent = "Annonce: " + data.length;
        div2.classList.add("col-md-3");
        div2.classList.add("overflow-hidden");
        jobgrid.appendChild(div2);

    });

}



async function deleteAnnounce(id) {
    const response = await fetch('../../php/offer/OfferDelete.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id })
    });

    const json = await response.json();

    if (json.success) {
        console.log("Suppression réussie");
    } else {
        console.error("Erreur dans la suppression :", json.error);
    }
}

function opAdmin() {

}
