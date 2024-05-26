<?php

include 'libs/app_fcts.php';

session_start();

//MySQL connexion
$conn = new mysqli('localhost', 'auth_db_admin', 'password123', 'auth_db');

// request
$sql = "SELECT log_dt, log_type, ip_address FROM logs WHERE supp_log = '{$_SESSION["email"]}' AND log_type IN ('Login Success', 'Login Fail') ORDER BY log_dt DESC LIMIT 5";
$resultat = mysqli_query($conn, $sql);


    if ($resultat->num_rows > 0) {
        // Shows last logs
        echo "<table border='1'>
                <tr>
                    <th>Date du log</th>
                    <th>Type de log</th>
                    <th>Adresse IP</th>
                </tr>";

        
        while ($row = $resultat->fetch_assoc()) {
            
            $log_dt = $row['log_dt'];
            $log_type = $row['log_type'];
            $ip_address = $row['ip_address'];

            
            echo "<tr>";
            echo "<td>" . $log_dt . "</td>";
            echo "<td>" . $log_type . "</td>";
            echo "<td>" . $ip_address . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    }
    

if (! isset($_SESSION["logged"]) || $_SESSION["logged"] != 1) {
  echo "<p>You must authenticate : <a href='index.php'>Connexion</p>";
  
  addLogEntry("Attempt to get to home page without authentication.", NULL, "Bypass attempt");
  exit;  
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
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
<h1>Home</h1>

<p>Your profile :</p>

<ul>
<li>Name : <?=$_SESSION["name"]?></lil>
<li>iD : <?=$_SESSION["user_id"]?></lil>
</ul>

<p><a href='logout.php'>Log Out</p>

</body>
</html>
