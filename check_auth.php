<?php
session_start();

include 'libs/app_fcts.php';
include 'libs/config.php';
include 'libs/User.class.php';
include 'libs/GoogleAuthenticator.class.php';


$_SESSION["email"] = $_POST["email"];
$_SESSION["password"] = $_POST["password"];
$_SESSION["pin"] = $_POST["pin"];




// connexion vers MySQL
$conn = new mysqli('localhost', 'auth_db_admin', 'password123', 'auth_db');

// requete
$sql = "SELECT * FROM users WHERE email = '{$_SESSION["email"]}'";
$resultat = mysqli_query($conn, $sql);

// verifie resultats
if (mysqli_num_rows($resultat) === 0) {
    // Aucun usager trouvé
    echo "Aucun usager trouvé correspondant à ces paramètres. Veuillez réessayer : <a href='login.php'>Se connecter</a>";
    // ajout au journal de log
    addLogEntry("Failed authentication process : user not found " . $_SESSION["email"], $_SESSION["email"], "Login Fail");
    sleep(3);

} else {

// usager identifi
    $row = mysqli_fetch_assoc($resultat);
    $password_hash = $row['hash']; 
    $salt = $row['salt']; 
    $pin = $_SESSION["pin"];
    $hash = hash('sha256', $_SESSION["password"] . $salt);


    // comparaison hash 
    if ($hash === $password_hash) {
        echo "Mot de passe correct, vérification du deuxième facteur.........";
        
        	
        // requete a Google
        $secret = $row['secret']; 
        $ga = new GoogleAuthenticator();
        $current_code = $ga->getCode($secret);
	
	//comparaison du pin et de la requete google
        if ($current_code == $pin) {
            // pin correct
            echo "Authentification réussie : <a href='home.php'>HOME</a>";
            // ajout au journal de log
            addLogEntry("Success of authentication process for " . $_SESSION["email"], $_SESSION["email"], "Login Success");
            
            //infos de session
            $_SESSION["logged"] = 1;
            $_SESSION["name"] = $row["name"]; 
            $_SESSION["user_id"] = $row["user_id"]; 
            $_SESSION["email"] = $row["email"]; 

        } else {
            // code pin est incorrect
            echo " Le deuxième facteur a échoué. Veuillez réessayer : <a href='login.php'>Se connecter</a>";
            // ajout au journal de log
            addLogEntry("Failed authentication process: second factor failed for " . $_SESSION["email"], $_SESSION["email"], "Login Fail");
            sleep(3);
  
        }
    } else {
        // mot de passe incorrect
        echo  "Aucun usager trouvé correspondant à ces paramètres. Veuillez réessayer : <a href='login.php'>Se connecter</a>";
        // ajout au journal de log
        addLogEntry("Failed authentication process: bad password for " . $_SESSION["email"], $_SESSION["email"], "Login Fail");
        sleep(3);
    }
}


?>
