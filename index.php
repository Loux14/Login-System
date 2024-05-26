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
<h1>SafeBox</h1>

<p><a href='login.php'>Connexion</a></p>
<p><a href='register.php'>Register</a></p>

</body>
</html>
