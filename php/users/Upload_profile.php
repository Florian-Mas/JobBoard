<?php
session_start();
require '../connectionDB.php';


if (isset($_FILES['pp']) && $_FILES['pp']['error'] === 0) {
    $userId = $_SESSION['ID'];
    $fileTmp = $_FILES['pp']['tmp_name'];
    $fileName = $_FILES['pp']['name'];
    $fileSize = $_FILES['pp']['size'];
    $fileError = $_FILES['pp']['error'];

    $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if (in_array($fileExt, $allowed)) {

        $newFileName = uniqid('pp_', true) . '.' . $fileExt;
        $uploadPath = '../../html/index/img/uploads/' . $newFileName;

        if (move_uploaded_file($fileTmp, $uploadPath)) {
            $stmt = $connection->prepare("UPDATE users SET profil_picture = :pic WHERE id = :id");
            $stmt->execute([
                ':pic' => $newFileName,
                ':id' => $userId
            ]);
            echo json_encode (["name" => $newFileName]);
            header('Location: ../../html/index/profile.html');
            exit;
        } else {
            echo "Erreur lors du transfert du fichier.";
        }
    } else {
        echo "Format non autorisé (jpg, png, gif, webp seulement).";
    }
} else {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo $_FILES['pp']['name']; /* nom  */
        echo $_FILES['pp']['type']; /* type */
        echo $_FILES['pp']['size']; /* taille */
        echo $_FILES['pp']['tmp_name']; /* emplacement du fichier */
        echo $_FILES['pp']['error']; /* code erreur du téléchargement */

    }
}