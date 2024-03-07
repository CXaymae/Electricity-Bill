<?php
session_start();
require 'dbcon.php';

// Check if the search form is submitted
if(isset($_POST['search'])){
    $search = mysqli_real_escape_string($con, $_POST['search']);
    $query = "SELECT Clients.id, facture.id_facture, facture.mois, facture.consommation FROM Clients LEFT JOIN facture ON Clients.id = facture.id_client WHERE nom LIKE '%$search%'";
    $query_run = mysqli_query($con, $query);
} else {
    $query = "SELECT Clients.id, facture.id_facture, facture.mois, facture.consommation FROM Clients LEFT JOIN facture ON Clients.id = facture.id_client";
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

    <title>Client Facture Details</title>
</head>
<body>

<div class="container mt-4">

    <?php include('message.php'); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Client Facture Details</h4>
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
                            <th>ID Facture</th>
                            <th>Mois</th>
                            <th>Consommation</th>
                            <th>Status Payement</th>
                            <th>Download PDF</th>
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
                                    <td><?= $data['mois']; ?></td>
                                    <td><?= $data['consommation']; ?></td>
                                   
                                    <td>
                                        <a href="download-pdf.php?id=<?= $data['id_facture']; ?>" class="btn btn-primary btn-sm">Download PDF</a>
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

                    <!-- Back Button -->
                    <a href="javascript:history.go(-1)" class="btn btn-secondary">Back</a>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
