<head>
  <style>
    nav {
      background-color: #1F224F;
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

    .nav-links .dropdown {
      position: relative;
    }

    .nav-links .dropdown:hover .dropdown-content {
      display: block;
    }

    .nav-links .dropdown-content {
      display: none;
      position: absolute;
      z-index: 1;
      background-color: #fff;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    }

    .nav-links .dropdown-content a {
      color: #000;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }

    .nav-links .dropdown-content a:hover {
      background-color: #f1f1f1;
    }

  </style>
</head>

<nav>
  <div class="nav-logo">
    <a href="principal_admin.php">
      <img src="images/logo.png" alt="Logo">
    </a>
  </div>
  <div class="nav-links">
    <a href="principal_admin.php">Accueil</a>
    <div class="dropdown">
      <a href="#">Gestion des commandes</a>
      <div class="dropdown-content">
        <a href="#">Nouvelle commande</a>
        <a href="demandes_recues.php">Demandes Reçues</a>
        <a href="#">Demandes refusé</a>
      </div>
    </div>
        <div class="dropdown">
      <a href="#">Gestion des voitures</a>
      <div class="dropdown-content">
        <a href="ajouter.php">Nouvelle voiture</a>
        <a href="LesVoitures.php">Toutes les voitures</a>
        <a href="#">Option 3</a>
      </div>
    </div>
    <div class="dropdown">
      <a href="#">Gestion des utilisateurs</a>
      <div class="dropdown-content">
        <a href="consult_contact.php">Messages</a>
        <a href="#">Option 2</a>
        <a href="#">Option 3</a>
      </div>
    </div>
    <a href="profil_admin.php">Profil</a>
    <a href="deconnexion.php">Deconnexion</a>
</nav>