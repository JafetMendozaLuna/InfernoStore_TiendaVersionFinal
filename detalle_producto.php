<?php
session_start();
require "CRUD/conexion.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: productos.php");
    exit();
}

$id = (int)$_GET['id'];
$consulta = $pdo->prepare("SELECT * FROM productos WHERE id = ?");
$consulta->execute([$id]);
$producto = $consulta->fetch(PDO::FETCH_ASSOC);
if (!$producto) {
    header("Location: productos.php");
    exit();
}

$consulta_relacionados = $pdo->prepare("SELECT * FROM productos WHERE categoria = ? AND id != ? ORDER BY RAND() LIMIT 8");
$consulta_relacionados->execute([$producto['categoria'], $id]);
$productos_relacionados = $consulta_relacionados->fetchAll(PDO::FETCH_ASSOC);

$consulta_aleatorios = $pdo->prepare("SELECT * FROM productos WHERE id != ? ORDER BY RAND() LIMIT 8");
$consulta_aleatorios->execute([$id]);
$productos_aleatorios = $consulta_aleatorios->fetchAll(PDO::FETCH_ASSOC);

$productos_slider = array_merge($productos_relacionados, $productos_aleatorios);
$productos_slider = array_slice($productos_slider, 0, 8);

$imagen = htmlspecialchars($producto['imagen']);
$nombre_producto = htmlspecialchars($producto['producto']);
$categoria = htmlspecialchars($producto['categoria']);
$descripcion = htmlspecialchars($producto['descripcion']);
$precio = number_format($producto['precio'], 2);
$cantidad = (int)$producto['cantidad'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $nombre_producto ?> - Detalles del Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glider-js@1/glider.min.css">
    
</head>
<body>
<nav class="navbar navbar-expand-sm navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center" href="/InfernoStore_Tienda/index.php">
    <img src="img/logoInferno.png" 
         alt="InfernoStore Logo" 
         class="d-inline-block align-text-top"
         style="height: 30px; width: auto; margin-right: 10px;">
    <span class="d-none d-sm-inline">INFERNOSTORE</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link active" href="/InfernoStore_Tienda/index.php"><i class="bi bi-house-door"></i> Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/InfernoStore_Tienda/catalogo.php"><i class="bi bi-collection"></i> Catálogo</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/InfernoStore_Tienda/contacto.php"><i class="bi bi-envelope"></i> Contacto</a>
        </li>

        <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'cliente'): ?>
          <li class="nav-item">
            <a class="nav-link" href="/InfernoStore_Tienda/carrito.php"><i class="bi bi-cart3"></i> Carrito</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/InfernoStore_Tienda/favoritos.php"><i class="bi bi-heart"></i> Favoritos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="bi bi-person"></i> <?= htmlspecialchars($_SESSION['usuario']); ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-danger" href="/InfernoStore_Tienda/PHP_Login/logout.php"><i class="bi bi-box-arrow-right"></i> Cerrar sesión</a>
          </li>

        <?php elseif (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
          <li class="nav-item">
            <a class="nav-link" href="/InfernoStore_Tienda/CRUD/index_crud.php"><i class="bi bi-box-seam"></i> Administrar productos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="bi bi-person"></i> <?= htmlspecialchars($_SESSION['usuario']); ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-danger" href="/InfernoStore_Tienda/PHP_Login/logout.php"><i class="bi bi-box-arrow-right"></i> Cerrar sesión</a>
          </li>

        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link btn btn-outline-primary me-2" href="/InfernoStore_Tienda/PHP_Login/login.php"><i class="bi bi-box-arrow-in-right"></i> Iniciar sesión</a>
          </li>
          <li class="nav-item">
            <a class="nav-link btn btn-outline-success" href="/InfernoStore_Tienda/PHP_Login/registro.php"><i class="bi bi-person-plus"></i> Registrarse</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
    <div class="container my-5">
        <div class="row">
            <div class="col-md-6 mb-4">
                <img src="<?= $imagen ?>" class="img-fluid product-image rounded shadow" alt="<?= $nombre_producto ?>">
            </div>
            <div class="col-md-6">
                <div class="product-info">
                    <h1 class="mb-3"><?= $nombre_producto ?></h1>
                    <p class="text-muted mb-2">Categoría: <?= $categoria ?></p>
                    <h3 class="text-success mb-4">$<?= $precio ?></h3>
                    
                    <h4 class="mb-3">Descripción</h4>
                    <p class="mb-4"><?= nl2br($descripcion) ?></p>
                    
                    <p class="mb-4"><strong>Disponibilidad:</strong> 
                        <?= $cantidad > 0 ? '<span class="text-success">En stock ('.$cantidad.' disponibles)</span>' : '<span class="text-danger">Agotado</span>' ?>
                    </p>
                    
                    <div class="d-flex gap-2">
                        <?php if (isset($_SESSION['id_usuario'])): ?>
                            <form method="post" action="PHP_Productos/agregar_carrito.php" class="d-inline">
                                <input type="hidden" name="producto_id" value="<?= $id ?>">
                                <button type="submit" class="btn btn-primary">Agregar al carrito</button>
                            </form>
                            <form method="post" action="PHP_Productos/agregar_favorito.php" class="d-inline">
                                <input type="hidden" name="producto_id" value="<?= $id ?>">
                                <button type="submit" class="btn btn-outline-danger">❤️ Agregar a favoritos</button>
                            </form>
                        <?php else: ?>
                            <a href="/InfernoStore_Tienda/PHP_Login/login.php" class="btn btn-primary">
                                🔑 Inicia sesión para comprar
                            </a>
                        <?php endif; ?>
                        <a href="catalogo.php" class="btn btn-outline-secondary">Volver a productos</a>
                    </div>
                </div>
            </div>
        </div>

        <?php if (!empty($productos_slider)): ?>
        <div class="related-products mt-5">
            <h3 class="mb-4">Productos que te pueden interesar</h3>
            
            <div class="glider-contain">
                <div class="glider">
                    <?php foreach ($productos_slider as $prod): ?>
                    <?php
                        $prod_imagen = !empty($prod['imagen']) ? htmlspecialchars($prod['imagen']) : 'ruta/imagen_por_defecto.jpg';
                        $prod_nombre = htmlspecialchars($prod['producto']);
                        $prod_precio = number_format($prod['precio'], 2);
                        $prod_id = (int)$prod['id'];
                    ?>
                    <div class="related-product-card">
                        <div class="card h-100 shadow-sm">
                            <img src="<?= $prod_imagen ?>" class="card-img-top" alt="<?= $prod_nombre ?>" style="height: 180px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title"><?= substr($prod_nombre, 0, 30) ?><?= strlen($prod_nombre) > 30 ? '...' : '' ?></h5>
                                <p class="card-text text-success">$<?= $prod_precio ?></p>
                            </div>
                            <div class="card-footer bg-white">
                                <a href="detalle_producto.php?id=<?= $prod_id ?>" class="btn btn-sm btn-outline-primary w-100">
                                    Ver más
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <button aria-label="Previous" class="glider-prev">«</button>
                <button aria-label="Next" class="glider-next">»</button>
                <div role="tablist" class="glider-dots"></div>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/glider-js@1/glider.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Glider(document.querySelector('.glider'), {
                slidesToShow: 4,
                slidesToScroll: 1,
                draggable: true,
                arrows: {
                    prev: '.glider-prev',
                    next: '.glider-next'
                },
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 3
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 576,
                        settings: {
                            slidesToShow: 1
                        }
                    }
                ]
            });
        });
    </script>
<footer class="bg-dark text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4 mb-md-0">
              <div class="d-flex align-items-center mb-3">
                  <img src="img/logoInferno.png" alt="InfernoStore Logo" class="me-2" style="height: 40px; width: auto;">
                  <h5 class="mb-0 text-danger">INFERNOSTORE</h5>
              </div>
              <p class="mb-3">Tu tienda de artículos dark y rock de calidad.</p>
              <div class="social-links">
                  <a href="https://www.facebook.com/share/12KBeM6uSH4/" class="text-white me-3" target="_blank" rel="noopener noreferrer">
                      <i class="bi bi-facebook fs-4"></i>
                  </a>
                  <a href="https://www.instagram.com/inferno_rockstore?igsh=aWN3dm5qNHB3eTVu" class="text-white me-3" target="_blank" rel="noopener noreferrer">
                      <i class="bi bi-instagram fs-4"></i>
                  </a>
              </div>
          </div>
                      <div class="col-md-4 mb-4 mb-md-0">
                <h5><i class="bi bi-geo-alt text-danger"></i> Contacto</h5>
                <p><i class="bi bi-geo-alt me-2"></i> Blvd. Independencia 1510, Juárez, Chih.</p>
                <p><i class="bi bi-envelope me-2"></i> infernostore.info.page@gmail.com</p>
                <p><i class="bi bi-phone me-2"></i> +52 656 175 1211</p>
            </div>
            <div class="col-md-4">
                <h5><i class="bi bi-link-45deg text-danger"></i> Enlaces</h5>
                <ul class="list-unstyled">
                    <li><a href="index.php" class="text-white text-decoration-none"><i class="bi bi-house me-2"></i> Inicio</a></li>
                    <li><a href="catalogo.php" class="text-white text-decoration-none"><i class="bi bi-collection me-2"></i> Catálogo</a></li>
                    <li><a href="contacto.php" class="text-white text-decoration-none"><i class="bi bi-envelope me-2"></i> Contacto</a></li>
                    <li><a href="siteMap.php" class="text-danger text-decoration-none"><i class="bi bi-diagram-3 me-2"></i> Mapa del Sitio</a></li>
                </ul>
            </div>
        </div>
        <hr class="my-4 bg-light">
        <div class="text-center">
            <p class="mb-0">&copy; 2023 InfernoStore. Todos los derechos reservados.</p>
        </div>
    </div>
</footer>
</body>
</html>