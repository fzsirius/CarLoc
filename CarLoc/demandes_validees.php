<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- Lien vers la feuille de style Bootstrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  
  <!-- Lien vers style personnalisée -->
  <!--<link rel="stylesheet" href="style.css">-->
  

  <title>Demandes validées</title>
    <style>
	body{
		margin-top : 100px;
	}
	  h1 {
        color: #333;
        margin: 30px 0;
        text-align: center;
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
    

    #bt5 {
        color: #0099ff;
        text-decoration: none;
        display: inline-block;
        border: 2px solid #0099ff;
        padding: 10px 20px;
        border-radius: 30px;
        transition: background-color 0.2s ease-in-out;
        margin: 30px auto;
        display: block;
        width: 200px;
        text-align: center;
    }

    #bt5:hover {
        background-color: #0099ff;
        color: #fff;
    }

    @media screen and (max-width: 768px) {
        table {
            width: 100%;
        }
    }

</style>
</head>
<body>
  <!--  contenu de la page  -->
    
<?php
require_once('nav_admin.php');

// Connexion à la base de données
$conn = new mysqli("localhost", "root", "", "karim_carloc");

// Vérification de la connexion
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Exécution de la requête SQL
$sql = "SELECT commande.id_commande, voiture.Marque, voiture.Annee, voiture.Model, voiture.URL_photo, client.Nom, client.Prenom, commande.statut
        FROM commande
        JOIN voiture ON commande.ID_voiture = voiture.ID_voiture
        JOIN client ON commande.ID_client = client.ID_client
        WHERE commande.statut = '1'
        ORDER BY commande.id_commande DESC;";
$result = $conn->query($sql);

// Vérification des résultats
if ($result->num_rows > 0) {
  echo "<table>
          <thead>
            <tr>
              <th>ID Commande</th>
              <th>Voiture commandée</th>
              <th>Client</th>
              <th>Statut</th>
            </tr>
          </thead>
          <tbody>";
  while($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>".$row["id_commande"]."</td>
            <td>
              <div style='display:flex;align-items:center;'>
                <img id ='poto' src='".$row["URL_photo"]."' alt='".$row["Marque"]." ".$row["Model"]."' width='100' height='auto' style='margin-right:10px;'>
                <div>
                  <p style='margin:0;'>".$row["Marque"]." ".$row["Model"]."</p>
                  <p style='margin:0;'>Année : ".$row["Annee"]."</p>
                </div>
              </div>
            </td>
            <td>".$row["Nom"]." ".$row["Prenom"]."</td>
            <td>".$row["statut"]."</td>
          </tr>";
  }
  echo "</tbody></table>";
} else {
  echo "Aucune commande validée trouvée.";
}

// Fermeture de la connexion à la base de données
$conn->close();
?>
</body>
</html>
