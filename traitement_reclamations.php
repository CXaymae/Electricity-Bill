<?php
// traitement_reclamations.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST["user_id"];
    $type_reclamation = $_POST["type_reclamation"];
    $autre_reclamation = ($type_reclamation == 'autre') ? $_POST["autre_reclamation"] : "";
    $reclamation = $_POST["reclamation"];
    
    // Statut par défaut : non traité
    $statut = 0; // 0 pour non traité, vous pouvez ajuster selon votre logique

    // Remplacez ces informations par les vôtres
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "electricite";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO Reclamation (id_reclamation, id, statut, type_reclamation, autre_reclamation, description) VALUES (NULL, ?, ?, ?, ?, ?)");

    $stmt->bind_param("iisss", $id_reclamation, $statut, $type_reclamation, $autre_reclamation, $reclamation);

    if ($stmt->execute()) {
        echo "Réclamation enregistrée avec succès.";
    } else {
        echo "Erreur lors de l'enregistrement de la réclamation : " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
