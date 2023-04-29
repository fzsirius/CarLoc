<!DOCTYPE html>
<html>
<head>
     <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Panier</title>
	<style>
		body {
            margin : 100px;
			font-family: Arial, sans-serif;
			background-color: #f2f2f2;
		}
        	.container {
		margin: 0 auto;
		padding: 20px;
		background-color: #fff;
		border-radius: 5px;
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
		max-width: 800px;
	}

	h1 {
		text-align: center;
		color: #444;
		margin-bottom: 30px;
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
		font-weight: normal;
		text-transform: uppercase;
	}

	tr:hover {
		background-color: #f5f5f5;
	}

	td:last-child, th:last-child {
		text-align: right;
	}

	.btn {
		display: inline-block;
		padding: 10px 20px;
		margin: 20px 5px 0 0;
		background-color: #4CAF50;
		color: #fff;
		border-radius: 5px;
		text-decoration: none;
		transition: background-color 0.3s ease;
	}

	.btn:hover {
		background-color: #0099ff;
	}

	.empty {
		text-align: center;
		margin: 50px auto;
		font-size: 24px;
		color: #666;
	}

</style>
</head>
<body>
	<?php require_once('nav.php'); ?>
	<div class="container">
		<?php
			session_start();
		// Vérifier si le panier existe déjà
		if (isset($_SESSION['panier'])) {
			// Afficher les voitures ajoutées au panier
			echo "<h1>Panier</h1>";
			echo "<table>";
			echo "<tr><th>Marque</th><th>Modèle</th><th>Prix unitaire</th><th>Quantité</th><th>Total</th></tr>";

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

// Calculer le total de la voiture
$total_voiture = $prix * $quantite;

// Ajouter le total de la voiture au total général
$total += $total_voiture;

// Afficher les informations de la voiture dans une nouvelle ligne du tableau
echo "<tr>";
echo "<td>$marque</td>";
echo "<td>$modele</td>";
echo "<td>$prix €</td>";
echo "<td>$quantite</td>";
echo "<td>$total_voiture €</td>";
echo "</tr>";
}

// Afficher le total général
echo "<tr>";
echo "<td colspan='4' style='text-align: right;'>Total :</td>";
echo "<td>$total €</td>";
echo "</tr>";
echo "</table>";

// Ajouter les boutons pour vider le panier et commander
echo "<div style='text-align: center;'>";
echo "<a class='btn' href='supprimer_panier.php'>Vider le panier</a>";
echo "<a class='btn' href='commande.php'>Commander</a>";
echo "</div>";
} else {
// Afficher un message si le panier est vide
echo "<h2>Votre panier est vide.</h2>";
}

// Ajouter un bouton pour retourner à la page d'accueil
echo "<div style='text-align: center;'>";
echo "</div>";

?>
</div>
</body>
</html>
