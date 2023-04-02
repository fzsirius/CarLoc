<?php
session_start();

// Vérifier si le client est connecté
if (isset($_SESSION['client']['id'])) {
	// Récupérer les informations du client depuis la base de données
	$host = "localhost";
	$db_name = "karim_carloc";
	$username = "root";
	$password = "";
	$conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
	$ID_client = $_SESSION['client']['id'];
	$sql = "SELECT * FROM client WHERE ID_client = :ID_client";
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(":ID_client", $ID_client);
	$stmt->execute();
	$client = $stmt->fetch(PDO::FETCH_ASSOC);

	// Afficher les informations du client dans la page
?>
<!DOCTYPE html>
<html>
<head>
	<title>Profil client</title>
	<link rel="stylesheet" type="text/css" href="style.css">
    
    <style>
/* Réinitialisation des styles par défaut */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

/* Styles pour le corps de la page */
body {
  font-family: Arial, sans-serif;
  background-color: #f7f7f7;
  color: #333;
    margin : 100px;
}

.container {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
  background-color: #fff;
  box-shadow: 0 2px 4px rgba(0,0,0,.1);
}

h1 {
  font-size: 32px;
  font-weight: bold;
  margin-bottom: 20px;
}

.info {
  border-top: 2px solid #ccc;
  margin-top: 20px;
  padding-top: 20px;
}

.info p {
  margin-bottom: 10px;
}

.info p strong {
  display: inline-block;
  width: 120px;
  font-weight: bold;
}

/* Styles pour les liens */
#bt2 {
  color: #333;
  text-decoration: none;
  border: 2px solid #333;
  padding: 10px 20px;
  border-radius: 5px;
  display: inline-block;
  margin-top: 20px;
}

#bt2:hover {
  background-color: #333;
  color: #fff;
}

/* Styles pour le bouton de retour */
button {
  background-color: #333;
  color: #fff;
  padding: 10px 20px;
  border-radius: 5px;
  border: none;
  cursor: pointer;
  margin-top: 20px;
}

button:hover {
  background-color: #555;
}

/* Styles pour les formulaires */
form {
  margin-top: 20px;
}

label {
  display: block;
  margin-bottom: 10px;
}

input[type="text"],
input[type="email"],
input[type="password"] {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  margin-bottom: 10px;
}

input[type="submit"] {
  background-color: #333;
  color: #fff;
  padding: 10px 20px;
  border-radius: 5px;
  border: none;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #555;
}

    </style>
</head>
<body>
    <?php require_once('nav.php');?>
	<div class="container">
		<h1>Profil</h1>
		<div class="info">
			<p>Nom : <?php echo $client['Nom']; ?></p>
            <p>Prenom : <?php echo $client['Prenom']; ?></p>
			<p>Email : <?php echo $client['Email']; ?></p>
		
		</div>
		<a id="bt2" href="modif_prof_client.php">Modifier le profil</a>
	</div>



</body>
</html>
<?php
} else {
	// Rediriger l'utilisateur vers la page de connexion si le client n'est pas connecté
	header("Location: connexion.php");
	exit();
}
?>
