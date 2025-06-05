document.addEventListener('DOMContentLoaded', function(){
    const form = document.getElementById('');
    if(!form) return;

    form.addEventListener('submit', function(e){
        e.preventDefault();
        fetch("index.php", {
            method: "POST",
        })
        .then(res => res.text())
        .then(respuesta => {
            alert(respuesta);
        });
    });

});

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('tracking-form');
    if (!form) return;
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const trackingNumber = document.getElementById('tracking-number').value.trim();
        
        fetch("indexN.php?trackingNumber=" + encodeURIComponent(trackingNumber), {
            method: "GET"
        })
        .then(res => res.text())
        .then(respuesta => {
            document.getElementById('tracking-result').innerHTML = respuesta;
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('tracking-result').innerHTML = 
                '<div class="tracking-status error">Error al consultar el estado</div>';
        });
    });
});

//Script catalogo

let expandedProducto = null;
function comprarProducto(productoId) {
    // Mostrar el modal de compra
    document.getElementById('modalCompra').style.display = 'block';
    
    // Guardar el ID del producto para usarlo después
    document.getElementById('formCompra').dataset.producto = productoId;
}

// Manejar el envío del formulario// En la función que maneja el envío del formulario de compra
document.getElementById('formCompra').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const productoId = this.dataset.producto;
    const cantidad = document.getElementById(`cantidad-${productoId}`).value;
    
    formData.append('producto', productoId);
    formData.append('cantidad', cantidad);
    
    // Enviar formulario tradicionalmente (sin AJAX)
    this.submit();
});

// Cerrar modal al hacer clic en la X
document.querySelector('.cerrar').addEventListener('click', function() {
    document.getElementById('modalCompra').style.display = 'none';
});

// Cerrar modal al hacer clic fuera del contenido
window.addEventListener('click', function(event) {
    if (event.target === document.getElementById('modalCompra')) {
        document.getElementById('modalCompra').style.display = 'none';
    }
});



function mostrarDetalles(productoId) {
    const producto = document.getElementById(productoId);

    if (expandedProducto && expandedProducto !== producto) {
        expandedProducto.classList.remove('expanded');
    }
    producto.classList.toggle('expanded');
    if (producto.classList.contains('expanded')) {
        expandedProducto = producto;
    } else {
        expandedProducto = null;
    }
}

window.addEventListener('click', function (event) {
    const modal = document.getElementById('modalCompra');
    const contenido = modal.querySelector('.modal-contenido');

    if (event.target === modal) {
        modal.style.display = 'none';
    }
});


document.addEventListener('DOMContentLoaded', function () {
    const btnComprar = document.getElementById('btnComprar');
    const modal = document.getElementById('modalCompra');
    document.querySelector('.cerrar').addEventListener('click', function () {
        document.getElementById('modalCompra').style.display = 'none';
    });
    const nombre = document.getElementById('nombre');
    const telefono = document.getElementById('telefono');
    const correo = document.getElementById('correo');
    const ubicacion = document.getElementById('ubicacion');
    const cantidadInput = document.getElementById('cantidad');
    const numeroPedidoInput = document.getElementById('numero_pedido');

    // Abrir modal
    btnComprar.addEventListener('click', function () {
        const cantidad = parseInt(cantidadInput.value);
        if (cantidad < 1) {
            alert('Por favor ingrese una cantidad válida');
            return;
        }
        modal.style.display = 'block';
    });

    // Cerrar modal
    cerrar.addEventListener('click', function () {
        modal.style.display = 'none';
    });

    window.addEventListener('click', function (event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });

    // Manejar el envío del formulario
    formCompra.addEventListener('submit', function (e) {
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

    });
});
document.addEventListener('DOMContentLoaded', () => {
    const currentPath = window.location.pathname.split('/').pop();

    document.querySelectorAll('#nav-list a').forEach(link => {
        const linkPath = link.getAttribute('href').split('/').pop();
        if (linkPath === currentPath) {
            link.classList.add('active');
        }
    });
});