
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="UTF-8">
    <title>To-Do Liste</title>
    <link rel="stylesheet" href="css/home.css">
  </head>
  <body>
    <header>
      <h1>Willkommen, <?php echo $_SESSION['username']; ?> 👋</h1>
    </header>
  <div class="container">
    <h2 id="monthYear"></h2>
    <div class="calendar" id="calendar"></div>
  </div>
  <div class="container">
    <h2>Meine To-Do Liste ✅</h2>
    
    <input id="input" type="text" placeholder="Neue Aufgabe...">
    <button onclick="addTodo()">Hinzufügen</button>
    <ul id="liste"></ul>
    <a href="logout.php" class="logout">Ausloggen</a>
  </div>

  <footer class="footer">
    <div class="footer-content">
     <p>&copy; <?php echo date("Y"); ?> Meine To-Do App – organisiert durchs Leben</p>
      <a href="html/impressum.html">Impressum</a>
    </div>
  </footer>
  <script src="js/calendar.js"></script>
  <script src="js/todo.js"></script>
</body>
</html>