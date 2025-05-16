<?php
session_start();

function requireLogin() {
    if (!isset($_SESSION["usuario"])) {
        header("Location: login.php");
        exit;
    }
}

function requireRole($roles = []) {
    if (!in_array($_SESSION["rol"], $roles)) {
        echo "Acceso denegado.";
        exit;
    }
}
?>
