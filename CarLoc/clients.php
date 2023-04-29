<!DOCTYPE html>
<html lang="fr">
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

  <title>Nos clients</title>
    <style>
        body{margin : 10px; margin-top : 75px;}
  h1 {
        color: #333;
        margin: 30px 0;
        text-align: center;
    }

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
session_start();
require_once('include.php');
require_once('nav_admin.php');

// Vérifier si une session admin est en cours
if (!isset($_SESSION['admin']) || empty($_SESSION['admin'])) {
    header("Location: connexion_admin.php");
    exit();
}

// Créer une connexion à la base de données
$conn = mysqli_connect($servername = "localhost", $username = "root", $password = "", $dbname = "karim_carloc");

// Vérifier la connexion
if (!$conn) {
    die("Connexion échouée: " . mysqli_connect_error());
}

// Récupérer tous les clients
$sql = "SELECT * FROM client";
$result = mysqli_query($conn, $sql);

// Vérifier s'il y a des clients à afficher
if (mysqli_num_rows($result) > 0) {
    echo "<h1>Liste des clients</h1>";
    echo "<table>";
    echo "<tr>";
    echo "<th>ID_client</th>";
    echo "<th>Nom</th>";
    echo "<th>Prénom</th>";
    echo "<th>Email</th>";
    echo "<th>Date d'inscription</th>";
    echo "</tr>";
    // Parcourir les clients et afficher chaque client dans une ligne de tableau
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["ID_client"] . "</td>";
        echo "<td>" . $row["Nom"] . "</td>";
        echo "<td>" . $row["Prenom"] . "</td>";
        echo "<td>" . $row["Email"] . "</td>";
        echo "<td>" . $row["date_inscription"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<h1>Aucun client</h1>";
    echo "<p>Aucun client n'a été enregistré pour le moment.</p>";
}

// Fermer la connexion à la base de données
mysqli_close($conn);
?>


</body>
</html>
