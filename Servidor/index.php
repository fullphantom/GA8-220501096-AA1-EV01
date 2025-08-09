<?php 
// Se incluye el archivo que contiene la clase TareasAPI (el controlador principal de la API).
require_once "TareasAPI.php";

// Se crea una instancia de la clase TareasAPI.
$tareasAPI = new TareasAPI();

// Se llama al método API(), que gestiona la petición HTTP recibida (GET, POST, PUT o DELETE).
$tareasAPI->API();
?>
