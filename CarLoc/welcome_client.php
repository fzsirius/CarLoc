<?php session_start();

if (empty($_SESSION['client'])) {
    header('Location: login.php');
    exit;
}

$nom = $_SESSION['client']['nom'];
$prenom = $_SESSION['client']['prenom'];

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion réussie</title>
    <style>
        body {
            background-image: url('assets/img/a.jpg');
            background-repeat: no-repeat;
            background-size: 100% 100%;
            background-attachment: fixed;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background-color: #e6f7ff;
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
            <h1>Bienvenue <?php echo $_SESSION['client']['prenom']; ?> <?php echo $_SESSION['client']['nom']; ?></h1>
            <p>Vous êtes maintenant connecté.</p>
            <p>Vous allez être redirigé vers la page principale dans <span id="countdown">5</span> secondes...</p>
        </div>
    </div>

    <script>
        var seconds = 5; //  nombre de secondes à décompter
        var countdown = setInterval(function() {
            seconds--;
            document.getElementById("countdown").textContent = seconds;
            if (seconds == 0) {
                clearInterval(countdown);
                window.location.href = "principal.php";
            }
        }, 1000); // mettre à jour le compte à rebours toutes les secondes
    </script>

</body>
</html>
