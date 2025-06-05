<?php
// Procesamiento de compra
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['nombre'])) {
    session_start();
    if (!isset($_SESSION['envios'])) {
        $_SESSION['envios'] = []; // Cambiamos a array asociativo
    }
    
    $estados = ["Preparando para transporte", "En camino", "Llegando a la sucursal", "Listo para retirar"];
    
    // Generar número único
    do {
        $num = rand(1, 1000000);
    } while (array_key_exists($num, $_SESSION['envios']));
    
    // Asignar estado aleatorio pero fijo para este envío
    $estado = $estados[array_rand($estados)];
    
    // Guardar ambos datos
    $_SESSION['envios'][$num] = $estado;
    
    $producto = $_POST['producto'] ?? 'Desconocido';
    $cantidad = $_POST['cantidad'] ?? 1;
    
    header("Location: indexN.php?pedido=$num&status=success");
    exit;
}

// Procesamiento de seguimiento
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['trackingNumber'])) {
    session_start();
    $trackingNumber = (int)$_GET['trackingNumber'];
    
    if (isset($_SESSION['envios']) && array_key_exists($trackingNumber, $_SESSION['envios'])) {
        // Obtener el estado fijo asignado a este número
        $estado = $_SESSION['envios'][$trackingNumber];
        echo '<div class="tracking-status success">Estado: ' . htmlspecialchars($estado) . '</div>';
    } else {
        echo '<div class="tracking-status error">No se encontró información para el número ingresado.</div>';
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atlus-Tp4</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>

<body>
    <nav id="title-bar">
        <img src="./img/logo.png" alt="main logo" id="logo">
    </nav>
    <nav id="main-nav" class="main-nav">
        <ul id="nav-list" class="nav-list">
            <li><a href="" >Envíos Internacionales</a></li>
            <li><a href="index.php">Búsqueda Paquetes</a></li>
            <li><a href="">Nuestras Sucursales</a></li>
            <li><a href="indexN.php">Catálogo</a></li>
            <li><a href="">Calendario de Lanzamientos</a></li>
        </ul>
    </nav>
    <div id="products-grid" class="products-grid">
        <div id="producto1" class="producto">
            <div class="producto-info" onclick="mostrarDetalles('producto1')">
                <img src="img/producto1.jpg" alt="imagen del producto 1" class="img-producto">
                <h3>Producto 1</h3>
                <span class="precio">$10.00</span>
            </div>
            <div class="descripcion">
                <p>Descripción del producto 1. Este es un producto de alta calidad que ofrece excelentes características
                    y beneficios.</p>
                <ul class="caracteristicas">
                    <li>Característica 1</li>
                    <li>Característica 2</li>
                    <li>Característica 3</li>
                </ul>
                <div class="comprar">
                    <label for="cantidad">Cantidad:</label>
                    <input type="number" id="cantidad-producto2" name="cantidad" min="1" max="10" value="1">
                    <button class="btn" onclick="comprarProducto('producto1')">Comprar</button>

                </div>
            </div>
        </div>
        <div id="producto2" class="producto">
            <div class="producto-info" onclick="mostrarDetalles('producto2')">
                <img src="img/producto2.jpg" alt="imagen del producto 2" class="img-producto">
                <h3>Producto 2</h3>
                <span class="precio">$10.00</span>
            </div>
            <div class="descripcion">
                <p>Descripción del producto 2. Este es un producto de alta calidad que ofrece excelentes características
                    y beneficios.</p>
                <ul class="caracteristicas">
                    <li>Característica 1</li>
                    <li>Característica 2</li>
                    <li>Característica 3</li>
                </ul>
                <div class="comprar">
                    <label for="cantidad">Cantidad:</label>
                    <input type="number" id="cantidad-producto2" name="cantidad" min="1" max="10" value="1">
                    <button class="btn" onclick="comprarProducto('producto2')">Comprar</button>

                </div>
            </div>
        </div>
        <div id="producto3" class="producto">
            <div class="producto-info" onclick="mostrarDetalles('producto3')">
                <img src="img/producto3.jpg" alt="imagen del producto 3" class="img-producto">
                <h3>Producto 3</h3>
                <span class="precio">$1500.00</span>
            </div>
            <div class="descripcion">
                <p>Descripción del producto 3. Este es un producto de alta calidad que ofrece excelentes características
                    y beneficios.</p>
                <ul class="caracteristicas">
                    <li>Característica 1</li>
                    <li>Característica 2</li>
                    <li>Característica 3</li>
                </ul>
                <div class="comprar">
                    <label for="cantidad">Cantidad:</label>
                    <input type="number" id="cantidad-producto3" name="cantidad" min="1" max="10" value="1">
                    <button class="btn" onclick="comprarProducto('producto3')">Comprar</button>

                </div>
            </div>
        </div>
        <div id="producto4" class="producto">
            <div class="producto-info" onclick="mostrarDetalles('producto4')">
                <img src="img/producto4.jpg" alt="imagen del producto 4" class="img-producto">
                <h3>Producto 3</h3>
                <span class="precio">$1500.00</span>
            </div>
            <div class="descripcion">
                <p>Descripción del producto 4. Este es un producto de alta calidad que ofrece excelentes características
                    y beneficios.</p>
                <ul class="caracteristicas">
                    <li>Característica 1</li>
                    <li>Característica 2</li>
                    <li>Característica 3</li>
                </ul>
                <div class="comprar">
                    <label for="cantidad">Cantidad:</label>
                    <input type="number" id="cantidad-producto4" name="cantidad" min="1" max="10" value="1">
                    <button class="btn" onclick="comprarProducto('producto4')">Comprar</button>

                </div>
            </div>
        </div>
        <div id="producto5" class="producto">
            <div class="producto-info" onclick="mostrarDetalles('producto5')">
                <img src="img/producto5.jpg" alt="imagen del producto 5" class="img-producto">
                <h3>Producto 5</h3>
                <span class="precio">$1500.00</span>
            </div>
            <div class="descripcion">
                <p>Descripción del producto 5. Este es un producto de alta calidad que ofrece excelentes características
                    y beneficios.</p>
                <ul class="caracteristicas">
                    <li>Característica 1</li>
                    <li>Característica 2</li>
                    <li>Característica 3</li>
                </ul>
                <div class="comprar">
                    <label for="cantidad">Cantidad:</label>
                    <input type="number" id="cantidad-producto5" name="cantidad" min="1" max="10" value="1">
                    <button class="btn" onclick="comprarProducto('producto5')">Comprar</button>
                </div>
            </div>
        </div>
        <div id="producto6" class="producto">
            <div class="producto-info" onclick="mostrarDetalles('producto6')">
                <img src="img/producto6.jpg" alt="imagen del producto 6" class="img-producto">
                <h3>Producto 6</h3>
                <span class="precio">$1500.00</span>
            </div>
            <div class="descripcion">
                <p>Descripción del producto 6. Este es un producto de alta calidad que ofrece excelentes características
                    y beneficios.</p>
                <ul class="caracteristicas">
                    <li>Característica 1</li>
                    <li>Característica 2</li>
                    <li>Característica 3</li>
                </ul>
                <div class="comprar">
                    <label for="cantidad">Cantidad:</label>
                    <input type="number" id="cantidad-producto6" name="cantidad" min="1" max="10" value="1">
                    <button class="btn" onclick="comprarProducto('producto6')">Comprar</button>

                </div>
            </div>
        </div>
        <div id="producto7" class="producto">
            <div class="producto-info" onclick="mostrarDetalles('producto7')">
                <img src="img/producto7.jpg" alt="imagen del producto 7" class="img-producto">
                <h3>Producto 7</h3>
                <span class="precio">$1500.00</span>
            </div>
            <div class="descripcion">
                <p>Descripción del producto 7. Este es un producto de alta calidad que ofrece excelentes características
                    y beneficios.</p>
                <ul class="caracteristicas">
                    <li>Característica 1</li>
                    <li>Característica 2</li>
                    <li>Característica 3</li>
                </ul>
                <div class="comprar">
                    <label for="cantidad">Cantidad:</label>
                    <input type="number" id="cantidad-producto7" name="cantidad" min="1" max="10" value="1">
                    <button class="btn" onclick="comprarProducto('producto7')">Comprar</button>

                </div>
            </div>
        </div>
        <div id="producto8" class="producto">
            <div class="producto-info" onclick="mostrarDetalles('producto8')">
                <img src="img/producto8.jpg" alt="imagen del producto 8" class="img-producto">
                <h3>Producto 8</h3>
                <span class="precio">$1500.00</span>
            </div>
            <div class="descripcion">
                <p>Descripción del producto 8. Este es un producto de alta calidad que ofrece excelentes características
                    y beneficios.</p>
                <ul class="caracteristicas">
                    <li>Característica 1</li>
                    <li>Característica 2</li>
                    <li>Característica 3</li>
                </ul>
                <div class="comprar">
                    <label for="cantidad">Cantidad:</label>
                    <input type="number" id="cantidad-producto8" name="cantidad" min="1" max="10" value="1">
                    <button class="btn" onclick="comprarProducto('producto8')">Comprar</button>
                </div>
            </div>
        </div>
        <div id="producto9" class="producto">
            <div class="producto-info" onclick="mostrarDetalles('producto9')">
                <img src="img/producto9.jpg" alt="imagen del producto 9" class="img-producto">
                <h3>Producto 9</h3>
                <span class="precio">$1500.00</span>
            </div>
            <div class="descripcion">
                <p>Descripción del producto 9. Este es un producto de alta calidad que ofrece excelentes características
                    y beneficios.</p>
                <ul class="caracteristicas">
                    <li>Característica 1</li>
                    <li>Característica 2</li>
                    <li>Característica 3</li>
                </ul>
                <div class="comprar">
                    <label for="cantidad">Cantidad:</label>
                    <input type="number" id="cantidad-producto9" name="cantidad" min="1" max="10" value="1">
                    <button class="btn" onclick="comprarProducto('producto9')">Comprar</button>
                </div>
            </div>
        </div>
        <div id="producto10" class="producto">
            <div class="producto-info" onclick="mostrarDetalles('producto10')">
                <img src="img/producto10.jpg" alt="imagen del producto 10" class="img-producto">
                <h3>Producto 10</h3>
                <span class="precio">$1500.00</span>
            </div>
            <div class="descripcion">
                <p>Descripción del producto 10. Este es un producto de alta calidad que ofrece excelentes características
                    y beneficios.</p>
                <ul class="caracteristicas">
                    <li>Característica 1</li>
                    <li>Característica 2</li>
                    <li>Característica 3</li>
                </ul>
                <div class="comprar">
                    <label for="cantidad">Cantidad:</label>
                    <input type="number" id="cantidad-producto10" name="cantidad" min="1" max="10" value="1">
                    <button class="btn" onclick="comprarProducto('producto10')">Comprar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal (ventana emergente) -->
    <div id="modalCompra" class="modal">
        <div class="modal-contenido">
            <span class="cerrar">&times;</span>
            <h2>Complete datos de envio</h2>
            <!--  method="POST" al formulario -->
            <form action="" method="POST" id="formCompra">
                <!-- Campos ocultos para FormSubmit -->
                <div class="formulario">
                    <input type="hidden" name="numero_pedido" id="numero_pedido">
                    <input type="hidden" name="_template" value="table">
                    <input type="hidden" name="_subject" value="Pedido Confirmado - Atlus.com">
                    <input type="hidden" name="_next" value="https://localhost/TP4_DisWeb2025_Grupo_B">
                    <input type="hidden" name="numero_pedido" id="numero_pedido">

                    <label for="nombre">Nombre completo:</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Ingrese su nombre completo" required>

                    <label for="correo">Correo electrónico:</label>
                    <input type="email" id="correo" name="correo" placeholder="Ingrese su correo electrónico" required>

                    <label for="telefono">Teléfono:</label>
                    <input type="tel" id="telefono" name="telefono" placeholder="Ingrese su número de teléfono"
                        required>

                    <label for="ubicacion">Ubicación:</label>
                    <input type="text" id="ubicacion" name="ubicacion" placeholder="Ingrese su ubicación" required>

                    <button type="submit" id="confirmarCompra">Realizar compra</button>
                </div>
            </form>
        </div>
    </div>
    <footer>
        <table>
            <tbody>
                <tr>
                    <td>
                        <p>SERVICIOS</p>
                        <p>_______</p>
                        <ul>
                            <li><a href="">Postales</a></li>
                            <li><a href="">Paquetería</a></li>
                            <li><a href="">Logística</a></li>
                            <li><a href="">Trámites</a></li>
                        </ul>
                    </td>
                    <td>
                        <p>HERRAMIENTAS RÁPIDAS</p>
                        <p>_______</p>
                        <ul>
                            <li><a href="">Seguimiento de envío</a></li>
                            <li><a href="">Sucursales</a></li>
                            <li><a href="">E-Shop</a></li>
                            <li><a href="">Noticias</a></li>
                            <li><a href="">Preguntas Frecuentes</a></li>
                        </ul>
                    </td>
                    <td>
                        <p>NUEVOS SERVICIOS</p>
                        <p>_______</p>
                        <ul>
                            <li><a href="">MiAtlus</a></li>
                            <li><a href="">Portal de envíos internacionales</a></li>
                            <li><a href="">Envíos digitales - SIE</a></li>
                        </ul>
                    </td>
                    <td>
                        <p>CONTACTO</p>
                        <p>_______</p>
                        <ul>
                            <li><a href="">Atención al cliente</a></li>
                            <li><a href="">Transparencia activa</a></li>
                            <li><a href="">Recursos Humanos</a></li>
                            <li><a href="">Proveedores</a></li>
                            <li><a href="">Piezas en rezago</a></li>
                            <li><a href="">Términos y condiciones</a></li>
                            <li><a href="">Declaración General de Privacidad</a></li>
                        </ul>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="footer-extra">
            <p>&copy; 2025 Track&Trace. Todos los derechos reservados.</p>
            <p>Contacto: <a href="mailto:info@tracktrace.com">info@tracktrace.com</a> | Tel: +54 11 1234-5678</p>
            <p>Dirección: Av. Siempre Viva 123, Buenos Aires, Argentina</p>
        </div>
    </footer>
</body>

</html>