<?php
header('Content-Type: application/json; charset=utf-8');
require "../connectionDB.php";
session_start();

$userId = $_SESSION['ID'];

$sql = "SELECT Nom, Prénom, Email, Tel, Formations, Expériences, Grade FROM users WHERE id = :id";

$sqlpreparation = $connection->prepare($sql);
$sqlpreparation->bindParam(':id', $userId, PDO::PARAM_INT);

$sqlpreparation->execute();


    //récupère tous les éléments de toutes les offres
$row = $sqlpreparation->fetch(PDO::FETCH_ASSOC);

echo json_encode([
    'success' => true,
    'data' => $row
]);
