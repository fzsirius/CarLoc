<!DOCTYPE html>
<html>
<head>
      <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- Lien vers style personnalisée -->
  <!--<link rel="stylesheet" href="style.css">-->
	<title>Historique des commandes</title>
	<style>
    
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
echo "<td><img id = 'photocar' src='" . $row['URL_photo'] . "' width='100px'></td>";
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
