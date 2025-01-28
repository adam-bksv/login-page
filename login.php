<?php

$servername = "sql7.freesqldatabase.com";
$username = "sql7759979"; 
$password = "rZj9MYVBCt"; 
$dbname = "sql7759979";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $input_username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($actual_password);
        $stmt->fetch();

        if ($input_password === $actual_password) { 
            echo "<h1>Hallo, " . htmlspecialchars($input_username) . "!</h1>";
        } else {
            echo "<h1>Falsches Passwort!</h1>";
        }
    } else {
        echo "<h1>Nutzername wurde nicht gefunden!</h1>";
    }

    $stmt->close();
}

$conn->close();
?>
