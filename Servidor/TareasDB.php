<?php

// Se define la clase TareasDB, responsable de todas las operaciones con la base de datos.
class TareasDB {

    // Propiedad protegida que almacenará el objeto de conexión MySQLi.
    protected $mysqli;

    // Constantes para los parámetros de conexión a la base de datos.
    const LOCALHOST = 'localhost'; 
    const USER = 'root';
    const PASSWORD = ''; 
    const DATABASE = 'restaurante';

    // Constructor: establece la conexión con la base de datos usando MySQLi.
    public function __construct() {
        try {
            $this->mysqli = new mysqli(self::LOCALHOST, self::USER, self::PASSWORD, self::DATABASE);
            if ($this->mysqli->connect_error) {
                throw new Exception("Error de conexión: " . $this->mysqli->connect_error);
            }
        } catch (Exception $e) {
            http_response_code(500); // En caso de error, se responde con código 500.
            exit; // Se detiene la ejecución.
        }
    }

    // Retorna un usuario específico según su ID.
    public function dameUnoPorId($id) {
        $stmt = $this->mysqli->prepare("SELECT * FROM usuario WHERE Id_usuario=?");
        $stmt->bind_param('i', $id); // Se vincula el parámetro como entero.
        $stmt->execute(); // Se ejecuta la consulta.
        $result = $stmt->get_result(); // Se obtiene el resultado.
        $usuario = $result->fetch_all(MYSQLI_ASSOC); // Se convierte el resultado en arreglo asociativo.
        $stmt->close(); // Se cierra la consulta preparada.
        return $usuario; // Se retorna el resultado.
    }

    // Retorna una lista de todos los usuarios, incluyendo su tipo (relación con tabla tipo_usuario).
    public function dameLista() {
        $result = $this->mysqli->query("SELECT u.*, t.tipo FROM usuario u INNER JOIN tipo_usuario t ON u.Id_tipo_usuario = t.Id_tipo_usuario");
        $usuarios = $result->fetch_all(MYSQLI_ASSOC); // Se transforma en arreglo asociativo.
        $result->close(); // Se cierra el resultado.
        return $usuarios;
    }

    // Guarda un nuevo usuario en la base de datos.
    public function guarda($datos) {
        $stmt = $this->mysqli->prepare("INSERT INTO usuario (Id_tipo_usuario, Nombre, Apellido, Direccion, Telefono, Cedula, Email, Password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param(
            'isssssss',
            $datos->Id_tipo_usuario,
            $datos->Nombre,
            $datos->Apellido,
            $datos->Direccion,
            $datos->Telefono,
            $datos->Cedula,
            $datos->Email,
            $datos->Password
        );
        $r = $stmt->execute(); // Se ejecuta la consulta.
        $stmt->close(); // Se cierra la consulta.
        return $r; // Se retorna true o false dependiendo del resultado.
    }

    // Elimina un usuario por su ID.
    public function elimina($id) {
        $stmt = $this->mysqli->prepare("DELETE FROM usuario WHERE Id_usuario = ?");
        $stmt->bind_param('i', $id); // Se vincula el ID como entero.
        $r = $stmt->execute(); // Se ejecuta la eliminación.
        $stmt->close(); // Se cierra la consulta.
        return $r;
    }

    // Actualiza los datos de un usuario existente.
    public function actualiza($id, $datos) {
        if ($this->verificaExistenciaPorId($id)) { // Se verifica que el usuario exista.
            $stmt = $this->mysqli->prepare("UPDATE usuario SET Id_tipo_usuario=?, Nombre=?, Apellido=?, Direccion=?, Telefono=?, Cedula=?, Email=?, Password=? WHERE Id_usuario=?");
            $stmt->bind_param(
                'isssssssi',
                $datos->Id_tipo_usuario,
                $datos->Nombre,
                $datos->Apellido,
                $datos->Direccion,
                $datos->Telefono,
                $datos->Cedula,
                $datos->Email,
                $datos->Password,
                $id
            );
            $r = $stmt->execute(); // Se ejecuta la actualización.
            $stmt->close();
            return $r;
        }
        return false; // Si no existe el usuario, retorna false.
    }

    // Verifica si un usuario existe por su ID.
    public function verificaExistenciaPorId($id) {
        $stmt = $this->mysqli->prepare("SELECT 1 FROM usuario WHERE Id_usuario=?");
        $stmt->bind_param("i", $id); // Se vincula el ID como entero.
        $stmt->execute(); // Se ejecuta la consulta.
        $stmt->store_result(); // Se almacenan los resultados para revisar si hay filas.
        $exists = $stmt->num_rows > 0; // Devuelve true si hay al menos una fila.
        $stmt->close();
        return $exists;
    }
}
?>
