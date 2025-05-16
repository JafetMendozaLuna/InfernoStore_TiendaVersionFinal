<?php
session_start();

if (!isset($_SESSION['id_usuario'])) {
    $_SESSION['error_msg'] = "Debes iniciar sesión para comentar";
    header("Location: login.php");
    exit;
}

require_once __DIR__ . '/config/conexion_tienda.php';
require_once __DIR__ . '/config/conexion_usuarios.php';
require_once __DIR__ . '/config/conexion_comentarios.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comentario'])) {
    try {
        $comentario = trim($_POST['comentario']);
        if (empty($comentario)) {
            throw new Exception("El comentario no puede estar vacío");
        }

        $stmt = $pdo_usuarios->prepare("SELECT id, usuario FROM usuarios WHERE id = ?");
        $stmt->execute([$_SESSION['id_usuario']]);
        $usuario = $stmt->fetch();

        if (!$usuario) {
            throw new Exception("Usuario no válido");
        }

        $sql = "INSERT INTO comentarios_db.comentarios 
                (usuario_id, comentario, fecha, aprobado) 
                VALUES (?, ?, NOW(), ?)";
        
        $aprobado = ($_SESSION['rol'] === 'admin') ? 1 : 0;
        
        $stmt = $pdo_comentarios->prepare($sql);
        $stmt->execute([
            $_SESSION['id_usuario'],
            htmlspecialchars($comentario),
            $aprobado
        ]);

        $_SESSION['comentario_msg'] = $aprobado 
            ? "¡Comentario publicado!" 
            : "¡Comentario enviado para moderación!";
            
    } catch (PDOException $e) {
        error_log("Error al procesar comentario: " . $e->getMessage());
        $_SESSION['error_msg'] = "Error al guardar el comentario. Por favor, inténtalo más tarde.";
    } catch (Exception $e) {
        $_SESSION['error_msg'] = $e->getMessage();
    }
}

header("Location: " . ($_SERVER['HTTP_REFERER'] ?? 'index.php'));
exit;
?>