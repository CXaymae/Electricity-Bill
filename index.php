<?php
session_start();
require 'dbcon.php';

// Check if the search form is submitted
if(isset($_POST['search'])){
    $search = mysqli_real_escape_string($con, $_POST['search']);
    $query = "SELECT * FROM Clients WHERE nom LIKE '%$search%'";
    $query_run = mysqli_query($con, $query);
} else {
    $query = "SELECT * FROM Clients";
    $query_run = mysqli_query($con, $query);
}
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Client CRUD</title>
    <style>
        body {
            padding-top: 60px; /* Ajoute un espacement au-dessus de la barre de navigation fixe */
        }

        .navbar-custom {
            background-color: #007bff; /* Couleur bleue pour la barre de navigation */
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

    <!-- Bootstrap JS et dépendances -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<div class="container mt-4">

    <?php include('message.php'); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Client Details
                        <a href="client-create.php" class="btn btn-primary float-end">Add Clients</a>
                    </h4>
                </div>
                <div class="card-body">

                    <!-- Search Bar -->
                    <form action="" method="POST" class="mb-3">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search by name">
                            <button type="submit" class="btn btn-outline-secondary">Search</button>
                        </div>
                    </form>

                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Client Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Adresse</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if(mysqli_num_rows($query_run) > 0)
                        {
                            foreach($query_run as $client)
                            {
                                ?>
                                <tr>
                                    <td><?= $client['id']; ?></td>
                                    <td><?= $client['nom']; ?></td>
                                    <td><?= $client['email']; ?></td>
                                    <td><?= $client['phone']; ?></td>
                                    <td><?= $client['adresse']; ?></td>
                                    <td>
                                        <a href="client-view.php?id=<?= $client['id']; ?>" class="btn btn-info btn-sm">View</a>
                                        <a href="client-edit.php?id=<?= $client['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                        <form action="code.php" method="POST" class="d-inline">
                                            <button type="submit" name="delete_student" value="<?=$client['id'];?>" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        else
                        {
                            echo "<h5> No Record Found </h5>";
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
