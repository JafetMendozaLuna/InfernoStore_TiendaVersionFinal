<?php
if(isset($_POST)){
    $producto =$_POST['producto'];
    $categoria =$_POST['categoria'];
    $descripcion =$_POST['descripcion'];
    $precio =$_POST['precio'];
    $cantidad =$_POST['cantidad'];
    $imagen =$_POST['imagen'];
    require("conexion.php");
    if(empty($_POST['idp'])){
        $query = $pdo->prepare("INSERT INTO productos(producto, categoria, descripcion, precio, cantidad, imagen) value(:pro, :cat, :descr, :pre, :can, :img)");
        $query->bindParam(":pro", $producto);
        $query->bindParam(":cat", $categoria);
        $query->bindParam(":descr", $descripcion);
        $query->bindParam(":pre", $precio);
        $query->bindParam(":can", $cantidad);
        $query->bindParam(":img", $imagen);
        $query->execute();
        $pdo = null;
        echo "ok";
    }else{
        $id = $_POST['idp'];
        $query = $pdo->prepare("UPDATE productos SET producto = :pro, categoria = :cat, descripcion = :descr, precio = :pre, cantidad = :can, imagen = :img WHERE id = :id");
        $query->bindParam(":pro", $producto);
        $query->bindParam(":cat", $categoria);
        $query->bindParam(":descr", $descripcion);
        $query->bindParam(":pre", $precio);
        $query->bindParam(":can", $cantidad);
        $query->bindParam(":img", $imagen);
        $query->bindParam(":id", $id);
        $query->execute();
        $pdo = null;
        echo "modificar";
    }
}
?>