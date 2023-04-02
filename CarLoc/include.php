<?php
include_once('_db/connexionDB.php');
?>
<?php
$cncarloc=new MySQLi("localhost","root","","karim_carloc");

?>
<?php
// Définir les paramètres de connexion à la base de données
$host = 'localhost';
$dbname = 'karim_carloc';
$username = 'root';
$password = '';

// Connexion à la base de données
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
} catch (PDOException $e) {
    die("La connexion à la base de données a échoué: " . $e->getMessage());
}
?>
