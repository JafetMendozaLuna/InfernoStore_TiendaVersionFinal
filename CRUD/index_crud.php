<?php session_start(); 
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../PHP_Login/login.php");
    exit;
}
if ($_SESSION['rol'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin - InfernoStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --dark-bg: #1a1a1a;
            --primary-red: #dc3545;
            --light-bg: #f8f9fa;
        }
        
        body {
            background-color: var(--light-bg);
        }
        
        .navbar {
            background-color: var(--dark-bg) !important;
            border-bottom: 2px solid var(--primary-red);
        }
        
        .navbar-brand, .nav-link {
            color: white !important;
        }
        
        .nav-link:hover {
            color: var(--primary-red) !important;
        }
        
        .card {
            border: 1px solid var(--dark-bg);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        
        .card-header {
            background-color: var(--dark-bg) !important;
            color: white;
            border-bottom: 2px solid var(--primary-red) !important;
        }
        
        .form-control {
            border: 1px solid #ced4da;
        }
        
        .form-control:focus {
            border-color: var(--primary-red);
            box-shadow: 0 0 0 0.25rem rgba(220,53,69,.25);
        }
        
        .btn-primary {
            background-color: var(--primary-red);
            border-color: var(--primary-red);
        }
        
        .btn-primary:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
        
        .table-dark {
            background-color: var(--dark-bg) !important;
        }
        
        .table-hover tbody tr:hover {
            background-color: rgba(220,53,69,.1);
        }
        
        @media (max-width: 992px) {
            .form-section, .table-section {
                flex: 0 0 100%;
                max-width: 100%;
            }
            
            .search-box {
                margin-bottom: 15px;
            }
        }
        
        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
            
            .table td, .table th {
                white-space: nowrap;
            }
            
            .card-body {
                padding: 15px;
            }
        }
        
        @media (max-width: 576px) {
            .navbar-nav .btn {
                margin: 5px 0;
                width: 100%;
            }
            
            .form-group {
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-sm navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center" href="/InfernoStore_Tienda/index.php">
    <img src="../img/logoInferno.png" 
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
<div class="container py-4">
    <div class="row">
        <div class="col-lg-4 col-md-6 form-section">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0"><i class="bi bi-plus-circle"></i> Gestión de Productos</h4>
                </div>
                <div class="card-body">
                    <form id="frm">
                        <input type="hidden" name="idp" id="idp">
                        
                        <div class="mb-3">
                            <label class="form-label">Producto</label>
                            <input type="text" name="producto" id="producto" class="form-control" placeholder="Nombre" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Categoría</label>
                            <input type="text" name="categoria" id="categoria" class="form-control" placeholder="Categoría">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Descripción</label>
                            <textarea name="descripcion" id="descripcion" class="form-control" rows="2" placeholder="Descripción"></textarea>
                        </div>
                        
                        <div class="row g-2 mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Precio</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" name="precio" id="precio" class="form-control" placeholder="0.00" step="0.01">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Cantidad</label>
                                <input type="number" name="cantidad" id="cantidad" class="form-control" placeholder="0">
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Imagen (URL)</label>
                            <input type="text" name="imagen" id="imagen" class="form-control" placeholder="https://...">
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="button" id="registrar" class="btn btn-primary">
                                <i class="bi bi-save"></i> Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-6 table-section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="bi bi-list-ul"></i> Productos</h4>
                    <div class="search-box">
                        <div class="input-group">
                            <input type="text" id="buscar" class="form-control" placeholder="Buscar...">
                            <button class="btn btn-outline-secondary" type="button">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tbody id="resultado">
                            </tbody>
                        </table>
                    </div>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../js/script_crud.js"></script>
</body>
</html>