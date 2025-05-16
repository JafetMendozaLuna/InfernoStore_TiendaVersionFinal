<?php
    $servidor = "mysql:dbname=u206475965_tienda_db; host=localhost";
    $user = "u206475965_tiendainferno";
    $pass = "Renzho02";
    try{
        $pdo = new PDO($servidor, $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    } catch(PDOException $e){
        echo"conexion fallida".$e->getMessage();
    }
?>