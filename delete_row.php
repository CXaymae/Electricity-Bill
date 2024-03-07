<?php
include 'dbcon.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    $updateSql = "UPDATE reclamation SET notifier_clicked = 1 WHERE id_reclamation = $id";
    $updateResult = mysqli_query($con, $updateSql);

    if ($updateResult) {
        // Redirect back to the page
        header("Location: sendEmail.php");
        exit();
    } else {
        die('Error updating row: ' . mysqli_error($con));
    }
} else {
    die('Invalid request.');
}
?>
