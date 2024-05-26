<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Fermeture de session</title>
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
<h1>Fermeture de session</h1>

<p>
Votre session a été détruite
</p>
<p><a href='login.php'>Connexion</p>
</body>
</html>
