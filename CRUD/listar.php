<?php
    $data = file_get_contents("php://input");
    require "conexion.php";
    $consulta = $pdo->prepare("SELECT * FROM productos ORDER BY id DESC");
    $consulta->execute();
    if($data != ""){
        $consulta = $pdo->prepare("SELECT * FROM productos WHERE id LIKE '%".$data."%' OR producto LIKE '%".$data."%' OR precio LIKE '%".$data."%' OR categoria LIKE '".$data."'");
        $consulta->execute();
    }
    $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
    echo "
    <table class='table'>
        <thead>
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Categoría</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
    ";
    foreach($resultado as $data){
        echo"<tr>
            <td>".$data['id']."</td>
            <td>".$data['producto']."</td>
            <td>".$data['categoria']."</td>
            <td>".$data['descripcion']."</td>
            <td>".$data['precio']."</td>
            <td>".$data['cantidad']."</td>
            <td><img src='".$data['imagen']."' alt='Imagen producto' style='width: 100px; height: 100px;'></td>
            <td>
                <button type='button' class='btn btn-success' onclick=Editar('".$data['id']."')>Editar</button>
                <button type='button' class='btn btn-danger' onclick=Eliminar('".$data['id']."')>Eliminar</button>
            </td>
        </tr>";
    }

?>