<?php
require "CRUD/conexion.php";

$consulta = $pdo->prepare("SELECT * FROM productos ORDER BY id DESC");
$consulta->execute();
$productos = $consulta->fetchAll(PDO::FETCH_ASSOC);
?>

<?php foreach ($productos as $producto): ?>
    <?php
        $imagen = !empty($producto['imagen']) ? htmlspecialchars($producto['imagen']) : 'img/default-product.jpg';
        $nombre_producto = htmlspecialchars($producto['producto']);
        $categoria = htmlspecialchars($producto['categoria']);
        $precio = isset($producto['precio']) ? number_format($producto['precio'], 2) : '0.00';
        $id = (int) $producto['id'];
    ?>
    <link rel="stylesheet" href="css/productosCSS.css">
    <div class="col-md-4 col-lg-3 mb-4">
        <div class="card h-100 product-card">
            <div class="badge-category"><?= $categoria ?></div>
            <img src="<?= $imagen ?>" class="card-img-top product-img" alt="<?= $nombre_producto ?>">
            <div class="card-body">
                <h5 class="card-title product-title"><?= $nombre_producto ?></h5>
                <p class="card-text product-price">$<?= $precio ?></p>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="detalle_producto.php?id=<?= $id ?>" class="btn btn-sm btn-view">
                        <i class="bi bi-eye"></i> Detalles
                    </a>
                    <div class="product-actions">
                        <?php if (isset($_SESSION['id_usuario'])): ?>
                            <form method="post" action="PHP_Productos/agregar_carrito.php" class="d-inline">
                                <input type="hidden" name="producto_id" value="<?= $id ?>">
                                <button type="submit" class="btn btn-sm btn-cart" title="Añadir al carrito">
                                    <i class="bi bi-cart-plus"></i>
                                </button>
                            </form>
                            <form method="post" action="PHP_Productos/agregar_favorito.php" class="d-inline">
                                <input type="hidden" name="producto_id" value="<?= $id ?>">
                                <button type="submit" class="btn btn-sm btn-fav" title="Añadir a favoritos">
                                    <i class="bi bi-heart"></i>
                                </button>
                            </form>
                        <?php else: ?>
                            <a href="/InfernoStore_Tienda/PHP_Login/login.php" class="btn btn-sm btn-login" title="Iniciar sesión">
                                <i class="bi bi-box-arrow-in-right"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<script src="js/carrito.js"></script>
<script src="js/favoritos.js"></script>