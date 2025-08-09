<?php
require_once "Rutas.php";

$rutas = new Rutas();
$resultado = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

    $json = json_encode($data);
    $url = $rutas->dameUrlBase() . "/Servidor/TareasAPI.php?action=usuarios";

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    $result = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode === 200) {
        header("Location: datos_clientes.php");
        exit;
    } else {
        $resultado = "Error al guardar el nuevo usuario.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Usuario</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <a href="bienvenida.php" class="Encalezado-logo">
        <img class="logo" src="/RestauranteCrudPHP/Cliente/img/Presentación1.png" alt="Logo del restaurante" />
        <h1 class="titulo">Puerto Broaster Britalia</h1>
    </a>
</header>

<main class="contacto-contenedor">
    <h2 class="texto-bienvenida">Registrar Nuevo Cliente</h2>

    <form method="post" class="formulario">
        <label>ID Tipo Usuario:</label>
        <select name="Id_tipo_usuario" required>
            <option value="">Seleccione una opción</option>
            <option value="1">Administrador</option>
            <option value="2">Empleado</option>
            <option value="3">Cliente</option>
        </select>

        <label>Nombre:</label>
        <input type="text" name="Nombre" required>

        <label>Apellido:</label>
        <input type="text" name="Apellido" required>

        <label>Dirección:</label>
        <input type="text" name="Direccion" required>

        <label>Teléfono:</label>
        <input type="text" name="Telefono" required>

        <label>Cédula:</label>
        <input type="text" name="Cedula" required>

        <label>Email:</label>
        <input type="email" name="Email" required>

        <label>Contraseña:</label>
        <input type="password" name="Password" required>

        <br>
        <input type="submit" class="nav_enlace_boton" value="Registrar">
        <a href="datos_clientes.php" class="nav_enlace_boton">Cancelar</a>
    </form>

    <p><?= $resultado ?></p>
</main>

<footer class="footer">
    <p class="pie_pagina">Puerto Broaster Britalia - Todos los Derechos Reservados 2025</p>
</footer>

</body>
</html>
