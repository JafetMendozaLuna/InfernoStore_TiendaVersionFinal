<!DOCTYPE html>
<?php session_start(); ?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acerca del Proyecto | InfernoStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/estilo.css">
    <style>
        :root {
            --inferno-red: #dc3545;
            --inferno-dark: #1a1a1a;
            --inferno-gray: #2a2a2a;
            --inferno-light: #f8f9fa;
            --inferno-accent: #ff6b6b;
        }
        body {
            background-color: var(--inferno-light);
            color: var(--inferno-dark);
        }
        .creator-card {
            border-left: 5px solid var(--inferno-red);
            transition: transform 0.3s;
        }
        .creator-card:hover {
            transform: translateY(-5px);
        }
        .color-box {
            width: 100%;
            height: 100px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.5);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
    </style>
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
        <h1 class="text-center mb-5"><i class="bi bi-diagram-3 text-danger"></i> Mapa del Sitio & Información</h1>
        
        <div class="row">
            <div class="col-md-6 mb-5">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-danger text-white">
                        <h3><i class="bi bi-qr-code-scan"></i> Accesos Rápidos</h3>
                    </div>
                    <div class="card-body text-center">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <img src="img/QRPagina.png" alt="QR InfernoStore" class="img-fluid mb-2" style="max-height: 200px;">
                                <h5>Sitio Web</h5>
                                <p>Escanea para visitarnos</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <img src="img/QRRepositorio" alt="QR Repositorio" class="img-fluid mb-2" style="max-height: 200px;">
                                <h5>Repositorio</h5>
                                <p>Repositorio de la pagina</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-5">
                <div class="card creator-card h-100">
                    <div class="card-header bg-dark text-white">
                        <h3><i class="bi bi-person-badge"></i> Creador del Proyecto</h3>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <img src="img/ImagenCreador.jpeg" alt="Creador" class="rounded-circle shadow" style="width: 150px; height: 150px; object-fit: cover;">
                        </div>
                        <h4 class="text-center">Mendoza Luna Jafet Antonio</h4>
                        <p class="text-muted text-center">Diseñador & Desarrollador Web</p>
                        <hr>
                        <p><i class="bi bi-envelope text-danger"></i> <strong>Email:</strong> sentrystudio@gmail.com</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow-sm mb-5">
            <div class="card-header bg-dark text-white">
                <h3><i class="bi bi-palette"></i> Paleta de Colores Oficial</h3>
            </div>
            <div class="card-body">
                <div class="row text-center g-4">
                    <div class="col-md-3 col-6">
                        <div class="color-box" style="background-color: #dc3545;">
                            Rojo Inferno<br>#dc3545
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="color-box" style="background-color: #1a1a1a; color: white;">
                            Negro Profundo<br>#1a1a1a
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="color-box" style="background-color: #2a2a2a; color: white;">
                            Gris Oscuro<br>#2a2a2a
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="color-box" style="background-color: #f8f9fa; color: #333;">
                            Fondo Claro<br>#f8f9fa
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow-sm">
            <div class="card-header bg-danger text-white">
                <h3><i class="bi bi-diagram-3"></i> Mapa del Sitio</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <h5><i class="bi bi-house-door text-dark"></i> Páginas Principales</h5>
                        <ul class="list-unstyled">
                            <li><a href="index.php" class="text-decoration-none">Inicio</a></li>
                            <li><a href="catalogo.php" class="text-decoration-none">Catálogo</a></li>
                            <li><a href="contacto.php" class="text-decoration-none">Contacto</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h5><i class="bi bi-person text-dark"></i> Área de Usuario</h5>
                        <ul class="list-unstyled">
                            <li><a href="index.php" class="text-decoration-none">Inicio</a></li>
                            <li><a href="catalogo.php" class="text-decoration-none">Catálogo</a></li>
                            <li><a href="contacto.php" class="text-decoration-none">Contacto</a></li>
                            <li><a href="/InfernoStore_Tienda/PHP_Login/login.php" class="text-decoration-none">Iniciar Sesión</a></li>
                            <li><a href="/InfernoStore_Tienda/PHP_Login/registro.php" class="text-decoration-none">Registro</a></li>
                            <li><a href="carrito.php" class="text-decoration-none">Carrito</a></li>
                            <li><a href="favoritos.php" class="text-decoration-none">Favoritos</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h5><i class="bi bi-gear text-dark"></i> Administración</h5>
                        <ul class="list-unstyled">
                            <li><a href="index.php" class="text-decoration-none">Inicio</a></li>
                            <li><a href="catalogo.php" class="text-decoration-none">Catálogo</a></li>
                            <li><a href="contacto.php" class="text-decoration-none">Contacto</a></li>
                            <li><a href="/InfernoStore_Tienda/CRUD/index_crud.php" class="text-decoration-none">CRUD</a></li>
                        </ul>
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