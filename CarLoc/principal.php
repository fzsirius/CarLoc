    <!DOCTYPE html>
<html>
  <head>
  
    <meta charset="utf-8">
    <title>Principal</title>
    <link rel="stylesheet" type="text/css" href="style.css">
	<!-- Lien vers le fichier CSS de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
	
	<style>
body {
  margin: 0;
}

.container {
  display: flex;
  justify-content: center;
  padding: 50px 0;
  background-image: url('assets/img/OIP.jpeg');
  background-size: cover;
  width: 100%; 
}

form {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: rgba(255,255,255,0.9);
  border-radius: 10px;
  padding: 30px;
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.2);
}

label {
  font-weight: bold;
  margin-right: 20px;
  font-size: 14px;
}

input[type="text"], select {
  padding: 10px;
  font-size: 14px;
  border-radius: 5px;
  box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.1);
  width: 25%;
}

input[type="submit"] {
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 10px;
  padding: 10px 20px;
  font-size: 16px;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #0069d9;
}





	</style>
  </head>
  <body>
  
  
  
  <?php
	
	//le but ici est de récuperer les données de la base
		  require_once('include.php'); // Charge le fichier include.php
		  
		  
		  $db = new connexionDB();  //creation d'une instance de connexionDB
		  $conn = $db->DB();

		  

			try {
			  // Connexion à la base de données

			  // Récupération des données de la table "véhicule"

			  $resultat = $conn->query("SELECT DISTINCT annee FROM Voiture ORDER BY annee DESC");
			  $annees = $resultat->fetchAll(PDO::FETCH_COLUMN);

			 // $resultat = $conn->query("SELECT DISTINCT nbre_sieges FROM Voiture ORDER BY nbre_sieges ASC");
			 // $sieges = $resultat->fetchAll(PDO::FETCH_COLUMN);

			  $resultat = $conn->query("SELECT DISTINCT type_energie FROM Voiture ORDER BY type_energie ASC");
			  $energies = $resultat->fetchAll(PDO::FETCH_COLUMN);
			  
			  $resultat = $conn->query("SELECT DISTINCT marque FROM Voiture ORDER BY marque ASC");
			  $marques = $resultat->fetchAll(PDO::FETCH_COLUMN);
			  
			  $resultat = $conn->query("SELECT DISTINCT model FROM Voiture ORDER BY model ASC");
			  $models = $resultat->fetchAll(PDO::FETCH_COLUMN);

			  $resultat = $conn->query("SELECT DISTINCT categorie FROM Voiture ORDER BY categorie ASC");
			  $categories = $resultat->fetchAll(PDO::FETCH_COLUMN);

			} catch (PDOException $e) { //gestion d'erreur en cas de problèmes de connexion à la BD
			  echo "Erreur : " . $e->getMessage();
			}

			// Fermeture de la connexion à la base de données
			$conn = null;

		  ?>
  
 
    <div class="container">
      <form method="post" action="resultats.php"> <!-- J'AI MIS LE PARAMETRE ACTION POUR ALLER VERS UNE NOUVELLE PAGE APRES LE FORMULAIRE-->
        <label for="marque">Marque:</label>
		<select id="marque" name="marque">
			<option value="toutes">Toutes</option>
			<?php foreach ($marques as $marque) { ?>
				<option value="<?= $marque ?>"><?php echo $marque; ?></option>
			<?php } ?>
		</select>

        <label for="model">Modèle:</label>
		<select id="model" name="model">
			<option value="tous">Tous</option>
			<?php foreach ($models as $model) { ?>
				<option value="<?= $model ?>"><?php echo $model; ?></option>
			<?php } ?>
		</select>

		<label for="annee">Année:</label>
		<select id="annee" name="annee">
			<option value="toutes">Toutes</option>
			<?php
			foreach ($annees as $annee) {
				echo '<option value="' . $annee . '">' . $annee . '</option>';     //on ne va afficher que les années qui existent dans la base
			}
			?>
		</select>

		<label for="type_energie">Energie:</label>
		<select id="type_energie" name="energie">
			<option value="toutes">Toutes</option>
			<?php foreach ($energies as $energie) { ?>
				<option value="<?= $energie ?>"><?php echo $energie; ?></option>
			<?php } ?>
		</select>


<!--
        <label>Kilométrage:</label>
        <select name="km">
          <option value="">Tous</option>
          <option value="0-50000">0-50,000</option>
          <option value="50001-100000">50,001-100,000</option>
          <option value="100001-150000">100,001-150,000</option>
          <option value="150001-200000">150,001-200,000</option>
          <option value="200001+">200,001 et plus</option>
        </select>

-->



        <input type="submit" name="search" value="Recherche">
      </form>
	  
    </div>
	
	
	<br/><br/><br/>
	<center>
	<div>
	
	


</div><br/>
	</center>
  </body>
</html>
