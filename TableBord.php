<!DOCTYPE html>
<html>
<head>
  <title>Tableau de bord</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

  <div class="container">
    <h1>Tableau de bord</h1>

    <div class="row">
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Nombre total de clients</h5>
            <p class="card-text" id="totalClients"><?php getDataFromDatabase("clients"); ?></p>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Nombre total de réclamations</h5>
            <p class="card-text" id="totalReclamations"><?php getDataFromDatabase("reclamations"); ?></p>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Nombre total de factures</h5>
            <p class="card-text" id="totalFactures"><?php getDataFromDatabase("factures"); ?></p>
          </div>
        </div>
      </div>
    </div>

    <button class="btn btn-primary mt-3" onclick="redirectToAccueil()">Retour à l'accueil</button>
  </div>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script>
    // Fonction pour rediriger vers la page d'accueil
    function redirectToAccueil() {
      // Ajoutez ici le code pour rediriger vers la page d'accueil
      console.log("Redirection vers l'accueil");
    }
  </script>
</body>
</html>