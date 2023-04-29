<?php require_once('include.php');?>
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

  <title>Ajouter une voiture</title>
    <style>

body{
    margin : 75px;}

.formulaire {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
  background-color: #fff;
  box-shadow: 0 2px 4px rgba(0,0,0,.1);
}

h2 {
    text-align: center;
    margin-bottom: 30px;
    color: #333;
}

label {
    font-weight: bold;
    display: block;
    margin-bottom: 10px;
    color: #333;
}

.zonetext {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

.submit {
    background-color: #800000;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;
    font-size: 16px;
}

.submit:hover {
    background-color: white;
    color: #800000;
    border: 2px solid #800000;
}

    </style>
</head>
<body>
  <!-- contenu de la page -->
    <?php require_once('nav_admin.php');?>
<div id="container">
	
	<form name="formadd" action="" method="post" class="formulaire" enctype="multipart/form-data">
		<h2 align="center">Ajouter Nouvelle Voiture...</h2>
                
                <label><b>Immatriculation</b></label>
                <input class="zonetext" type="text" placeholder="Entrer Immatriculation" name="txtImm" required>

                <label><b>Marque</b></label>
                <input class="zonetext" type="text" placeholder="Entrer la Marque" name="txtMarque" required>

               <label><b>Prix de Location </b></label>
                <input class="zonetext" type="text" placeholder="Entrer Prix de Location" name="txtPl" required>
                
                <label><b>Photo</b></label>
                <input class="zonetext" type ="file" placeholder="choisir une photo" name="txtphoto" required>
				            <input type="submit" id='submit' class="submit" name="btadd" value='Ajouter' >
            
            
            <label style="text-align: center;color: #360001;">
            	
            	<?php
				
if(isset($_POST['btadd']))
{
	$imm=$_POST['txtImm'];
	$marque=$_POST['txtMarque'];
	$prixloc=$_POST['txtPl'];
			
$image = $_FILES['txtphoto']['tmp_name'];

	//$image_text = mysqli_real_escape_string($cnloccar, $_POST['txtphoto']);

$target = "assets/img/".$_FILES['txtphoto']['name'];
//$target = "images/".basename($image);
if (move_uploaded_file($image,$target)) {
$msg = "Image téléchargée avec succès";
}else{
$msg = "Impossible de télécharger l'image";
}
$sql = "INSERT INTO voiture (ID_voiture, Marque, Prix_j, URL_photo)
        VALUES ('$imm','$marque','$prixloc', '$target')
        ON DUPLICATE KEY UPDATE 
        Prix_j = '$prixloc',
        URL_photo = '$target';
        ";


$resultat=mysqli_query($cncarloc,$sql);

if($resultat)
{
echo "Insertion des données validées";
}else{
echo "Echec d'insertion des données !";
}

}?>
            	
            	
            	
            </label>
</form>


</div>
</body>
</html>