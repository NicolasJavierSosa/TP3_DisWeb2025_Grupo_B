<?php
session_start();

// Procesar compra
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['nombre'])) {
    if (!isset($_SESSION['numEnvios'])) {
        $_SESSION['numEnvios'] = [];
    }
    
    // Generar número aleatorio único
    do {
        $num = rand(1, 1000000);
    } while (in_array($num, $_SESSION['numEnvios']));
    
    $_SESSION['numEnvios'][] = $num;
    
    // Responder con JSON
    header('Content-Type: application/json');
    echo json_encode([
        'success' => true,
        'numero_envio' => $num,
        'producto' => $_POST['producto'] ?? 'Desconocido',
        'cantidad' => $_POST['cantidad'] ?? 1,
        'mensaje' => "Su compra fue realizada con éxito",
        'estado' => "Preparando para transporte"
    ]);
    exit;
}

// Procesar consulta de tracking
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['trackingNumber'])) {
    $trackingNumber = (int)$_GET['trackingNumber'];
    $estados = ["Preparando para transporte", "En camino", "Llegando a la sucursal", "Listo para retirar"];
    
    if (isset($_SESSION['numEnvios']) && in_array($trackingNumber, $_SESSION['numEnvios'])) {
        echo '<div class="tracking-status success">Estado: ' . $estados[array_rand($estados)] . '</div>';
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
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <title>Atlus-Tp4</title>
</head>

<body>
 
    <nav id="title-bar">
        <img src="./img/logo.png" alt="main logo" id="logo" >
    </nav> 
    <nav id="main-nav">
        <ul id="nav-list">
            <li><a href="">Envíos Internacionales</a></li>
            <li><a href="">Búsqueda Paquetes</a></li>
            <li><a href="">Nuestras Sucursales</a></li>
            <li><a href="indexN.php">Catálogo</a></li>
            <li><a href="">Calendario de Lanzamientos</a></li>
        </ul>
    </nav>
    <div class="info-banner">
        <div id="info-banner-text-container">
            <h2>Seguimiento de envíos</h2>
            <p>Escaneá el código de barras de la etiqueta y seguí tus envíos.</p>
        </div>
        <img src="./img/banner-img.jpeg" alt="Info Banner Image" id="info-banner-img">
    </div>

    <main>
        <section id="tracking-section">
            <div class="tracking-title-bar">Número de Seguimiento</div>
            <div class="tracking-form-container">
                <form id="tracking-form">
                    <input type="text" id="tracking-number" placeholder="Ingresá tu número de seguimiento" />
                    <button type="submit">Consultar</button>
                </form>
                <div id="tracking-result"></div>
            </div>
        </section>
    </main>

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