<?php 

$servername = "localhost"; // Adresse du serveur
$username = "root";         // Nom d'utilisateur (par défaut : root)
$password = "";             // Mot de passe (par défaut vide pour root)
$dbname = "bd_tp2";        // Nom de votre base de données

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    // Retourner une erreur JSON si la connexion échoue
    header('Content-Type: application/json'); // Définir le type de contenu
    echo json_encode(["status" => "error", "message" => "Erreur de connexion : " . $conn->connect_error]);
    exit; // Terminer le script
}

// Fermer la connexion (optionnel ici, vous pouvez le faire plus tard dans le script principal)
//$conn->close();

?>
