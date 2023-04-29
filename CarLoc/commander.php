<?php
session_start();

if (isset($_SESSION['panier'])) {
	// Remarque : vous devez remplacer les valeurs ci-dessous par les informations de connexion à votre base de données
	$host = "localhost";
	$db_name = "karim_carloc";
	$username = "root";
	$password = "";
	$conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);

	// Récupérer l'ID_client depuis la session
	if (isset($_SESSION['client']['id'])) {
		$ID_client = $_SESSION['client']['id'];
	} else {
		// Gérer le cas où l'ID_client n'existe pas dans la session
		echo "Erreur : Impossible de récupérer l'ID_client depuis la session.";
		exit();
	}

	// Ajouter chaque voiture du panier dans la table commande
	foreach ($_SESSION['panier'] as $ID_voiture => $quantite) {
		// Insérer la commande dans la table commande
		$sql_insert_commande = "INSERT INTO commande (ID_voiture, ID_client, quantite, statut)
								VALUES (:ID_voiture, :ID_client, :quantite, false)";
		$stmt = $conn->prepare($sql_insert_commande);
		$stmt->bindParam(":ID_voiture", $ID_voiture);
		$stmt->bindParam(":ID_client", $ID_client);
		$stmt->bindParam(":quantite", $quantite);
		$stmt->execute();
	}

	// Vider le panier
	unset($_SESSION['panier']);

	// on affiche un message de confirmation et  un lien pour revenir à la page principale
	echo "<div style='background-color: #DFF2BF; border: 1px solid #4F8A10; color: #4F8A10; padding: 10px; margin: 0 auto; width: 50%; text-align: center;'>
			Votre demande a été transmise avec succès !<br> 
			La récupération de votre voiture se fera à l'agence sur présentation de vos papiers officiels (permis).<br><br>
			<a href='principal.php' style='background-color: #4CAF50; border: none; color: white; padding: 10px 20px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer;'>Retour à la page principale</a>
		</div>";
} else {
	// Rediriger l'utilisateur vers la page panier.php si le panier est vide
	header("Location: panier.php");
	exit();
}
?>
