<?php
    session_start();


// Vérifier si une session est active
if (!isset($_SESSION['admin'])) {
	 header('Location: connexion_admin.php');
        exit;
} else {
    // Afficher un message de bienvenue et un lien pour se déconnecter
    require_once('nav_admin.php');
    echo '<BR/>'; echo '<BR/>';
    echo '<BR/>'; echo '<BR/>';
    echo '<BR/>'; echo '<BR/>';
     echo '<BR/>'; echo '<BR/>';
    
  //GRAPHIQUE 1 DEBUT 
   // Se connecter à la base de données
    $conn = mysqli_connect("localhost", "root", "", "karim_carloc");

    // Vérifier si la connexion a réussi
    if (!$conn) {
        die("La connexion à la base de données a échoué : " . mysqli_connect_error());
    }

    // Requête SQL pour récupérer les 10 voitures les plus demandées
    $sql = "SELECT v.Marque, v.Model, SUM(c.quantite) AS total_quantite
            FROM commande c
            JOIN voiture v ON c.ID_voiture = v.ID_voiture
            WHERE c.statut = 'confirmé'
            GROUP BY v.ID_voiture
            ORDER BY total_quantite DESC
            LIMIT 10";

 // Exécution de la requête
$result = mysqli_query($conn, $sql);

// Vérifier si la requête a réussi
if (!$result) {
    die("La requête SQL a échoué : " . mysqli_error($conn));
}

// Récupération des données
$labels = array();
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $labels[] = $row['Marque'] . ' ' . $row['Model'];
    $data[] = $row['total_quantite'];
}


    // Fermer la connexion à la base de données
    mysqli_close($conn);  
}

?>

<!-- Inclure la librairie Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Créer un canvas pour le graphique -->
    
<canvas id="myChart" width="250" height="50"></canvas>


<!-- Initialiser le graphique avec les données récupérées -->
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($labels); ?>,
            datasets: [{
                label: 'Voitures les plus demandées',
                data: <?php echo json_encode($data); ?>,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>



<BR/><BR/><BR/>




    <div class="col-md-5 col-md-offset-2 chart-dashboard">  


	
        <!-- Création du canvas pour le graphique -->
        <canvas id="graphe_nb_clients" width="400" height="50"></canvas>
    </div>

    <?php
        // Connexion à la base de données et récupération du nombre de clients
        require_once('include.php'); // Charge le fichier include.php
        $db = new connexionDB();  // Création d'une instance de connexionDB
        $conn = $db->DB();  // Connexion à la base de données

        $query = "SELECT DATE_FORMAT(date_inscription, '%Y-%m-%d') as date, COUNT(*) as nb_clients FROM client GROUP BY date ORDER BY date";
        $result = $conn->query($query);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <script>
        // Récupération du canvas
        var graphe_nb_clients = document.getElementById('graphe_nb_clients').getContext('2d');

        // Création du graphique
        var chart = new Chart(graphe_nb_clients, {
            type: 'line',
            data: {
                labels: [<?php foreach ($rows as $row) { echo "'" . $row['date'] . "', "; } ?>],
                datasets: [{
                    label: 'Évolution du nombre de clients',
                    data: [<?php foreach ($rows as $row) { echo $row['nb_clients'] . ', '; } ?>],
                    backgroundColor: "lightblue",
                    borderColor: "red",
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1 // Ajout de stepSize pour afficher des entiers sur l'axe des y
                        }
                    }]
                }
            }
        });
    </script>


<style>
    body{
margin-left : 100px;
    margin-right : 100px;

    }
</style>


