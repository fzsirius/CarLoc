<?php
    session_start();


// Vérifier si une session est active
if (!isset($_SESSION['admin'])) {
    // Afficher les liens "Nouveau Client" et "Se connecter"
    echo '<a href="nouveau.php">Nouveau Client</a>';
    echo '<BR/>';
    echo '<a href="connexion.php">Se connecter</a>';
} else {
    // Afficher un message de bienvenue et un lien pour se déconnecter
    require_once('nav_admin.php');
     echo '<BR/>';
    echo '<BR/>'; echo '<BR/>';
    echo '<BR/>'; echo '<BR/>';
    echo '<BR/>';
    echo 'Bienvenu ' . $_SESSION['admin']['prenom'] . ' ' . $_SESSION['admin']['nom']." ". $_SESSION['admin']['id'];
    echo '<BR/>';
    echo '<BR/>';
    echo '<a href="deconnexion.php">Se déconnecter</a>';
    echo '<BR/>';echo '<BR/>';
    echo '<a href = panier.php>Mon panier</a>';
     echo '<BR/>';echo '<BR/>';
     echo '<a href="profil_client.php">Profil</a>';
   // echo '<a href = "articles/article">Ajouter article au panier</a>';
}
?>