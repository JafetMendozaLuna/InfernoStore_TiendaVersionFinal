const baseUrl = window.location.origin + '/InfernoStore_Tienda/';

function showError(message) {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: message,
        confirmButtonColor: '#dc3545'
    });
}

document.getElementById("formLogin")?.addEventListener("submit", function(e) {
    e.preventDefault();
    const datos = new FormData(this);

    fetch(window.location.origin + '/InfernoStore_Tienda/PHP_Login/funciones/validar_login.php', {
        method: 'POST',
        body: datos
    })
    .then(res => {
        if (!res.ok) throw new Error('HTTP error');
        return res.json();
    })
    .then(data => {
        if (data.status === "ok") {
            window.location.href = data.redirect || 
                                 window.location.origin + '/InfernoStore_Tienda/index.php';
        } else {
            Swal.fire('Error', data.msg || 'Error en el login', 'error');
        }
    })
    .catch(error => {
        console.error('Fetch error:', error);
        Swal.fire('Error', 'No se pudo conectar al servidor', 'error');
    });
});

document.getElementById("formRegistro")?.addEventListener("submit", function(e) {
    e.preventDefault();
    const datos = new FormData(this);

    const clave = this.querySelector('[name="clave"]').value;
    const clave2 = this.querySelector('[name="clave2"]').value;
    
    if (clave !== clave2) {
        showError('Las contraseñas no coinciden');
        return;
    }

    fetch(baseUrl + 'PHP_Login/funciones/registrar_usuario.php', {
        method: 'POST',
        body: datos
    })
    .then(res => {
        if (!res.ok) {
            throw new Error('Error en la respuesta del servidor');
        }
        return res.json();
    })
    .then(data => {
        if (data.status === "ok") {
            Swal.fire({
                icon: 'success',
                title: '¡Cuenta creada!',
                text: 'Tu cuenta ha sido registrada exitosamente',
                confirmButtonColor: '#28a745',
                willClose: () => {
                    window.location.href = baseUrl + 'index.php';
                }
            });
        } else {
            showError(data.msg || 'Error al registrar el usuario');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showError('Ocurrió un error al procesar tu solicitud');
    });
});