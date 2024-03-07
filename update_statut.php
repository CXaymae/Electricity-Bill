<?php
include_once "dbcon.php"; // Adjust the path to your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id_reclamation = $_GET['id_reclamation'];

    // Retrieve the current 'statut'
    $sql = "SELECT statut FROM reclamation WHERE id_reclamation = '$id_reclamation'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $current_statut = $row['statut'];

        // Toggle the 'statut'
        $new_statut = ($current_statut == 'non traites') ? 'traites' : 'non traites';

        // Update the 'statut' in the database
        $update = mysqli_query($con, "UPDATE reclamation SET statut = '$new_statut' WHERE id_reclamation = '$id_reclamation'");

        if ($update) {
            // Redirect back to the original page
            header("Location: {$_SERVER['HTTP_REFERER']}");
            exit;
        } else {
            echo "Error updating status";
        }
    } else {
        echo "Error retrieving current status";
    }
} else {
    echo "Invalid request method";
}
?>
