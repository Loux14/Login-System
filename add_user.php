<?php
session_start();

include 'libs/app_fcts.php';

$_SESSION["email"] = $_POST["email"];
$_SESSION["password"] = $_POST["password"];
$_SESSION["name"] = $_POST["name"];


// Add new user
// random salt
$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$charactersLength = strlen($characters);
$salt = '';
for ($i = 0; $i < 20; $i++) {
  $salt .= $characters[random_int(0, $charactersLength - 1)];
}


// Hash creation
$hash = hash('sha256', $_SESSION["password"] . $salt);

// MySQL connexion
$conn = new mysqli('localhost', 'auth_db_admin', 'password123', 'auth_db');

// MySQL command creation
$sql = "INSERT INTO users (name, email, hash, salt) VALUES ('" . $_SESSION["name"] . "', '" .
       $_SESSION["email"] . "', '" . $hash . "', '" . $salt . "')";


//MySQL command
$result = $conn->query($sql);

addLogEntry("User registration process complete for " . $_SESSION["email"], $_SESSION["email"], "User registration");

?>
<!DOCTYPE html>
<html>
<head>
  <title>New user</title>
</head>

<body>
<h1>New user</h1>

<p>New user added to database</p>

<p>Connect here : <a href="login.php">Connexion</p>

</body>
</html>
