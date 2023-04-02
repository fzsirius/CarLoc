<!DOCTYPE html>
<html>
<head>
	<title>Recommandation de voitures</title>
	<style>
		.container {
			margin: 0 auto;
			width: 80%;
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
			border-collapse: collapse;
			width: 100%;
		}

		th, td {
			text-align: left;
			padding: 8px;
		}

		tr:nth-child(even) {
			background-color: #f2f2f2;
		}

		th {
			background-color: #4CAF50;
			color: white;
		}
	</style>
</head>
<body>
	<div class="container">
		<?php
		session_start();
		require_once('nav.php');
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
	                echo "<td><img src='" . $row2['URL_photo'] . "' width='100px'></td>";
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
