<?php

include "serverConnect.php"; // Inclure le fichier de connexion à la base de données

// Vérifier si l'ID est passé dans la requête GET
if (isset($_GET['id'])) {
    $client_id = $_GET['id'];

    // Préparer la requête SQL pour récupérer les données du client par ID
    $sqlClient = "SELECT id_client, lastname, firstname, sex, age, email FROM client WHERE id_client = ?";
    
    
    // Préparer la déclaration données client=====================================
    $stmtClient = $conn->prepare($sqlClient);
    $stmtClient->bind_param("i", $client_id); // "i" pour indiquer que l'ID est un entier

    // Exécuter la déclaration
    $stmtClient->execute();

    // Obtenir le résultat
    $resultClient = $stmtClient->get_result();
    //=============================================================================

    // Préparer la requête SQL pour récupérer les données des activitées=================================
    $sqlActivity = "SELECT id_activity, name, description, season FROM activity";
    //préparation de la déclaration des données activity

    $stmtActivity = $conn->query($sqlActivity);

    //===================================================================================================

    // Initialiser l'en-tête pour JSON
    header('Content-Type: application/json');

    if ($resultClient->num_rows > 0) {
        $client = $resultClient->fetch_assoc(); // Récupérer les données sous forme de tableau associatif
        if ($stmtActivity === false) {
            echo json_encode(["status" => "error", "message" => "Erreur dans la requête : " . $conn->error]);
        } elseif ($stmtActivity->num_rows > 0) {
            $activity = [];
            while ($row = $stmtActivity->fetch_assoc()) {
                $activity[] = $row;
            }
            echo json_encode(["status" => "success", "dataActivity" => $activity,"dataClient" => $client]);
        } else {
            echo json_encode(["status" => "success", "dataActivity" => [],"dataClient" => $client]);
        }
        
        //echo json_encode(["status" => "success", "dataClient" => $client]); // Retourner les données en JSON
    } else {
        echo json_encode(["status" => "error", "message" => "Aucun client trouvé avec cet ID."]);
    }

    // Fermer la déclaration et la connexion
    $stmtActivity->close();
    $conn->close();

} else {
    // Si l'ID n'est pas spécifié
    echo json_encode(["status" => "error", "message" => "ID non spécifié."]);
}
?>
