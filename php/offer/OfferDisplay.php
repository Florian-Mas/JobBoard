<?php
//connection à la DB
header('Content-Type: application/json; charset=utf-8');
require "../connectionDB.php";

//prépare les variable vide
$allOffersElement = [];
$allNameOffers = [];
$count = 0;

try {
    $sql = "SELECT offres.ID, offres.Titre, offres.Description, offres.Type, offres.Durée, entreprise_id AS entreprise_id, entreprise.Nom AS entreprise_nom
            FROM offres
            JOIN entreprise ON offres.entreprise_id = entreprise.ID
";
    $result = $connection->query($sql);

    //récupère tous les éléments de toutes les offres
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $allOffersElement[$count] = $row;
        $count++;
    }


    echo json_encode([
        "success" => true,
        "data" => $allOffersElement,

    ]);
} catch (Exception $e) {
    echo json_encode([
        "success" => false,
        "error" => $e->getMessage()
    ]);
}