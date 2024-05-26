<?php
session_start();

include 'libs/app_fcts.php';

$_SESSION["name"] = $_POST["name"];
$_SESSION["email"] = $_POST["email"];
$_SESSION["password"] = $_POST["password"];

include 'libs/config.php';
include 'libs/User.class.php';
include 'libs/GoogleAuthenticator.class.php';

addLogEntry("Initiating user registration: password established for " . $_SESSION["email"], $_SESSION["email"], "User registration");

$ga = new GoogleAuthenticator();
$_SESSION["secret"] = $ga -> createSecret();

$qrCodeUrl = $ga->getQRCodeGoogleUrl($_SESSION["email"], $_SESSION["secret"], "Demo pour UQO CYB1133");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Ajout du deuxième facteur</title>
</head>

<body>
<h1>Ajout du deuxième facteur</h1>

<p>Voici le code QR pour l'app d'authentification</p>

<div id="img">
  <img src='<?php echo $qrCodeUrl; ?>' />
</div>

<p>
<a href="add_user.php"><input type="button" value="Valider"></a>
</p>

</body>
</html>
