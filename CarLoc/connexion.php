    <?php
require_once('include.php'); // Charge le fichier include.php

if (!empty($_POST)) { // Vérifie s'il y a des données soumises via la méthode POST
    extract($_POST); // Extrait les variables de la soumission POST pour que nous puissions les utiliser comme des variables normales

    $valid = true; // Initialise la variable $valid à true
    $errorClass = 'error-message'; // Initialise la variable $errorClass à 'error-message'

    if (isset($_POST['Connexion'])) { // Vérifie si l'utilisateur a soumis les informations de connexion
        $email = trim($email); // Supprime les espaces blancs au début et à la fin de la variable $email
        $mdp = trim($mdp); // Supprime les espaces blancs au début et à la fin de la variable $mdp
    }

    if (empty($email)) { // Vérifie si la variable email est vide
        $valid = false; // Définit la variable $valid à false
        $err_email = "<span class='$errorClass'>Email obligatoire</span>"; // Définit la variable $err_email à un message d'erreur
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // Vérifie si la variable $email est une adresse email valide
        $valid = false; // Définit la variable $valid à false
        $err_email = "<span class='$errorClass'>Email invalide</span>"; // Définit la variable $err_email à un message d'erreur
    }

    if (empty($mdp)) { // Vérifie si la variable $mdp est vide
        $valid = false; // Définit la variable $valid à false
        $err_mdp = "<span class='$errorClass'>Mot de passe obligatoire</span>"; // Définit la variable $err_mdp à un message d'erreur
    }

    if ($valid) { // Vérifie si toutes les validations ont été passées avec succès
        // Récupère le mot de passe de l'utilisateur depuis la base de données en utilisant son adresse e-mail
        $req = $DB->prepare("SELECT * FROM client WHERE Email = ?");
        $req->execute(array($email));
        $user = $req->fetch();

        // Vérifie le mot de passe de l'utilisateur
        if (!$user || !password_verify($mdp, $user['mdp1'])) {
            // Si le mot de passe est incorrect, définit la variable $valid à false et $err_mdp à un message d'erreur
            $valid = false;
            $err_mdp = "<span class='$errorClass'>Identifiants incorrects</span>";
        } else {
            // Si l'utilisateur est authentifié, définit la variable de session $_SESSION['user_id'] et redirige vers la page d'accueil
            $_SESSION['user_id'] = $user['idClient'];
            header('Location: principal.php');
            exit;
        }
    }
}


?>

<html lang="en">
  <head>
    <title>Connexion</title>
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
  
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <form method="post">
        <div class="form-group">
          <label for="email">Email :</label>
          <input class="form-control <?php if(isset($err_email)){echo "is-invalid";}?>" type="text" id="email" name="email" value="<?php if(isset($email)){echo $email;}?>" placeholder="Email">
          <?php if(isset($err_email)){echo '<div class="invalid-feedback">'.$err_email.'</div>';}?>
        </div>
        <div class="form-group">
          <label for="mdp">Mot de passe :</label>
          <input class="form-control <?php if(isset($err_mdp)){echo "is-invalid";}?>" type="password" id="mdp" name="mdp" value="<?php if(isset($mdp)){echo $mdp;}?>" placeholder="Mot de passe">
          <?php if(isset($err_mdp)){echo '<div class="invalid-feedback">'.$err_mdp.'</div>';}?>
        </div>
        <div class="form-group">
          <center><button type="submit" name="Connexion" class="btn btn-primary" style="width: 100%;">Connexion</button></center>
        </div>
        <div><a href="inscription.php">Pas encore inscrit ?</a></div>
      </form>
    </div>
  </div>
</div>
  
  </body>
</html>