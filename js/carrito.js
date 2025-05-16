document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.btn-agregar-carrito').forEach(button => {
    button.addEventListener('click', function() {
      const productoId = this.getAttribute('data-producto-id');
      agregarAlCarrito(productoId);
    });
  });

  async function agregarAlCarrito(productoId) {
    try {
      const response = await fetch('PHP_Productos/agregar_carrito.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `producto_id=${productoId}`
      });

      if (response.ok) {
        Swal.fire('¡Éxito!', 'Producto agregado al carrito', 'success');
        actualizarContadorCarrito();
      } else {
        Swal.fire('Error', 'No se pudo agregar al carrito', 'error');
      }
    } catch (error) {
      console.error('Error:', error);
      Swal.fire('Error', 'Error de conexión', 'error');
    }
  }

  async function actualizarContadorCarrito() {
    const response = await fetch('PHP_Productos/get_cart_count.php');
    const data = await response.json();
    
    const counter = document.getElementById('cart-counter');
    if (counter) {
      counter.textContent = data.count || '0';
      counter.style.display = data.count > 0 ? 'block' : 'none';
    }
  }
});