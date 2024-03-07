<?php
session_start();
require 'dbcon.php';

// Handling search functionality
$search = isset($_GET['search']) ? mysqli_real_escape_string($con, $_GET['search']) : '';

$query = "SELECT Clients.id, Clients.nom, Facture.id_facture, Facture.consommation, Facture.mois, Facture.annee, Facture.compteur_photo 
          FROM Clients
          LEFT JOIN Facture ON Clients.id = Facture.id";

// Add search condition if the search term is provided
if (!empty($search)) {
    $query .= " WHERE Clients.nom LIKE '%$search%' OR Facture.id_facture LIKE '%$search%'";
}

$query_run = mysqli_query($con, $query);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Facture List</title>
    <style>
        body {
            padding-top: 60px;
        }

        .navbar-custom {
            background-color: #007bff; 
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark fixed-top navbar-custom">
        <a class="navbar-brand" href="#">Facturaty</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="Stats.html" class="btn btn-primary btn-sm mr-2">Tableaux de bord</a>
                </li>
                <li class="nav-item">
                    <a href="anuelle.php" class="btn btn-primary btn-sm mr-2">Consommation Annuelle</a>
                </li>
                <li class="nav-item">
                    <a href="recl.php" class="btn btn-primary btn-sm mr-2">Réclamations</a>
                </li>
                <li class="nav-item">
                    <a href="index.php" class="btn btn-primary btn-sm mr-2">Liste des clients</a>
                </li>
                <li class="nav-item">
                    <a href="factureFact.php" class="btn btn-primary btn-sm">Liste des factures</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="btn btn-danger ml-2" onclick="logout()">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

<div class="container mt-4">

    <?php include('message.php'); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Client and Facture Details</h4>
                    <!-- Add search bar -->
                    <form action="" method="GET" class="form-inline">
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="search" class="sr-only">Search</label>
                            <input type="text" class="form-control" id="search" name="search" placeholder="Search" value="<?= $search; ?>">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Search</button>
                    </form>
                </div>
                <div class="card-body">

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Client Name</th>
                                <th>Facture ID</th>
                                <th>Consommation</th>
                                <th>Mois</th>
                                <th>Annee</th>
                                <th>Compteur Photo</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if(mysqli_num_rows($query_run) > 0)
                            {
                                foreach($query_run as $data)
                                {
                                    ?>
                                    <tr>
                                        <td><?= $data['id']; ?></td>
                                        <td><?= $data['nom']; ?></td>
                                        <td><?= $data['id_facture']; ?></td>
                                        <td><?= $data['consommation']; ?></td>
                                        <td><?= $data['mois']; ?></td>
                                        <td><?= $data['annee']; ?></td>
                                        <td>
                                            <!-- Display the image -->
                                            <img src="<?= $data['compteur_photo']; ?>" alt="Compteur Photo" style="max-width: 100px; max-height: 100px;">
                                        </td>
                                        <td>
                                            <a href="facture-edit.php?id=<?= $data['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            else
                            {
                                echo "<h5>No Record Found</h5>";
                            }
                            ?>
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
        function logout() {
            // Mettez ici le code de déconnexion, par exemple, redirection vers la page de déconnexion.
            alert("Vous êtes déconnecté !");
            window.location.href = "index.html"; // Assurez-vous d'ajuster le chemin selon votre structure de fichiers.
        }
    </script>

</body>
</html>
