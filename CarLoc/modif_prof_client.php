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

	// Vérifier si le formulaire a été soumis
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// Récupérer les nouvelles informations depuis le formulaire
		$Nom = $_POST["Nom"];
		$Prenom = $_POST["Prenom"];
		$Email = $_POST["Email"];

		// Mettre à jour les informations du client dans la base de données
		$sql = "UPDATE client SET Nom=:Nom, Prenom=:Prenom, Email=:Email WHERE ID_client=:ID_client";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':Nom', $Nom);
		$stmt->bindParam(':Prenom', $Prenom);
		$stmt->bindParam(':Email', $Email);
		$stmt->bindParam(':ID_client', $ID_client);
		$stmt->execute();

		// Rediriger l'utilisateur vers la page de profil mise à jour
		header("Location: profil_client.php");
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Modifier le profil</title>
	<link rel="stylesheet" type="text/css" href="style.css">
    <style>
        body{
        margin : 100px;
        }
.container {
margin: 50px auto;
width: 80%;
text-align: center;
}

h1 {
font-size: 36px;
color: #333;
}

.form {
margin: 20px;
padding: 20px;
border: 1px solid #ccc;
background-color: #f7f7f7;
text-align: left;
}

input[type="text"], input[type="email"] {
width: 100%;
padding: 10px;
margin-bottom: 20px;
border: 1px solid #ccc;
border-radius: 5px;
}
input[type="submit"], bt {
  background-color: #4CAF50; /* couleur de fond */
  color: white; /* couleur de texte */
  padding: 12px 20px; /* taille du padding */
  border: none; /* pas de bordure */
  border-radius: 5px; /* coins arrondis */
  cursor: pointer; /* curseur de souris en pointer */
  margin-right: 10px; /* marge à droite pour séparer les boutons */
}

input[type="submit"]:hover, bt:hover {
  background-color: #3e8e41; /* couleur de fond au survol */
}
input[type="submit"]:hover, bt2:hover {
  background-color: #3e8e41; /* couleur de fond au survol */
}

#bt2 {
  background-color: #4CAF50; /* couleur de fond */
  color: white; /* couleur de texte */
  padding: 12px 20px; /* taille du padding */
  border: none; /* pas de bordure */
  border-radius: 5px; /* coins arrondis */
  cursor: pointer; /* curseur de souris en pointer */
  margin-right: 10px; /* marge à droite pour séparer les boutons */
}
#bt2:hover {
  background-color: #3e8e41; /* couleur de fond au survol */
}
        </style>
</head>
<body>
       <?php require_once('nav.php');?>

	<div class="container">
		<h1>Modifier le profil</h1>
		<form class="form" method="POST">
			<label for="Nom">Nom :</label>
			<input type="text" name="Nom" value="<?php echo $client['Nom']; ?>">
			<label for="Prenom">Prénom :</label>
			<input type="text" name="Prenom" value="<?php echo $client['Prenom']; ?>">
			<label for="Email">
                Email :</label>
<input type="email" name="Email" id="Email" value="<?php echo $client['Email']; ?>">
<br>
<input type="submit" value="Enregistrer les modifications">
            <BR/><BR/><BR/>
            <a id = "bt2" href="profil_client.php">Annuler</a>

</form>
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