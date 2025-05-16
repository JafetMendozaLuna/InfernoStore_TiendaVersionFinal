<?php
$host = "localhost";
$db = "inferno_db";
$user = "root";
$pass = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
