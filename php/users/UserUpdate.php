<?php
session_start();
//récupère les éléments pour le json et la connection serveur 
header('Content-Type: application/json; charset=utf-8');
require "../connectionDB.php";

//évite les erreur si il n'y a pas de session
if ($_SESSION == null){
    echo json_encode("Non connecté ou session expiré.");
    exit();
}
//initie les valeur
$TheID = $_SESSION['ID'];
$available = true;

//regarde dans la DB pour MDP de l'id de la session
$sql = "SELECT MDP from users WHERE ID = $TheID";
//prépare une query avec tout les éléments
$sqlpreparation = $connection -> prepare($sql);
$sqlpreparation->execute();
//conserve le MDP de la DB
$sqlresult = $sqlpreparation->fetch(PDO::FETCH_ASSOC);
//regarde les Username et ID de users
$sql = "SELECT Username,ID from users";
$sqlpreparation = $connection -> prepare($sql);
$sqlpreparation->execute();
$sqlUserIDresult = $sqlpreparation->fetchall(PDO::FETCH_ASSOC);

$username = $_REQUEST["username"];
$Password = $_REQUEST["oldpassword"];
$NPassword = $_REQUEST["newpassword"];
$NPassword = password_hash($NPassword,PASSWORD_BCRYPT);
$name = $_REQUEST["name"];
$firstname = $_REQUEST["prenom"];
$email = $_REQUEST["email"];
$tel = $_REQUEST["tel"];



foreach ($sqlUserIDresult as $row){
    if($row["Username"] == $username && $row["ID"] != $TheID){
        $available = false ;
    }
}

//refuser si c'est le nom d'utilisateur est déjà utilisé
if(!$available){
    echo json_encode("Nom d'utilisateur déjà utilisé");
    exit();
}


if (password_verify($Password,$sqlresult["MDP"])){
    $sql = "UPDATE users SET Username='$username', MDP='$NPassword', Nom='$name', Prénom='$firstname',Email='$email', Tel='$tel'  WHERE ID=$TheID";
    $sqlpreparation = $connection -> prepare($sql);
    $sqlpreparation->execute();
    echo json_encode("Donnée modifié avec succes.");
    
}
else{
    echo json_encode("Mauvais Mot de passe, veillez vérifier.");
}

exit();
