<?php
// login.php
// Este archivo muestra el formulario de login, ya sea para administrador o cliente

$tipo = isset($_GET['tipo']) ? $_GET['tipo'] : '';
// Obtiene el tipo de usuario desde la URL (puede ser 'cliente' o 'administrador')

if (!in_array($tipo, ['cliente', 'administrador'])) {
    die("Tipo de usuario no válido.");
}
// Si el tipo no es válido, detiene la ejecución con un mensaje de error

$titulo = ($tipo === 'administrador') ? 'Administrador' : 'Cliente';
// Define el título que se mostrará en la interfaz, según el tipo de usuario
?>
<!DOCTYPE html>
<html lang="es">
<!-- Documento HTML en español -->

<head>
    <meta charset="UTF-8">
    <!-- Define la codificación de caracteres -->

    <title>Login <?= ucfirst($titulo) ?></title>
    <!-- Título de la pestaña que incluye el tipo de usuario (Cliente o Administrador) -->

    <link rel="stylesheet" href="css/style.css">
    <!-- Enlace al archivo de estilos CSS -->
</head>

<body>
<!-- Cuerpo del documento -->

<header>
    <!-- Encabezado con logo y nombre del restaurante -->

    <a href="bienvenida.php" class="Encalezado-logo">
        <!-- Enlace que lleva a la página de bienvenida -->

        <img class="logo" src="/RestauranteCrudPHP/Cliente/img/Presentación1.png" alt="Logo del restaurante" />
        <!-- Logo del restaurante -->

        <h1 class="titulo">Puerto Broaster Britalia</h1>
        <!-- Título del restaurante -->
    </a>
</header>

<main class="contacto-contenedor">
    <!-- Contenedor principal del formulario -->

    <h2 class="texto-bienvenida">Inicio de sesión - <?= ucfirst($titulo) ?></h2>
    <!-- Mensaje de bienvenida al login con el tipo de usuario -->

    <form method="POST" action="procesar_login.php" class="formulario">
        <!-- Formulario que envía los datos por método POST a procesar_login.php -->

        <input type="hidden" name="tipo" value="<?= htmlspecialchars($tipo) ?>">
        <!-- Campo oculto que guarda el tipo de usuario -->

        <label>Email:</label>
        <!-- Etiqueta para el campo de email -->

        <input type="email" name="email" required>
        <!-- Campo para ingresar el correo electrónico (obligatorio) -->

        <label>Contraseña:</label>
        <!-- Etiqueta para el campo de contraseña -->

        <input type="password" name="password" required>
        <!-- Campo para ingresar la contraseña (obligatorio) -->

        <button type="submit" class="nav_enlace_boton">Ingresar</button>
        <!-- Botón para enviar el formulario -->

        <?php if ($tipo === 'cliente'): ?>
        <!-- Si el tipo de usuario es cliente, se muestra la opción de registro -->

            <p style="text-align: center; margin-top: 15px;">
                ¿No tienes cuenta?
                <a href="registrar.php" class="nav_enlace_boton">Regístrate aquí</a>
                <!-- Enlace a la página de registro -->
            </p>

        <?php endif; ?>
        <!-- Fin de la condición para mostrar enlace de registro -->
    </form>
</main>

<footer class="footer">
    <!-- Pie de página del sitio -->

    <p class="pie_pagina">Puerto Broaster Britalia - Todos los Derechos Reservados 2025</p>
    <!-- Mensaje legal -->
</footer>

</body>
</html>
