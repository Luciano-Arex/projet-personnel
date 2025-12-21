<?php

include "serverConnect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Échapper les données pour éviter les injections SQL
    $lastname = $conn->real_escape_string($_POST['lastname']);
    $firstname = $conn->real_escape_string($_POST['firstname']);
    $sex = $conn->real_escape_string($_POST['sex']);
    $age = $conn->real_escape_string($_POST['age']);
    $email = $conn->real_escape_string($_POST['email']);


    if (isset($email)) {

        // Échapper les caractères spéciaux pour éviter les injections SQL
        $email = $conn->real_escape_string($email);

        // Requête SQL pour vérifier si l'email existe
        $sql = "SELECT id_client FROM client WHERE email = '$email'";
        $result = $conn->query($sql);

        // Initialiser l'en-tête pour JSON
        header('Content-Type: application/json');

        if ($result) {
            if ($result->num_rows > 0) {
                // L'email existe
                echo json_encode(["status" => "exists", "message" => "L'email existe déjà."]);
            } else {
                
                // Requête SQL pour insérer les données
                $sql = "INSERT INTO client (lastname, firstname, sex, age, email) VALUES ('$lastname', '$firstname', '$sex', '$age', '$email')";

                // Exécution de la requête
                if ($conn->query($sql) === TRUE) {
                    echo json_encode(["status" => "success", "message" => "Nouveau client enregistrement créé avec succès"]);
                } else {
                    echo json_encode(["status" => "Erreur", "message" => "Erreur : " . $sql . "<br>" . $conn->error]);
                }
            }
        } else {
            // Retourner une erreur si la requête échoue
            echo json_encode(["status" => "error", "message" => "Erreur dans la requête : " . $conn->error]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Aucun email fourni."]);
    }
}

// Fermer la connexion
$conn->close();
?>