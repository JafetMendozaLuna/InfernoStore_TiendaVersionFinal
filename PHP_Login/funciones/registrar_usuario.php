<?php
session_start();
require '../conexion_usuarios.php';

$usuario = trim($_POST['usuario']);
$clave = $_POST['clave'];
$clave2 = $_POST['clave2'];

if ($clave !== $clave2) {
    echo json_encode(["status" => "error", "msg" => "Las contraseñas no coinciden."]);
    exit;
}

$check = $pdo_usuarios->prepare("SELECT id FROM usuarios WHERE usuario = :usuario");
$check->bindParam(":usuario", $usuario);
$check->execute();

if ($check->rowCount() > 0) {
    echo json_encode(["status" => "error", "msg" => "El usuario ya existe."]);
    exit;
}

$hash = password_hash($clave, PASSWORD_DEFAULT);
$rol = "cliente";
$insert = $pdo_usuarios->prepare("INSERT INTO usuarios (usuario, clave, rol) VALUES (:usuario, :clave, :rol)");
$insert->bindParam(":usuario", $usuario);
$insert->bindParam(":clave", $hash);
$insert->bindParam(":rol", $rol);
$insert->execute();

$_SESSION['usuario'] = $usuario;
$_SESSION['rol'] = $rol;
$_SESSION['id_usuario'] = $pdo_usuarios->lastInsertId();

echo json_encode(["status" => "ok"]);