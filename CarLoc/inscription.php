	<?php
	require_once('include.php');

	if (!empty($_POST)) {
		extract($_POST);

		$valid = true;
		$errorClass = 'error-message';

		if (isset($_POST['inscription'])) {
			$nom = trim($nom);
			$prenom = trim($prenom);
			$email = trim($email);
			$confmail = trim($confmail);
			$mdp1 = trim($mdp1);
			$mdp2 = trim($mdp2);
		}
		if (empty($nom)) {
			$valid = false;
			$err_nom = "<span class='$errorClass'>Nom obligatoire</span>";
		} elseif (!preg_match('/^[a-zA-Zéèêëôöüçàáâä]+[-]?[a-zA-Zéèêëôöüçàáâä]+$/u', $nom)) {
			$valid = false;
			$err_nom ="<span class='$errorClass'>Nom invalide</span>";
		} elseif (strlen($nom) < 2 || strlen($nom) > 50) {
			$valid = false;
			$err_nom = "<span class='$errorClass'>Nom doit contenir 2-50 carac</span>";
		}

		if (empty($prenom)) {
			$valid = false;
			$err_prenom ="<span class='$errorClass'>Prenom obligatoire</span>";
		} elseif (!preg_match('/^[a-zA-Zéèêëôöüçàáâä]+[-]?[a-zA-Zéèêëôöüçàáâä]+$/u', $prenom)) {
			$valid = false;
			$err_prenom = "<span class='$errorClass'>Prenom invalide</span>";
		} elseif (strlen($prenom) < 2 || strlen($prenom) > 50) {
			$valid = false;
			$err_prenom = "<span class='$errorClass'>Prenom doit contenir 2-50 carac.</span>";
		}

		if (empty($email)) {
			$valid = false;
			$err_email = "<span class='$errorClass'>Email obligatoire</span>";
		} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$valid = false;
			$err_email = "<span class='$errorClass'>Email invalide</span>";
		} elseif ($email != $confmail) {
			$valid = false;
			$err_email = "<span class='$errorClass'>Les emails ne correspondent pas</span>";
		}

		if (empty($mdp1)) {
			$valid = false;
			$err_mdp1 = "<span class='$errorClass'>Mot de passe obligatoire</span>";
		} elseif (strlen($mdp1) < 8) {
			$valid = false;
			$err_mdp1 = "<span class='$errorClass'>Mot de passe doit contenir au moins 8 carac.</span>";
		} elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',$mdp1)) {
			$valid = false;
			$err_mdp1 = "<span class='$errorClass'>Mot de passe doit contenir minuscule, majuscule, chiffre et caractère spécial</span>";
		} elseif ($mdp1 != $mdp2) {
			$valid = false;
			$err_mdp2 = "<span class='$errorClass'>Les mots de passe ne correspondent pas</span>";
		}
		if($valid){
			//on va crypter notre mot de passe
		   $crypt_mdp1 = crypt($mdp1, '$6$rounds=5000$=v!MPr|2PPeH>L-93waK?,,^wW+(m:Cb!G/?:M7b,=nm*gz-+Z]R*1 nCM`-(z3oS$');
			
			//Insertion à notre bdd
			$req = $DB -> prepare("INSERT INTO client(Nom, Prenom, Email,mdp1) VALUES (?,?,?,?)");
			$req -> execute(array($nom, $prenom, $email, $crypt_mdp1));

			header('Location: connexion.php');
			exit;
		}else{
			echo 'non ok';
			//rien(affichage message d'erreur
		}
	}

	?>

<html lang="en">
  <head>
    <title>Inscription</title>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
      <link href="assets/css/styles.css" rel="stylesheet" />
      <style>  body{
       background-image: url('images/a.jpg');
       background-repeat : no-repeat;
       background-size : 100% 100%;
       background-attachment:fixed;
      }
        .row {
  display: flex;
  align-items: center;
  min-height: 100vh; /* garde le formulaire centré verticalement même si la hauteur de l'écran est plus petite */
}

/* Mise en forme générale */
.container {
  margin-top: 50px;
}
form {
  background-image: linear-gradient(to bottom, #e6f7ff, #fff);
  border: 1px solid #ccc;
  border-radius: 5px;
  padding: 20px;
  box-shadow: 0 0 50px 0 rgba(0, 0, 255, 0.2);
}
h1 {
  font-size: 2.5rem;
  margin-bottom: 30px;
}

.form-group {
  margin-bottom: 20px;
}

/* Styles pour les champs de formulaire */
label {
  display: block;
  font-weight: bold;
  margin-bottom: 5px;
}

input[type="text"],
input[type="password"] {
  border-radius: 5px;
  border: none;
  box-shadow: 0 0 2px #ccc;
  height: 40px;
  padding: 10px;
  width: 100%;
}

input[type="text"]:focus,
input[type="password"]:focus {
  outline: none;
  box-shadow: 0 0 2px #007bff;
}

.invalid-feedback {
  color: red;
  font-size: 14px;
  margin-top: 5px;
}

button {
  background-color: #00bfff;
  border: none;
  border-radius: 5px;
  color: #fff;
  cursor: pointer;
  font-size: 16px;
  height: 45px;
  margin-top: 10px;
  width: 100%;
}

button[type="submit"]:hover {
background-color: #FFA500;
color: white;
border: 2px solid #0069d9;
border-radius: 5px;
box-shadow: 2px 2px 2px #888888;
}</style>
  </head>
  <body>
    
<div class="container" >
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="post">
                <div class="mb-3">
                    <label>Nom :</label>
                    <input class="form-control <?php if(isset($err_nom)){echo "is-invalid";}?>" type="text" name="nom" value="<?php if(isset($nom)){echo $nom;}?>" placeholder="Nom">
                    <?php if(isset($err_nom)){echo '<div class="invalid-feedback">'.$err_nom.'</div>';}?>
                </div>
                <div class="mb-3">    
                    <label>Prenom :</label>
                    <input class="form-control <?php if(isset($err_prenom)){echo "is-invalid";}?>" type="text" name="prenom" value="<?php if(isset($prenom)){echo $prenom;}?>" placeholder="Prenom">
                    <?php if(isset($err_prenom)){echo '<div class="invalid-feedback">'.$err_prenom.'</div>';}?>
                </div>
                <div class="mb-3">
                    <label>Email :</label>
                    <input class="form-control <?php if(isset($err_email)){echo "is-invalid";}?>" type="text" name="email" value="<?php if(isset($email)){echo $email;}?>" placeholder="Email">
                    <?php if(isset($err_email)){echo '<div class="invalid-feedback">'.$err_email.'</div>';}?>
                </div>
                <div class="mb-3">
                    <label>Confirmation Email :</label>
                    <input class="form-control <?php if(isset($err_email)){echo "is-invalid";}?>" type="text" name="confmail" value="" placeholder="Confirmation Email">
                    <?php if(isset($err_email)){echo '<div class="invalid-feedback">'.$err_email.'</div>';}?>
			
                </div>
                <div class="mb-3">
                    <label>Mot de passe :</label>
                    <input class="form-control <?php if(isset($err_mdp1)){echo "is-invalid";}?>" type="password" name="mdp1" value="<?php if(isset($mdp1)){echo $mdp1;}?>" placeholder="Mot de passe">
                    <?php if(isset($err_mdp1)){echo '<div class="invalid-feedback">'.$err_mdp1.'</div>';}?>
                </div>
                <div class="mb-3">
                    <label>Confirmation Mot de passe :</label>
                    <input class="form-control <?php if(isset($err_mdp2)){echo "is-invalid";}?>" type="password" name="mdp2" value="" placeholder="Confirmation mot de passe">
                    <?php if(isset($err_mdp2)){echo '<div class="invalid-feedback">'.$err_mdp2.'</div>';}?>
                </div><BR/>
                <div class="mb-3">
					<center><button type="submit" name="Inscription" class="btn btn-primary" style="width: 600px; height: 45px; text-align: center; cursor: pointer; padding: 5px; font-size: 16px ;">Inscription</button></center>
                </div>
				<div><a href = "connexion.php">Déjà inscrit ?</a></div>
            </form>
        </div>
     </div>
	 
</div>

  </body>
</html>



