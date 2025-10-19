<?php
header('Content-Type: application/json; charset=utf-8');
session_start();
require "../connectionDB.php";

$TheID = $_SESSION["ID"];

$name = $_POST["name"];
$description = $_POST["description"];
$siret = $_POST["siret"];

    //choisir les valeurs a mettre 

$sql = "INSERT into entreprise (Owners, Nom, Description, NuSiret)
VALUES (:owners, :theName, :description, :nuSiret) ";


//préparer les valeur pour les insérer dans la DB users pour les rentré de la bonne façon
$sqlpreparation = $connection-> prepare($sql);
$sqlpreparation->bindParam(':owners', $TheID);
$sqlpreparation->bindParam(':theName', $name);
$sqlpreparation->bindParam(':description', $description);
$sqlpreparation->bindParam(':nuSiret', $siret);

//les mettre dans la DB
$sqlpreparation->execute();

$entrepriseId = $connection->lastInsertId();

$_SESSION['entreprise_id'] = $entrepriseId;

echo "Entreprise créée avec l'ID : " . $entrepriseId;

echo json_encode("la demande de création d'entreprise a été effectué");
