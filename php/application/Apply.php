<?php
header('Content-Type: application/json; charset=utf-8');
require "../connectionDB.php";
session_start();

$userId = $_SESSION['ID'];
$entreprise = $_REQUEST['enterprise'];
$nom = $_REQUEST['name'];
$prenom = $_REQUEST['prenom'];
$mail = $_REQUEST['mail'];
$phone_number = $_REQUEST['phone_number'];
$commentaires = $_REQUEST['commentary'];


$sql = "INSERT INTO application(user_ID, Nom, prenom, email, phone_number, commentary, enterprise_id)
VALUES (:user_ID, :name, :prenom, :mail, :phone_number, :commentary, :enterprise_id)";

$sqlpreparation = $connection-> prepare($sql);

$sqlpreparation->bindParam(':user_ID', $userId);
$sqlpreparation->bindParam(':name', $nom);
$sqlpreparation->bindParam(':prenom', $prenom);
$sqlpreparation->bindParam(':mail', $mail);
$sqlpreparation->bindParam(':phone_number', $phone_number);
$sqlpreparation->bindParam(':commentary', $commentaires);
$sqlpreparation->bindParam(':enterprise_id', $entreprise);
$sqlpreparation->execute();

$result = $sqlpreparation->fetch(PDO::FETCH_ASSOC);
header('Location: ../../html/index');

echo json_encode($result);