<?php

include 'libs/app_fcts.php';

session_start();

// connexion vers MySQL
$conn = new mysqli('localhost', 'auth_db_admin', 'password123', 'auth_db');

// requete
$sql = "SELECT log_dt, log_type, ip_address FROM logs WHERE supp_log = '{$_SESSION["email"]}' AND log_type IN ('Login Success', 'Login Fail') ORDER BY log_dt DESC LIMIT 5";
$resultat = mysqli_query($conn, $sql);


    if ($resultat->num_rows > 0) {
        // Affichage du début de la table
        echo "<table border='1'>
                <tr>
                    <th>Date du log</th>
                    <th>Type de log</th>
                    <th>Adresse IP</th>
                </tr>";

        // Parcourir les lignes de résultats
        while ($row = $resultat->fetch_assoc()) {
            // Vous pouvez utiliser les valeurs ici
            $log_dt = $row['log_dt'];
            $log_type = $row['log_type'];
            $ip_address = $row['ip_address'];

            // Afficher chaque ligne dans une nouvelle ligne de la table
            echo "<tr>";
            echo "<td>" . $log_dt . "</td>";
            echo "<td>" . $log_type . "</td>";
            echo "<td>" . $ip_address . "</td>";
            echo "</tr>";
        }

        // Fermeture de la table
        echo "</table>";
    } else {
        echo "Aucun résultat trouvé.";
    }



if (! isset($_SESSION["logged"]) || $_SESSION["logged"] != 1) {
  echo "<p>Il faut être authentifié pour accéder à cette ressource: <a href='index.php'>Connexion</p>";
  addLogEntry("Attempt to get to home page without authentication.", NULL, "Bypass attempt");
  exit;   // Terminate the script.
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Page d'accueil</title>
</head>

<body>
<h1>Page d'accueil</h1>

<p>Bienvenue dans l'application. Voici votre profil:</p>

<ul>
<li>Nom: <?=$_SESSION["name"]?></lil>
<li>Numéro: <?=$_SESSION["user_id"]?></lil>
</ul>

<p>Quitter la session: <a href='logout.php'>Déconnexion</p>

</body>
</html>
