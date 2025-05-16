<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $mensaje = $_POST['mensaje'] ?? '';
    header('Location: contacto.php?exito=1');
    exit;
}

header('Location: contacto.php');
exit;
?>