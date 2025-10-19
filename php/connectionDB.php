<?php
//identification de serveur mySQL
$servername = "localhost";
$username = "root";

//________les effet de try et catch pour s'assurer que la connexion se fait_________
try {

  $connection = new PDO("mysql:host=$servername;dbname=jobboard", $username);
  $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



} catch(PDOException $e) {
      echo json_encode([
        "success" => false,
        "error" => $e->getMessage()
    ]);
}