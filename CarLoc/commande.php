
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- Lien vers la feuille de style Bootstrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  
  <!-- Lien vers style personnalisée -->
  <!--<link rel="stylesheet" href="style.css">-->
  
  <!-- Lien vers le fichier JavaScript de Bootstrap -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
  <!-- Lien vers fichier JavaScript personnalisée -->
  <!--<script src="script.js"></script>-->
    
	<title>Récapitulatif de votre commande</title>
	<style>
	body {
			font-family: Arial, sans-serif;
			background-color: #f2f2f2;
        margin : 100px;
		}
		.container {
			margin: 0 auto;
			padding: 20px;
			background-color: #fff;
			border-radius: 5px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
			max-width: 800px;
			text-align: center; 
		}
		h1 {
			text-align: center;
			color: #444;
		}
		table {
			border-collapse: collapse;
			margin-top: 20px;
			width: 100%;
		}
		th, td {
			text-align: left;
			padding: 8px;
			border-bottom: 1px solid #ddd;
		}
		th {
			background-color: #f2f2f2;
			color: #444;
		}
		tr:hover {
			background-color: #f5f5f5;
		}
		td:last-child, th:last-child {
			text-align: right;
		}
		.btn {
			display: inline-block;
			padding: 8px 12px;
			margin-top: 20px;
			background-color: #4CAF50;
			color: #fff;
			border-radius: 5px;
			text-decoration: none;
			transition: background-color 0.3s ease;
		}
		.btn:hover {
			background-color: #E30509;
		}
	</style>
</head>
<body>
	<div class="container">
		<h1>Récapitulatif de votre commande</h1>
			<?php
		session_start();
require_once('nav.php');
		// Vérifier si le panier existe déjà
		if (isset($_SESSION['panier'])) {
			echo "<table>";
			echo "<tr><th>Marque</th><th>Modèle</th><th>Prix</th><th>Quantité</th><th>Total</th></tr>";

			$total = 0;
			foreach ($_SESSION['panier'] as $ID_voiture => $quantite) {
				// Récupérer les informations de la voiture depuis la base de données
				// Remarque : vous devez remplacer les valeurs ci-dessous par les informations de connexion à votre base de données
				$host = "localhost";
				$db_name = "karim_carloc";
				$username = "root";
				$password = "";
				$conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);

				$stmt = $conn->prepare("SELECT Marque, Model, Prix_j FROM voiture WHERE ID_voiture = :ID_voiture");
				$stmt->bindParam(":ID_voiture", $ID_voiture);
				$stmt->execute();
				$row = $stmt->fetch(PDO::FETCH_ASSOC);

				// Afficher les informations de la voiture
				$marque = $row['Marque'];
				$modele = $row['Model'];
				$prix = $row['Prix_j'];
								$total_voiture = $prix * $quantite;
				$total += $total_voiture;
				
				echo "<tr>";
				echo "<td>$marque</td>";
				echo "<td>$modele</td>";
				echo "<td>$prix €</td>";
				echo "<td>$quantite</td>";
				echo "<td>$total_voiture €</td>";
				echo "</tr>";
			}

			echo "<tr>";
			echo "<td colspan='4' style='text-align: right;'>Total :</td>";
			echo "<td>$total €</td>";
			echo "</tr>";
			echo "</table>";
			echo "<a class='btn' href='commander.php'>Valider</a>";
		} 
		
	?>

</div>
</body>
</html>



