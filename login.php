
<?php
$success = 0;
session_start();
$login = 0;   // Statusvariable für erfolgreichen Login
$invalid = 0; // Statusvariable für ungültige Login-Daten
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   // Verbindung zur Datenbank herstellen
   include 'connect.php';
   // Benutzereingaben aus dem Formular abholen
   $username = $_POST['username'];
   $password = $_POST['password'];
   // SQL-Abfrage zur Überprüfung von Benutzername und Passwort
   $sql = "SELECT * FROM registration WHERE username='$username' AND password='$password'";
   $result = mysqli_query($con, $sql);
   if ($result) {
     $num = mysqli_num_rows(result: $result);
       if ($num > 0) {
         // Login erfolgreich → Daten aus DB holen
          $row = mysqli_fetch_assoc($result);
           // Session starten
           $_SESSION["user_id"] = $row["id"];      // WICHTIG → User-ID in Session
           $_SESSION["username"] = $row["username"]; 
           $login = 1;
           header('Location: home.php'); // Weiterleitung nach Login
           exit;
       } else {
           // Benutzername oder Passwort falsch
           $invalid = 1;
       }
   }
}
?>
