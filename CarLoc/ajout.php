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

  <title>Ajout au panier</title>
    <style>
    body {
			font-family: Arial, sans-serif;
			background-color: #F5F5F5;
		}
		h1 {
			text-align: center;
			color: #555;
			margin-top: 50px;
		}
		p {
			margin: 20px;
			padding: 10px;
			border-radius: 5px;
			font-size: 1.2em;
			text-align: center;
		}
		p.success {
			background-color: #DFF0D8;
			color: #3C763D;
		}
		p.error {
			background-color: #F2DEDE;
			color: #A94442;
		}
		a {
  color: #0099ff;
  text-decoration: none;
  display: inline-block;
  border: 1px solid #0099ff;
  padding: 10px 20px;
  border-radius: 5px;
  transition: background-color 0.2s ease-in-out;
  margin: 20px auto 0;
}

		a:hover {
			background-color: #0099ff;
			color: #fff;
		}
    </style>
</head>
<body>
  <!-- Contenu de la page -->
    <h1>Ajout au panier</h1>
	<?php
	session_start();
// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['client'])) {
    header('Location: connexion.php');
    exit();
}

// Vérifier si l'ID de la voiture est spécifié
if (!isset($_POST['ID_voiture'])) {
    echo "<p class='error'>L'identifiant de la voiture n'est pas spécifié.</p>";
    echo "<a href='principal.php'>Retour à l'accueil</a>";
    exit();
}

// Récupérer l'ID de la voiture
$ID_voiture = $_POST['ID_voiture'];

// Vérifier si le panier existe déjà
if (isset($_SESSION['panier'])) {
    // Parcourir le panier pour vérifier si la voiture existe déjà
    foreach ($_SESSION['panier'] as $key => $value) {
        if ($key == $ID_voiture) {
            // La voiture existe déjà, afficher un message d'erreur en rouge
            echo "<p class='error'>Cette voiture est déjà sélectionnée dans votre panier.</p>";
            echo "<a href='principal.php'>Retour à l'accueil</a>";
            exit();
        }
    }
    // La voiture n'existe pas encore dans le panier, l'ajouter avec une quantité de 1 et afficher un message de confirmation en vert
    $_SESSION['panier'][$ID_voiture] = 1;
    echo "<p class='success'>La voiture a été ajoutée avec succès !</p>";
    echo "<a href='panier.php'>Voir panier</a>";
     echo "<br/>";
    echo "<a href='principal.php'>Retour à l'accueil</a>";
    exit();
} else {
    // Le panier n'existe pas encore, le créer et ajouter la voiture avec une quantité de 1 et afficher un message de confirmation en vert
    $_SESSION['panier'] = array($ID_voiture => 1);
    echo "<p class='success'>La voiture a été ajoutée avec succès !</p>";
echo "<a class='btn btn-primary' href='panier.php'>Voir panier</a> ";
echo "<a class='btn btn-secondary' href='principal.php'>Retour à l'accueil</a>";
exit();
}
?>
    


```php
<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['client'])) {
    header('Location: connexion.php');
    exit();
}

// Vérifier si l'ID de la voiture est spécifié
if (!isset($_POST['ID_voiture'])) {
    echo "<p class='error'>L'identifiant de la voiture n'est pas spécifié.</p>";
    echo "<a class='btn btn-secondary' href='principal.php'>Retour à l'accueil</a>";
    exit();
}

// Récupérer l'ID de la voiture
$ID_voiture = $_POST['ID_voiture'];

// Vérifier si le panier existe déjà
if (isset($_SESSION['panier'])) {
    // Parcourir le panier pour vérifier si la voiture existe déjà
    foreach ($_SESSION['panier'] as $key => $value) {
        if ($key == $ID_voiture) {
            // La voiture existe déjà, afficher un message d'erreur en rouge
            echo "<p class='error'>Cette voiture est déjà sélectionnée dans votre panier.</p>";
            echo "<a class='btn btn-secondary' href='principal.php'>Retour à l'accueil</a>";
            exit();
        }
    }
    // La voiture n'existe pas encore dans le panier, l'ajouter avec une quantité de 1 et afficher un message de confirmation en vert
    $_SESSION['panier'][$ID_voiture] = 1;
    echo "<p class='success'>La voiture a été ajoutée à votre panier.</p>";
    echo "<a class='btn btn-primary' href='panier.php'>Voir panier</a> ";
    echo "<a class='btn btn-secondary' href='principal.php'>Retour à l'accueil</a>";
    exit();
} else {
    // Le panier n'existe pas encore, le créer et ajouter la voiture avec une quantité de 1 et afficher un message de confirmation en vert
    $_SESSION['panier'] = array($ID_voiture => 1);
    echo "<p class='success'>La voiture a été ajoutée à votre panier.</p>";
    echo "<a class='btn btn-primary' href='panier.php'>Voir panier</a> ";
    echo "<a class='btn btn-secondary' href='principal.php'>Retour à l'accueil</a>";
    exit();
}
?>
</body>
</html>
