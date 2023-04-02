<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Déconnexion</title>
	<style>
body {
	font-family: Arial, sans-serif;
	font-size: 16px;
	margin: 0;
	padding: 0;
	background-color: #f7f7f7; 
}

.container {
	display: flex;
	flex-direction: column;
	align-items: center;
	justify-content: center;
	height: 100vh;
}

h1 {
	font-size: 28px;
	font-weight: bold;
	margin-bottom: 20px;
	text-align: center;
	text-transform: uppercase;
}

p {
	font-size: 18px;
	margin-bottom: 40px;
	text-align: center;
}

a {
	color: #fff;
	background-color: #333;
	padding: 10px 20px;
	text-decoration: none;
	border-radius: 5px;
	transition: background-color 0.2s ease-in-out;
}

a:hover {
	background-color: #ff6600; /* Changement de couleur d'arrière-plan au survol */
} 

	</style>
</head>
<body>
	<?php
		session_start();
		session_unset();
		session_destroy();
	?>
	<div class="container">
	<h1>Déconnexion</h1>
	<p>Merci de votre visite. Vous avez été déconnecté.</p>
	<a href="connexion.php">Se connecter</a>
</div>
</body>
</html> 