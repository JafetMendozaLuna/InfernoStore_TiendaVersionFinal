document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.btn-favorito').forEach(button => {
    button.addEventListener('click', function() {
      const productoId = this.getAttribute('data-producto-id');
      toggleFavorito(productoId, this);
    });
  });

  async function toggleFavorito(productoId, boton) {
    try {
      const response = await fetch('PHP_Productos/agregar_favoritos.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `producto_id=${productoId}`
      });

      if (response.ok) {
        const data = await response.json();
        boton.querySelector('i').className = data.action === 'added' 
          ? 'bi bi-heart-fill' 
          : 'bi bi-heart';
        
        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: data.action === 'added' ? 'Añadido a favoritos' : 'Eliminado de favoritos',
          showConfirmButton: false,
          timer: 1000
        });
      }
    } catch (error) {
      console.error('Error:', error);
    }
  }
});