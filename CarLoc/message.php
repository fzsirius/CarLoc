<!DOCTYPE html>
<html>
<head>
	<title>Message du client</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f2f2f2;
			text-align: center;
		}
h1 {
		color: #333;
		margin-top: 50px;
		text-transform: uppercase;
		font-size: 36px;
		letter-spacing: 2px;
	}

	table {
		margin: 50px auto;
		border-collapse: collapse;
		width: 80%;
		background-color: #fff;
		box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
		border-radius: 10px;
		overflow: hidden;
		display: inline-block;
		text-align: left;
	}

	th, td {
		padding: 20px;
		text-align: left;
		border-bottom: 1px solid #ddd;
	}

	th {
		background-color: #007bff;
		color: #fff;
		text-transform: uppercase;
		letter-spacing: 1px;
	}

	td {
		font-size: 18px;
		color: #333;
		line-height: 24px;
        max-width: 100%;
	}

	a {
			color: #0099ff;
			text-decoration: none;
			margin-top: 20px;
			display: inline-block;
			border: 1px solid #0099ff;
			padding: 10px 20px;
			border-radius: 5px;
			transition: background-color 0.2s ease-in-out;
		}

		a:hover {
			background-color: #0099ff;
			color: #fff;
		}
</style>

</head>
<body>
	<?php
	require_once('include.php');
// Vérifier si un ID de message a été spécifié
if (isset($_GET['id'])) {
    // Récupérer l'ID de message depuis l'URL
    $id = $_GET['id'];

    // Créer une connexion
    $conn = mysqli_connect($servername = "localhost", $username = "root", $password = "", $dbname = "karim_carloc");

    // Vérifier la connexion
    if (!$conn) {
        die("Connexion échouée: " . mysqli_connect_error());
    }

    // Récupérer le message correspondant à l'ID
    $sql = "SELECT * FROM contact WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    // Vérifier s'il y a un message à afficher
    if (mysqli_num_rows($result) > 0) {
        // Récupérer les données du message
        $row = mysqli_fetch_assoc($result);
        $nom = $row['nom'];
        $email = $row['email'];
$objet = $row['objet'];
$message = $row['message'];
            // Afficher le message dans un tableau
    echo "<h1>Message du client</h1>";
    echo "<table>";
    echo "<tr><th>De:</th><td>$nom &lt;$email&gt;</td></tr>";
    echo "<tr><th>Objet:</th><td>$objet</td></tr>";
    echo "<tr><th>Message:</th><td style='word-wrap: break-word;'>$message</td></tr>"; // Ajouter la propriété CSS 'word-wrap' pour que le message s'adapte en fonction de sa longueur et ne dépasse pas de la cellule de tableau

    echo "</table>";
} else {
    // Si aucun message n'a été trouvé, afficher un message d'erreur
    echo "<h1>Message introuvable</h1>";
    echo "<p>Le message que vous avez demandé n'existe pas.</p>";
}

// Fermer la connexion
mysqli_close($conn);
    } else {
// Si aucun ID de message n'a été spécifié, afficher un message d'erreur
echo "<h1>Message introuvable</h1>";
echo "<p>Désolé, nous n'avons pas pu trouver le message que vous cherchez.</p>";
}
?>
    <br/><a href="consult_contact.php">Retour en arrière</a>
</body>
</html>

