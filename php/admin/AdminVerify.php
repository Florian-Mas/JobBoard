<?php
header('Content-Type: application/json; charset=utf-8');
session_start();
require "../connectionDB.php";
if($_SESSION == null){
    echo json_encode(["Link"=>"index.html","admin"=>false]);
    exit();
}
$TheID = $_SESSION["ID"];

$sql = "SELECT Grade from users WHERE ID = $TheID";
$sqlpreparation = $connection -> prepare($sql);
$sqlpreparation->execute();
$sqlresult = $sqlpreparation->fetch();


if ($sqlresult["Grade"] == "admin"){
    echo json_encode (["Link"=>"../../html/index/admin/admin.html","admin"=>true]);
}
else{
    echo json_encode(["Link"=>"index.html","admin"=>false]);
}
