document.addEventListener("DOMContentLoaded", displayProfile)



async function displayProfile(e) {
e.preventDefault();
fetch('../../php/users/ReadProfile.php')
    .then(res => res.json())
    .then(data => {
        if (data.success && data.image) {

            const imagePath = `img/uploads/${data.image}`;
            document.getElementById('profil-picture').src = imagePath;
        } else {
            console.warn("Image non trouvée ou utilisateur non connecté.");
        }
    })
    .catch(error => {
        console.error("Erreur lors de la récupération de l'image :", error);
    });

}

//img/uploads/pp_68eec50f6eb2b4.24606242.jpg