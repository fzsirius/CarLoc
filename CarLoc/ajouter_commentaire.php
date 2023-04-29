<?php
session_start();
if (isset($_SESSION['client']['id'])) {
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $ID_voiture = $_POST["ID_voiture"];
    $commentaire = $_POST["commentaire"];
    $id_client = $_SESSION['client']['id'] ;
    // Insérer le commentaire dans la base de données
    $conn = mysqli_connect("localhost", "root", "", "karim_carloc");
    if (!$conn) {
        die("La connexion à la base de données a échoué: " . mysqli_connect_error());
    }
    $query = "INSERT INTO commentaire (ID_voiture,id_client, commentaire) VALUES ('$ID_voiture','$id_client', '$commentaire')";
    $result = mysqli_query($conn, $query);
    mysqli_close($conn);
    
  // Redirection vers la page précédente
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();
}}
?>
