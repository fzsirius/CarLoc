<!DOCTYPE html>
<html>
<head>
     <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--<link rel="stylesheet" href="style.css">-->

	<title>Recommandation de voitures</title>
	<style>
        body{margin-top : 100px;}
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
  width: 100%; 
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
	<div class="container">
		<?php
		session_start();
		require_once('nav.php');
		// Remarque : vous devez remplacer les valeurs ci-dessous par les informations de connexion à votre base de données
		$host = "localhost";
		$db_name = "karim_carloc";
		$username = "root";
		$password = "";
		$conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);

		// Récupérer l'ID_client depuis la session
		if (isset($_SESSION['client']['id'])) {
		    $ID_client = $_SESSION['client']['id'];

		    // Récupérer les commandes passées par le client
		    $sql_select_commandes = "SELECT c.ID_voiture, v.Marque, v.Model, v.Annee, v.Series, v.Nbre_sieges, v.Prix_j, v.URL_photo FROM commande c JOIN voiture v ON c.ID_voiture = v.ID_voiture WHERE c.ID_client = :ID_client";
		    $stmt = $conn->prepare($sql_select_commandes);
		    $stmt->bindParam(":ID_client", $ID_client);
		    $stmt->execute();

		    // Vérifier si l'historique est vide
            
		    $rowCount = $stmt->rowCount();

		    // Si l'historique n'est pas vide, récupérer les voitures similaires à celles commandées par le client
		    if ($rowCount > 0) {
		        // Récupérer les ID_voiture des voitures commandées par le client
		        $ID_voitures_commandees = array();
		        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		            array_push($ID_voitures_commandees, $row['ID_voiture']);
		        }

		        // Récupérer les voitures similaires à celles commandées par le client (même marque, modèle, série et nombre de sièges)
		        $sql_select_voitures_similaires = "SELECT ID_voiture, Marque, Model, Annee, Series, Nbre_sieges, Prix_j, URL_photo FROM voiture WHERE ID_voiture NOT IN (" . implode(',', $ID_voitures_commandees) . ") AND (Marque, Model, Series, Nbre_sieges) IN (SELECT Marque, Model, Series, Nbre_sieges FROM voiture WHERE ID_voiture IN (" . implode(',', $ID_voitures_commandees) . "))";
		        $stmt2 = $conn->prepare($sql_select_voitures_similaires);
$stmt2->execute();
$rowCount2 = $stmt2->rowCount();
                	        // Afficher les voitures similaires dans un tableau, ou un message si aucune voiture similaire n'a été trouvée
	        if ($rowCount2 > 0) {
        echo "<h2>Voitures similaires à celles que vous avez déjà commandées :</h2>";
        while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='col-md-4'>";
            echo "<div class='card'>";
            echo "<img class='card-img-top' src='" . $row2['URL_photo'] . "' alt='" . $row2['Marque'] . " " . $row2['Model'] . "'>";
            echo "<div class='card-body'>";
            echo "<h3 class='card-title'>" . $row2['Marque'] . " " . $row2['Model'] . " "   . $row2['Annee'] . "</h3>";
           
            echo "<p class='card-text'>Prix par jour : " . $row2['Prix_j'] . " €</p>";
          
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }} else {
	            echo "<p style='text-align:center;font-size:24px;margin-top:50px;'>Aucune voiture similaire n'a été trouvée.</p>";
	        }
	    } else {
	        echo "<p style='text-align:center;font-size:24px;margin-top:50px;'>Vous n'avez pas encore commandé de voitures.</p>";
	    }
	} else {
	    echo "<p style='text-align:center;font-size:24px;margin-top:50px;'>Vous devez vous connecter pour accéder à cette page.</p>";
	}
	?>
</div>
</body>
</html>
