<?php
// upload.php

session_start();

if ($_FILES["fileInput"]["error"] == UPLOAD_ERR_OK) {
    $fileContent = file_get_contents($_FILES["fileInput"]["tmp_name"]);
    $_SESSION['uploadedFile'] = $fileContent;

    // Parse the file content and update the database
    $fileLines = explode("\n", $fileContent);
    foreach ($fileLines as $line) {
        $lineData = explode('|', $line);
        $clientName = $lineData[0];
        $consumption = $lineData[1];
        $year = $lineData[2];

        // Assuming you have a function to update the database
        updateDatabase($clientName, $consumption, $year);
    }

    header("Location: your-main-file.php"); // Redirect to your main file after processing
} else {
    echo "Erreur lors du téléchargement du fichier.";
}

// Function to update the database
function updateDatabase($clientName, $consumption, $year) {
    // Implement the logic to update the database
    global $con;
    $query = "UPDATE facture SET consumption = '$consumption' WHERE client_name = '$clientName' AND year = '$year'";
    mysqli_query($con, $query);
}
?>
