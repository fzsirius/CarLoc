<!DOCTYPE html>
<html>
<head>
	<title>Location de voitures</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<style>
        	/*-- ---------------------------------------------------- debut style ------------------------------------------------------*/

		.carousel-inner img {
			width: 100%;
			height: 500px;
		}
		.carousel-item {
			height: 500px;
		}
        
        /* Style spécifique pour la section Comment ça marche */
section.bg-light.my-5.comment {
  background-color: orange;
  color: black;
}

/* Style pour les titres de carte */
.card-title {
  font-size: 1.2rem;
}

.card {
border: 1px solid #ddd;
border-radius: 5px;
padding: 10px;
box-shadow: 0 2px 4px rgba(0,0,0,0.2);
transition: all 0.3s ease;
    
}

.card:hover {
box-shadow: 0 4px 8px rgba(0,0,0,0.3);
transform: translateY(-5px);
}

.card-img-top {
height: 200px;
object-fit: cover;
border-radius: 5px;
}

.card-title {
font-size: 1.2rem;
margin-bottom: 0;
}

.card-text {
margin-bottom: 0.5rem;
}

.btn-primary {
background-color: #007bff;
border-color: #007bff;
}

.btn-primary:hover {
background-color: #E30509;
border-color: #0062cc;
}
.center-content {
  text-align: center;
}

        /* style pour le footer*/

footer {
  background-color: #1F2A3C;
  color: #fff;
  padding: 50px 0;
}

.footer-wrapper {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  max-width: 1200px;
  margin: 0 auto;
}

.footer-section {
  width: 30%;
  margin-bottom: 30px;
}

.footer-section h3 {
  font-size: 18px;
  margin-bottom: 20px;
}

.footer-section p {
  font-size: 14px;
  line-height: 1.5;
  margin-bottom: 20px;
}

ul {
  list-style: none;
  margin: 0;
  padding: 0;
}

ul li {
  font-size: 14px;
  margin-bottom: 10px;
}



        
        /*---------------------------------------------logconnexionin---------------------------------------*/

#login-btn {
  
	
  color: black;
  padding: 14px 20px;
  margin: 8px 0;
  border: 1px solid #F30;
	border-right: none;
  cursor: pointer;
  width: 5%;
	right: 0;
	z-index: 10;position: absolute;
}

#login-btn:hover {
  opacity: 1;background-color: #F30;border: none;
}


     /* Styles le formulaire de contact*/
section.my-5 {
  background-color: #f5f5f5;
  padding-top: 60px;
  padding-bottom: 60px;
}

form.border {
  border: 1px solid #ddd;
  padding: 30px;
  border-radius: 5px;
}

form.border label {
  font-weight: bold;
}

form.border input[type="text"],
form.border input[type="email"],
form.border textarea {
  border: 1px solid #ccc;
  border-radius: 3px;
  padding: 8px;
  width: 100%;
  margin-bottom: 20px;
}

form.border textarea {
  height: 150px;
}

form.border button {
  background-color: #007bff;
  border: none;
  color: #fff;
  padding: 10px 20px;
  font-size: 18px;
  border-radius: 3px;
  cursor: pointer;
}

form.border button:hover {
  background-color: #0069d9;
}

form.border button:focus {
  outline: none;
}
   /* Style pour la boîte de dialogue modale */
.modal {
  display: none; /* caché par défaut */
  position: fixed; /* position fixe */
  z-index: 1; /* pour être au-dessus du reste du contenu */
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0,0,0,0.4); /* couleur de fond semi-transparente */
}

/* Style pour le contenu de la boîte de dialogue modale */
.modal-content {
  background-color: #fefefe;
  margin: 10% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 30%;
  text-align: center;
}

/* Style pour les boutons dans la boîte de dialogue modale */
.modal-content button {
  margin: 10px;
  padding: 10px;
  border: none;
  border-radius: 5px;
  background-color: #4CAF50;
  color: white;
  cursor: pointer;
}

/* Style pour le bouton de fermeture de la boîte de dialogue modale */
.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}
	/*-- ---------------------------------------------------- fin style ------------------------------------------------------>

	</style>
</head>
<body>
<div id="entete">
<!-- ----------------------------------------------------Lien connexion ---------------------->
<button id="login-btn">Login</button>

<div id="login-modal" class="modal">
  <div class="modal-content">
    <h2>Connexion</h2>
    <p>Choisissez votre type de compte:</p>
    <button id="client-btn">Client</button>
    <button id="admin-btn">Admin</button>
  </div>
</div>

<script>
    // Récupération des éléments HTML
var loginBtn = document.getElementById("login-btn");
var modal = document.getElementById("login-modal");
var clientBtn = document.getElementById("client-btn");
var adminBtn = document.getElementById("admin-btn");

// Fonction pour afficher la boîte de dialogue modale
function showModal() {
  modal.style.display = "block";
}

// Fonction pour masquer la boîte de dialogue modale
function hideModal() {
  modal.style.display = "none";
}

// Ajout d'un événement au bouton "Login"
loginBtn.addEventListener("click", showModal);

// Ajout d'un événement au bouton "Client"
clientBtn.addEventListener("click", function() {
  // Rediriger l'utilisateur vers la page de connexion client
  window.location.href = "connexion.php";
});

// Ajout d'un événement au bouton "Admin"
adminBtn.addEventListener("click", function() {
  // Rediriger l'utilisateur vers la page de connexion admin
  window.location.href = "connexion_admin.php";
});

// Ajout d'un événement pour masquer la boîte de dialogue modale lorsque l'utilisateur clique en dehors de la boîte
window.addEventListener("click", function(event) {
  if (event.target == modal) {
    hideModal();
  }
});

    
    </script>

 <!-- ----------------------------------------------Carrousel d'images------------------------------------------------->

	<div id="demo" class="carousel slide" data-ride="carousel">

		<!-- Indicateurs de position -->
		<ul class="carousel-indicators">
			<li data-target="#demo" data-slide-to="0" class="active"></li>
			<li data-target="#demo" data-slide-to="1"></li>
			<li data-target="#demo" data-slide-to="2"></li>
		</ul>

		<!-- Slides -->
		<div class="carousel-inner">
			<div class="carousel-item active">
				<img src="images/image1.jpg" alt="Voiture 1">
				<div class="carousel-caption">
					<h3>Location de voitures de luxe</h3>
					<p>Nous avons une grande variété de voitures haut de gamme pour répondre à tous vos besoins.</p>
				</div>
			</div>
			<div class="carousel-item">
				<img src="images/image2.jpg" alt="Voiture 2">
				<div class="carousel-caption">
					<h3>Voitures économiques</h3>
					<p>Nous offrons des voitures économiques pour ceux qui cherchent à économiser de l'argent.</p>
				</div>
			</div>
			<div class="carousel-item">
				<img src="images/image3.jpg" alt="Voiture 3">
				<div class="carousel-caption">
					<h3>Service de qualité</h3>
					<p>Notre équipe est dédiée à vous offrir le meilleur service possible pour rendre votre expérience de location de voiture agréable.</p>
				</div>
			</div>
		</div>

		<!-- Contrôles de navigation -->
		<a class="carousel-control-prev" href="#demo" data-slide="prev">
			<span class="carousel-control-prev-icon"></span>
		</a>
		<a class="carousel-control-next" href="#demo" data-slide="next">
			<span class="carousel-control-next-icon"></span>
		</a>

	</div>

            	<!-- ---------------------------------------------------- Section "Comment ça marche" ------------------------------------------------------>
<section id="comment-ca-marche-section" class="bg-light my-5">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="text-center">Comment ça marche ?</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4 mb-4">
				<div class="card h-100">
					<div class="card-body">
						<h5 class="card-title">1. Choisissez votre voiture</h5>
						<p class="card-text">Parcourez notre sélection de voitures disponibles à la location et choisissez celle qui vous convient.</p>
					</div>
				</div>
			</div>
			<div class="col-md-4 mb-4">
				<div class="card h-100">
					<div class="card-body">
						<h5 class="card-title">2. Réservez votre voiture</h5>
						<p class="card-text">Sélectionnez la durée de location et réservez votre voiture en ligne en quelques clics seulement.</p>
					</div>
				</div>
			</div>
			<div class="col-md-4 mb-4">
				<div class="card h-100">
					<div class="card-body">
						<h5 class="card-title">3. Profitez de votre voiture</h5>
						<p class="card-text">Récupérez votre voiture à l'endroit convenu et profitez de votre location en toute tranquillité.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
    
           	<!-- ---------------------------------------------------- Section "Nos voitures" ------------------------------------------------------>
	<section class="my-5">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="text-center">Nos voitures</h1>
				</div>
                			<?php
// connexion à la bd
$conn = mysqli_connect('localhost', 'root', '', 'karim_carloc');
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Définir le nombre de voitures à afficher par page
$limit = 20;

// Récupère le numéro de la page actuelle à partir de l'URL, ou par défaut 1
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calcule le décalage
$offset = ($page - 1) * $limit;

// Récupérer les voitures à afficher
$sql = "SELECT * FROM voiture LIMIT $offset, $limit";
$result = mysqli_query($conn, $sql);

// Affiche les voitures dans une grille
if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    echo '
    <div class="col-md-4 mb-4 center-content">
      <div class="card h-100">
        <img src="'.$row['URL_photo'].'" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">'.$row['Marque'].' '.$row['Model'].'</h5>
          <p class="card-text">'.$row['Annee'].'</p>
          <p class="card-text"><strong>Prix par jour:</strong> '.$row['Prix_j'].' €</p>
         <a href="voiture_details.php?marque='.$row['Marque'].'&modele='.$row['Model'].'&annee='.$row['Annee'].'&energie='.$row['Type_energie'].'" class="btn btn-primary">Consulter</a>

        </div>
      </div>
    </div>';
  }
} else {
  echo "Aucune voiture n'est disponible pour le moment.";
}

// Récupérer le nombre total de voitures
$sql = "SELECT COUNT(*) AS total FROM voiture";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$total_cars = $row['total'];

// Calcule le nombre total de pages
$total_pages = ceil($total_cars / $limit);

// Affiche le bouton "Voir plus" s'il y a plus de pages
if ($page < $total_pages) {
  echo '<div class="col-12 text-center"><a href="index.php?page=4'.($page+1).'" class="btn btn-primary">Voir plus</a></div>';
}

mysqli_close($conn);
?>
		</div>
	</div>
</section>


               	<!-- ---------------------------------------------------- section contact ------------------------------------------------------>
<section class="my-5">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="text-center">Contactez-nous !</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-8 mx-auto">
				<form action="contact.php" method="post">
					<div class="form-group">
						<label for="nom">Nom*</label>
						<input type="text" class="form-control" id="nom" name="nom" required>
					</div>
					<div class="form-group">
						<label for="email">Adresse email*</label>
						<input type="email" class="form-control" id="email" name="email" required>
					</div>
					<div class="form-group">
						<label for="objet">Objet*</label>
						<input type="text" class="form-control" id="objet" name="objet" required>
					</div>
					<div class="form-group">
						<label for="message">Message*</label>
						<textarea class="form-control" id="message" name="message" rows="5" required></textarea>
					</div>
					<center><button type="submit" class="btn btn-primary">Envoyer</button></center>
				</form>
			</div>
		</div>
	</div>
</section>

    
    
    
    
    
    
                   	<!-- ----------------------------------------------------  Section "Footer" ------------------------------------------------------>

<footer>
  <div class="footer-wrapper">
    <div class="footer-section">
      <h3>A propos de nous</h3>
      <p>Carloc est une entreprise de location de voitures qui offre une large gamme de véhicules pour répondre à tous les besoins de déplacement. Que vous cherchiez une petite citadine, une berline de luxe ou un utilitaire spacieux, nous avons la voiture qu'il vous faut.</p>
    </div>
    <div class="footer-section">
      <h3>Nous contacter</h3>
      <ul>
        <li>Téléphone: +33 754202462</li>
        <li>Email: tcherekarim@gmail.com</li>
        <li>Adresse: Route de mende, Montpellier 34000</li>
      </ul>
    </div>
    <div class="footer-section">
      <h3>Suivez-nous</h3>
      <ul class="social-links">
          <a href="https://www.facebook.com/">Facebook</a>
          <BR/>
          <a href="https://www.instagram.com/">Instagram</a>
          <BR/>
          <a href="https://twitter.com/">Twiter</a>      
        </ul>
    </div>
    
      
  </div>
</footer>
</body>
</html>

