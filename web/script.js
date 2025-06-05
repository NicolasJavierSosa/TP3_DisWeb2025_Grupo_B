let expandedProducto = null;
function comprarProducto(productoId) {
    const producto = document.getElementById(productoId);
    const cantidadInput = producto.querySelector('input[name="cantidad"]');
    const cantidad = cantidadInput.value;
    alert(`Compraste ${cantidad} unidades de ${producto.querySelector('h3').innerText}`);
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
