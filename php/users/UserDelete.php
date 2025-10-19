<?php
session_start();
//récupère les éléments pour le json et la connection serveur 
header('Content-Type: application/json; charset=utf-8');
require "../connectionDB.php";
//vérification d'une session valide
if ($_SESSION == null){
    echo json_encode("Non connecté ou session expiré.");
    exit();
}
$TheID = $_SESSION['ID'];

$sql = "DELETE from users WHERE ID= $TheID";
$sqlpreparation = $connection -> prepare($sql);
$sqlpreparation->execute();
session_destroy();

header("Location:../../html/index/");