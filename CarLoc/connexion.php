<?php
session_start();
require_once('include.php');

if (!empty($_POST)) {
    extract($_POST);
    $valid = true;
    $errorClass = 'error-message';

    if (isset($_POST['Connexion'])) {
        $email = trim($email);
        $mdp = trim($mdp);
    }

    if (empty($email)) {
        $valid = false;
        $err_email = "<span class='$errorClass'>Email obligatoire</span>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $valid = false;
        $err_email = "<span class='$errorClass'>Email invalide</span>";
    }

    if (empty($mdp)) {
        $valid = false;
        $err_mdp = "<span class='$errorClass'>Mot de passe obligatoire</span>";
    }

    if ($valid) {
        $req = $DB->prepare("SELECT * FROM client WHERE Email = ?");
        $req->execute(array($email));
        $user = $req->fetch();

        if (!$user || !password_verify($mdp, $user['mdp1'])) {
            $valid = false;
            $err_mdp = "<span class='$errorClass'>Identifiants incorrects</span>";
        } else {
            $client = $user;
            $_SESSION['client'] = array(
                'id' => $client['ID_client'],
                'nom' => $client['Nom'],
                'prenom' => $client['Prenom'],
                'mail' => $client['Email'],
            );
            header('Location: welcome_client.php');
            exit;
        }
    }
}
?>


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
    <title>Connexion</title>
      
      <style>  body{
       background-image: url('assets/img/a.jpg');
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
background-color: #E30509;
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