<?php
require_once "Rutas.php"; // Se incluye el archivo que contiene la clase Rutas para acceder a la URL base de la API
$rutas = new Rutas(); // Se crea una instancia de la clase Rutas

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Verifica si el formulario fue enviado por método POST
    $data = [ // Se crea un arreglo con los datos del formulario
        "Id_tipo_usuario" => 3, // Se asigna el tipo de usuario como Cliente (valor fijo 3)
        "Nombre" => $_POST["Nombre"], // Nombre del cliente
        "Apellido" => $_POST["Apellido"], // Apellido del cliente
        "Direccion" => $_POST["Direccion"], // Dirección del cliente
        "Telefono" => $_POST["Telefono"], // Teléfono del cliente
        "Cedula" => $_POST["Cedula"], // Cédula del cliente
        "Email" => $_POST["Email"], // Correo electrónico
        "Password" => $_POST["Password"] // Contraseña
    ];

    $jsonData = json_encode($data); // Se convierte el arreglo en formato JSON
    $url = $rutas->dameUrlBase() . "/Servidor/TareasAPI.php?action=usuarios"; // Se construye la URL para enviar los datos a la API

    $ch = curl_init($url); // Se inicializa cURL con la URL
    curl_setopt($ch, CURLOPT_POST, true); // Se indica que se usará el método POST
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData); // Se pasan los datos JSON al cuerpo de la solicitud
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Se espera respuesta de la API
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']); // Se indica que el contenido es JSON
    $response = curl_exec($ch); // Se ejecuta la solicitud y se obtiene la respuesta
    curl_close($ch); // Se cierra la sesión cURL

    header("Location: login.php?tipo=cliente"); // Si todo va bien, se redirige al login del cliente
    exit; // Se termina el script
}
?>

<!DOCTYPE html>
<html lang="es"> <!-- Idioma del documento: español -->
<head>
    <meta charset="UTF-8"> <!-- Codificación UTF-8 -->
    <title>Registro de Cliente</title> <!-- Título de la página -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet"> <!-- Fuente Montserrat -->
    <link rel="stylesheet" href="css/style.css"> <!-- Hoja de estilos local -->
</head>
<body>

<header> <!-- Encabezado de la página -->
    <a href="bienvenida.php" class="Encalezado-logo"> <!-- Enlace al inicio -->
        <img class="logo" src="/RestauranteCrudPHP/Cliente/img/Presentación1.png" alt="Logo del restaurante" /> <!-- Logo -->
        <h1 class="titulo">Puerto Broaster Britalia</h1> <!-- Nombre del restaurante -->
    </a>
</header>

<main class="contacto-contenedor"> <!-- Contenedor principal -->
    <h2 class="texto-bienvenida">Registro de Cliente</h2> <!-- Título de sección -->

    <form method="POST" class="formulario"> <!-- Formulario que se envía por POST al mismo archivo -->

        <label>Nombre:</label>
        <input type="text" name="Nombre" required> <!-- Campo para el nombre -->

        <label>Apellido:</label>
        <input type="text" name="Apellido" required> <!-- Campo para el apellido -->

        <label>Dirección:</label>
        <input type="text" name="Direccion" required> <!-- Campo para la dirección -->

        <label>Teléfono:</label>
        <input type="text" name="Telefono" required> <!-- Campo para el teléfono -->

        <label>Cédula:</label>
        <input type="text" name="Cedula" required> <!-- Campo para la cédula -->

        <label>Email:</label>
        <input type="email" name="Email" required> <!-- Campo para el correo -->

        <label>Contraseña:</label>
        <input type="password" name="Password" required> <!-- Campo para la contraseña -->

        <button type="submit" class="nav_enlace_boton">Registrarse</button> <!-- Botón de envío -->

        <a href="login.php?tipo=cliente" class="nav_enlace_boton">Ya tengo cuenta</a> <!-- Enlace para usuarios ya registrados -->

    </form>
</main>

<footer class="footer"> <!-- Pie de página -->
    <p class="pie_pagina">Puerto Broaster Britalia - Todos los Derechos Reservados 2025</p> <!-- Derechos reservados -->
</footer>

</body>
</html>
