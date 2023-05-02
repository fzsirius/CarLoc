<?php
session_start();

if (isset($_SESSION['client']['id'])) {
    // Vérifier si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer les données du formulaire
        $ID_voiture = $_POST["ID_voiture"];
        $commentaire = $_POST["commentaire"];
        $id_client = $_SESSION['client']['id'];
        
        // Connexion à la base de données
        $conn = mysqli_connect("localhost", "root", "", "karim_carloc");
        if (!$conn) {
            die("La connexion à la base de données a échoué: " . mysqli_connect_error());
        }
        
        // Préparation de la requête SQL
        $query = "INSERT INTO commentaire (ID_voiture, id_client, commentaire) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        
        // Liaison des paramètres
        mysqli_stmt_bind_param($stmt, "iis", $ID_voiture, $id_client, $commentaire);
        
        // Exécution de la requête
        $result = mysqli_stmt_execute($stmt);
        if (!$result) {
            die("L'insertion du commentaire a échoué: " . mysqli_error($conn));
        }
        
        // Fermeture de la connexion
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        
        // Redirection vers la page précédente
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
} else {
    echo "Vous devez être connecté pour poster un commentaire.";
}
?>
