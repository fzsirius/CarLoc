<?php require_once('include.php');?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mise à jour voiture</title>
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
<?php require_once('nav_admin.php');?>
<?php 
require_once('include.php');
if(isset($_POST['btmod'])){
    $imm = $_POST['txtImm'];
    $marque = $_POST['txtMarque'];
    $prix = $_POST['txtPl'];
    $photo = $_FILES['txtphoto']['name'];
    $chemin = "assets/img/".$photo;
    move_uploaded_file($_FILES['txtphoto']['tmp_name'],$chemin);
    $reqmodif = "UPDATE voiture SET Marque='$marque', Prix_j='$prix', URL_photo='$chemin' WHERE ID_voiture='$imm'";
    $resultat = mysqli_query($cncarloc, $reqmodif);
    if($resultat){
        header('Location: LesVoitures.php');
        exit();
    } else{
        echo "Erreur : ".mysqli_error($cncarloc);
    }
}
if(isset($_GET['mod'])){
    $imm = $_GET['mod'];
    $reqselect = "SELECT * FROM voiture WHERE ID_voiture='$imm'";
    $resultat = mysqli_query($cncarloc, $reqselect);
    $ligne = mysqli_fetch_assoc($resultat);
?>

<div id="container">
    <form name="formadd" action="" method="post" class="formulaire" enctype="multipart/form-data">
        <h2 align="center">Mise à jour voiture...</h2>
        <label><b>Immatriculation</b></label>
        <input class="zonetext" type="text" name="txtImm" value="<?php echo $ligne['ID_voiture'] ?>" readonly>
        <label><b>Marque</b></label>
        <input class="zonetext" type="text" placeholder="Entrer la Marque" name="txtMarque" value="<?php echo $ligne['Marque'] ?>" required>
        <label><b>Prix de Location </b></label>
        <input class="zonetext" type="text" placeholder="Entrer Prix de Location" name="txtPl" value="<?php echo $ligne['Prix_j'] ?>" required>
        <label><b>Photo</b></label>
        <input class="zonetext" type="file" placeholder="choisir une photo" name="txtphoto" required>
        <input type="submit" id='submit' class="submit" name="btmod" value='Mettre a Jour' >
    </form>
</div>
<?php } ?>


</body>
</html>
