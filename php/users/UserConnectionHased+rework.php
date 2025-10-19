<?php
session_start();
//récupère les éléments pour le json et la connection serveur 
header('Content-Type: application/json; charset=utf-8');
require "../connectionDB.php";
//récupère les identifiant de connexion
$username = $_POST["username"];
$Password = $_POST["password"];

if ($username == null || $Password == null) {
    echo json_encode("rien");
    exit();
}

//regarde dans la DB pour users avec le meme nom d'utilisateur
$sql = "SELECT * from users where Username = '$username'";
//positionne la vérification sur false en attente que les deux soit juste (MDP et Username)
$GoodUserAndpassword = false;

//connecte à la DB
$sqlprepare = $connection->prepare($sql);
try {
    $sqlprepare->execute();
} catch (Exception $e) {
    echo json_encode(["Password" => $GoodUserAndpassword]);
    exit();
}

$sqlresult = $sqlprepare->fetch(PDO::FETCH_ASSOC);

if (password_verify($Password, $sqlresult["MDP"])) {
    $GoodUserAndpassword = true;
    $_SESSION['ID'] = $sqlresult['ID'];
    $_SESSION["Grade"] = $sqlresult["Grade"];
    $_SESSION["User"] = $sqlresult["Username"];

    $sql2 = "SELECT ID FROM entreprise WHERE Owners = :ownerId";
    $stmt2 = $connection->prepare($sql2);
    $stmt2->bindParam(':ownerId', $_SESSION['ID']);
    $stmt2->execute();
    $entreprise = $stmt2->fetch(PDO::FETCH_ASSOC);
    if ($entreprise) {
        $_SESSION['entreprise_id'] = $entreprise['ID'];
    }
} else {
    echo json_encode(["Password" => $GoodUserAndpassword]);
    exit();
}

//transfère la réponse true ou false  pour se connecter
echo json_encode(["Password" => $GoodUserAndpassword, "session" => $_SESSION['ID'], "Grade" => $_SESSION["Grade"], "User" => $_SESSION["User"]]);

