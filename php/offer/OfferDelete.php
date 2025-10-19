<?php
header('Content-Type: application/json');

// Connexion à la DB
require '../connectionDB.php';

try {
    $input = json_decode(file_get_contents('php://input'), true); // Recupere valeur envoye du JS entreprise_config via deleteAnnounce

    if (!isset($input['id'])) {
        echo $input;
        throw new Exception("ID manquant pour la suppression.");
    }

    $id = (int) $input['id'];

    $sqlpreparation = $connection->prepare("DELETE FROM offres WHERE ID = :id");
    $sqlpreparation->execute(['id' => $id]);

    if ($sqlpreparation->rowCount() === 0) {
        throw new Exception("Aucune annonce trouvée avec l'ID.");
    }
    header('Location: ../../html/index/enterprises_config.html');


    echo json_encode([
        "success" => true,
    ]);
} catch (Exception $e) {
    echo json_encode([
        "success" => false,
        "error" => $e->getMessage()
    ]);
}

