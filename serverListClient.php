<?php

include "serverConnect.php";

// Activer le tampon de sortie pour éviter toute sortie parasite
ob_start();

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    header('Content-Type: application/json');
    echo json_encode(["status" => "error", "message" => "Erreur de connexion : " . $conn->connect_error]);
    ob_end_flush(); // Envoyer la sortie tamponnée
    exit;
}

// Requête SQL pour récupérer les données
$sql = "SELECT id_client, lastname, firstname, sex, age, email FROM client";
$result = $conn->query($sql);

// Initialiser l'en-tête pour JSON
header('Content-Type: application/json');

if ($result === false) {
    echo json_encode(["status" => "error", "message" => "Erreur dans la requête : " . $conn->error]);
} elseif ($result->num_rows > 0) {
    $clients = [];
    while ($row = $result->fetch_assoc()) {
        $clients[] = $row;
    }
    echo json_encode(["status" => "success", "data" => $clients]);
} else {
    echo json_encode(["status" => "success", "data" => []]);
}

// Fermer la connexion
$conn->close();

// Envoyer la sortie tamponnée
ob_end_flush();

?>
