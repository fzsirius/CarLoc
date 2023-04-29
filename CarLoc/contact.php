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
    
	<title>Confirmation de message envoyé</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f2f2f2;
			text-align: center;
		}

		h1 {
			color: #333;
			margin-top: 50px;
		}

		p {
			color: #666;
			font-size: 18px;
			margin-top: 20px;
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

// Créer une connexion
$conn = mysqli_connect($servername = "localhost", $username = "root", $password = "", $dbname = "karim_carloc");

// Vérifier la connexion
if (!$conn) {
    die("Connexion échouée: " . mysqli_connect_error());
}

// Récupérer les données du formulaire
$nom = mysqli_real_escape_string($conn, $_POST['nom']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$objet = mysqli_real_escape_string($conn, $_POST['objet']);
$message = mysqli_real_escape_string($conn, $_POST['message']);

// Créer la requête SQL
$sql = "INSERT INTO contact (nom, email, objet, message) VALUES ('$nom', '$email', '$objet', '$message')";

// Exécuter la requête SQL
if (mysqli_query($conn, $sql)) {
    echo "<h1>Message envoyé!</h1>";
    echo "<p>Message envoyé avec succès</p>";
 echo"<br/>";
echo "<a href='index.php'>Retour à la page d'accueil</a>";
} else {
    echo "Erreur: " . $sql . "<br>" . mysqli_error($conn);
}


// Fermer la connexion
mysqli_close($conn);
?>
</body>
</html>