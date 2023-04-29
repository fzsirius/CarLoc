<?php require_once('include.php');?>
<!doctype html>
<html>
<head>
 <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- Lien vers la feuille de style Bootstrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  
  <!-- Lien vers style personnalisée -->
  <!--<link rel="stylesheet" href="style.css">-->
<title>Tableau de Bord</title>
<style>
	body{
		
		margin-top : 100px;
	}
   table {
        margin: auto;
  text-align: center;
        border-collapse: collapse;
        width: 100%;
        margin-top: 30px;
        border-radius: 10px;
        overflow: hidden;
    }
  th,
    td {
        padding: 15px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #007bff;
        color: #fff;
    }

    tr:hover {
        background-color: #f5f5f5;
    }

.photocar {
  width: 130px;
  height: 100px;
  border-radius: 5%;
  border: 1px solid;
}

#container {
  width: 400px;
  margin: 0 auto;
  margin-top: 10%;
}

/* Bordered form */
.formulaire {
  width: 100%;
  padding: 30px;
  border: 1px solid #f1f1f1;
  background: #fff;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}

#container h1 {
  width: 38%;
  margin: 0 auto;
  padding-bottom: 10px;
}

/* Full-width inputs */
.zonetext {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

/* Set a style for all buttons */
.submit {
  background-color: #f30;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

.submit:hover {
  background-color: white;
  color: #f30;
  border: 1px solid #f30;
}

table {
  caption-side: bottom;
}

th, td {
  border: 1px solid #ddd;
  padding: 10px;
}

th {
  background-color: #800000;
  color: #fff;
}


	</style>
</head>

<body>
<?php require_once('nav_admin.php');?>
    

<?php
    $reqselect = "SELECT * FROM voiture";
    $resultat = mysqli_query($cncarloc, $reqselect);
    $nbr = mysqli_num_rows($resultat);
    echo '<p style="text-align:center; font-size:24px; font-weight:bold;">Liste des Voitures...</p>
    <div style="text-align:center; font-size:16px; margin-bottom:20px;">(Total de ' . $nbr . ' voitures)</div>';
?>

	</p>
<table width="100%" border="1">
  <tbody>
    <tr>
      <th>Immatriculation</th>
      <th>Marque</th>
      <th>Prix de Location</th>
      <th>Photo</th>
      <th>Supprimer</th>
      <th>Modifier</th>
    </tr>
    
   
	<?php
	while($ligne=mysqli_fetch_assoc($resultat))
	{
	?>
	   
    <tr>
      <td><?php echo $ligne['ID_voiture']; ?></td>
      <td><?php echo $ligne['Marque']; ?></td>
      <td><?php echo $ligne['Prix_j']." €"; ?></td>
      <td><img class="photocar" src="<?php echo $ligne['URL_photo'];?>"></td>
      <td><a href="supprimer.php?supCar=<?php echo $ligne['ID_voiture']; ?>"><img src="assets/img/supprimer.jpg" width="50px" height="50px"></a></td>
      <td><a href="modifier.php?mod=<?php echo $ligne['ID_voiture']; ?>"><img src="assets/img/modifier.png" width="50px" height="50px"></a></td>

    </tr>
    <?php } ?>
  </tbody>
</table>



</body>
</html>