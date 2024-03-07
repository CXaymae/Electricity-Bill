<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Table Rows Count</title>
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <?php
        // Include the database connection file
        include 'dbcon.php';

        // Function to get row count for a table
        function getRowCount($conn, $tableName) {
            $sql = "SELECT COUNT(*) as rowCount FROM $tableName";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row['rowCount'];
            } else {
                return 0;
            }
        }
        ?>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Clients Table</h5>
                    <p class="card-text">Total Rows: <?php echo getRowCount($conn, 'clients'); ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Facture Table</h5>
                    <p class="card-text">Total Rows: <?php echo getRowCount($conn, 'facture'); ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Reclamation Table</h5>
                    <p class="card-text">Total Rows: <?php echo getRowCount($conn, 'reclamation'); ?></p>
                </div>
            </div>
        </div>
        
        <?php
        // Close the database connection
        $conn->close();
        ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.8/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
