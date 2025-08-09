<?php
// bienvenida.php
?>

<!DOCTYPE html>
<!-- Define el tipo de documento como HTML5 -->

<html lang="es">
<!-- Indica que el contenido del sitio está en español -->

<head>
    <meta charset="UTF-8" />
    <!-- Define la codificación de caracteres como UTF-8 para soportar caracteres especiales -->

    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Permite que el diseño sea responsivo en diferentes tamaños de pantalla (como móviles) -->

    <title>Puerto Broaster Britalia Inicio</title>
    <!-- Título que aparece en la pestaña del navegador -->

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />
    <!-- Enlace a Google Fonts para usar la fuente 'Montserrat' en la página -->

    <link rel="stylesheet" href="css/style.css" />
    <!-- Enlace al archivo de estilos CSS local que da diseño a la página -->

</head>

<body class="bienvenida">
<!-- Cuerpo de la página con la clase 'bienvenida' para aplicar estilos específicos desde CSS -->

<header>
    <!-- Encabezado de la página -->

    <a href="bienvenida.php" class="Encalezado-logo" aria-label="Ir a la página de inicio">
        <!-- Enlace que redirige a esta misma página, sirve como logo del sitio -->
        
        <img class="logo" src="/RestauranteCrudPHP/Cliente/img/Presentación1.png" alt="Logo del restaurante"/>
        <!-- Imagen del logo del restaurante con ruta absoluta desde la carpeta Cliente/img -->

        <h1 class="titulo">Puerto Broaster Britalia</h1>
        <!-- Título principal del restaurante -->

    </a>
</header>

<nav class="navegacion">
    <!-- Sección de navegación con enlaces a los formularios de inicio de sesión -->

    <a class="nav_enlace_boton" href="login.php?tipo=administrador">Ingreso Administrador</a>
    <!-- Botón/enlace que lleva al formulario de login para administradores -->

    <a class="nav_enlace_boton" href="login.php?tipo=cliente">Ingreso Cliente</a>
    <!-- Botón/enlace que lleva al formulario de login para clientes -->
</nav>

<main class="contacto-contenedor">
    <!-- Contenedor principal del contenido -->

    <h2 class="texto-bienvenida">Bienvenidos al mejor Restaurante <br> de Britalia Bogotá</h2>
    <!-- Mensaje de bienvenida con salto de línea -->
</main>

<footer class="footer">
    <!-- Pie de página del sitio -->

    <p class="pie_pagina">Puerto Broaster Britalia - Todos los Derechos Reservados 2025</p>
    <!-- Mensaje legal en el pie de página -->
</footer>

</body>
</html>
<!-- Fin del documento HTML -->
