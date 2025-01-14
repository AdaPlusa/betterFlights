<?php
// Połączenie z bazą danych
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'bazarezerwacji';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Błąd połączenia: " . $e->getMessage());

}

