<?php
// Include the database connection file
include 'dbcon.php';

// Perform a query to fetch data from your database table with a JOIN statement
$sql = "SELECT reclamation.*, Clients.email 
        FROM reclamation 
        LEFT JOIN Clients ON reclamation.id = Clients.id";
$result = mysqli_query($con, $sql);

// Fetch data as an associative array
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reclamation Table</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
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


<div class="container mt-5">
    <h2>Reclamation Table</h2>
    <div class="input-group mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Search...">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button" onclick="searchTable()">Search</button>
        </div>
    </div>

    <!-- Message element for displaying warnings or errors -->
    <div id="searchMessage" class="alert alert-warning" style="display: none;"></div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Reclamation</th>
                <th>Email</th>
                <th>Date</th>
                <th>Type</th>
                <th>Description</th>
                <th>Statut</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Assuming $rows is your array of data fetched from the database
            foreach ($rows as $row) {
                echo "<tr>";
                echo "<td>{$row['id_reclamation']}</td>";
                echo "<td>{$row['email']}</td>";
                echo "<td>{$row['date_rec']}</td>";
                echo "<td>{$row['type_reclamation']}</td>";
                echo "<td>{$row['description']}</td>";
                echo "<td>";
                // Set the initial status button color
                if ($row['statut'] == 'non traites') {
                    echo "<button class='btn btn-danger' onclick=\"ChangeStatus('{$row['id_reclamation']}', ' non traites', this)\">Non Traitées</button>";
                } else {
                    echo "<button class='btn btn-success' onclick=\"ChangeStatus('{$row['id_reclamation']}', ' traites', this)\">Traitées</button>";
                }
                echo "</td>";
                echo "<td><a href='sendEmail.html?id={$row['id_reclamation']}' class='btn btn-info'>Notifier</a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script>
    // Function to handle status change
    function ChangeStatus(id, newStatus, button) {
        // Assuming you have a PHP script to update the status in the database
        // You can redirect to the same page or reload the data as needed
        alert('Status changed for ID ' + id + ' to ' + newStatus);
        window.location.reload();
    }

    // Function to handle table search
    function searchTable() {
        var input, filter, table, tr, td, i, txtValue, messageElement;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.querySelector(".table");
        tr = table.getElementsByTagName("tr");
        messageElement = document.getElementById("searchMessage");

        // Reset the message
        messageElement.style.display = "none";
        messageElement.innerHTML = "";

        // Flag to check if any result is found
        var resultFound = false;

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1]; // Change index based on the column you want to search
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                    resultFound = true;
                } else {
                    tr[i].style.display = "none";
                }
            }
        }

        // Display message if no results found
        if (!resultFound) {
            messageElement.innerHTML = "No results found.";
            messageElement.style.display = "block";
        }
    }

   
        function logout() {
            // Mettez ici le code de déconnexion, par exemple, redirection vers la page de déconnexion.
            alert("Vous êtes déconnecté !");
            window.location.href = "index.html"; // Assurez-vous d'ajuster le chemin selon votre structure de fichiers.
        }

            // Function to handle status change
    function ChangeStatus(id, newStatus, button) {
        // Assuming you have a PHP script to update the status in the database
        // You can redirect to the same page or reload the data as needed
        alert('Status changed for ID ' + id + ' to ' + newStatus);

        // Change button color and text based on the new status
        if (newStatus === 'non traites') {
            button.classList.remove('btn-success');
            button.classList.add('btn-danger');
            button.textContent = 'Non Traitées';
        } else {
            button.classList.remove('btn-danger');
            button.classList.add('btn-success');
            button.textContent = 'Traitées';
        }
    }
   
</script>

</body>
</html>
