<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <style>
      body {
            padding-top: 60px; /* Ajoute un espacement au-dessus de la barre de navigation fixe */
        }

        .navbar-custom {
            background-color: #007bff; /* Couleur bleue pour la barre de navigation */
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
      background-color: #f8f9fa;
    }

    .container {
      background-color: #ffffff;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      padding: 30px;
      margin-top: 50px;
    }

    .header {
      font-size: 24px;
      margin-bottom: 30px;
      text-align: center;
    }

    form {
      font-family: 'Arial', sans-serif;
    }

    label {
      font-weight: bold;
    }

    select,
    input[type="number"],
    input[type="file"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #ced4da;
      border-radius: 5px;
      box-sizing: border-box;
      background-color: #f1f3f5;
    }

    input[type="submit"],
    input[type="reset"] {
      background-color: #007bff;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 18px;
      margin-right: 10px;
    }

    input[type="submit"]:hover,
    input[type="reset"]:hover {
      background-color: #0056b3;
    }

    #image-preview {
      max-width: 100%;
      margin-top: 20px;
      display: none;
    }

    .error-message {
      color: #dc3545;
      font-size: 14px;
      margin-top: 5px;
      display: none;
    }

    .back-link {
      display: block;
      margin-top: 20px;
      text-align: center;
      color: #007bff;
      text-decoration: none;
    }

    .back-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
      <!-- Barre de navigation -->
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
  <div class="container">
    <div class="header">
      <h1>Saisir ma consommation</h1>
    </div>
    <form action="traitement.php" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="mois">Mois:</label>
        <select class="form-control" id="mois" name="mois" required>
        <option value="1">Janvier</option>
        <option value="2">Février</option>
        <option value="3">Mars</option>
        <option value="4">Avril</option>
        <option value="5">Mai</option>
        <option value="6">Juin</option>
        <option value="7">Juillet</option>
        <option value="8">Août</option>
        <option value="9">Septembre</option>
        <option value="10">Octobre</option>
        <option value="11">Novembre</option>
        <option value="12">Décembre</option>
        </select>
      </div>

      <div class="form-group">
  <label for="annee">Année:</label>
  <select class="form-control" id="annee" name="annee" required>
    <option value="2022">2022</option>
    <option value="2023">2023</option>
    <option value="2024" selected>2024</option>
  </select>
</div>

      <div class="form-group">
        <label for="consommation">Consommation d'électricité (en kWh):</label>
        <input type="number" class="form-control" id="consommation" name="consommation" min="0" required>
        <span class="error-message">Veuillez saisir une valeur positive.</span>
      </div>

      <div class="form-group">
        <label for="photo">Téléversement de la photo du compteur:</label>
        <input type="file" class="form-control" id="photo" name="photo" accept="image/*" onchange="previewImage(this);" required>
        <img id="image-preview" alt="Image Preview">
      </div>

      <button class="btn btn-primary" type="submit">Envoyer</button>
      <button class="btn btn-secondary" type="reset">Réinitialiser</button>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script>
    var consommationInput = document.getElementById("consommation");
    var errorMessage = document.querySelector(".error-message");

    consommationInput.addEventListener("input", function() {
      if (consommationInput.value < 0) {
        consommationInput.setCustomValidity("La valeur de consommation doit être positive.");
        errorMessage.style.display = "block";
      } else {
        consommationInput.setCustomValidity("");
        errorMessage.style.display = "none";
      }
    });

    function previewImage(input) {
      var preview = document.getElementById("image-preview");
      var file = input.files[0];
      var reader = new FileReader();

      reader.onloadend = function () {
        preview.src = reader.result;
        preview.style.display = "block";
      };

      if (file) {
        reader.readAsDataURL(file);
      } else {
        preview.src = "";
        preview.style.display = "none";
      }
    }

    function logout() {
            // Mettez ici le code de déconnexion, par exemple, redirection vers la page de déconnexion.
            alert("Vous êtes déconnecté !");
            window.location.href = "index.html"; // Assurez-vous d'ajuster le chemin selon votre structure de fichiers.
        }
  </script>
</body>
</html>
