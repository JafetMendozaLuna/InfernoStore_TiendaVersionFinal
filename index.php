<?php 
session_start();
require_once __DIR__ . '/config/conexion_tienda.php';
require_once __DIR__ . '/PHP_Login/conexion_usuarios.php';
require_once __DIR__ . '/config/conexion_comentarios.php';

try {
    $sql_productos = "SELECT id, producto, precio, imagen FROM productos ORDER BY RAND() LIMIT 12";
    $stmt_productos = $pdo_tienda->prepare($sql_productos);
    $stmt_productos->execute();
    $productos_aleatorios = $stmt_productos->fetchAll();
    
    if (empty($productos_aleatorios)) {
        error_log("No se encontraron productos en la base de datos");
    }
} catch (PDOException $e) {
    $productos_aleatorios = [];
    error_log("Error al obtener productos: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comentario'])) {
    if (isset($_SESSION['id_usuario'])) {
        $comentario = htmlspecialchars(trim($_POST['comentario']));
        $usuario_id = $_SESSION['id_usuario'];
        
        try {
            $stmt = $pdo_usuarios->prepare("SELECT id FROM usuarios WHERE id = ?");
            $stmt->execute([$usuario_id]);
            
            if (!$stmt->fetch()) {
                throw new Exception("Usuario no válido");
            }

            $sql = "INSERT INTO comentarios (usuario_id, comentario, fecha, aprobado) VALUES (?, ?, NOW(), ?)";
            $stmt = $pdo_comentarios->prepare($sql);

            $aprobado = ($_SESSION['rol'] === 'admin') ? 1 : 0;
            
            $stmt->execute([$usuario_id, $comentario, $aprobado]);
            
            $_SESSION['comentario_msg'] = $aprobado 
                ? "¡Comentario publicado con éxito!" 
                : "¡Comentario enviado para moderación!";
                
        } catch (PDOException $e) {
            $_SESSION['error_msg'] = "Error al publicar comentario. Por favor, inténtalo más tarde.";
            error_log("Error en comentarios: " . $e->getMessage());
        } catch (Exception $e) {
            $_SESSION['error_msg'] = $e->getMessage();
        }
    } else {
        $_SESSION['error_msg'] = "Debes iniciar sesión para comentar";
    }
    
    header("Location: index.php");
    exit;
}

try {
    $sql_comentarios = "
        SELECT c.*, u.usuario 
        FROM comentarios c
        JOIN usuarios u ON c.usuario_id = u.id
        WHERE c.aprobado = 1
        ORDER BY c.fecha DESC
        LIMIT 3
    ";
    $stmt_comentarios = $pdo_comentarios->prepare($sql_comentarios);
    $stmt_comentarios->execute();
    $comentarios = $stmt_comentarios->fetchAll();
    
    if (empty($comentarios)) {
        error_log("No se encontraron comentarios aprobados");
    }
} catch (PDOException $e) {
    $comentarios = [];
    error_log("Error al obtener comentarios: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InfernoStore - Tienda Dark/Rock</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
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

<div id="infernoCarousel" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#infernoCarousel" data-bs-slide-to="0" class="active"></button>
    <button type="button" data-bs-target="#infernoCarousel" data-bs-slide-to="1"></button>
    <button type="button" data-bs-target="#infernoCarousel" data-bs-slide-to="2"></button>
  </div>
  
  <div class="carousel-inner">

    <div class="carousel-item active">
      <img src="img/slideParte2.png" 
           alt="" 
           class="d-block w-100" 
           style="height: 700px; object-fit: cover; object-position: center;">
      <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-75 rounded p-4">
        <h3><i class="bi bi-moon-stars text-danger"></i>INFERNO STORE</h3>
        <p class="fs-5">Los diseños más oscuros</p>
      </div>
    </div>

    <div class="carousel-item">
      <img src="img/slideParte1.png" 
           alt="" 
           class="d-block w-100" 
           style="height: 700px; object-fit: cover; object-position: center;">
      <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-75 rounded p-4">
        <h3><i class="bi bi-vinyl text-danger"></i> Línea Rock</h3>
        <p class="fs-5">Tributo a las leyendas del rock</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="img/slideParte3.png" 
           alt="" 
           class="d-block w-100" 
           style="height: 700px; object-fit: cover; object-position: center;">
      <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-75 rounded p-4">
        <h3><i class="bi bi-stars text-danger"></i> Nuevas Piezas</h3>
        <p class="fs-5">Descubre nuestras últimas creaciones</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#infernoCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon bg-danger rounded p-3" aria-hidden="true"></span>
    <span class="visually-hidden">Anterior</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#infernoCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon bg-danger rounded p-3" aria-hidden="true"></span>
    <span class="visually-hidden">Siguiente</span>
  </button>
</div>

<div class="container mt-5">
    <div class="text-center mb-4">
      <div class="d-inline-flex align-items-center">
          <img src="img/logoInferno.png" alt="Logo InfernoStore" style="height: 40px;">
          <h2 class="text-danger mb-0 ms-2">INFERNO STORE</h2>
      </div>
    </div>
    <div class="row align-items-center">
        <div class="col-md-6 mb-4 mb-md-0">
            <div class="px-3 py-4 shadow-sm rounded bg-light">
                <p class="lead"><i class="bi bi-stars text-danger"></i> Somos una tienda especializada en artículos dark y rock. Desde playeras hasta accesorios, todo con diseños únicos que representan tu estilo.</p>
            </div>
        </div>
        <div class="col-md-6 text-center">
            <div class="position-relative d-inline-block">
                <img src="img/fotoInfernoLocal.jpg" alt="Local InfernoStore" 
                    class="img-fluid rounded-circle shadow-lg border border-3 border-danger"
                    style="width: 350px; height: 350px; object-fit: cover; transition: all 0.3s ease;"
                    onmouseover="this.style.transform='rotate(2deg) scale(1.05)'; this.style.boxShadow='0 10px 20px rgba(220, 53, 69, 0.3)'"
                    onmouseout="this.style.transform=''; this.style.boxShadow=''">
                <div class="position-absolute bottom-0 start-50 translate-middle-x bg-danger text-white px-3 py-1 rounded-pill">
                    <i class="bi bi-geo-alt"></i> Visítanos
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container py-5">
    <h2 class="text-center mb-4"><i class="bi bi-stars text-danger"></i> Productos Destacados</h2>
    <div class="row g-4">
        <?php foreach ($productos_aleatorios as $producto): ?>
        <div class="col-md-6 col-lg-4 col-xl-2">
            <div class="card card-producto h-100">
                <img src="<?= htmlspecialchars($producto['imagen']) ?>" class="card-img-top p-3" style="height: 180px; object-fit: contain;" alt="<?= htmlspecialchars($producto['producto']) ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($producto['producto']) ?></h5>
                    <p class="card-text text-danger fw-bold">$<?= number_format($producto['precio'], 2) ?></p>
                </div>
                <div class="card-footer bg-transparent">
                    <a href="catalogo.php?producto=<?= $producto['id'] ?>" class="btn btn-outline-dark w-100"><i class="bi bi-eye"></i> Ver detalles</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="text-center mt-4">
        <a href="catalogo.php" class="btn btn-dark"><i class="bi bi-grid"></i> Ver todos los productos</a>
    </div>
</div>
<div class="container py-5">
    <h2 class="text-center mb-4"><i class="bi bi-chat-square-text text-danger"></i> Opiniones de Clientes</h2>
    
    <?php if (isset($_SESSION['comentario_msg'])): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle"></i> <?= $_SESSION['comentario_msg'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php unset($_SESSION['comentario_msg']); ?>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['error_msg'])): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="bi bi-exclamation-triangle"></i> <?= $_SESSION['error_msg'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php unset($_SESSION['error_msg']); ?>
    <?php endif; ?>
    <div class="row g-4 mb-5">
        <?php if (!empty($comentarios)): ?>
            <?php foreach ($comentarios as $comentario): ?>
            <div class="col-md-6 col-lg-4">
                <div class="card comentario-card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-person-circle fs-3 me-3 text-danger"></i>
                            <div>
                                <h5 class="mb-0"><?= htmlspecialchars($comentario['usuario']) ?></h5>
                                <small class="text-muted">
                                    <?= date('d/m/Y H:i', strtotime($comentario['fecha'])) ?>
                                </small>
                            </div>
                        </div>
                        <p class="card-text"><?= htmlspecialchars($comentario['comentario']) ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-info"><i class="bi bi-info-circle"></i> No hay comentarios aún. ¡Sé el primero en comentar!</div>
            </div>
        <?php endif; ?>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-dark">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-pencil-square text-danger"></i> Deja tu comentario</h5>
                    <form method="POST">
                        <div class="mb-3">
                            <textarea class="form-control" name="comentario" rows="3" required
                                <?= !isset($_SESSION['id_usuario']) ? 'disabled placeholder="Debes iniciar sesión para comentar"' : 'placeholder="Comparte tu experiencia con nosotros..."' ?>></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary"
                            <?= !isset($_SESSION['id_usuario']) ? 'disabled' : '' ?>>
                            <i class="bi bi-send"></i> Publicar comentario
                        </button>
                        <?php if (!isset($_SESSION['id_usuario'])): ?>
                            <p class="text-muted mt-2">Debes <a href="PHP_Login/login.php">iniciar sesión</a> para comentar.</p>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>