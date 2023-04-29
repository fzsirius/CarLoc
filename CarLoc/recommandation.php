<!DOCTYPE html>
<html>
<head>
     <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--<link rel="stylesheet" href="style.css">-->

	<title>Recommandation de voitures</title>
	<style>
		.container {
			margin: 0 auto;
			width: 100%;
			padding-top: 50px;
		}

		h1 {
			text-align: center;
		}

		.empty {
			text-align: center;
			font-size: 24px;
			font-weight: bold;
			color: #ccc;
		}

	    table {
        margin: auto;
        border-collapse: collapse;
        width: 100%;
        margin-top: 30px;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    th,
    td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #689f38;
        color: #fff;
    }

    tr:hover {
        background-color: #f5f5f5;
    }
        #photocar {
  width: 90px;
  height: 60px;
  border-radius: 5%;
  border: 1px solid;
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
	            echo "<table>";
	            echo "<tr><th>Marque</th><th>Modèle</th><th>Année</th><th>Série</th><th>Nombre de sièges</th><th>Prix par jour</th><th>Photo</th></tr>";
	            while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
	                echo "<tr>";
	                echo "<td>" . $row2['Marque'] . "</td>";
	                echo "<td>" . $row2['Model'] ."</td>";
	                echo "<td>" . $row2['Annee'] . "</td>";
	                echo "<td>" . $row2['Series'] . "</td>";
	                echo "<td>" . $row2['Nbre_sieges'] . "</td>";
	                echo "<td>" . $row2['Prix_j'] . "</td>";
	                echo "<td><img id = 'photocar' src='" . $row2['URL_photo'] . "' width='100px'></td>";
	                echo "</tr>";
	            }
	            echo "</table>";
	        } else {
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
