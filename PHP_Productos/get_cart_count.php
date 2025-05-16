<?php
session_start();
require_once __DIR__ . '/../config/conexion_tienda.php';

header('Content-Type: application/json');

if (!isset($_SESSION['id_usuario'])) {
    echo json_encode(['count' => 0]);
    exit;
}

try {
    $stmt = $pdo->prepare(
        "SELECT SUM(cantidad) as total 
        FROM carrito 
        WHERE usuario_id = ?"
    );
    $stmt->execute([$_SESSION['id_usuario']]);
    $result = $stmt->fetch();

    echo json_encode(['count' => $result['total'] ?? 0]);

} catch (PDOException $e) {
    echo json_encode(['count' => 0]);
}
?>