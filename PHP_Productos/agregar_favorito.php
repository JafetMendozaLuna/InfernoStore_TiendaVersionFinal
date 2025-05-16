<?php
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../PHP_Login/login.php");
    exit;
}

require_once __DIR__ . '/../config/conexion_tienda.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $usuario_id = $_SESSION['id_usuario'];
        $producto_id = $_POST['producto_id'];
        $action = $_POST['action'] ?? 'toggle';

        if ($action === 'mover_a_carrito') {
            $pdo_tienda->beginTransaction();
            $stmt = $pdo_tienda->prepare("SELECT cantidad FROM carrito WHERE usuario_id = ? AND producto_id = ?");
            $stmt->execute([$usuario_id, $producto_id]);
            $existe = $stmt->fetch();
            
            if ($existe) {
                $stmt = $pdo_tienda->prepare("UPDATE carrito SET cantidad = cantidad + 1 WHERE usuario_id = ? AND producto_id = ?");
            } else {
                $stmt = $pdo_tienda->prepare("INSERT INTO carrito (usuario_id, producto_id, cantidad) VALUES (?, ?, 1)");
            }
            $stmt->execute([$usuario_id, $producto_id]);
            
            $stmt = $pdo_tienda->prepare("DELETE FROM favoritos WHERE usuario_id = ? AND producto_id = ?");
            $stmt->execute([$usuario_id, $producto_id]);
            
            $pdo_tienda->commit();
            $_SESSION['favorito_msg'] = "Producto movido al carrito";
            
        } else {
            $stmt = $pdo_tienda->prepare("SELECT * FROM favoritos WHERE usuario_id = ? AND producto_id = ?");
            $stmt->execute([$usuario_id, $producto_id]);
            
            if ($stmt->fetch()) {
                $stmt = $pdo_tienda->prepare("DELETE FROM favoritos WHERE usuario_id = ? AND producto_id = ?");
                $_SESSION['favorito_msg'] = "Producto eliminado de favoritos";
            } else {
                $stmt = $pdo_tienda->prepare("INSERT INTO favoritos (usuario_id, producto_id) VALUES (?, ?)");
                $_SESSION['favorito_msg'] = "Producto agregado a favoritos";
            }
            $stmt->execute([$usuario_id, $producto_id]);
        }
    } catch (Exception $e) {
        $pdo_tienda->rollBack();
        $_SESSION['error_msg'] = "Error: " . $e->getMessage();
    }
}

header("Location: " . ($_SERVER['HTTP_REFERER'] ?? '../index.php'));
exit;
?>