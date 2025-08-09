<?php
// Incluye el archivo Rutas.php para acceder a la URL base de la API
require_once "Rutas.php";

// Crea una nueva instancia de la clase Rutas
$rutas = new Rutas();

// Obtiene el parámetro 'id' desde la URL mediante GET, o asigna 0 si no existe
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Inicializa las variables para el usuario y el resultado del proceso
$usuario = null;
$resultado = "";

// Si se ha recibido un ID válido
if ($id > 0) {
    // Construye la URL para obtener los datos del usuario desde la API
    $url = $rutas->dameUrlBase() . "/Servidor/TareasAPI.php?action=usuarios&id=" . $id;

    // Inicializa cURL con la URL creada
    $ch = curl_init($url);

    // Configura cURL para que devuelva el resultado en lugar de imprimirlo
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Ejecuta la solicitud cURL y guarda la respuesta
    $response = curl_exec($ch);

    // Cierra la sesión cURL
    curl_close($ch);

    // Decodifica el JSON recibido en un array/objeto
    $usuarios = json_decode($response);

    // Toma el primer usuario del array o null si no hay resultados
    $usuario = $usuarios[0] ?? null;
}

// Verifica si se ha enviado el formulario por POST y si se encontró el usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $usuario) {
    // Crea un array con los datos recibidos desde el formulario
    $data = [
        "Id_tipo_usuario" => $_POST['Id_tipo_usuario'],
        "Nombre"          => $_POST['Nombre'],
        "Apellido"        => $_POST['Apellido'],
        "Direccion"       => $_POST['Direccion'],
        "Telefono"        => $_POST['Telefono'],
        "Cedula"          => $_POST['Cedula'],
        "Email"           => $_POST['Email'],
        "Password"        => $_POST['Password']
    ];

    // Codifica los datos en formato JSON para enviarlos a la API
    $json = json_encode($data);

    // URL para actualizar el usuario en la API
    $url = $rutas->dameUrlBase() . "/Servidor/TareasAPI.php?action=usuarios&id=" . $id;

    // Inicializa cURL para enviar los datos actualizados
    $ch = curl_init($url);

    // Indica que se usará el método PUT
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");

    // Asigna los datos JSON al cuerpo de la solicitud
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);

    // Configura cURL para devolver la respuesta
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Indica que el contenido enviado es JSON
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

    // Ejecuta la solicitud PUT
    $result = curl_exec($ch);

    // Obtiene el código de respuesta HTTP
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    // Cierra la sesión cURL
    curl_close($ch);

    // Si la actualización fue exitosa (código 200)
    if ($httpCode === 200) {
        // Redirige a la lista de clientes
        header("Location: datos_clientes.php");
        exit;
    } else {
        // Si hubo un error, muestra mensaje
        $resultado = "Error al actualizar los datos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> <!-- Codificación de caracteres -->
    <title>Editar Usuario</title> <!-- Título de la pestaña -->
    <link rel="stylesheet" href="css/style.css"> <!-- Enlace a hoja de estilos -->
</head>
<body>

<!-- Encabezado de la página -->
<header>
    <!-- Enlace al inicio con logo y nombre del restaurante -->
    <a href="bienvenida.php" class="Encalezado-logo">
        <img class="logo" src="/RestauranteCrudPHP/Cliente/img/Presentación1.png" alt="Logo del restaurante" />
        <h1 class="titulo">Puerto Broaster Britalia</h1>
    </a>
</header>

<!-- Contenedor principal del formulario -->
<main class="contacto-contenedor">
    <h2 class="texto-bienvenida">Editar Cliente</h2>

    <!-- Si se encontró el usuario, se muestra el formulario -->
    <?php if ($usuario): ?>
        <form method="post" class="formulario">
            <!-- Campo para seleccionar el tipo de usuario -->
            <label>ID Tipo Usuario:</label>
            <select name="Id_tipo_usuario" required>
                <option value="">Seleccione una opción</option>
                <option value="1">Administrador</option>
                <option value="2">Empleado</option>
                <option value="3">Cliente</option>
            </select>

            <!-- Campos con los datos del usuario ya cargados -->
            <label>Nombre:</label>
            <input type="text" name="Nombre" value="<?= $usuario->Nombre ?>" required>

            <label>Apellido:</label>
            <input type="text" name="Apellido" value="<?= $usuario->Apellido ?>" required>

            <label>Dirección:</label>
            <input type="text" name="Direccion" value="<?= $usuario->Direccion ?>" required>

            <label>Teléfono:</label>
            <input type="text" name="Telefono" value="<?= $usuario->Telefono ?>" required>

            <label>Cédula:</label>
            <input type="text" name="Cedula" value="<?= $usuario->Cedula ?>" required>

            <label>Email:</label>
            <input type="email" name="Email" value="<?= $usuario->Email ?>" required>

            <label>Contraseña:</label>
            <input type="password" name="Password" value="<?= $usuario->Password ?>" required>

            <br>

            <!-- Botón para enviar el formulario -->
            <input type="submit" class="nav_enlace_boton" value="Actualizar">

            <!-- Enlace para cancelar y volver a la lista de clientes -->
            <a href="datos_clientes.php" class="nav_enlace_boton">Cancelar</a>
        </form>
    <?php else: ?>
        <!-- Si no se encontró el usuario, se muestra un mensaje -->
        <p>Usuario no encontrado.</p>
    <?php endif; ?>

    <!-- Mensaje de resultado del proceso (éxito o error) -->
    <p><?= $resultado ?></p>
</main>

<!-- Pie de página -->
<footer class="footer">
    <p class="pie_pagina">Puerto Broaster Britalia - Todos los Derechos Reservados 2025</p>
</footer>

</body>
</html>
