<?php
//récupère les éléments pour le json et la connection serveur 
header('Content-Type: application/json; charset=utf-8');
session_start();
require "../connectionDB.php";
session_start();
if ($_SESSION == null) {
    echo json_encode("pas de session active");
    exit();
}

$userId = $_SESSION['ID'];
$titreOffre = $_POST['title'];
$descriptionOffre = $_POST['description'];
$type_contract = $_POST['type'];
$duration = $_POST['duration'];

$sql = "INSERT INTO offres (Titre, Description, Type, durée, entreprise_id)
       VALUES (:titre, :description, :type, :duration, :entreprise_id)";

$sqlpreparation = $connection->prepare($sql);
$sqlpreparation->bindParam(':titre', $titreOffre, PDO::PARAM_STR);
$sqlpreparation->bindParam(':description', $descriptionOffre, PDO::PARAM_STR);
$sqlpreparation->bindParam(':type', $type_contract, PDO::PARAM_STR);
$sqlpreparation->bindParam(':duration', $duration, PDO::PARAM_INT);
$sqlpreparation->bindParam(':entreprise_id', $_SESSION['entreprise_id'], PDO::PARAM_INT);

$sqlpreparation->execute();
header('Location: ../../html/index');