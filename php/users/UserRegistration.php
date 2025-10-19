<?php 
//récupère les éléments pour le json et la connection serveur 
header('Content-Type: application/json; charset=utf-8');
require "../connectionDB.php";
$username = $_POST["username"];
$Password = $_POST["password"];
$Password = password_hash($Password,PASSWORD_BCRYPT);
$name = $_POST["name"];
$firstname = $_POST["firstName"];
$email = $_POST["email"];
$phone = $_POST["phone"];

$arraySend = ["Status" => false, "Error" => null];

//regarde dans la DB pour users
$sql = "SELECT Username from users";
$availble = true;

//connecte à la DB
//$result = $connection->query($sql);
$result = $connection->prepare($sql);
$result->execute();
$result = $result->fetch(PDO::FETCH_ASSOC);

//fait pour toutes les ligne du tableau du sql
foreach ($result as $row){
    if ($row == $username){
        $availble = false;
    }

}

if($username == null){
    $arraySend ["Error"] = "pas de nom d'utilisateur.";
    echo json_encode($arraySend);
    exit();
}

if($Password == null){
   $arraySend ["Error"] = "pas de mot de passe.";
    echo json_encode($arraySend);
    exit();
}
if($name == null){
    $arraySend ["Error"] = "pas de de nom.";
    echo json_encode($arraySend);
    exit();
}

if($firstname == null){
    $arraySend ["Error"] = "pas de de prénom.";
    echo json_encode($arraySend);
    exit();
}

if ((strlen($Password)<8) || !preg_match('/[A-Z]/',$Password) || !preg_match('/[0-9]/',$Password) || !preg_match('/[!?\.?#$^:;§@&~"{\(\[\-\|`_\\\\\^\)\]=}\+\-\*\%><°²\' \/]/',$Password)){
    $arraySend ["Error"] = "forma du mot de passe incorrect";
    echo json_encode($arraySend);
    exit();
}
    

//verifie si c'est un email valide
if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $arraySend ["Error"] = "Format d'email non valide.";
    echo json_encode($arraySend);
    exit();
}

//vérifie si le numéro de tel fourni commence par +
if (!str_starts_with($phone,"+")){
    $arraySend ["Error"] = "Format de téléphone non valide. faire un numéro international avec + devant.";
    echo json_encode($arraySend);
    exit();
}

//si le nom d'utilisateur est disponible 
if($availble){
    //choisir les valeurs a mettre 
    $sql = "INSERT into users (Username,MDP,Nom,Prénom,Email,Tel) 
    VALUES (:username, :MDP, :theName, :firstname, :email, :phone)";
    //préparer les valeur pour les insérer dans la DB users pour les rentré de la bonne façon
    $sqlpreparation = $connection-> prepare($sql);
    $sqlpreparation->bindParam(':username', $username);
    $sqlpreparation->bindParam(':MDP', $Password);
    $sqlpreparation->bindParam(':theName', $name);
    $sqlpreparation->bindParam(':firstname', $firstname);
    $sqlpreparation->bindParam(':email', $email);
    $sqlpreparation->bindParam(':phone', $phone);
    //les mettre dans la DB
    $sqlpreparation->execute();
    $arraySend ["Status"] = true;
    

    
}
else{
    $arraySend ["Error"] = "Nom d'utilisateur non disponible.";
}

echo json_encode($arraySend);