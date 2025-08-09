<?php

// Incluye el archivo que maneja la conexión y operaciones con la base de datos
require_once "TareasDB.php";

// Clase principal que define la API REST
class TareasAPI {

    // Método principal que detecta y gestiona la petición HTTP
    public function API() {
        header('Content-Type: application/json'); // Define que la respuesta será en formato JSON
        $method = $_SERVER['REQUEST_METHOD'];     // Detecta el método HTTP (GET, POST, PUT, DELETE)

        // Según el método HTTP, llama al método correspondiente
        switch ($method) {
            case 'GET':
                $this->procesaListar();
                break;
            case 'POST':
                $this->procesaGuardar();
                break;
            case 'PUT':
                $this->procesaActualizar();
                break;
            case 'DELETE':
                $this->procesaEliminar();
                break;
            default:
                // Si el método HTTP no está permitido, responde con error 405
                $this->response(405, "error", "Método no permitido");
                break;
        }
    }

    // Método genérico para enviar una respuesta con código, estado y mensaje
    function response($code, $status, $message) {
        http_response_code($code); // Establece el código HTTP de respuesta
        echo json_encode([
            "status" => $status,
            "message" => $message
        ], JSON_PRETTY_PRINT); // Imprime respuesta en formato JSON legible
    }

    // Maneja peticiones GET: lista usuarios o uno solo si se pasa ID
    function procesaListar() {
        if ($_GET['action'] == 'usuarios') {
            $db = new TareasDB();
            if (isset($_GET['id'])) {
                $respuesta = $db->dameUnoPorId($_GET['id']); // Busca un solo usuario por ID
                echo json_encode($respuesta, JSON_PRETTY_PRINT);
            } else {
                $respuesta = $db->dameLista(); // Lista todos los usuarios
                echo json_encode($respuesta, JSON_PRETTY_PRINT);
            }
        } else {
            $this->response(400, "error", "Acción no válida");
        }
    }

    // Maneja peticiones POST: agrega un nuevo usuario
    function procesaGuardar() {
        if ($_GET['action'] == 'usuarios') {
            $obj = json_decode(file_get_contents('php://input')); // Lee y decodifica JSON recibido
            // Valida que los datos mínimos requeridos estén presentes
            if (!$obj || !isset($obj->Nombre) || !isset($obj->Email) || !isset($obj->Password)) {
                $this->response(422, "error", "Datos incompletos o incorrectos");
                return;
            }
            $db = new TareasDB();
            $db->guarda($obj); // Llama al método que guarda el usuario
            $this->response(201, "success", "Usuario agregado");
        } else {
            $this->response(400, "error", "Acción no válida");
        }
    }

    // Maneja peticiones PUT: actualiza los datos de un usuario
    function procesaActualizar() {
        if ($_GET['action'] == 'usuarios' && isset($_GET['id'])) {
            $obj = json_decode(file_get_contents('php://input')); // Lee el JSON enviado
            if (!$obj || !isset($obj->Nombre)) {
                $this->response(422, "error", "Datos incompletos o incorrectos");
                return;
            }
            $db = new TareasDB();
            $db->actualiza($_GET['id'], $obj); // Actualiza usuario con los nuevos datos
            $this->response(200, "success", "Usuario actualizado");
        } else {
            $this->response(400, "error", "Acción no válida");
        }
    }

    // Maneja peticiones DELETE: elimina un usuario por ID
    function procesaEliminar() {
        if ($_GET['action'] == 'usuarios' && isset($_GET['id'])) {
            $db = new TareasDB();
            $db->elimina($_GET['id']); // Elimina el usuario de la base de datos
            $this->response(200, "success", "Usuario eliminado");
        } else {
            $this->response(400, "error", "Acción no válida");
        }
    }
}

// Crea una instancia de la API y la ejecuta
$api = new TareasAPI();
$api->API();
