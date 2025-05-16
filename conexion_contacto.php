<?php
$host = "localhost";
$usuario = "u206475965_contactoinfern";
$password = "Renzho02";
$base_datos = "u206475965_contacto";

$conn = new mysqli($host, $usuario, $password, $base_datos);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>