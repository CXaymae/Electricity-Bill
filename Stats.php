<?php
include 'dbcon.php';

function getCount($conn, $table) {
    $query = "SELECT COUNT(*) as count FROM $table";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }
    return mysqli_fetch_assoc($result)['count'];
}

// Check if the connection is successful
if ($con) {
    $clientsCount = getCount($con, 'clients');
    $factureCount = getCount($con, 'facture');
    $reclamationCount = getCount($con, 'reclamation');
} else {
    die("Database connection failed.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
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

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<div class="ag-format-container">
    <div class="ag-courses_box">
        <div class="ag-courses_item">
            <a href="#" class="ag-courses-item_link">
                <div class="ag-courses-item_bg"></div>
                <div class="ag-courses-item_title">
                    <?php echo $clientsCount; ?>
                </div>
                <div class="ag-courses-item_date-box">
                    Total
                    <span class="ag-courses-item_date">
                        Clients
                    </span>
                </div>
            </a>
        </div>

        <div class="ag-courses_item">
            <a href="#" class="ag-courses-item_link">
                <div class="ag-courses-item_bg"></div>
                <div class="ag-courses-item_title">
                    <?php echo $factureCount; ?>
                </div>
                <div class="ag-courses-item_date-box">
                    Total
                    <span class="ag-courses-item_date">
                        Facture
                    </span>
                </div>
            </a>
        </div>

        <div class="ag-courses_item">
            <a href="#" class="ag-courses-item_link">
                <div class="ag-courses-item_bg"></div>
                <div class="ag-courses-item_title">
                    <?php echo $reclamationCount; ?>
                </div>
                <div class="ag-courses-item_date-box">
                    Total
                    <span class="ag-courses-item_date">
                        Reclamations
                    </span>
                </div>
            </a>
        </div>
    </div>
</div>

<script>
    function logout() {
        alert("Vous êtes déconnecté !");
        window.location.href = "index.html";
    }
</script>
</body>
</html>
