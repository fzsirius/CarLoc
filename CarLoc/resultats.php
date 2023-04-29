<!DOCTYPE html>
<html>
<head>
     <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--<link rel="stylesheet" href="style.css">-->
<head>
  <style>
  .card {
      height: 100%;
      border: 1px solid #ddd;
      border-radius: 5px;
      padding: 10px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
      transition: all 0.3s ease;
      width: 100%;
      margin-right: 1%;
      margin-bottom: 20px;
      height: 400px; /* hauteur fixe pour la carte */
    }

    .col-md-4 {
      width: 33.33%;
      margin-bottom: 20px;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    @media (max-width: 767px) {
      .col-md-4 {
        width: 50%;
      }
    }

    .card-body {
      height: calc(100% - 200px); /* hauteur fixe pour le corps de la carte */
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }
      .card:hover {
box-shadow: 0 4px 8px rgba(0,0,0,0.3);
transform: translateY(-5px);
}

    .card-img-top {
      height: 200px;
      object-fit: cover;
      border-radius: 5px;
    }

    .card-title {
      font-size: 1.2rem;
      margin-bottom: 0;
    }

    .card-text {
      margin-bottom: 0.5rem;
    }

.btn-primary {
  background-color: #007bff;
  border-color: #007bff;
  color: #fff;
  padding: 10px 20px;
  border-radius: 5px;
  font-size: 1rem;
  cursor: pointer;
}

.btn-primary:hover {
  background-color: #E30509;
  border-color: #0062cc;
}

      
    .center-content {
      text-align: center;
    }

    .row {
      display: flex;
      flex-wrap: wrap;
      margin: 0 -1%;
    }

  </style>
</head>
<body>
    <center>
  <?php   // Inclure le fichier contenant le formulaire de recherche
  include 'principal.php';
  ?>
  <?php
  //requête SQL pour récupérer les voitures qui correspondent aux critères de recherche
  require_once('include.php'); // Charge le fichier include.php
  $db = new connexionDB();  //creation d'une instance de connexionDB
  $conn = $db->DB();

  // Vérifier si le formulaire a été soumis
  if (isset($_POST['search'])) {

    // Récupérer les critères de recherche
    $marque = $_POST['brand'];
    $modele = $_POST['model'];
    $annee = $_POST['annee'];
    $energie = $_POST['energie'];
    //$km = $_POST['km'];

    // Construire la requête SQL en fonction des critères de recherche
    $query = "SELECT * FROM voiture WHERE 1=1";
    if (!empty($marque)) {
      $query .= " AND Marque='$marque'";
    }
    if (!empty($modele)) {
      $query .= " AND Model='$modele'";
    }
    if (!empty($annee) && $annee != "toutes") {
      $query .= " AND Annee='$annee'";
    }
    if (!empty($energie) && $energie != "tous") {
      $query .= " AND Type_energie ='$energie'";
    }
    // Exécuter la requête SQL
    $conn = mysqli_connect("localhost", "root", "", "karim_carloc");
    if (!$conn) {
      die("La connexion à la base de données a échoué: " . mysqli_connect_error());
    }
    $result = mysqli_query($conn, $query);

    // Afficher les résultats de la recherche
    if (mysqli_num_rows($result) > 0) {
      echo '<div class="row">';
      while ($row = mysqli_fetch_assoc($result)) {
echo '
<div class="col-md-4 mb-4 center-content">
<div class="card h-100">
<img src="'.$row['URL_photo'].'" class="card-img-top" alt="...">
<div class="card-body">
<h5 class="card-title">'.$row['Marque'].' '.$row['Model'].'</h5>
<p class="card-text">'.$row['Annee'].'</p>
<p class="card-text"><strong>Prix par jour:</strong> '.$row['Prix_j'].' €</p>
<a href="voiture_details.php?marque='.$row['Marque'].'&modele='.$row['Model'].'&annee='.$row['Annee'].'&energie='.$row['Type_energie'].'" class="btn btn-primary">Consulter</a>
        </div>
      </div>
    </div>';
  }
  echo '</div>';
} else {
  echo "Aucune voiture n'est disponible pour le moment.";
}

// Fermer la connexion à la base de données
mysqli_close($conn);
      }
?>
</body>
