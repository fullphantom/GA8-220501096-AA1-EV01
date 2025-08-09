<?php
// Incluye el archivo Rutas.php para acceder a la URL base de la API
require_once "Rutas.php";

// Crea una nueva instancia de la clase Rutas
$rutas = new Rutas();

// Obtiene el parámetro 'id' desde la URL con GET y lo convierte a entero
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Si el ID es válido (mayor que 0), se intenta eliminar el usuario
if ($id > 0) {
    // Construye la URL para realizar la solicitud DELETE a la API
    $url = $rutas->dameUrlBase() . "/Servidor/TareasAPI.php?action=usuarios&id=" . $id;

    // Inicializa cURL
    $ch = curl_init();

    // Establece la URL
    curl_setopt($ch, CURLOPT_URL, $url);

    // Establece el método HTTP como DELETE
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

    // Indica que se desea recibir la respuesta como string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Ejecuta la solicitud DELETE
    $result = curl_exec($ch);

    // Obtiene el código de respuesta HTTP
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    // Cierra la sesión cURL
    curl_close($ch);

    // Si el código HTTP es 200, la eliminación fue exitosa
    $resultado = ($httpCode == 200) ? "Usuario eliminado exitosamente" : "No fue posible eliminar el usuario";
} else {
    // Si el ID no es válido, se asigna un mensaje de error
    $resultado = "ID inválido";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> <!-- Codificación de caracteres -->
    <title>Eliminar Usuario</title> <!-- Título de la página -->
    
    <!-- Fuente desde Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">

    <!-- Enlace a la hoja de estilos CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- Encabezado de la página -->
<header>
    <a href="bienvenida.php" class="Encalezado-logo">
        <!-- Logo del restaurante -->
        <img class="logo" src="/RestauranteCrudPHP/Cliente/img/Presentación1.png" alt="Logo del restaurante" />
        
        <!-- Título del restaurante -->
        <h1 class="titulo">Puerto Broaster Britalia</h1>
    </a>
</header>

<!-- Contenido principal -->
<main class="contacto-contenedor">
    <h2 class="texto-bienvenida">Resultado de eliminación</h2>

    <!-- Muestra el mensaje con el resultado de la operación -->
    <p><?php echo $resultado; ?></p>

    <!-- Enlace para volver a la lista de clientes -->
    <a class="nav_enlace_boton" href="datos_clientes.php">Volver a la lista de clientes</a>
</main>

<!-- Pie de página -->
<footer class="footer">
    <p class="pie_pagina">Puerto Broaster Britalia - Todos los Derechos Reservados 2025</p>
</footer>

</body>
</html>
