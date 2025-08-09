<?php
// Incluye la clase Rutas para obtener la URL base de la API
require_once "Rutas.php";

// Crea una instancia del objeto Rutas
$rutas = new Rutas();

// Construye la URL para obtener la lista de usuarios desde la API
$url = $rutas->dameUrlBase() . "/Servidor/TareasAPI.php?action=usuarios";

// Inicializa cURL para hacer la petición a la API
$ch = curl_init();

// Establece la URL que se va a solicitar
curl_setopt($ch, CURLOPT_URL, $url);

// Indica que se debe devolver la respuesta como string (no imprimirla directamente)
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Ejecuta la petición y guarda la respuesta JSON en una variable
$response = curl_exec($ch);

// Cierra la sesión cURL
curl_close($ch);

// Decodifica la respuesta JSON a un objeto PHP
$usuarios = json_decode($response);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> <!-- Define la codificación de caracteres como UTF-8 -->
    <title>Lista de Usuarios</title> <!-- Título de la pestaña del navegador -->

    <!-- Fuente Montserrat desde Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">

    <!-- Enlace a la hoja de estilos CSS personalizada -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- Encabezado de la página -->
<header>
    <!-- Enlace que lleva a la página de bienvenida -->
    <a href="bienvenida.php" class="Encalezado-logo">
        <!-- Logo del restaurante -->
        <img class="logo" src="/RestauranteCrudPHP/Cliente/img/Presentación1.png" alt="Logo del restaurante" />

        <!-- Título del restaurante -->
        <h1 class="titulo">Puerto Broaster Britalia</h1>
    </a>
</header>

<!-- Contenedor principal del contenido -->
<main class="contacto-contenedor">

    <!-- Encabezado de la tabla con botón para agregar nuevo cliente -->
    <div class="contenedor-tabla-header">
        <h2 class="texto-bienvenida">Lista de Clientes Registrados</h2>

        <!-- Enlace para registrar un nuevo cliente -->
        <a href="nuevo.php" class="nav_enlace_boton">Registrar nuevo cliente</a>
    </div>

    <!-- Verifica si la variable $usuarios contiene datos -->
    <?php if (!empty($usuarios)) : ?>
        <!-- Contenedor con desplazamiento horizontal para la tabla -->
        <div class="tabla-scroll">
            <!-- Tabla que muestra la información de los clientes -->
            <table class="tabla-clientes">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tipo</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Cédula</th>
                        <th>Email</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Recorre cada usuario y muestra sus datos en filas de la tabla -->
                    <?php foreach ($usuarios as $u): ?>
                    <tr>
                        <!-- Se imprime cada dato del usuario con htmlspecialchars para evitar inyecciones HTML -->
                        <td><?= htmlspecialchars($u->Id_usuario) ?></td>
                        <td><?= htmlspecialchars($u->tipo) ?></td>
                        <td><?= htmlspecialchars($u->Nombre) ?></td>
                        <td><?= htmlspecialchars($u->Apellido) ?></td>
                        <td><?= htmlspecialchars($u->Direccion) ?></td>
                        <td><?= htmlspecialchars($u->Telefono) ?></td>
                        <td><?= htmlspecialchars($u->Cedula) ?></td>
                        <td><?= htmlspecialchars($u->Email) ?></td>
                        <td>
                            <!-- Botón para editar el cliente, pasando el ID como parámetro -->
                            <a href="editar.php?id=<?= urlencode($u->Id_usuario) ?>" class="nav_enlace_boton_editar">Editar</a>

                            <!-- Botón para eliminar el cliente con confirmación, pasando el ID como parámetro -->
                            <a href="eliminar.php?id=<?= urlencode($u->Id_usuario) ?>" class="nav_enlace_boton_eliminar" onclick="return confirm('¿Seguro que deseas eliminar este usuario?')">Eliminar</a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <!-- Mensaje que se muestra si no hay usuarios registrados -->
        <p>No hay usuarios registrados.</p>
    <?php endif; ?>

</main>

<!-- Pie de página -->
<footer class="footer">
    <p class="pie_pagina">Puerto Broaster Britalia - Todos los Derechos Reservados 2025</p>
</footer>

</body>
</html>
