<?php  session_start();?>
<!DOCTYPE html>
<html>
<head>
      <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Commandes reçues</title>
    <style>
        body{
            margin-top : 100px;
        }
    table {
        margin: auto;
        border-collapse: collapse;
        width: 95%;
        margin-top: 30px;
        border-radius: 10px;
        overflow: hidden;
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
        #poto {
   width: 90px;
  height: 60px;
  border-radius: 5%;
  border: 1px solid;
}
        
        #id {
		color: #0099ff;
		text-decoration: none;
		margin-top: 20px;
		display: inline-block;
		border: 1px solid #0099ff;
		padding: 10px 20px;
		border-radius: 5px;
		transition: background-color 0.2s ease-in-out;
	}

	#id:hover {
		background-color: #689f38;
		color: #fff;
	}
    </style>
</head>
<body>
    <?php
    require_once('nav_admin.php');
    // Vérifier si l'administrateur est connecté
   
    if(isset($_SESSION['admin'])) {        
        // Connexion à la base de données
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "karim_carloc";
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // Vérifier la connexion à la base de données
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Requête SQL pour récupérer toutes les commandes avec les informations sur le client et la voiture
        $sql = "SELECT commande.ID_commande, commande.quantite, commande.statut, voiture.Marque, voiture.Model, voiture.Prix_j, voiture.URL_photo, client.Nom, client.Prenom, client.Email FROM commande INNER JOIN voiture ON commande.ID_voiture = voiture.ID_voiture INNER JOIN client ON commande.ID_client = client.ID_client WHERE commande.statut=0";
        $result = mysqli_query($conn, $sql);

        // Vérifier si des commandes ont été trouvées
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                echo "<table>";
                echo "<tr><th>Nom</th><th>Prénom</th><th>Email</th><th>Marque</th><th>Modèle</th><th>Prix/jour</th><th>Photo</th><th>Quantité</th><th>Statut</th><th>Action</th></tr>";
                // Afficher les informations de chaque commande
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr><td>" . $row["Nom"]. "</td><td>" . $row["Prenom"]. "</td><td>" . $row["Email"]. "</td><td>" . $row["Marque"]. "</td><td>" . $row["Model"]. "</td><td>" . $row["Prix_j"]. "</td><td><img id = 'poto' src=\"" . $row["URL_photo"] . "\" height=\"100\"></td><td>" . $row["quantite"]. "</td><td>En attente</td><td><form method='POST' action='valider_commande.php?id_commande=" . $row["ID_commande"] . "'><input id = 'id' type='submit' value='Valider'></form></td></tr>";
                }
                echo "</table>";
            } else {
                echo "Aucune commande trouvée";
            }
        } else {
            echo "Erreur de requête : " . mysqli_error($conn);
    }

    // Fermer la connexion à la base de données
    mysqli_close($conn);
} else {
    // Rediriger l'utilisateur vers la page de connexion administrateur
    header
("Location: demandes_recues.php");
}
?>

</body>
</html> 