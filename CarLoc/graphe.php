<html>
<head>
    <title>nombre_de_clients_dashboard</title>
    <link rel="stylesheet" type="text/css" href="styles/graphe.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Inclusion de la bibliothèque Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body>

    <?php require_once("nav_admin.php");?>

    <div class="col-md-5 col-md-offset-2 chart-dashboard">  


	
        <!-- Création du canvas pour le graphique -->
        <canvas id="graphe_nb_clients"></canvas>
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

</body>
</html>
