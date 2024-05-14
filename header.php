<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ArcadiaZoo</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Anonymous+Pro&family=Comfortaa&family=Inika:wght@400;700&family=Lexend+Mega&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Zen+Tokyo+Zoo&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
  </head>
  <body>
    <a href="#" class="admin">Admin</a>
    <div class="login-form">
      <form action="verificationAdmin.php" method="POST">
        <input type="text" name="username" placeholder="Nom d'utilisateur" />
        <input type="password" name="password" placeholder="Mot de passe" />
        <button type="submit">Se connecter</button>
      </form>
    </div>
    <header>
      <div class="background-image"></div>
      <div class="header-container">
        <div class="logo">
          <img src="logo/logoArcadia.png" alt="ArcadiaLogo" />
        </div>

       <nav class="header-nav">
    <ul>
        <li <?php if(basename($_SERVER['PHP_SELF']) == 'index.php') echo 'class="active"'; ?>><a href="index.php">ACCUEIL</a></li>
        <li <?php if(basename($_SERVER['PHP_SELF']) == 'desert.php') echo 'class="active"'; ?>><a href="desert.php">Animaux et Habitats</a></li>
        <li <?php if(basename($_SERVER['PHP_SELF']) == 'services.php') echo 'class="active"'; ?>><a href="services.php">SERVICES</a></li>
        <li <?php if(basename($_SERVER['PHP_SELF']) == 'formulaire.php') echo 'class="active"'; ?>><a href="formulaire.php">CONTACT</a></li>
    </ul>
</nav>
      </div>
<div class="burger-container">
    <a href="#" id="logo-burger-button">
        <img
            id="logo-burger"
            src="logo/LOGO.png"
            alt="logo-burger"
            height="40px"
            width="40px"
            class="logo-burger"
        />
    </a>
</div>

<div id="vertical-navbar" class="vertical-navbar">
    <ul>
        <li <?php if(basename($_SERVER['PHP_SELF']) == 'index.php') echo 'class="active"'; ?>><a href="index.php">ACCUEIL</a></li>
        <li <?php if(basename($_SERVER['PHP_SELF']) == 'desert.php') echo 'class="active"'; ?>><a href="desert.php">Animaux et Habitats</a></li>
        <li <?php if(basename($_SERVER['PHP_SELF']) == 'services.php') echo 'class="active"'; ?>><a href="services.php">SERVICES</a></li>
        <li <?php if(basename($_SERVER['PHP_SELF']) == 'formulaire.php') echo 'class="active"'; ?>><a href="formulaire.php">CONTACT</a></li>
    </ul>
    <button id="close-button">Fermer</button>
</div>


    </header>