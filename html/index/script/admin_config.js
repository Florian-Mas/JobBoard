document.addEventListener("DOMContentLoaded", AdminVerification)



async function AdminVerification (){
  const request = await fetch("../../../php/admin/AdminVerify.php");
  const Admin = await request.json();
  console.log(Admin)
  if (!Admin["admin"]){
    window.location.href = "../../index/"+Admin["Link"];
  }
  adminConfig();
}


async function adminConfig() {
    fetch('../../../php/offer/OfferDisplay.php')
        .then(response => response.json())
        .then(json => {
            if (json.success) {
                adminCountAnnounces(json.data);
                console.log(json.data);
            } else {
                console.error("Erreur dans la réponse:", json);
            }
        })

}

async function adminCountAnnounces(offerdisplay) {
    fetch('../../../php/offer/OfferDisplay.php')
        .then(response => response.json())
        .then(json => {
            if (json.success) {
                displayAnnounce(json.data, offerdisplay);
                console.log(json.data);
            } else {
                console.error("Erreur dans la réponse:", json);
            }
        })

}

function displayAnnounce(count, announce) {
    const jobgrid = document.getElementById('AdminGrid');
    announce.forEach(div => {
        const div2 = document.createElement('div');
        div2.innerHTML = `
                    <div class="p-card bg-white p-2 rounded px-3 border border-dark">
                        <h5 class="mt-2">${div.Titre}</h5><span
                            class="badge badge-danger py-1 mb-2">Marketing &amp; Sales</span><span
                            class="d-block mb-5">${div.Description}</span>
                        <div class="d-flex justify-content-between stats">
                            <div><button type="button" class="btn btn-primary">Modifier</button>
                                <button type="button" class="btn btn-warning">Supprimer</button>
                                <button type="button" class="btn btn-danger">Bannir</button>
                            </div>
                        </div>
                    </div>
    `;
            const cardtext = document.getElementById('AnnounceCount')
        cardtext.textContent ="Annonce: " + announce.length ;
        div2.classList.add("col-md-3");
        jobgrid.appendChild(div2);
        
    });

}

function displayUsers(count, announce) {
    const jobgrid = document.getElementById('AdminGrid');
    announce.forEach(div => {
        const div2 = document.createElement('div');
        div2.innerHTML = `
                    <div class="p-card bg-white p-2 rounded px-3 border border-dark">
                        <h5 class="mt-2">${div.Titre}</h5><span
                            class="d-block mb-5">${div.Description}</span>
                        <div class="d-flex justify-content-between stats">
                            <div><button type="button" class="btn btn-primary">Modifier</button>
                                <button type="button" class="btn btn-warning">Supprimer</button>
                                <button type="button" class="btn btn-danger">Bannir</button>
                            </div>
                        </div>
                    </div>
    `;
            const cardtext = document.getElementById('AnnounceCount')
        cardtext.textContent ="Annonce: " + announce.length ;
        div2.classList.add("col-md-3");
        jobgrid.appendChild(div2);
    });

}




