ListarProductos();
function ListarProductos(busqueda){
    fetch("listar.php",{
        method: "POST",
        body: busqueda
    }).then(response => response.text()).then(response => {
        resultado.innerHTML = response;
    })
}

registrar.addEventListener("click", () => {
    fetch("registrar.php", {
        method: "POST",
        body: new FormData(frm)
    })
    .then(response => response.text())
    .then(response => {
        if (response == "ok") {
            Swal.fire({
                icon: "success",
                title: "Registrado",
                showConfirmButton: false,
                timer: 1500
            });
        } else {
            Swal.fire({
                icon: "success",
                title: "Modificado",
                showConfirmButton: false,
                timer: 1500
            });
        }
        registrar.value = "Registrar";
        idp.value = "";
        frm.reset();
        ListarProductos();
    });
});
function Eliminar(id){
    Swal.fire({
        title: "Estas seguro de eliminar?",
        text: "No podras revertir este proceso!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "SI!",
        cancelButtonText: 'NO'
      }).then((result) => {
        if (result.isConfirmed) {
            fetch("eliminar.php", {
                method: "POST",
                body: id
            }).then(response => response.text()).then(response => {
                if(response == "ok"){
                    ListarProductos();
                    Swal.fire({
                        icon: "success",
                        title: "Eliminado",
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            })
        }
    });
}
function Editar(id) {
    fetch("editar.php", {
        method: "POST",
        body: id
    }).then(response => response.json()).then(response => {
        idp.value = response.id;
        producto.value = response.producto;
        categoria.value = response.categoria;
        descripcion.value = response.descripcion;
        precio.value = response.precio;
        cantidad.value = response.cantidad;
        imagen.value = response.imagen;
        registrar.value = "Actualizar";
    })
}
buscar.addEventListener("keyup", () => {
    const valor = buscar.value;
    if(valor == ""){
        ListarProductos();
    }else{
        ListarProductos(valor);
    }
});