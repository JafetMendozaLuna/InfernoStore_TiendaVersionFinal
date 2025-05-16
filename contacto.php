<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - InfernoStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
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
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow border-dark">
                <div class="card-header bg-dark text-white">
                    <h2 class="h4 mb-0"><i class="bi bi-envelope-fill"></i> Contáctanos</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="enviar_contacto.php" method="POST" class="contact-form">
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre completo</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                                </div>

                                <div class="mb-3">
                                    <label for="correo" class="form-label">Correo electrónico</label>
                                    <input type="email" class="form-control" id="correo" name="correo" required>
                                </div>

                                <div class="mb-3">
                                    <label for="mensaje" class="form-label">Mensaje</label>
                                    <textarea class="form-control" id="mensaje" name="mensaje" rows="5" required></textarea>
                                </div>

                                <button type="submit" class="btn btn-danger w-100">
                                    <i class="bi bi-send"></i> Enviar mensaje
                                </button>
                            </form>
                        </div>

                        <div class="col-md-6">
                            <div class="ratio ratio-16x9 mb-4">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d217306.2749568768!2d-106.3970947!3d31.6773428!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x86e76737eefc2a0b%3A0xa2ede9da2a3a2502!2sInferno%20Rock%20Store!5e0!3m2!1ses-419!2smx!4v1747020558649!5m2!1ses-419!2smx" 
                                    style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade" class="rounded"></iframe>
                            </div>
                            
                            <div class="contact-info">
                                <h4 class="text-dark mb-3"><i class="bi bi-info-circle"></i> Información de contacto</h4>
                                <ul class="list-unstyled">
                                    <li class="mb-2">
                                        <i class="bi bi-geo-alt-fill text-danger"></i> 
                                        Blvd. Independencia 1510, La Perla, 32590 Juárez, Chih.
                                    </li>
                                    <li class="mb-2">
                                        <i class="bi bi-envelope-fill text-danger"></i> 
                                        infernostore.info.page@gmail.com
                                    </li>
                                    <li class="mb-2">
                                        <i class="bi bi-telephone-fill text-danger"></i> 
                                        +52 656 175 1211
                                    </li>
                                    <li class="mb-2">
                                        <i class="bi bi-clock-fill text-danger"></i> 
                                        Lunes a Domingo: 10am - 8pm
                                    </li>
                                </ul>
                            </div>
                        </div>
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

<?php if (isset($_GET['exito']) && $_GET['exito'] == 1): ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: 'Mensaje enviado',
            text: 'Gracias por contactarnos. Te responderemos pronto.',
            icon: 'success',
            confirmButtonColor: '#dc3545',
            confirmButtonText: 'Aceptar'
        }).then(() => {
            const url = new URL(window.location);
            url.searchParams.delete('exito');
            window.history.replaceState({}, '', url);
        });
    });
</script>
<?php endif; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>