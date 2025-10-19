<?php
header('Content-Type: application/json; charset=utf-8');
session_start();
require "../connectionDB.php";
//évite les erreur si il n'y a pas de session
if ($_SESSION == null){
    echo json_encode("Non connecté ou session expiré.");
    exit();
}

$TheID = 1;//$_SESSION['ID'];
//ceux qui possède l'entreprise (pour poster)
$AllOwn = [];
//premier owner
$ChiefOwn = [];

$sql = "SELECT ID,Owners,Nom,Description,NuSiret from entreprise";
$sqlpreparation = $connection -> prepare($sql);
$sqlpreparation->execute();
//récupère les éléments
while ($row = $sqlpreparation->fetch(PDO::FETCH_ASSOC)) {
    if (str_contains($row["Owners"],$_SESSION["ID"])){
        $AllOwn[] = $row;
    }
}    

foreach ($AllOwn as $oneCompany){
    //verifi le premier owners
    if (substr($oneCompany["Owners"], 0, strpos($oneCompany["Owners"], ","))==$_SESSION["ID"]){
        $ChiefOwn[] = $oneCompany;
        
    }
}

if ($ChiefOwn == null){
    $ChiefOwn = null;
}
if ($AllOwn == null){
    $AllOwn = null;
    exit();
}

$_SESSION["entreprise"] = $AllOwn[0]["ID"];;

echo json_encode(["Owned" => $AllOwn, "ChiefOwn" => $ChiefOwn]);
