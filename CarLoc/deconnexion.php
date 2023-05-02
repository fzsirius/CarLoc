<?php
    session_start();
    session_unset();
    session_destroy();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Déconnexion</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <!-- Lien vers la feuille de style Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  
    <style>
        body {
            background-image: url('assets/img/a.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 0 50px 0 rgba(0, 0, 255, 0.2);
            padding: 30px;
            text-align: center;
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 30px;
        }

        p {
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        a {
            color: #fff;
            background-color: #007bff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.2s ease-in-out;
        }

        a:hover {
            background-color: #0062cc;
        } 

        #countdown {
            font-size: 2.5rem;
            font-weight: bold;
            color: #ff6600;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="card">
            <h1>Déconnexion</h1>
            <p>Merci de votre visite.</p>
            <p>Vous avez été déconnecté.</p>
            <p>Vous allez être redirigé vers la page d'accueil dans <span id="countdown">5</span> secondes...</p>
        </div>
    </div>

    <script>
        var seconds = 5; // définir le nombre de secondes à décompter
        var countdown = setInterval(function() {
            seconds--;
            document.getElementById("countdown").textContent = seconds;
            if (seconds == 0) {
                clearInterval(countdown);
                window.location.href = "index.php";
            }
        }, 1000); // mettre à jour le compte à rebours toutes les secondes
    </script>

</body>
</html>
