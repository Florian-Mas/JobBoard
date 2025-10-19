<?php
//connection à la DB
header('Content-Type: application/json; charset=utf-8');
require "../connectionDB.php";
session_start();

//prépare les variable vide
$allOffersElement = [];
$allNameOffers = [];
$count = 0;

$test = $_SESSION['entreprise_id'];



try {
    $sql = "SELECT offres.ID, offres.Titre, offres.Description, offres.Type, offres.Durée, entreprise.Nom AS entreprise_nom
            FROM offres
            JOIN entreprise ON offres.entreprise_id = entreprise.ID WHERE entreprise_id = :id_entreprise
";
    $result = $connection->prepare($sql);
    $result->bindParam(':id_entreprise', $test, PDO::PARAM_INT);
    $result->execute();
    //récupère tous les éléments de toutes les offres
    $row = $result->fetchAll(PDO::FETCH_ASSOC);


    echo json_encode([
        "success" => true,
        "data" => $row,

    ]);
} catch (Exception $e) {
    echo json_encode([
        "success" => false,
        "error" => $e->getMessage()
    ]);
}