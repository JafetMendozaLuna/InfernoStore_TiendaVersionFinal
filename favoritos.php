<?php
session_set_cookie_params([
    'lifetime' => 86400,
    'path' => '/',
    'domain' => $_SERVER['HTTP_HOST'],
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Lax'
]);

session_start();
if (!isset($_SESSION['id_usuario'])) {
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
    $_SESSION['error_msg'] = 'Por favor inicia sesión para ver tus favoritos';
    header('Location: /InfernoStore_Tienda/PHP_Login/login.php');
    exit;
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/InfernoStore_Tienda/config/conexion_tienda.php';

try {
    $sql = "
        SELECT 
            p.id,
            p.producto AS nombre,
            p.descripcion,
            p.precio,
            p.imagen AS imagen_url,
            p.categoria  -- Agregué categoría como ejemplo de dato adicional útil
        FROM productos p
        INNER JOIN favoritos f ON p.id = f.producto_id
        WHERE f.usuario_id = ?
        ORDER BY p.producto ASC  -- Orden alfabético por nombre
    ";
    
    $stmt = $pdo_tienda->prepare($sql);
    $stmt->execute([$_SESSION['id_usuario']]);
    $favoritos = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    error_log('Error en favoritos.php: ' . $e->getMessage());
    $_SESSION['error_msg'] = 'Ocurrió un error al cargar tus favoritos';
    header('Location: /InfernoStore_Tienda/index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Favoritos - InfernoStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/estilo.css">
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

    <div class="container py-5">
        <div class="row mb-4">
            <div class="col">
                <h1 class="display-6 fw-bold text-dark">
                    <i class="bi bi-heart-fill text-danger"></i> Mis Favoritos
                </h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                        <li class="breadcrumb-item active">Favoritos</li>
                    </ol>
                </nav>
                
                <?php if (isset($_SESSION['favorito_msg'])): ?>
                    <div class="alert alert-success alert-dismissible fade show">
                        <i class="bi bi-check-circle"></i> <?= $_SESSION['favorito_msg'] ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <?php unset($_SESSION['favorito_msg']); ?>
                <?php endif; ?>
                
                <?php if (isset($_SESSION['error_msg'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show">
                        <i class="bi bi-exclamation-triangle"></i> <?= $_SESSION['error_msg'] ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <?php unset($_SESSION['error_msg']); ?>
                <?php endif; ?>
            </div>
        </div>

        <?php if (empty($favoritos)): ?>
            <div class="alert alert-dark text-center py-4">
                <i class="bi bi-heart fs-1 text-danger"></i>
                <h2 class="h4 mt-3 text-white">No tienes productos favoritos</h2>
                <p class="mb-0 text-white-50">Explora nuestro catálogo y agrega tus productos favoritos</p>
                <a href="catalogo.php" class="btn btn-danger mt-3">
                    <i class="bi bi-bag"></i> Ver Catálogo
                </a>
            </div>
        <?php else: ?>
            <div class="row">
                <div class="col">
                    <div class="card shadow-sm border-dark">
                        <div class="card-header bg-dark text-white">
                            <h2 class="h5 mb-0"><i class="bi bi-list-check"></i> Tus Productos Favoritos</h2>
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">
                                <?php foreach ($favoritos as $producto): ?>
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-md-2">
                                            <img src="<?= htmlspecialchars($producto['imagen_url']) ?>" 
                                                 class="product-img img-fluid rounded">
                                        </div>
                                        <div class="col-md-6">
                                            <h5 class="mb-1"><?= htmlspecialchars($producto['nombre']) ?></h5>
                                            <p class="text-muted small mb-1"><?= htmlspecialchars(mb_strimwidth($producto['descripcion'], 0, 100, '...')) ?></p>
                                            <p class="mb-0 fw-bold text-danger">$<?= number_format($producto['precio'], 2) ?></p>
                                        </div>
                                        <div class="col-md-4 text-end">
                                            <form method="post" action="PHP_Productos/agregar_favorito.php" class="d-inline">
                                                <input type="hidden" name="producto_id" value="<?= $producto['id'] ?>">
                                                <input type="hidden" name="action" value="mover_a_carrito">
                                                <button type="submit" class="btn btn-danger me-2">
                                                    <i class="bi bi-cart-plus"></i> Mover al Carrito
                                                </button>
                                            </form>
                                            <form method="post" action="PHP_Productos/agregar_favorito.php" class="d-inline">
                                                <input type="hidden" name="producto_id" value="<?= $producto['id'] ?>">
                                                <button type="submit" class="btn btn-outline-dark" 
                                                        onclick="return confirm('¿Eliminar de favoritos?')">
                                                    <i class="bi bi-trash"></i> Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>