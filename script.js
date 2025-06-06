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
function mostrarDetalles(productoId) {
    const producto = document.getElementById(productoId);
    let expandedProducto = window.expandedProducto || null;

    if (expandedProducto && expandedProducto !== producto) {
        expandedProducto.classList.remove('expanded');
    }
    producto.classList.toggle('expanded');
    if (producto.classList.contains('expanded')) {
        window.expandedProducto = producto;
    } else {
        window.expandedProducto = null;
    }
}

function comprarProducto(productoId) {
    const modal = document.getElementById('modalCompra');
    const formCompra = document.getElementById('formCompra');
    
    if (modal && formCompra) {
        modal.style.display = 'block';
        formCompra.dataset.producto = productoId;
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('modalCompra');
    const cerrarBtn = document.querySelector('.cerrar');
    const formCompra = document.getElementById('formCompra');

    // Cerrar modal al hacer clic en la X
    if (cerrarBtn) {
        cerrarBtn.addEventListener('click', function() {
            if (modal) modal.style.display = 'none';
        });
    }
    
    // Cerrar modal al hacer clic fuera del contenido
    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });

    if (formCompra) {
        formCompra.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const productoId = this.dataset.producto;
            const cantidadInput = document.getElementById(`cantidad-${productoId}`);
            const cantidad = cantidadInput ? cantidadInput.value : 1;
            
            const productoInput = document.createElement('input');
            productoInput.type = 'hidden';
            productoInput.name = 'producto';
            productoInput.value = productoId;
            this.appendChild(productoInput);
            
            const cantidadHiddenInput = document.createElement('input');
            cantidadHiddenInput.type = 'hidden';
            cantidadHiddenInput.name = 'cantidad';
            cantidadHiddenInput.value = cantidad;
            this.appendChild(cantidadHiddenInput);
            
            // Validaciones
            const nombre = document.getElementById('nombre');
            const telefono = document.getElementById('telefono');
            const correo = document.getElementById('correo');
            const ubicacion = document.getElementById('ubicacion');

            if (!nombre.value.trim()) {
                alert('Por favor ingrese su nombre completo');
                return false;
            }

            if (!correo.value.trim() || !correo.value.includes('@') || !correo.value.includes('.')) {
                alert('Por favor ingrese un correo electrónico válido');
                return false;
            }

            if (!telefono.value.trim() || !telefono.value.match(/^\d+$/)) {
                alert('Por favor ingrese un número de teléfono válido');
                return false;
            }

            if (!ubicacion.value.trim()) {
                alert('Por favor ingrese su ubicación');
                return false;
            }

            // Si todo está bien, enviar el formulario
            this.submit();
        });
    }


    const trackingForm = document.getElementById('tracking-form');
    if (trackingForm) {
        trackingForm.addEventListener('submit', function(e) {
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
    }
});