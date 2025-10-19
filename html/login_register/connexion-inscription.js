document.addEventListener("DOMContentLoaded", () => {
    const buttonPageRegister = document.getElementById("PageRegister");
    const formInscription = document.getElementById("FormInscription");
    const formConnexion = document.getElementById("loginForm");
    const retourBtn = document.getElementById("ReturnBtn");
    const loginBtn = document.getElementById("LoginButton");
    const registerBtn = document.getElementById("RegisterButton");

    //passer sur le form d'inscription
    buttonPageRegister.addEventListener("click", (event) => {
        event.preventDefault();
        formConnexion.style.display = "none";
        formInscription.style.display = "flex"; // montre inscription
        document.getElementById("CPassword").value = "";
        document.getElementById("CUsername").value = "";
    });
        
    //revenir sur l'écran de connexion
    retourBtn.addEventListener("click", (event) => {
        event.preventDefault();
        formInscription.style.display = "none";
        formConnexion.style.display = "flex"; // montre login
    });

    //sur inscription revenir sur connexion (ne verifie pas si l'inscription est faite)
    registerBtn.addEventListener("click",Insciption_Button);

    //activer la connexion
    loginBtn.addEventListener("click",Connection_Button);
});


    


//connexion
    async function Connection_Button(e){
        e.preventDefault();

        //liaison php
        const request = await fetch("../../php/users/UserConnectionHased+rework.php",{
            method:"POST",
            headers: {"Content-Type": "application/x-www-form-urlencoded"},
            body: "username=" + encodeURIComponent(document.getElementById("CUsername").value) + "&"+ 
            "password=" + encodeURIComponent(document.getElementById("CPassword").value)
        });
        const data = await request.json();
        console.log(data);
        console.log(data["Password"]);
        if (data["Password"] == true) {

            //mettre vers la page principal
            document.location.href="../index/index.html";

        }
        else{
            document.getElementById("CPassword").value = "";
            alert("Nom d'utilisateur ou mot de passe incorrect");
        }
        
    }


//inscription
    async function Insciption_Button(e){
        e.preventDefault();
        const request = await fetch("../../php/users/UserRegistration.php",{
            method:"POST",
            headers: {"Content-Type": "application/x-www-form-urlencoded"},
            body: "username=" + encodeURIComponent(document.getElementById("Username").value) + "&"+ 
            "password=" + encodeURIComponent(document.getElementById("Password").value) + "&"+
            "name=" + encodeURIComponent(document.getElementById("Name").value) + "&"+
            "firstName=" + encodeURIComponent(document.getElementById("FirstName").value) + "&"+
            "email=" + encodeURIComponent(document.getElementById("Email").value) + "&"+
            "phone=" + encodeURIComponent(document.getElementById("Phone").value)
        });
        const data = await request.json();
        console.log(data)



        if (data["Status"]){
            document.getElementById("FormInscription").style.display = "none";
            document.getElementById("loginForm").style.display = "flex";
        }
        else{
            alert(data["Error"])
        }
    }





