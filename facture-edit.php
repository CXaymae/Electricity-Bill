<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require 'dbcon.php';

if(isset($_GET['id'])) {
    $client_id = mysqli_real_escape_string($con, $_GET['id']);
    $query = "SELECT Clients.id, Clients.nom,  Facture.id_facture, Facture.consommation, Facture.mois, Facture.annee, Facture.compteur_photo 
              FROM Clients
              INNER JOIN Facture ON Clients.id = Facture.id_facture
              WHERE Clients.id = $client_id";
    $query_run = mysqli_query($con, $query);
    $client_data = mysqli_fetch_assoc($query_run);

    if (!$client_data) {
        header("Location: client-list.php");
        exit();
    }
} else {
    header("Location: client-list.php");
    exit();
}

// Handle form submission to update database
if(isset($_POST['update_facture'])) {
    // Retrieve and sanitize form data
    $facture_id = mysqli_real_escape_string($con, $_POST['facture_id']);
    $consommation = mysqli_real_escape_string($con, $_POST['consommation']);
    $mois = mysqli_real_escape_string($con, $_POST['mois']);
    $annee = mysqli_real_escape_string($con, $_POST['annee']);
    $compteur_photo = mysqli_real_escape_string($con, $_POST['compteur_photo']);

    // Update the database with the new information
    $update_query = "UPDATE Facture SET consommation='$consommation', mois='$mois', annee='$annee', compteur_photo='$compteur_photo' WHERE id_facture='$facture_id'";
    $update_query_run = mysqli_query($con, $update_query);

    if ($update_query_run) {
        $_SESSION['message'] = "Facture information updated successfully!";
        // No need to redirect here, stay on the same page
    } else {
        $_SESSION['message'] = "Error updating facture information!";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Facture Information</title>
</head>
<body>

<div class="container mt-4">

    <?php include('message.php'); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Facture Information</h4>
                </div>
                <div class="card-body">

                    <!-- Display and edit facture information in a form -->
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="facture_id" class="form-label">Facture ID</label>
                            <input type="text" class="form-control" id="facture_id" name="facture_id" value="<?= $client_data['id_facture']; ?>" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="consommation" class="form-label">Consommation</label>
                            <input type="text" class="form-control" id="consommation" name="consommation" value="<?= $client_data['consommation']; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="mois" class="form-label">Mois</label>
                            <input type="text" class="form-control" id="mois" name="mois" value="<?= $client_data['mois']; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="annee" class="form-label">Annee</label>
                            <input type="text" class="form-control" id="annee" name="annee" value="<?= $client_data['annee']; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="compteur_photo" class="form-label">Compteur Photo</label>
                            <input type="text" class="form-control" id="compteur_photo" name="compteur_photo" value="<?= $client_data['compteur_photo']; ?>">
                        </div>

                        <button type="submit" name="update_facture" class="btn btn-primary">Update Facture Information</button>
                    </form>

                    <!-- Updated "Back" button link -->
                    <a href="factureFact.php" class="btn btn-secondary">Back</a>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
