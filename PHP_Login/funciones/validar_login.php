<?php
session_start();
require '../conexion_usuarios.php';

$usuario = $_POST['usuario'] ?? '';
$clave = $_POST['clave'] ?? '';

$consulta = $pdo_usuarios->prepare("SELECT * FROM usuarios WHERE usuario = :usuario");
$consulta->bindParam(":usuario", $usuario);
$consulta->execute();

if ($consulta->rowCount() == 1) {
    $user = $consulta->fetch(PDO::FETCH_ASSOC);
    if (password_verify($clave, $user['clave'])) {
        $_SESSION['usuario'] = $user['usuario'];
        $_SESSION['rol'] = $user['rol'];
        $_SESSION['id_usuario'] = $user['id'];
        
        $_SESSION['carrito'] = [];
        $_SESSION['favoritos'] = [];
        
        $tiendaConfig = '../config/conexion_tienda.php';
        if (file_exists($tiendaConfig)) {
            require $tiendaConfig;
            if (isset($pdo_tienda)) {
                try {
                    $stmt = $pdo_tienda->prepare("SELECT producto_id FROM carrito WHERE usuario_id = ?");
                    $stmt->execute([$user['id']]);
                    $_SESSION['carrito'] = $stmt->fetchAll(PDO::FETCH_COLUMN);
                    
                    $stmt = $pdo_tienda->prepare("SELECT producto_id FROM favoritos WHERE usuario_id = ?");
                    $stmt->execute([$user['id']]);
                    $_SESSION['favoritos'] = $stmt->fetchAll(PDO::FETCH_COLUMN);
                } catch (PDOException $e) {
                    error_log("Error cargando carrito/favoritos: " . $e->getMessage());
                }
            }
        }
        
        echo json_encode([
            "status" => "ok", 
            "rol" => $user['rol'],
            "redirect" => "/InfernoStore_Tienda/index.php"
        ]);
        exit;
    }
}

echo json_encode(["status" => "error", "msg" => "Credenciales incorrectas"]);
?>