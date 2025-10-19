<?php
//connection à la DB
header('Content-Type: application/json; charset=utf-8');
require "../connectionDB.php";

//prépare les variable vide
$allOffersElement = [];
$allNameOffers = [];
$count = 0;

try{
$sql = "SELECT COUNT(*) FROM users";
$result = $connection->query($sql);

//récupère tous les éléments de toutes les offres
while ($row =  $result-> fetch(PDO::FETCH_ASSOC)){
    echo json_encode([
        "success" => true,
        "data" => $row,
    ]);
}


} catch (Exception $e) {
    echo json_encode([
        "success" => false,
        "error" => $e->getMessage()
    ]);
}