<?php
session_start();
require_once __DIR__ . '/../config/conexion_tienda.php';

if (!isset($_SESSION['id_usuario'])) {
    header('Location: ../PHP_Login/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['producto_id'])) {
    try {
        $stmt = $pdo_crud->prepare("SELECT id FROM productos WHERE id = ?");
        $stmt->execute([$_POST['producto_id']]);
        
        if (!$stmt->fetch()) {
            throw new Exception('El producto no existe');
        }
        $sql = "INSERT INTO carrito (usuario_id, producto_id, cantidad) 
                VALUES (?, ?, 1)
                ON DUPLICATE KEY UPDATE cantidad = cantidad + 1";
        
        $stmt = $pdo_tienda->prepare($sql);
        $stmt->execute([$_SESSION['id_usuario'], $_POST['producto_id']]);

        $_SESSION['carrito_msg'] = "Producto agregado al carrito";
        
    } catch (Exception $e) {
        $_SESSION['error_msg'] = $e->getMessage();
    }
}

header("Location: " . ($_SERVER['HTTP_REFERER'] ?? '../index.php'));
exit;
?>