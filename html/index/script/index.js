document.addEventListener("DOMContentLoaded", lunchLoad)
document.getElementById("deconnexion").addEventListener("click", deco)
document.getElementById("AdminMenu").addEventListener("click", GoAdminMenu)

var Admin;

async function lunchLoad() {
    fetch('../../php/offer/OfferDisplay.php')
        .then(response => response.json())
        .then(json => {
            if (json.success) {
                displayAnnounce(json.data);

            } else {
                console.error("Erreur dans la réponse:", json);
            }
        })

}

async function userReadAutoFill() {
    fetch('../../php/users/ReadUser.php')
        .then(response => response.json())
        .then(json => {
            if (json.success) {
                console.log(json.data)
                const FillName = document.getElementById('name');
                FillName.value = json.data['Nom'];

                const FillPrenom = document.getElementById('prenom');
                FillPrenom.value = json.data['Prénom'];

                const Fillmail = document.getElementById('mail');
                Fillmail.value = json.data['Email'];

                const FillPhoneNumber = document.getElementById('phone_number');
                FillPhoneNumber.value = json.data['Tel'];
            } else {
                console.error("Erreur dans la réponse:", json);
            }
        })
}



function displayAnnounce(announce) {
    const jobgrid = document.getElementById('jobgrid');
    announce.forEach(div => {
        const div2 = document.createElement('div');
        console.log(div);
        div2.innerHTML = `
                    <div class="">
                        <h3>${div.Titre}</h3>
                        <h4>${div.entreprise_nom || "Non precisé"}</h4>
                        <p>${div.Type}</p>
                    </div>
                    <div class="favAndCheck">
                        <div>
                            <img src="./img/bookmark.png" width="25px">
                        </div>
                        <div class="d-flex justify-content-center align-items-center">
                        <img src="./img/check-mark.png" alt="" srcset="">
                        <article>Vu</article>
                        </div>
                        <button class="btn btn-primary more-btn" id="more" onclick="">En savoir plus</button>
                    </div>
    `;
        div2.classList.add("announce-Card");
        div2.classList.add("p-3");
        div2.style.cursor = "pointer";
        jobgrid.appendChild(div2);
        const morebutton = div2.querySelector('.more-btn');
        morebutton.onclick = () => displayDetails(div.Titre, div.entreprise_id, div.Type, div.Description, div.entreprise_nom, div.entreprise_id);
    });
    Profil_Loaded();
    AdminMenu();
}

function displayDetails(titre, entreprise, type, description, entreprise_nom, entreprise_id) {
    const enterpriseInputID = document.getElementById('enterprise');
    enterpriseInputID.value = entreprise_id;
    const detailContainer = document.getElementById('detail-jobs');
    detailContainer.classList.remove("invisible");
    detailContainer.classList.add("visible");
    detailContainer.innerHTML = `
        <h2>${titre}</h2>
        <h3>${entreprise_nom ?? 'Entreprise non précisée'}</h3>
        <p><strong>Type :</strong> ${type}</p>
        <p><strong>Description :</strong></p>
        <p>${description ?? 'Aucune description disponible.'}</p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalCenter" id="test"
                onclick="userReadAutoFill()">Postuler</button>

            
    `;
    userReadAutoFill()
}


function test() {
    console.log("clicked");
}

async function Profil_Loaded() {

    const request = await fetch("../../php/users/SessionOn.php");
    const data = await request.json();
    console.log(data);
    if (data != "Non connecté ou session expiré.") {
        document.getElementById("deconnexion").style.display = "default"
        document.getElementById("Connexion/Inscription").style.display = "none"

    }
    else {
        document.getElementById("deconnexion").style.display = "none";
        document.getElementById("Connexion/Inscription").style.display = "default"

    }

}

async function deco() {
    const request = await fetch("../../php/users/SessionOff.php");
    const data = await request.json();
    console.log(data);
    window.location.href = "./index.html";

}

async function AdminMenu() {
    const request = await fetch("../../php/admin/AdminVerify.php");
    Admin = await request.json();
    if (Admin["admin"] == true) {
        document.getElementById("AdminMenu").style.display = "flex";
    }
    else {
        document.getElementById("AdminMenu").style.display = "none";
    }
}

function GoAdminMenu() {
    window.location.href = Admin["Link"];
}