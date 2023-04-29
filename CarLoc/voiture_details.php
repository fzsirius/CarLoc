<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
     <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--<link rel="stylesheet" href="style.css">-->
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
        background-color: #689f38;
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


input[type="submit"], button {
  background-color: #4CAF50;
  color: #fff;
  border: none;
  padding: 10px 20px;
  font-size: 16px;
  cursor: pointer;
}

label {
  display: block;
  margin-bottom: 10px;
}

input[type="text"],
textarea {
  width: 40%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: none;
  box-sizing: border-box;
}

textarea {
  height: 100px;
}

#tableau {
  position: absolute;
  top: 80%;
  left: 50%;
  transform: translate(-50%, -50%);
}

#co {
  background-color: #f5f5f5;
  margin-top: 45px;;
  width: 100%;
  height: 400px;
  align-items: center;
  justify-content: center;
    padding-top : 50px;
}
#coe {
  background-color: #f5f5f5;
  margin-top: 45px;;
  width: 100%;
  height: 250px;
    padding : 50px;
 
}
body {
  overflow-x: hidden;
}

      #image_voiture{
  display: block; 
  margin: auto;
  max-width: 100%; 
  height: auto; 
  border: 1px solid black; 
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
    $url = str_replace('"', '', $row['URL_photo']); // supprimer les guillemets de l'url. Les guillemets ont permis l'importation du csv auparavant
    echo "<img id='image_voiture' src=\"" . $url . "\" alt=\"" . $row['Marque'] . " " . $row['Model'] . "\">";
    echo "<table>";
    echo "<tr><td>Marque et modèle</td><td>" . htmlspecialchars($row['Marque'] . " " . $row['Model']) . "</td></tr>";
    echo "<tr><td>Année</td><td>" . htmlspecialchars($row['Annee']) . "</td></tr>";
    echo "<tr><td>Type d'énergie</td><td>" . htmlspecialchars($row['Type_energie']) . "</td></tr>";
    echo "<tr><td>Prix journalier</td><td>" . htmlspecialchars($row['Prix_j']) . " €</td></tr>";
    echo "<tr><td>Catégorie</td><td>" . htmlspecialchars($row['Categorie']) . "</td></tr>";
    echo "</table>";
    echo "</div>";
}

        
        
// Ajouter le formulaire pour l'ajout au panier
if (isset($_SESSION['client'])) {
  echo "<center><form method='post' action='ajout.php'>";
  echo "<input type='hidden' name='ID_voiture' value='" . $row['ID_voiture'] . "' </center>";
  
  

  
  // Ajouter un input submit avec la valeur "Ajoutez à votre panier"
  echo "<input type='submit' value='Ajoutez à votre panier' />";
  echo "</form>";
  echo "</div>";
    
    
//Formulaire pour le commentaire
echo '<div id="co">';
echo '<form id="formulaire" method="post" action="ajouter_commentaire.php">
    <input type="hidden" name="ID_voiture" value="' . $row['ID_voiture'] . '">
    <br>
    <label for="commentaire">Commentaire (entre 5 et 200 caractères):</label>
    <textarea id="commentaire" name="commentaire" minlength="5" maxlength="200" required></textarea>
    <br>
    <input type="submit" value="Envoyer">
</form>';
echo '</div>';





    
}


// Fermer la connexion à la base de données
mysqli_close($conn);
?>
    
    
<!--Commentaires laissés par les clients-->

<div id = 'coe'>
    <h2>Commentaires</h2>
 <br/> 
    <hr/>
<div class="carousel">
    <?php
// Récupérer l'ID de la voiture à partir de l'URL
$ID_voiture = $row['ID_voiture'];

// Construire la requête SQL pour récupérer les commentaires associés à cette voiture
$query = "SELECT commentaire.*, client.nom, client.prenom
FROM commentaire
INNER JOIN client
ON commentaire.id_client = client.id_client
WHERE commentaire.ID_voiture = '$ID_voiture'";

// Exécuter la requête SQL
$conn = mysqli_connect("localhost", "root", "", "karim_carloc");
if (!$conn) {
    die("La connexion à la base de données a échoué: " . mysqli_connect_error());
}
$result = mysqli_query($conn, $query);

// Si des commentaires sont trouvés, les afficher
if (mysqli_num_rows($result) > 0) {
   
    foreach ($result as $commentaire) {
      echo '<div class="commentaire">
  <div class="commentaire-titre">
    <p class="auteur-commentaire">' . $commentaire['prenom'].' '. $commentaire['nom'] . '</p>
    <p class="date-commentaire">' . $commentaire['date_commentaire'] . '</p>
  </div><hr/>
  <div class="commentaire-contenu">
    <p>' . $commentaire['commentaire'] . '</p>
  </div>
</div>';

    }
}else{
    echo "<h4>Aucun commentaire laissé</h4>";}
?>



<button class="prev"><</button>
<button class="next">></button>
</div>
</div>
    


    
<style>
.carousel {
    display: flex;
    overflow-x: scroll;
    scroll-snap-type: x mandatory;
    scroll-behavior: smooth;
    height: 200px;
    padding: 0 20px;
    margin: 0 -20px;
    
}

.commentaire {
  min-width: calc(100% - 50px);
  min-width: 500px;
  margin-right: 20px;
  scroll-snap-align: center;
  border: 1px solid #ccc;
  padding: 5px;
  margin-bottom: 10px;
  transition: all 0.3s ease;
     background-color: #fff  ;
    font-size : 13px;
}

.commentaire:hover {
  transform: scale(1.05);
  background-color: #8BC34A;
    color : #fff;

}




.prev,
.next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    padding: 5px;
    background-color: #fff;
    border: none;
    cursor: pointer;
}

.prev:hover,
.next:hover {
    background-color: #f2f2f2;
}

.prev {
    left: 0;
}

.next {
    right: 0;
}

</style>

<script>
const carousel = document.querySelector('.carousel');
const prevBtn = document.querySelector('.prev');
const nextBtn = document.querySelector('.next');
const indicators = document.querySelectorAll('.indicator');
let direction;
let canScroll = true;

prevBtn.addEventListener('click', () => {
    direction = -1;
    scrollCarousel();
});

nextBtn.addEventListener('click', () => {
    direction = 1;
    scrollCarousel();
});

carousel.addEventListener('scroll

</script>

</body>

</html>
