<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "bazarezerwacji"; // Nazwa bazy danych

// Połączenie z MySQL
try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Połączenie z bazą danych działa!";
} catch (PDOException $e) {
    echo "Błąd połączenia: " . $e->getMessage();
}
?>