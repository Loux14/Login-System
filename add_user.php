<?php
session_start();

include 'libs/app_fcts.php';

// Ajout de l'usager dans la base de données.
// Il faut d'abord calculer certaines valeurs.
// Établissement au hasard d'une valeur "salt" qui sera ajoutée au mot de passe.
$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$charactersLength = strlen($characters);
$salt = '';
for ($i = 0; $i < 20; $i++) {
  $salt .= $characters[random_int(0, $charactersLength - 1)];
}
// echo $salt;   // Décommenter cette ligne pour vérifier la création du salt.

// Calcul du code de hachage.
$hash = hash('sha256', $_SESSION["password"] . $salt);
// echo $hash;  // Utiliser cette ligne pour voir la valeur de hash code.

// Établir la connexion vers MySQL.
$conn = new mysqli('localhost', 'auth_db_admin', 'password123', 'auth_db');

// Création de la commande SQL pour insérer l'usager dans la base de données.
$sql = "INSERT INTO users (name, email, hash, salt, secret) VALUES ('" . $_SESSION["name"] . "', '" .
       $_SESSION["email"] . "', '" . $hash . "', '" . $salt . "', '" . $_SESSION["secret"] . "')";

//  echo $sql;  // Utiliser pour voir la commande.

// Execution de la commande en utilisant la connexion vers MySQL.
$result = $conn->query($sql);

addLogEntry("User registration process complete for " . $_SESSION["email"], $_SESSION["email"], "User registration");

?>
<!DOCTYPE html>
<html>
<head>
  <title>Ajout du nouveau compte</title>
</head>

<body>
<h1>Ajout du nouveau compte</h1>

<p>Le nouveau compte a été créé et ajouté dans la base de données.</p>

<p>Vous pouvez ouvrir une nouvelle session ici: <a href="login.php">Connexion</p>

</body>
</html>
