<?php
// anuelle.php
session_start();
include 'dbcon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['fileInput']) && $_FILES['fileInput']['error'] === UPLOAD_ERR_OK) {
        $fileContent = file_get_contents($_FILES['fileInput']['tmp_name']);
        // Extract lines from the file content
        $fileLines = explode("\n", $fileContent);

        foreach ($fileLines as $line) {
            $lineData = explode(' ', $line);
            $cleanedLineData = array_map('trim', $lineData);

            // Check if the expected keys exist in the array
            if (isset($cleanedLineData[0], $cleanedLineData[1], $cleanedLineData[2], $cleanedLineData[3])) {
                $annee = $cleanedLineData[0];
                $dateSaisie = $cleanedLineData[1];
                $id = $cleanedLineData[2];
                $consomAnn = $cleanedLineData[3];

                $query = "INSERT INTO consommation_annuelle (Annee, Date_saisie, id, Consom_ann) VALUES ('$annee', '$dateSaisie', '$id', '$consomAnn')";
        
                // Insert data into the consommation_annuelle table
                mysqli_query($con, $query) or die(mysqli_error($con));
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consommation Annuelle</title>
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

    <!-- Bootstrap JS et dépendances -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>



<div class="container mt-5">
    <!-- File upload section -->
    <div class="mb-3">
        <h2>Consommation Annuelle</h2>
        <form action="anuelle.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="fileInput">Upload File:</label>
                <input type="file" class="form-control-file" id="fileInput" name="fileInput" accept=".txt">
            </div>
            <button type="submit" class="btn btn-primary">Upload and Process</button>
        </form>
    </div>

    <!-- Comparison button -->
    <div class="mb-3">
        <h2>Compare Consom_ann Values for December</h2>
        <button class="btn btn-success" onclick="compareValues()">Compare Values</button>
    </div>

    <!-- Display the comparison result -->
    <div id="comparisonResult" class="alert alert-info" style="display: none;"></div>

</div>

<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script>
    // Function to handle comparison
    function compareValues() {
        // You can implement the logic to compare Consom_ann values for December here
        // Update the #comparisonResult element with the result
        document.getElementById("comparisonResult").innerHTML = "Comparison result will be displayed here.";
        document.getElementById("comparisonResult").style.display = "block";


        
    }

   
        function logout() {
            // Mettez ici le code de déconnexion, par exemple, redirection vers la page de déconnexion.
            alert("Vous êtes déconnecté !");
            window.location.href = "index.html"; // Assurez-vous d'ajuster le chemin selon votre structure de fichiers.
        }
    
</script>

</body>
</html>
