<?php
$host_crud = 'localhost';
$db_crud   = 'u206475965_tienda_db';
$user_crud = 'u206475965_tiendainferno';
$pass_crud = 'Renzho02';
$charset = 'utf8mb4';

$host_tienda = 'localhost';
$db_tienda   = 'u206475965_tienda_db';
$user_tienda = 'u206475965_tiendainferno';
$pass_tienda = 'Renzho02';

try {
    $dsn_crud = "mysql:host=$host_crud;dbname=$db_crud;charset=$charset";
    $pdo_crud = new PDO($dsn_crud, $user_crud, $pass_crud, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    $dsn_tienda = "mysql:host=$host_tienda;dbname=$db_tienda;charset=$charset";
    $pdo_tienda = new PDO($dsn_tienda, $user_tienda, $pass_tienda, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>