<?php
$success = 0; // Statusvariable für erfolgreiche Registrierung
$user = 0;  // Statusvariable, falls der Benutzername bereits existiert
$error = 0;
$error2 = 0;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verbindung zur Datenbank herstellen
    include 'connect.php';

    // Benutzereingaben aus dem Formular abholen
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $vorname = trim($_POST['vorname']);
    $nachname = trim($_POST['nachname']);

    if (empty($username) || empty($password) || empty($vorname) || empty($nachname)) {
        $error = 1;
    }

    if (strlen($password) < 7) {
        $error2 = 1;
    }

    if (empty($error) && empty($error2)) {
    // Prüfen, ob der Benutzername bereits existiert
    $sql = "SELECT * FROM `registration` WHERE username='$username'";
    $result = mysqli_query($con, $sql); 

    if ($result) {
        $num = mysqli_num_rows(result: $result);
        if ($num > 0) {
            // Benutzername existiert bereits
            $user = 1;
        } else {
            // Benutzername ist neu – Daten in die Datenbank einfügen
            $sql = "INSERT INTO `registration` (username, password, vorname, nachname) 
                    VALUES ('$username', '$password', '$vorname', '$nachname')";
            $result = mysqli_query($con, $sql);

            if ($result) {
                // Registrierung erfolgreich
                $success = 1;
                header('location:login.php'); // Weiterleitung zur Login-Seite
            } else {
                // Fehler beim Einfügen
                die(mysqli_error($con));
            }
        }
    }
  }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIGN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="css/sign.css">
  </head>
  <body>
    <?php 
       if($error2){
        echo 
          '<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
          <strong>Fehler</strong> Das Passwort muss mindestens 8 Zeichen enthalten
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
      }
    ?>

    <?php 
      if($error){
        echo 
          '<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
          <strong>Fehler</strong> Bitte alle Felder ausfüllen
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
      }
    ?>

    <?php 
      if($user){
        echo 
          '<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
          <strong>Ohh nein</strong> Der Nutzer existiert schon
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
      }
    ?>

    <?php 
      if($success){
        echo 
          '<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
          <strong>Erfolgreich</strong> registriert!
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
      }
    ?>

    <h1 class="text-center">Registrieren</h1>
    <div class="container mt-5">
      <form action="sign.php" method="post">
        <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Vorname</label>
        <input type="text" class="form-control" placeholder="Vorname eingeben" name="vorname">
        </div>

        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Name</label>
          <input type="text" class="form-control" placeholder="Nachname eingeben" name="nachname">
        </div>

        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Username</label>
          <input type="text" class="form-control" placeholder="Username erstellen" name="username">
        </div>

       <div class="mb-3">
         <label for="exampleInputPassword1" class="form-label">Passwort erstellen</label>
         <input type="password" class="form-control" placeholder="Passwort erstellen" name="password">
        </div>

        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Passwort wiederholen</label>
         <input type="password" class="form-control" placeholder="Passwort wiederholen" name="password">
       </div>

        <button type="submit" class="btn btn-primary w-100">Registrieren</button>
        <p></p>
        <a href="login.php">
          <button type="submit" class="btn btn-outline-primary w-100" disabled>Zurück zum Login</button>
        </a>
      </form>
    </div>
  </body>
</html>