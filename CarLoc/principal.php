    <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Principal</title>
    <link rel="stylesheet" type="text/css" href="style.css">
	
	<style>
body {
  margin: 0;
}

.container {
  display: flex;
  justify-content: center;
  padding: 50px 0;
  background-image: url('assets/img/OIP.jpeg');
  background-size: cover;
  width: 100%; 
}

form {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: rgba(255,255,255,0.9);
  border-radius: 10px;
  padding: 30px;
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.2);
}

label {
  font-weight: bold;
  margin-right: 20px;
  font-size: 14px;
}

input[type="text"], select {
  padding: 10px;
  font-size: 14px;
  border-radius: 5px;
  box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.1);
  width: 25%;
}

input[type="submit"] {
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 10px;
  padding: 10px 20px;
  font-size: 16px;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #0069d9;
}

	</style>
  </head>
  <body>
    <div class="container">
      <form method="post">
        <label>Marque:</label>
        <input type="text" name="brand">

        <label>Modèle:</label>
        <input type="text" name="model">

        <label>Année:</label>
        <select name="annee">
          <option value="">Tous</option>
          <?php
            // Créer une boucle pour afficher les options pour les années
            $current_year = date('Y');
            for ($i = $current_year; $i >= 1900; $i--) {
              echo "<option value=\"$i\">$i</option>";
            }
          ?>
        </select>

        <label>Kilométrage:</label>
        <select name="km">
          <option value="">Tous</option>
          <option value="0-50000">moins de 50.000</option>
          <option value="50001-100000">50.001 - 100.000</option>
          <option value="100001-150000">100.001 - 150.000</option>
          <option value="150001-200000">150.001 - 200.000</option>
          <option value="200001+">200.001 et plus</option>
        </select>

        <input type="submit" name="search" value="Recherche">
      </form>
    </div>
	
	<br/><br/><br/>
	<center>
	<div><?php
// Vérifier si le formulaire a été soumis
if (isset($_POST['search'])) {
  
  // Récupérer les critères de recherche
  $marque = $_POST['brand'];
  $modele = $_POST['model'];
  $annee = $_POST['annee'];
  $km = $_POST['km'];
  
  // Construire la requête SQL en fonction des critères de recherche
  $query = "SELECT * FROM voiture WHERE 1=1";
  if (!empty($marque)) {
    $query .= " AND Marque='$marque'";
  }
  if (!empty($modele)) {
    $query .= " AND Model='$modele'";
  }
  if (!empty($annee)) {
    $query .= " AND Annee='$annee'";
  }
  if (!empty($km)) {
    $km_range = explode('-', $km);
    $km_min = $km_range[0];
    $km_max = $km_range[1];
    $query .= " AND Kilometrage BETWEEN $km_min AND $km_max";
  }
  
  // Exécuter la requête SQL
  $conn = mysqli_connect("localhost", "root", "", "c");
if (!$conn) {
    die("La connexion à la base de données a échoué: " . mysqli_connect_error());
}
  $result = mysqli_query($conn, $query);
  
  // Afficher les résultats de la recherche
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<div>";
      echo "<img src=\"" . $row['URL_photo'] . "\" alt=\"" . $row['Marque'] . " " . $row['Model'] . "\">";
      echo "<p>" . $row['Marque'] . " " . $row['Model'] . "</p>";
      echo "<p>" . $row['Prix_j'] . " €/jour</p>";
      echo "</div>";
    }
  } else {
    echo "Aucun résultat trouvé.";
  }
  
  // Fermer la connexion à la base de données
  mysqli_close($conn);
}
?></div><br/>
	</center>
  </body>
</html>
