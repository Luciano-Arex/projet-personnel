<?php

include "serverConnect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Échapper les données pour éviter les injections SQL
    $name = $conn->real_escape_string($_POST['name']);
    $description = $conn->real_escape_string($_POST['description']);
    $season = $conn->real_escape_string($_POST['season']);

    // Requête SQL pour insérer les données
    $sql = "INSERT INTO activity (name, description, season) VALUES ('$name', '$description', '$season')";

    // Exécution de la requête
    if ($conn->query($sql) === TRUE) {
        echo "Nouveau activity enregistrement créé avec succès";
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET"){

}

// Fermer la connexion
$conn->close();
?>