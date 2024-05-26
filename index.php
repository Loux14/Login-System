<?php

session_start();

include 'libs/app_fcts.php';

if (isset($_SESSION["logged"]) && $_SESSION["logged"] == 1) {
  // The user is already logged in 
  header("Location: home.php");
  exit;  
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Welcome Page</title>
</head>

<body>
<h1>SafeBox</h1>

<p><a href='login.php'>Connexion</a></p>
<p><a href='register.php'>Register</a></p>

</body>
</html>
