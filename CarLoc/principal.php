    <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Principal</title>
    <link rel="stylesheet" type="text/css" href="style.css">
	
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
    <div class="container">
      <form method="post">
        <label>Marque:</label>
        <input type="text" name="brand">

        <label>Modèle:</label>
        <input type="text" name="model">

        <label>Année:</label>
        <select name="annee">
          <option value="">Tous</option>
          <?php
            // Créer une boucle pour afficher les options pour les années
            $current_year = date('Y');
            for ($i = $current_year; $i >= 1900; $i--) {
              echo "<option value=\"$i\">$i</option>";
            }
          ?>
        </select>

        <label>Kilométrage:</label>
        <select name="km">
          <option value="">Tous</option>
          <option value="0-50000">0-50,000</option>
          <option value="50001-100000">50,001-100,000</option>
          <option value="100001-150000">100,001-150,000</option>
          <option value="150001-200000">150,001-200,000</option>
          <option value="200001+">200,001 et plus</option>
        </select>

        <input type="submit" name="search" value="Recherche">
      </form>
    </div>
	
	<br/><br/><br/>
	<center>
	<div>Dans cette partie je vais afficher le resultat de la recherche.</div><br/>
	<div>Construire des requêtes qui interrogent la base des données et renvoie le resultat organisés</div><br/>
	</center>
  </body>
</html>
