<?php
// Vérifier si l'administrateur est connecté
session_start();
if(isset($_SESSION['admin'])) {
    // Vérifier si l'identifiant de commande a été fourni
    if(isset($_GET['id_commande'])) {
        // Connexion à la base de données
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "karim_carloc";
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // Vérifier la connexion à la base de données
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Récupérer l'identifiant de commande
        $id = $_GET['id_commande'];

        // Mettre à jour le statut de la commande
        $sql = "UPDATE commande SET statut=1 WHERE id_commande=$id";
        if (mysqli_query($conn, $sql)) {
            // Rediriger l'administrateur vers la page des commandes reçues
            header("Location: demandes_recues.php");
        } else {
            echo "Erreur dans la mise à jour de la commande : " . mysqli_error($conn);
        }

        // Fermer la connexion à la base de données
        mysqli_close($conn);
    } else {
        echo "Identifiant de commande manquant.";
    }
} else {
    // Rediriger l'utilisateur vers la page de connexion administrateur
    header("Location: connexion_admin.php");
}
?>
