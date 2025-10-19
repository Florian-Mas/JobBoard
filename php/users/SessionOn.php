<?php
header('Content-Type: application/json; charset=utf-8');
session_start();
if ($_SESSION == null){
    echo json_encode("Non connecté ou session expiré.");
    exit();
}
echo json_encode($_SESSION["ID"]);