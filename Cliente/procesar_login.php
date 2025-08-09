<?php
session_start(); 
// Inicia una sesión para poder guardar información del usuario una vez que inicie sesión

require_once "Rutas.php";
// Incluye el archivo 'Rutas.php' que contiene la clase Rutas

$rutas = new Rutas();
// Crea una instancia de la clase Rutas para obtener la URL base de la API

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica que el método de la solicitud sea POST (desde el formulario)

    $email = $_POST['email'];
    // Obtiene el correo electrónico ingresado por el usuario

    $password = $_POST['password'];
    // Obtiene la contraseña ingresada por el usuario

    $tipo = $_POST['tipo']; // 'cliente' o 'administrador'
    // Obtiene el tipo de usuario (viene desde un campo oculto del formulario)

    // Obtener usuarios desde la API
    $url = $rutas->dameUrlBase() . "/Servidor/TareasAPI.php?action=usuarios";
    // Construye la URL para consultar los usuarios desde la API

    $ch = curl_init($url);
    // Inicializa una sesión cURL con la URL anterior

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // Indica que se quiere obtener la respuesta como un string

    $response = curl_exec($ch);
    // Ejecuta la solicitud cURL y guarda la respuesta

    curl_close($ch);
    // Cierra la sesión cURL

    $usuarios = json_decode($response);
    // Decodifica el JSON recibido desde la API y lo convierte en un array de objetos PHP

    foreach ($usuarios as $usuario) {
        // Recorre cada usuario recibido desde la API

        if ($usuario->Email === $email && $usuario->Password === $password) {
            // Verifica si el email y contraseña ingresados coinciden con los de un usuario

            // Validar tipo y redirigir correctamente
            if ($tipo === 'administrador' && $usuario->Id_tipo_usuario == 1) {
                // Si es administrador (tipo 1), guarda el usuario en la sesión y redirige a datos_clientes.php

                $_SESSION['usuario'] = $usuario;
                // Guarda la información del usuario en la sesión

                header("Location: datos_clientes.php");
                // Redirige a la página de datos de clientes

                exit;
                // Finaliza la ejecución del script
            } elseif ($tipo === 'cliente' && $usuario->Id_tipo_usuario == 3) {
                // Si es cliente (tipo 3), guarda el usuario en la sesión y redirige a menu.php

                $_SESSION['usuario'] = $usuario;
                // Guarda la información del usuario en la sesión

                header("Location: menu.php");
                // Redirige a la página del menú del cliente

                exit;
                // Finaliza la ejecución del script
            }
        }
    }

    // Si no se encontró un usuario válido
    echo "<script>alert('Credenciales incorrectas o tipo de usuario no válido');window.location='login.php?tipo=$tipo';</script>";
    // Muestra un mensaje de error con JavaScript y redirige nuevamente al formulario de login
}
?>
