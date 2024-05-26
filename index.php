<?php

session_start();

include 'libs/app_fcts.php';

if (isset($_SESSION["logged"]) && $_SESSION["logged"] == 1) {
  // The user is already logged in so we redirect to the home page.
  header("Location: home.php");
  exit;   // Terminate the script.
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Page par défaut</title>
</head>

<body>
<h1>Page par défaut</h1>

<p>Bienvenue dans l'application. Vous devez avoir un compte et vous authentifier pour utiliser les fonctionnalités.</p>
<p>Vous pouvez ouvrir une session ici: <a href='login.php'>Connexion</a></p>
<p>Si vous n'avez pas de compte, vous pouvez en créer un ici: <a href='register.php'>Enregistrement</a></p>

</body>
</html>
