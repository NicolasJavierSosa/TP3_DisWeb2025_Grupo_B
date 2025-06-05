let expandedProducto = null;

function comprarProducto(productoId) {
    const producto = document.getElementById(productoId);
    //const cantidadInput = producto.querySelector('input[name="cantidad"]');
    const botonesComprar = document.querySelectorAll('.btnComprar');
botonesComprar.forEach((boton, index) => {
    boton.addEventListener('click', function() {
        const cantidad = parseInt(cantidadInputs[index].value);
        if (cantidad < 1 || isNaN(cantidad)) {
            alert('Por favor ingrese una cantidad válida');
            return;
        }
        modal.style.display = 'block';
    });
});
}
function mostrarDetalles(productoId) {
    const producto = document.getElementById(productoId);

    if(expandedProducto && expandedProducto !== producto) {
        expandedProducto.classList.remove('expanded');
    }
    producto.classList.toggle('expanded');
    if(producto.classList.contains('expanded')) {
        expandedProducto = producto;
    }else{
        expandedProducto = null;
    }
}


document.addEventListener('DOMContentLoaded', function() {
    const btnComprar = document.getElementById('btnComprar');
    const modal = document.getElementById('modalCompra');
    const cerrar = document.querySelector('.cerrar');
    document.getElementById('formCompra').addEventListener('submit', function(e) {
    const userEmail = document.getElementById('correo').value;
    this.action = `https://formsubmit.co/${userEmail}`;
});
    const nombre = document.getElementById('nombre');
    const telefono = document.getElementById('telefono');
    const correo = document.getElementById('correo');
    const ubicacion = document.getElementById('ubicacion');
    const cantidadInput = document.getElementById('cantidad');
    const numeroPedidoInput = document.getElementById('numero_pedido');

    function generarNumeroPedido() {
        return Math.floor(100000 + Math.random() * 900000);
    }

    // Abrir modal
    btnComprar.addEventListener('click', function() {
        const cantidad = parseInt(cantidadInput.value);
        if (cantidad < 1) {
            alert('Por favor ingrese una cantidad válida');
            return;
        }
        modal.style.display = 'block';
    });

    // Cerrar modal
    cerrar.addEventListener('click', function() {
        modal.style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });

    // Manejar el envío del formulario
    formCompra.addEventListener('submit', function(e) {
        // Validaciones
        if (!nombre.value.trim()) {
            alert('Por favor ingrese su nombre completo');
            e.preventDefault();
            return;
        }
        
        if (!correo.value.trim() || !correo.value.includes('@') || !correo.value.includes('.')) {
            alert('Por favor ingrese un correo electrónico válido');
            e.preventDefault();
            return;
        }
        
        if (!telefono.value.trim() || !telefono.value.match(/^\d+$/)) {
            alert('Por favor ingrese un número de teléfono válido');
            e.preventDefault();
            return;
        }
        
        if (!ubicacion.value.trim()) {
            alert('Por favor ingrese su ubicación');
            e.preventDefault();
            return;
        }

        // Generar y asignar número de pedido
        const numeroPedido = generarNumeroPedido();
        numeroPedidoInput.value = numeroPedido;
        
        // Guardar en localStorage
        const datosCliente = {
            numeroPedido: numeroPedido,
            nombre: nombre.value.trim(),
            telefono: telefono.value.trim(),
            correo: correo.value.trim(),
            ubicacion: ubicacion.value.trim(),
            fecha: new Date().toLocaleString()
        };
        localStorage.setItem('datosCliente', JSON.stringify(datosCliente));
        
        // Mostrar confirmación (el formulario se enviará automáticamente)
        alert(`¡Compra confirmada con éxito!\nNúmero de pedido: ${numeroPedido}\nSe enviará confirmación a: ${correo.value}`);
    });
});