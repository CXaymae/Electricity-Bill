<?php
// votre_script_de_traitement.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturer les données du formulaire
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $role = $_POST["role"];

    // Vérification des informations de connexion dans la base de données
    // ... (Assurez-vous d'utiliser des requêtes sécurisées)

    // Exemple simple de redirection en fonction du rôle
    if ($role == "client") {
        header("Location: Choice.html");
        exit();
    } elseif ($role == "fournisseur") {
        header("Location: welcome.html");
        exit();
    } else {
        // Gérer d'autres rôles au besoin
        echo "Rôle non reconnu";
    }
}
?>
