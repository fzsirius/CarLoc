<!DOCTYPE html>
<html>
<head>
	<title>Messages des clients</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f2f2f2;
			text-align: center;
            
		}
        	h1 {
		color: #333;
		margin: 10px;
	}

	table {
		margin: auto;
		border-collapse: collapse;
		width: 80%;
		margin-top: 50px;
	}

	th, td {
		padding: 10px;
		text-align: left;
		border-bottom: 1px solid #ddd;
	}

	th {
		background-color: #007bff;
		color: #fff;
	}

	#bt5 {
		color: #0099ff;
		text-decoration: none;
		margin-top: 20px;
		display: inline-block;
		border: 1px solid #0099ff;
		padding: 10px 20px;
		border-radius: 5px;
		transition: background-color 0.2s ease-in-out;
	}

	#bt5:hover {
		background-color: #0099ff;
		color: #fff;
	}
</style>
    </head>
<body>
<?php
require_once('include.php');
require_once('nav_admin.php');


// Créer une connexion
$conn = mysqli_connect($servername = "localhost", $username = "root", $password = "", $dbname = "karim_carloc");

// Vérifier la connexion
if (!$conn) {
	die("Connexion échouée: " . mysqli_connect_error());
}

// Récupérer tous les messages
$sql = "SELECT * FROM contact";
$result = mysqli_query($conn, $sql);

// Vérifier s'il y a des messages à afficher
if (mysqli_num_rows($result) > 0) {
	echo "<h1>Messages des clients</h1>";
	echo "<table>";
	echo "<tr>";
	echo "<th>Nom</th>";
	echo "<th>Email</th>";
	echo "<th>Objet</th>";
	echo "<th>Date de création</th>";
	echo "<th>Message</th>";
	echo "</tr>";
	// Parcourir les messages et afficher chaque message dans une ligne de tableau
	while($row = mysqli_fetch_assoc($result)) {
		echo "<tr>";
		echo "<td>" . $row["nom"] . "</td>";
		echo "<td>" . $row["email"] . "</td>";
		echo "<td>" . $row["objet"] . "</td>";
        echo "<td>" . $row["date_creation"] . "</td>";
		echo '<td><a id = "bt5" href="message.php?id=' . $row["id"] . '">Voir le message</a></td>';
		echo "</tr>";
	}
	echo "</table>";
} else {
	echo "<h1>Aucun message</h1>";
	echo "<p>Aucun message n'a été envoyé pour le moment.</p>";
}


// Fermer la connexion
mysqli_close($conn);
?>
</body>
</html>
