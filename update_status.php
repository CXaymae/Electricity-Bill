<?php
include('dbcon.php');

$id_facture = $_GET['id'];
$newStatus = $_GET['status'];

// Update the 'status' column in the facture table
$updateQuery = "UPDATE facture SET status = '$newStatus' WHERE id_facture = $id_facture";
mysqli_query($con, $updateQuery);

// Close the database connection
mysqli_close($con);
?>
