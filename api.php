<?php
session_start();

include 'connect.php';

// Sicherstellen, dass eingeloggt
if (!isset($_SESSION['user_id'])) {
    echo "Nicht eingeloggt";
    exit;
}
$user_id = (int) $_SESSION['user_id'];

// --- HINZUFÜGEN ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['todo'])) {
    $text = trim($_POST['todo']);
    if ($text === '') {
        echo "Fehler: leeres Feld";
         exit;
    }

    $stmt = $con->prepare("INSERT INTO todos (user_id, `text`) VALUES (?, ?)");
    if (!$stmt) {
        echo "Prepare-Fehler: " . $con->error;
        exit;
    }
    $stmt->bind_param("is", $user_id, $text);
    if ($stmt->execute()) {
        echo "OK";
    } else {
        echo "Execute-Fehler: " . $stmt->error;
    }
    $stmt->close();
    exit;
}




// --- HINZUFÜGEN ---
/*if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['todo'])) {
    $text = trim($_POST['todo']);
    if ($text === '') {
        echo "Fehler: leeres Feld";
        exit;
    }

    // Uhrzeit vorbereiten
    $created_at = date("Y-m-d H:i:s");

    $stmt = $con->prepare("INSERT INTO todos (user_id, `text`, created_at) VALUES (?, ?, ?)");
    if (!$stmt) {
        echo "Prepare-Fehler: " . $con->error;
        exit;
    }

    $stmt->bind_param("is", $user_id, $text, $created_at);
    if ($stmt->execute()) {
        // Uhrzeit im lesbaren Format zurückgeben
        echo json_encode([
            "status" => "OK",
            "text" => $text,
            "timestamp" => date("H:i d.m.Y", strtotime($created_at))
        ]);
    } else {
        echo "Execute-Fehler: " . $stmt->error;
    }
    $stmt->close();
    exit;
}*/









// --- LÖSCHEN ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $id = (int) $_POST['delete_id'];
    $stmt = $con->prepare("DELETE FROM todos WHERE id = ? AND user_id = ?");
    if (!$stmt) {
        echo "Prepare-Fehler: " . $con->error;
        exit;
    }
    $stmt->bind_param("ii", $id, $user_id);
    if ($stmt->execute()) {
        echo "OK";
    } else {
        echo "Execute-Fehler: " . $stmt->error;
    }
    $stmt->close();
    exit;
}

// --- GET: Todos abrufen ---
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmt = $con->prepare("SELECT id, `text` FROM todos WHERE user_id = ? ORDER BY id DESC");
    if (!$stmt) {
        echo "Prepare-Fehler: " . $con->error;
        exit;
    }
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $res = $stmt->get_result();
    while ($row = $res->fetch_assoc()) {
        $id = (int)$row['id'];
        $text = htmlspecialchars($row['text']);
        echo "<li>$text <button onclick='deleteTodo($id)'>Löschen</button></li>";
    }
    $stmt->close();
    exit;
}
?>
