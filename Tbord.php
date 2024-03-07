<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Dashboard</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <!-- Additional styles can be added if needed -->
</head>
<body>

<?php include 'dbcon.php'; // Include the database connection file ?>

<div class="container mt-5">
    <main class="content-wrap">
        <header class="content-head">
            <h1>Societe Generale</h1>
        </header>

        <div class="content">
            <section class="row row-cols-1 row-cols-md-2 g-4">
                <?php
                // Example queries, replace with your actual queries
                $clientCountQuery = "SELECT COUNT(*) AS client_count FROM clients";
                $reclamationCountQuery = "SELECT COUNT(*) AS reclamation_count FROM reclamation";
                $factureCountQuery = "SELECT COUNT(*) AS facture_count FROM facture";

                // Execute queries
                $clientCountResult = $conn->query($clientCountQuery);
                $reclamationCountResult = $conn->query($reclamationCountQuery);
                $factureCountResult = $conn->query($factureCountQuery);

                // Fetch counts
                $clientCount = $clientCountResult->fetch_assoc()['client_count'];
                $reclamationCount = $reclamationCountResult->fetch_assoc()['reclamation_count'];
                $factureCount = $factureCountResult->fetch_assoc()['facture_count'];
                ?>

                <!-- Display Count of Clients -->
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Clients</h5>
                            <p class="card-text display-4"><?php echo $clientCount; ?></p>
                        </div>
                    </div>
                </div>

                <!-- Display Count of Reclamations -->
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Reclamations</h5>
                            <p class="card-text display-4"><?php echo $reclamationCount; ?></p>
                        </div>
                    </div>
                </div>

                <!-- Display Count of Factures -->
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Factures</h5>
                            <p class="card-text display-4"><?php echo $factureCount; ?></p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Back Button -->
            <div class="mt-4">
                <a href="previous_page.php" class="btn btn-primary">Back</a>
            </div>
        </div>
    </main>
</div>

<!-- Bootstrap JS (optional, if needed) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
