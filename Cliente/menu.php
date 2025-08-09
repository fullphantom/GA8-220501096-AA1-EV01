<?php
session_start(); // Inicia la sesión para acceder a las variables de $_SESSION
if (!isset($_SESSION['usuario'])) { // Verifica si el usuario está autenticado
    header('Location: index.html'); // Si no hay sesión, redirige al archivo index.html (página pública)
    exit(); // Finaliza la ejecución del script
}

$usuario = $_SESSION['usuario']; // Guarda los datos del usuario autenticado en una variable
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> <!-- Codificación de caracteres -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Vista responsiva para móviles -->
    <title>Puerto Broaster Britalia - Menú</title> <!-- Título de la pestaña del navegador -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet"> <!-- Fuente Montserrat -->
    <link rel="stylesheet" href="css/style.css"> <!-- Hoja de estilos principal -->
</head>
<body>

    <header class="encabezado"> <!-- Encabezado del sitio -->
        <a href="bienvenida.php" class="encabezado-logo"> <!-- Logo que redirige a la página de bienvenida -->
            <img class="logo" src="img/Presentación1.png" alt="Logo del Restaurante"> <!-- Imagen del logo -->
            <h1>Puerto Broaster Britalia</h1> <!-- Nombre del restaurante -->
        </a>
    </header>

    <!-- Sección del carrito de compras -->
    <div class="carrito_compras">
        <a class="enlace_carrito" href="#" id="carrito-link"> <!-- Enlace visual del carrito -->
            <h5 class="text-carrito">Carrito</h5>
            <img src="img/cart-alt-solid-24.png" alt="Carrito" id="carrito-icono"> <!-- Icono de carrito -->
            <span id="cantidad-carrito">0</span> <!-- Cantidad de productos (aún estático) -->
        </a>
    </div>

    <!-- Menú de navegación principal -->
    <nav class="navegacion">
        <a class="nav_enlace" href="#">Nosotros</a> <!-- Enlace a sección informativa -->
        <a class="nav_enlace" href="#">Contáctanos</a> <!-- Enlace a contacto -->
        <a class="nav_enlace" href="bienvenida.php">Logout</a> <!-- Logout que redirige al inicio -->
    </nav>

    <h1 class="producto_menu">Nuestro Menú</h1> <!-- Título principal del menú -->

    <main class="contenedor_menu"> <!-- Contenedor principal de productos -->
        <div class="grid"> <!-- Diseño en cuadrícula -->

            <!-- Producto: Pollo Puerto Broaster -->
            <div class="producto">
                <a href="#">
                    <img class="producto_imagen" src="img/pollo.png" alt="Pollo Puerto Broaster">
                    <div class="producto_informacion">
                        <p class="producto_nombre">Pollo Puerto Broaster</p>
                        <p class="producto_precio">$32.000</p>
                    </div>
                </a>
            </div>

            <!-- Producto: Arroz con Pollo -->
            <div class="producto">
                <a href="#">
                    <img class="producto_imagen" src="img/arroz con pollo.png" alt="Arroz con Pollo">
                    <div class="producto_informacion">
                        <p class="producto_nombre">Arroz con Pollo</p>
                        <p class="producto_precio">$32.000</p>
                    </div>
                </a>
            </div>

            <!-- Producto: Bagre -->
            <div class="producto">
                <a href="#">
                    <img class="producto_imagen" src="img/bagre.png" alt="Bagre">
                    <div class="producto_informacion">
                        <p class="producto_nombre">Bagre</p>
                        <p class="producto_precio">$32.000</p>
                    </div>
                </a>
            </div>

            <!-- Producto: Chuleta -->
            <div class="producto">
                <a href="#">
                    <img class="producto_imagen" src="img/chuleta.png" alt="Chuleta">
                    <div class="producto_informacion">
                        <p class="producto_nombre">Chuleta</p>
                        <p class="producto_precio">$32.000</p>
                    </div>
                </a>
            </div>

            <!-- Producto: Churrasco -->
            <div class="producto">
                <a href="#">
                    <img class="producto_imagen" src="img/churrasco.png" alt="Churrasco">
                    <div class="producto_informacion">
                        <p class="producto_nombre">Churrasco</p>
                        <p class="producto_precio">$32.000</p>
                    </div>
                </a>
            </div>

            <!-- Producto: Mojarra -->
            <div class="producto">
                <a href="#">
                    <img class="producto_imagen" src="img/mojarra.png" alt="Mojarra">
                    <div class="producto_informacion">
                        <p class="producto_nombre">Mojarra</p>
                        <p class="producto_precio">$32.000</p>
                    </div>
                </a>
            </div>

            <!-- Producto: Medio Pollo -->
            <div class="producto">
                <a href="#">
                    <img class="producto_imagen" src="img/medio pollo.png" alt="1/2 Pollo">
                    <div class="producto_informacion">
                        <p class="producto_nombre">1/2 Pollo</p>
                        <p class="producto_precio">$32.000</p>
                    </div>
                </a>
            </div>

            <!-- Producto: Cuarto de Pollo -->
            <div class="producto">
                <a href="#">
                    <img class="producto_imagen" src="img/quarto de pollo.png" alt="1/4 Pollo">
                    <div class="producto_informacion">
                        <p class="producto_nombre">1/4 Pollo</p>
                        <p class="producto_precio">$32.000</p>
                    </div>
                </a>
            </div>

            <!-- Producto: Ajiaco -->
            <div class="producto">
                <a href="#">
                    <img class="producto_imagen" src="img/sopa.png" alt="Ajiaco">
                    <div class="producto_informacion">
                        <p class="producto_nombre">Ajiaco</p>
                        <p class="producto_precio">$32.000</p>
                    </div>
                </a>
            </div>

        </div>
    </main>

    <footer class="footer"> <!-- Pie de página -->
        <p class="pie_pagina">Puerto Broaster Britalia - Todos los Derechos Reservados 2025</p> <!-- Derechos reservados -->
    </footer>

</body>
</html>
