<?php

// Definiert die Verbindungsparameter Datenbank
$HOSTNAME = 'localhost';   
$USERNAME = 'root';        
$PASSWORD = 'root';        
$DATABASE = 'signupforms'; 

// Stellt eine Verbindung zur MySQL-Datenbank her
$con = mysqli_connect($HOSTNAME, $USERNAME, $PASSWORD, $DATABASE);

// Überprüft, ob die Verbindung erfolgreich war
if ($con->connect_error) {
    die("Verbindung fehlgeschlagen: " . $con->connect_error);
}

?>
