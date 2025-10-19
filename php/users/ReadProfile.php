<?php
session_start();
require '../connectionDB.php';

if (!isset($_SESSION['ID'])) {
    echo json_encode(["success" => false, "message" => "Non connecté"]);
    exit;
}

$userId = $_SESSION['ID'];

$stmt = $connection->prepare("SELECT profil_picture FROM users WHERE id = :id");
$stmt->execute([':id' => $userId]);
$pic = $stmt->fetchColumn();

if ($pic) {
    echo json_encode(["success" => true, "image" => $pic]);
} else {
    echo json_encode(["success" => false, "message" => "Aucune image trouvée"]);
}