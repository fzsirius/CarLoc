<!DOCTYPE html>
<html lang="fr">
<head>
     <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <style>
    nav {
      background-color: #689f38 ;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      z-index: 1;
    }
    
    .nav-logo {
      margin-left: 20px;
    }
    
    .nav-logo img {
      height: 50px;
      width: 150px;
    }
    
    .nav-links {
      display: flex;
      align-items: center;
      margin-right: 20px;
    }
    
    .nav-links a {
      color: #fff;
      font-size: 18px;
      text-decoration: none;
      padding: 10px;
      margin-left: 20px;
      position: relative;
    }
    
    .nav-links a:hover {
  background-color: #fff;
  color: #0c1f2e;
  height: 100%;
}

    
    .nav-links a:before {
      content: '';
      position: absolute;
      width: 100%;
      height: 3px;
      bottom: 0;
      left: 0;
      background-color: #fff;
      transform: scaleX(0);
      transition: transform 0.3s ease-out;
      transform-origin: bottom;
    }
    
    .nav-links a:hover:before {
      transform: scaleX(1);
      transition: transform 0.3s ease-out;
      transform-origin: bottom;
    }
  </style>
</head>
<body>
<nav>
  <div class="nav-logo">
    <a href="principal.php">
      <img src="images/logo.png" alt="Logo">
    </a>
  </div>
  <div class="nav-links">
    <a href="principal.php">Accueil</a>
    <a href="recommandation.php">Recommandations</a>
    <a href="panier.php">Panier</a>
    <a href="historique.php">Historique</a>
    <a href="profil_client.php">Profil</a>
    <a href="deconnexion.php">Se déconnecter</a>
  </div>
</nav>
</body>
</html>