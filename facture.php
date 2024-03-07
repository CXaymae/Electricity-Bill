<?php
// Start the session
session_start();

// Include this script in the head or at the end of the body
echo '<script>
    function viewDetails(id_facture) {
        // Redirect to the second page and pass the id_facture as a session variable
        window.location.href = `second_page.php?id_facture=${id_facture}`;
    }
</script>';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulter mes factures</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 60px;
        }

        .navbar-custom {
            background-color: #007bff; 
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .option-section {
            text-align: center;
            margin-bottom: 10px;
        }

        .option-button {
            padding: 10px 20px;
            font-size: 18px;
        }

        .nav-link-button {
            color: #fff;
            padding: 10px 20px;
            font-size: 18px;
            cursor: pointer;
        }

        .logout-button {
            background-color: #dc3545;
            color: #fff;
            margin-left: 10px;
        }
    body {
      font-family: Arial, sans-serif;
    }

    .container {
      max-width: 600px;
      margin: 50px auto;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .header {
      text-align: center;
      margin-bottom: 20px;
    }

    .label {
      font-weight: bold;
    }
    .other-field {
      display: none;
    }

    .back-button {
      margin-top: 20px;
    }
  </style>
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top navbar-custom">
        <a class="navbar-brand" href="#">Facturaty</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="data.php" class="nav-link nav-link-button">Saisir ma consommation</a>
                </li>
                <li class="nav-item">
                    <a href="reclamation.html" class="nav-link nav-link-button">Réclamer</a>
                </li>
                <li class="nav-item">
                    <a href="facture.php" class="nav-link nav-link-button">Mes factures</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="btn btn-danger logout-button" onclick="logout()">Logout</a>
                </li>
            </ul>
        </div>
</nav>
    <div class="container mt-4" style="max-width: 800px";>
        <h2>Consulter mes factures</h2>
        <div class="form-group d-flex">
            <input type="text" class="form-control" id="searchBar" placeholder="Search">
            <button class="btn btn-primary ml-2" onclick="search()">Search</button>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>ID Facture</th>
                    <th>Mois</th>
                    <th>Consommation</th>
                    <th>Status</th>
                    <th>Prix</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="factureTableBody">
            <?php
                include('dbcon.php');
                $query = "SELECT * FROM facture";
                $result = mysqli_query($con, $query);

                // Loop through each facture in the result set and display it in the table
                
                // Assuming you have fetched prix_ht along with other columns in your SQL query
                while ($facture = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$facture['id_facture']}</td>";
                    echo "<td>{$facture['mois']}</td>";
                    echo "<td>{$facture['consommation']}</td>";
                    echo "<td>{$facture['status']}</td>";
                    echo "<td>{$facture['prix_ht']} DH</td>";
                    echo "<td>
                            <select class=\"form-control\" onchange=\"changeStatus({$facture['id_facture']}, this.value)\">
                                <option value=\"Paid\" " . ($facture['status'] === 'Paid' ? 'selected' : '') . ">Paid</option>
                                <option value=\"Unpaid\" " . ($facture['status'] === 'Unpaid' ? 'selected' : '') . ">Unpaid</option>
                            </select>
                          </td>";
                    echo "<td>
                            <button onclick=\"viewDetails({$facture['id_facture']})\" class=\"btn btn-info btn-sm\">View Details</button>
                          </td>";
                    echo "</tr>";
                }
                mysqli_close($con);
                ?>
            </tbody>
        </table>

        <?php
// Set the session variable for the selected id_facture
$_SESSION['selected_id_facture'] = isset($_GET['id_facture']) ? $_GET['id_facture'] : null;
?>
        
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    
    <script>
        let factureData = [];

function fetchFactureData() {
    $.ajax({
        url: 'get_facture_data.php', 
        method: 'GET',
        success: function(response) {
            factureData = response;
            populateTable(factureData);
        },
        error: function(xhr, status, error) {
            console.error('Error fetching facture data:', error);
        }
    });
}
fetchFactureData();
let Ht;

        function calculatePrice(consommation) {
            if (consommation <= 100) {
                return Ht = consommation * 0.8; 
            } else if (consommation <= 200) {
                return Ht = consommation * 0.9;
            } else {
                return HT = consommation * 1.0;
            }
        }

        function populateTable(data) {
            const tableBody = document.getElementById('factureTableBody');
            tableBody.innerHTML = '';

            data.forEach((facture) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${facture.id_facture}</td>
                    <td>${facture.mois}</td>
                    <td>${facture.consommation}</td>
                    <td>
                        <select class="form-control" onchange="changeStatus(${facture.id_facture}, this.value)">
                            <option ${facture.status === 'Paid' ? 'selected' : ''}>Paid</option>
                            <option ${facture.status === 'Pending' ? 'selected' : ''}>Pending</option>
                            <!-- Add more status options as needed -->
                        </select>
                    </td>
                    <td>${calculatePrice(facture.consommation).toFixed(2)} DH</td>
                    <td>
                    <button onclick="viewDetails(${facture.id_facture})" class="btn btn-info btn-sm">View Details</button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        }

 function search() {
        const searchTerm = document.getElementById('searchBar').value.toLowerCase();
        const filteredData = factureData.filter(facture =>
            facture.mois.toLowerCase().includes(searchTerm)
        );
        populateTable(filteredData);
    }
         

        function changeStatus(id_facture, newStatus) {
            const index = factureData.findIndex(facture => facture.id_facture === id_facture);
            if (index !== -1) {
                factureData[index].status = newStatus;
                populateTable(factureData);
            }
        }
 function goBack() {
            window.location.href = "Choice.html";
        }

        populateTable(factureData);
    </script>
    <script>
    function changeStatus(id_facture, newStatus) {
        window.location.href = `update_status.php?id=${id_facture}&status=${newStatus}`;
    }

function viewDetails(id_facture) {
    window.location.href = `preview.php?id_facture=${id_facture}`;
}

function logout() {
            alert("Vous êtes déconnecté !");
            window.location.href = "index.html"; 
        }
</script>

</body>

</html>
