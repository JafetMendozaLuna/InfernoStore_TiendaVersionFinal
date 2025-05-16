<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - InfernoStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="login-container">
                <div class="brand-logo">
                    <i class="bi bi-emoji-dizzy"></i>
                    <h2>InfernoStore</h2>
                    <p class="text-muted">Crear nueva cuenta</p>
                </div>
                
                <form id="formRegistro">
                    <div class="mb-4">
                        <label for="usuario" class="form-label">
                            <i class="bi bi-person-fill"></i> Usuario
                        </label>
                        <input type="text" name="usuario" class="form-control" id="usuario" required>
                    </div>
                    
                    <div class="mb-4">
                        <label for="clave" class="form-label">
                            <i class="bi bi-lock-fill"></i> Contraseña
                        </label>
                        <input type="password" name="clave" class="form-control" id="clave" required>
                    </div>
                    
                    <div class="mb-4">
                        <label for="clave2" class="form-label">
                            <i class="bi bi-lock-fill"></i> Repetir Contraseña
                        </label>
                        <input type="password" name="clave2" class="form-control" id="clave2" required>
                    </div>
                    
                    <button type="submit" class="btn btn-login">
                        <i class="bi bi-person-plus"></i> Registrarse
                    </button>
                    
                    <div class="register-link">
                        ¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../js/auth.js"></script>
</body>
</html>