<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mois = $_POST["mois"];
    $annee = $_POST["annee"];
    $consommation = $_POST["consommation"];
    
    // Connexion à la base de données (à remplacer par vos propres informations)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "electricite";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Upload de la photo
    $photo_path = "upload/"; // Dossier où vous souhaitez enregistrer les photos
    $photo_name = $_FILES["photo"]["name"];
    $photo_tmp = $_FILES["photo"]["tmp_name"];
    $photo_destination = $photo_path . $photo_name;

    move_uploaded_file($photo_tmp, $photo_destination);

    // Calculate prix_ttc and HT based on consommation
    if ($consommation <= 100) {
        $a = 0.8;
    } elseif ($consommation <= 200) {
        $a = 0.9;
    } else {
        $a = 1.0;
    }

    $prix_ttc = $consommation * 1.14 * $a;
    $prix_ht = $consommation * $a;

    // Insertion des données dans la table de facture
    // Assuming that 'id_client' is the foreign key in the 'facture' table referencing the 'id' in the 'clients' table
    $stmt = $conn->prepare("INSERT INTO facture (mois, annee, consommation, prix_ttc, prix_ht, id, compteur_photo) VALUES (?, ?, ?, ?, ?, ?, ?)");
    
    // Replace 'id' with the actual foreign key column name in the 'facture' table
    $client_id_query = $conn->query("SELECT id FROM clients ORDER BY RAND() LIMIT 1");

    if ($client_id_query) {
        $client_id_result = $client_id_query->fetch_assoc();
        $client_id = $client_id_result["id"];
    } else {
        // Handle the query error
        echo "Error: " . $conn->error;
    }

    $stmt->bind_param("iisddis", $mois, $annee, $consommation, $prix_ttc, $prix_ht, $client_id, $photo_destination);
    
    if ($stmt->execute()) {
        echo "Les données ont été enregistrées avec succès.";
    } else {
        echo "Erreur lors de l'enregistrement des données : " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
}
?>
