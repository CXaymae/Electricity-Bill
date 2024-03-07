<?php
// Include your database connection file (dbcon.php)
include 'dbcon.php';

// Fetch facture data from the database
$query = "SELECT * FROM facture";
$result = mysqli_query($con, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($con));
}

$factureData = array();

// Fetch each row and add it to the $factureData array
while ($row = mysqli_fetch_assoc($result)) {
    $factureData[] = $row;
}

// Close the database connection
mysqli_close($con);

// Return the facture data as JSON
header('Content-Type: application/json');
echo json_encode($factureData);
?>
