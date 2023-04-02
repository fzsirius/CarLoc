<!DOCTYPE html>
<html>
<head>
	<title>Historique des commandes</title>
	<style>
        body{
        margin : 100px;
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

		    // Récupérer toutes les commandes passées par le client avec les informations de la voiture correspondante
		    $sql_select_commandes = "SELECT c.id_commande, v.Marque, v.Model, v.Annee, v.Series, v.Nbre_sieges, v.Prix_j, v.URL_photo, c.quantite, c.statut FROM commande c JOIN voiture v ON c.ID_voiture = v.ID_voiture WHERE c.ID_client = :ID_client";
		    $stmt = $conn->prepare($sql_select_commandes);
		    $stmt->bindParam(":ID_client", $ID_client);
		    $stmt->execute();

		    // Vérifier si l'historique est vide
		    $rowCount = $stmt->rowCount();

		    // Afficher les commandes dans un tableau avec les informations sur la voiture, ou un message si l'historique est vide
		    if ($rowCount > 0) {
		        echo "<table>";
		        echo "<tr><th>ID commande</th><th>Marque</th><th>Modèle</th><th>Année</th><th>Série</th><th>Nombre de sièges</th><th>Prix par jour</th><th>Quantité</th><th>Statut</th><th>Photo</th></tr>";
		        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		            echo "<tr>";
		            echo "<td>" . $row['id_commande'] . "</td>";
		            echo "<td>" . $row['Marque'] ."</td>";
echo "<td>" . $row['Model'] . "</td>";
echo "<td>" . $row['Annee'] . "</td>";
echo "<td>" . $row['Series'] . "</td>";
echo "<td>" . $row['Nbre_sieges'] . "</td>";
echo "<td>" . $row['Prix_j'] . "</td>";
echo "<td>" . $row['quantite'] . "</td>";
echo "<td>" . ($row['statut'] ? "Terminée" : "En cours") . "</td>";
echo "<td><img src='" . $row['URL_photo'] . "' width='100px'></td>";
echo "</tr>";
}
echo "</table>";
} else {
// Gérer le cas où l'ID_client n'existe pas dans la session
echo "<p style='text-align:center;font-size:24px;margin-top:50px;'>Votre historique est vide.</p>";
}}
?>
</div>
</body>
</html>
