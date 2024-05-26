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
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    h1 {
      color: #333;
      font-size: 3em;
      margin-bottom: 20px;
    }

    p {
      margin: 10px 0;
    }

    a {
      text-decoration: none;
      color: #007BFF;
      font-size: 1.2em;
      transition: color 0.3s ease;
    }

    a:hover {
      color: #0056b3;
    }

    .container {
      text-align: center;
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>

<body>
<h1>New user</h1>

<p>New user added to database</p>

<p>Connect here : <a href="login.php">Connexion</p>

</body>
</html>
