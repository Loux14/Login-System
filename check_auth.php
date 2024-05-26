<?php
session_start();

include 'libs/app_fcts.php';
include 'libs/config.php';
include 'libs/User.class.php';



$_SESSION["email"] = $_POST["email"];
$_SESSION["password"] = $_POST["password"];





// MySQL connexion
$conn = new mysqli('localhost', 'auth_db_admin', 'password123', 'auth_db');

// request
$sql = "SELECT * FROM users WHERE email = '{$_SESSION["email"]}'";
$resultat = mysqli_query($conn, $sql);

// check results
if (mysqli_num_rows($resultat) === 0) {
    // nothing found
    echo "Aucun usager trouvé correspondant à ces paramètres. Veuillez réessayer : <a href='login.php'>Connexion</a>";
    // add to log
    addLogEntry("Failed authentication process : user not found " . $_SESSION["email"], $_SESSION["email"], "Login Fail");
    sleep(3);

} else {

// user check
    $row = mysqli_fetch_assoc($resultat);
    $password_hash = $row['hash']; 
    $salt = $row['salt']; 
    $hash = hash('sha256', $_SESSION["password"] . $salt);


    // hash check
    if ($hash === $password_hash) {
        echo "Authentication succesful : <a href='home.php'>HOME</a>";
        addLogEntry("Success authentication for "  . $_SESSION["email"], $_SESSION["email"], "Login Success");

        //Session infos
        $_SESSION["logged"] = 1;
        $_SESSION["name"] = $row["name"];
        $_SESSION["user_id"] = $row["user_id"];
        $_SESSION["email"] = $row["email"];

         
    } else {
        // wrong password
        echo  "Wrong username or password, try again : <a href='login.php'>Connexion</a>";
        // ajout au journal de log
        addLogEntry("Failed authentication process: bad password for " . $_SESSION["email"], $_SESSION["email"], "Login Fail");
        sleep(3);
    }
}


?>
