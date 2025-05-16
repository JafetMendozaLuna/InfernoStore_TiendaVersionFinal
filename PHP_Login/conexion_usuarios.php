<?php
    $host = "localhost";
    $dbname = "u206475965_tienda_db";
    $user = "u206475965_tiendainferno";
    $pass = "Renzho02";

    try {
        $pdo_usuarios = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
        $pdo_usuarios->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Error en la conexión: " . $e->getMessage());
    }
?>