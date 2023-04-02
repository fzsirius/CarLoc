<?php session_start();?>
<head>
  <style>
    /* Style pour l'affichage de la voiture en grand */
    #voiture {
        padding : 100px;
        margin: auto;
        width: 80%;
        text-align: center;
    }
    #voiture img {
        width: 70%;
        height: auto;
    }

    #voiture table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    #voiture td {
        padding: 10px;
        border: 1px solid black;
        text-align: center;
    }

    #voiture td:first-child {
        font-weight: bold;
        background-color: #E30509;
        color: white;
    }

    /* Style pour le bouton de soumission */
    input[type=submit] {
        color: #fff;
        background-color: #00bfff;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.2s ease-in-out;
        display: inline-block;
        margin-top: 20px;
        border: none;
        cursor: pointer;
    }

    input[type=submit]:hover {
        background-color: #E30509;
    }
	.form-label {
  font-size: 1.2rem;
  font-weight: bold;
  color: #333;
  margin-right: 10px;
}

.form-input {
  border: 2px solid #ccc;
  border-radius: 5px;
  padding: 8px;
  font-size: 1rem;
  width: 60px;
  margin: 0 10px;
}

  </style>
</head>

<body>
    <?php require_once("nav.php");?>
    <?php
    // Récupérer les paramètres de l'URL
    $marque = $_GET['marque'];
    $modele = $_GET['modele'];
    $annee = $_GET['annee'];
    $energie = $_GET['energie'];

    // Construire la requête SQL pour récupérer les informations de la voiture sélectionnée
    $query = "SELECT * FROM voiture WHERE Marque='$marque' AND Model='$modele' AND Annee='$annee' AND Type_energie='$energie'";

    // Exécuter la requête SQL
    $conn = mysqli_connect("localhost", "root", "", "karim_carloc");
    if (!$conn) {
        die("La connexion à la base de données a échoué: " . mysqli_connect_error());
    }
    $result = mysqli_query($conn, $query);

    // Afficher les informations de la voiture sélectionnée
    if ($row = mysqli_fetch_assoc($result)) {
        echo "<div id='voiture'>";
        $url = str_replace('"', '', $row['URL_photo']); // supprimer les guillemets de l'url. Les guillemets ont permi l'importation du csv auparavant
        echo "<img src=\"" . $url . "\" alt=\"" . $row['Marque'] . " " . $row['Model'] . "\">";
        echo "<table>";
        echo "<tr><td>Marque et modèle</td><td>" . $row['Marque'] . " " . $row['Model'] . "</td></tr>";
        echo "<tr><td>Année</td><td>" . $row['Annee'] . "</td></tr>";
        echo "<tr><td>Type d'énergie</td><td>" . $row['Type_energie'] . "</td></tr>";
        echo "<tr><td>Prix journalier</td><td>" . $row['Prix_j'] . " €</td></tr>";
echo "<tr><td>Catégorie</td><td>" . $row['Categorie'] . "</td></tr>";
// Ajouter le formulaire pour l'ajout au panier
if (isset($_SESSION['client'])) {
  echo "<form method='post' action='ajout.php'>";
  echo "<input type='hidden' name='ID_voiture' value='" . $row['ID_voiture'] . "' />";
  echo "<BR/>";
  

  
  // Ajouter un input submit avec la valeur "Ajoutez à votre panier"
  echo "<input type='submit' value='Ajoutez à votre panier' />";
  echo "</form>";
  echo "</div>";
}
}

// Fermer la connexion à la base de données
mysqli_close($conn);
?>
</body>



<!--
// Ajouter un input number pour choisir le nombre de jours de location
  echo "<label for='nb_jours' class='form-label'>Nombre de jours de location:</label>";
 echo "<input type='number' name='duree_j' id='duree_j' value='1' min='1' class='form-input' />";
-->