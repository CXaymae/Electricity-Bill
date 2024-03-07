<?php
$con = mysqli_connect("localhost", "root", "", "electricite");

if (!$con) {
    die('Connection Failed: ' . mysqli_connect_error());
}
?>

<?php
// Start the session
session_start();

// Retrieve the data for the selected id_facture from the session variable
$selected_id_facture = $_SESSION['selected_id_facture'] ?? null;

// Fetch the details from the database based on the selected id_facture
if ($selected_id_facture) {
    include('dbcon.php');
    $sql = "SELECT mois, annee, consommation, prix_ht FROM facture WHERE id_facture = $selected_id_facture";
    $result = mysqli_query($con, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        $mois = $row['mois'];
        $annee = $row['annee'];
        $consommation = $row['consommation'];
        $prix_ht = $row['prix_ht'];
    }

    mysqli_close($con);
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="pdf.css" />
    <script src="pdf.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

</head>

<body>
    <div class="container d-flex justify-content-center mt-50 mb-50">
        <div class="row">
            <div class="col-md-12 text-right mb-3">
                <button class="btn btn-primary" id="download"> download pdf</button>
            </div>
            <div class="col-md-12">
                <div class="card" id="invoice">
                    <div class="card-header bg-transparent header-elements-inline">
                        <h4 class="card-title text-primary">Facturaty</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-4 pull-left">

                                    <ul class="list list-unstyled mb-0 text-left">
                                        <li>Tous les droits sont reservee</li>
                                        <li>05 67 89 47 56 </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-4 ">
                                    <div class="text-sm-right">
                                        <h4 class="invoice-color mb-2 mt-md-2">Facture .....</h4>
                                        <ul class="list list-unstyled mb-0">
                                        <li>Date: <span class="font-weight-semibold"><?php echo date('F j, Y'); ?></span></li>
                                        </ul>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-md-flex flex-md-wrap">
                            <div class="mb-4 mb-md-2 text-left"> <span class="text-muted">Invoice To:</span>
                            <ul class="list list-unstyled mb-0">
                            <?php
                                include('dbcon.php');

                                // Your SQL query to fetch data from the 'clients' table, limiting to one row
                                $sqlClient = "SELECT nom, adresse, phone, email FROM clients";
                                $resultClient = mysqli_query($con, $sqlClient);

                                if (!$resultClient) {
                                    die("Query failed: " . mysqli_error($con));
                                }
                                $clientData = mysqli_fetch_assoc($resultClient);
                                
                            ?>


                                <li>
                                    <h5 class="my-2"><?php echo $clientData['nom']; ?></h5>
                                </li>
                                <li><?php echo $clientData['adresse']; ?></li>
                                <li><?php echo $clientData['phone']; ?></li>
                                <li><a href="mailto:<?php echo $clientData['email']; ?>" data-abc="true"><?php echo $clientData['email']; ?></a></li>
                            </ul>
                            </div>
                            <div class="mb-2 ml-auto"> <span class="text-muted">Payment Details:</span>
                                <div class="d-flex flex-wrap wmin-md-400">
                                    <ul class="list list-unstyled mb-0 text-left">
                                        <li>
                                            <h5 class="my-2">Capital</h5>
                                        </li>
                                        <li>Agence :</li>                            
                                        <li>Address:</li>
                                        <li>IBAN:</li>
                                    </ul>
                                    <ul class="list list-unstyled text-right mb-0 ml-auto">
                                        <li>
                                            <h5 class="font-weight-semibold my-2">111,090 Dhs</h5>
                                        </li>
                                        <li><span class="font-weight-semibold">Martil</span></li>
                                        <li>New standard</li>
                                        <li><span class="font-weight-semibold">98574959485</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-lg">
                            <thead>
                                <tr>
                                    <th>Mois</th>
                                    <th>Annee</th>
                                    <th>Consommation en KWs</th>
                                    <th>Prix HT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include('dbcon.php');

                                // Your SQL query to fetch data from the 'facture' table
                                $sql = "SELECT mois, annee, consommation, prix_ht FROM facture LIMIT 1";
                                $result = mysqli_query($con, $sql);

                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $row['mois'] . "</td>";
                                    echo "<td>" . $row['annee'] . "</td>";
                                    echo "<td>" . $row['consommation'] . "</td>";
                                    echo "<td>" . $row['prix_ht'] . "</td>";
                                    echo "</tr>";
                                }

                                // Close the database connection
                                mysqli_close($con);
                                ?>
                    <div class="card-body">
                        <div class="d-md-flex flex-md-wrap">
                            <div class="pt-2 mb-3 wmin-md-400 ml-auto">
                                <div class="table-responsive">
                                    <table class="table">

                                    <?php
// Unset the session variable after displaying the details
unset($_SESSION['selected_id_facture']);
?>
                                    <tbody>
    <tr>
        <th class="text-left">Subtotal:</th>
        <td class="text-right" id="subtotal">$1,090</td>
    </tr>
    <tr>
        <th class="text-left">Tax: <span class="font-weight-normal">(14%)</span></th>
        <td class="text-right" id="tax">$27</td>
    </tr>
    <tr>
        <th class="text-left">Total:</th>
        <td class="text-right text-primary" id="total">
            <h5 class="font-weight-semibold">$1,160</h5>
        </td>
    </tr>

    <script>
        // Fetch consommation value from the database or use a predefined value
        var consommation = 150; // Replace this with your actual consommation value

        // Calculate subtotal based on consommation and rates
        var rate = 0; // Default rate

        if (consommation <= 100) {
            rate = 0.8;
        } else if (consommation <= 200) {
            rate = 0.9;
        } else {
            rate = 1.0;
        }

        var subtotal = consommation * rate;

        // Calculate tax as 14% of the subtotal
        var tax = subtotal * 1.14;

        // Calculate total as the sum of subtotal and tax
        var total = subtotal + tax;
        document.getElementById("subtotal").textContent = "Dhs" + subtotal.toFixed(2);
        document.getElementById("tax").textContent = "Dhs" + tax.toFixed(2);
        document.getElementById("total").innerHTML = "<h5 class='font-weight-semibold'>Dhs" + total.toFixed(2) + "</h5>";
    </script>
</tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>