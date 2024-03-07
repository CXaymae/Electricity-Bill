<?php
session_start();
require 'dbcon.php';

if (isset($_POST['delete_student'])) {
    $client_id = mysqli_real_escape_string($con, $_POST['delete_student']);

    // Delete related records in the "consommation_annuelle" table
    $delete_related_query = "DELETE FROM consommation_annuelle WHERE client_id='$client_id'";
    $delete_related_query_run = mysqli_query($con, $delete_related_query);

    // Check if the related records were deleted successfully
    if ($delete_related_query_run) {
        // Now, you can proceed with deleting the client
        $query = "DELETE FROM Clients WHERE id='$client_id'";
        $query_run = mysqli_query($con, $query);

        if ($query_run) {
            $_SESSION['message'] = "client Deleted Successfully";
        } else {
            $_SESSION['message'] = "Clientt Not Deleted";
        }
    } else {
        $_SESSION['message'] = "Error deleting related records";
    }

    header("Location: index.php");
    exit(0);

}

if(isset($_POST['update_student']))
{
    $client_id = mysqli_real_escape_string($con, $_POST['client_id']);

    $nom = mysqli_real_escape_string($con, $_POST['nom']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $adresse = mysqli_real_escape_string($con, $_POST['adresse']);

    $query = "UPDATE Clients SET nom='$nom', email='$email', phone='$phone', adresse='$adresse' WHERE id='$client_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Student Updated Successfully";
        header("Location: index.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Student Not Updated";
        header("Location: index.php");
        exit(0);
    }

}


if(isset($_POST['save_student']))
{
    $nom = mysqli_real_escape_string($con, $_POST['nom']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $adresse = mysqli_real_escape_string($con, $_POST['adresse']);

    $query = "INSERT INTO Clients (nom,email,phone,adresse) VALUES ('$nom','$email','$phone','$adresse')";

    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
        $_SESSION['message'] = "Student Created Successfully";
        header("Location: client-create.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Student Not Created";
        header("Location: client-create.php");
        exit(0);
    }
}

?>