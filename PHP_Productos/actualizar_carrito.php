<?php
session_start();

ini_set('session.cookie_secure', '1');
ini_set('session.cookie_httponly', '1');
ini_set('session.use_strict_mode', '1');

if (!isset($_SESSION['id_usuario'])) {
    $_SESSION['error_msg'] = 'La sesión expiró, por favor ingresa nuevamente';
    header('Location: /InfernoStore_Tienda/PHP_Login/login.php');
    exit;
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/InfernoStore_Tienda/config/conexion_tienda.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['producto_id'], $_POST['action'])) {
    try {
        $producto_id = $_POST['producto_id'];
        $usuario_id = $_SESSION['id_usuario'];
        
        switch ($_POST['action']) {
            case 'increment':
                $sql = "UPDATE carrito SET cantidad = cantidad + 1 
                        WHERE usuario_id = ? AND producto_id = ?";
                $msg = "Cantidad aumentada";
                break;
                
            case 'decrement':
                $sql = "UPDATE carrito SET cantidad = GREATEST(1, cantidad - 1) 
                        WHERE usuario_id = ? AND producto_id = ?";
                $msg = "Cantidad disminuida";
                break;
                
            case 'remove':
                $sql = "DELETE FROM carrito 
                        WHERE usuario_id = ? AND producto_id = ?";
                $msg = "Producto eliminado";
                break;
                
            default:
                throw new Exception('Acción no válida');
        }
        
        $stmt = $pdo_tienda->prepare($sql);
        $stmt->execute([$usuario_id, $producto_id]);
        
        $_SESSION['carrito_msg'] = $msg;
        
    } catch (PDOException $e) {
        $_SESSION['error_msg'] = 'Error de base de datos: ' . $e->getMessage();
    } catch (Exception $e) {
        $_SESSION['error_msg'] = $e->getMessage();
    }
}

header('Location: /InfernoStore_Tienda/carrito.php');
exit;
?>