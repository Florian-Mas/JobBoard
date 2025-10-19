<?php
header('Content-Type: application/json; charset=utf-8');
require "../connectionDB.php";
session_start();

$sql = "SELECT 
    application.user_ID, application.email, application.commentary, application.phone_number, application.enterprise_id, entreprise.Nom AS entreprise_nom,
    users.Nom AS user_nom,
    users.Prénom AS user_prenom FROM application 
    JOIN entreprise ON application.enterprise_id = entreprise.ID
    JOIN users ON application.user_ID = users.ID; ";

$sqlpreparation = $connection->prepare($sql);
$sqlpreparation->execute();

$row = $sqlpreparation->fetchAll(PDO::FETCH_ASSOC);


echo json_encode([
    'success' => true,
    'data' => $row
]);