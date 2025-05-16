<?php
class Database {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        $isLocalhost = ($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == '127.0.0.1');
        
        if ($isLocalhost) {
            $host = 'localhost';
            $db   = 'tienda_db';
            $user = 'root';
            $pass = '';
        } else {
            $host = 'localhost';
            $db   = 'usuario_prod_tienda';
            $user = 'usuario_prod';
            $pass = 'contraseñaSegura123!';
        }

        $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $this->pdo = new PDO($dsn, $user, $pass, $options);
        } catch (PDOException $e) {
            error_log("Error de conexión: " . $e->getMessage());
            die("Error en el sistema. Por favor intente más tarde.");
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance->pdo;
    }
}

$pdo = Database::getInstance();
?>