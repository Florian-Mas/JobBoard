
document.addEventListener("DOMContentLoaded", AdminVerification)
const canvas = document.getElementById('canvas').getContext('2d');


async function AdminVerification (){
  const request = await fetch("../../../php/admin/AdminVerify.php");
  const Admin = await request.json();
  console.log(Admin)
  if (!Admin["admin"]){
    window.location.href = "../../index/"+Admin["Link"];
  }
  countUserLoad();
}



async function countUserLoad() {
  fetch('../../../php/admin/count_user.php')
    .then(response => response.json())
    .then(json => {
      if (json.success) {
        const cardtext = document.getElementById('card-text')
        cardtext.textContent = json.data["COUNT(*)"] + "👤";
        let userstatus = true;
        countOfferLoad(userstatus);
      } else {
        cardtext.textContent = "👤";
        console.error("Erreur dans la réponse:", json);

      }
    })
}



async function countOfferLoad(userstatus) {
  fetch('../../../php/admin/count_offers.php')
    .then(response => response.json())
    .then(json => {
      if (json.success) {
        const cardtext2 = document.getElementById('card-text-offers')
        cardtext2.textContent = json.data["COUNT(*)"] + "💼";
        offerstatus = true
        serverstatus(userstatus, offerstatus);
      } else {
        const cardtext2 = document.getElementById('card-text-offers')
        cardtext2.textContent = "💼";
        console.error("Erreur dans la réponse:", json);
      }
    })
}

function serverstatus(userstatus, offerstatus) {
  if (userstatus == true & offerstatus == true) {
    const online = document.getElementById('online');
    online.style.display = "block";
    const offline = document.getElementById('offline');
    offline.style.display = "none";
  }
  else {
    const online = document.getElementById('online');
    online.style.display = "none";
    const offline = document.getElementById('offline');
    offline.style.display = "block";
  }
}





let chart = new Chart(canvas, {
  type: 'bar',
  data: {
    labels: ['Statistiques'],
    datasets: [
      {
        label: "Utilisateurs non vérifiés",
        data: [5],
        backgroundColor: ['#ff7300ff']
      },
      {
        label: "",
        data: [0],
        backgroundColor: ['transparent']
      },
      {
        label: "Nb Entreprise",
        data: [7],
        backgroundColor: ['blue']
      },
      {
        backgroundColor: ['transparent'],
        label: "",
        data: [0],
      },
      {
        label: "Utilisateurs Bannis",
        data: [2],
        backgroundColor: ['red']
      },
    ]
  },
});



