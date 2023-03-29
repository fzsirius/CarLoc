<center>
  <div class="row justify-content-center">  <!--on alignera les véhicules à droite pour pouvoir insérer les filtres-->

  <?php

  // Inclure le fichier contenant le formulaire de recherche
  include 'principal.php';
  //requête SQL pour récupérer les voitures qui correspondent aux critères de recherche
  require_once('include.php'); // Charge le fichier include.php
  $db = new connexionDB();  //creation d'une instance de connexionDB
  $conn = $db->DB();

  // Vérifier si le formulaire a été soumis
  if (isset($_POST['search'])) {

    // Récupérer les critères de recherche
    $marque = $_POST['marque'];
    $model = $_POST['model'];
    $annee = $_POST['annee'];
    $energie=$_POST['energie'];
    //$km = $_POST['km'];

    // Construire la requête SQL en fonction des critères de recherche
    $query = "SELECT * FROM voiture WHERE 1=1";
    if (!empty($marque)&& $marque != "toutes") {
      $query .= " AND Marque='$marque'";
    }
    if (!empty($model)&& $model != "tous") {
      $query .= " AND Model='$model'";
    }
    if (!empty($annee) && $annee != "toutes") {    
      $query .= " AND Annee='$annee'";
    }
    if (!empty($energie) && $energie != "toutes") {
      $query .= " AND Type_energie ='$energie'";
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
        echo "<div class='col-md-3 m-2'>";
        echo "<div class='card'>";
        $url = str_replace('"', '', $row['URL_photo']); // supprimer les guillemets de l'url. Les guillemets ont permi l'importation du csv auparavant
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>" . $row['Marque'] . " " . $row['Model'] . "</h5>";
		echo "<img src=\"" . $url . "\" alt=\"" . $row['Marque'] . " " . $row['Model'] . "\" class='card-img-top'>";
        echo "<p class='card-text'>" . $row['Prix_j'] . " €/jour</p>";
		echo "<p class='card-text'>" . $row['Categorie'] . " </p>";
        echo "<a class='btn btn-primary'>Louer</a>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
      }
    } else {
      echo "Aucun résultat trouvé.";
    }

    // Fermer la connexion à la base de données
    mysqli_close($conn);
  }
  ?>

  </div>
</center>
