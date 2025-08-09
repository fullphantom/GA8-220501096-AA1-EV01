<?php

// Se define la clase Rutas para gestionar las direcciones del proyecto
class Rutas {

    // Propiedad protegida que contiene la URL base del proyecto
    protected $urlBase = "http://localhost/RestauranteCrudPHP";

    // Constructor de la clase (vacío por ahora, pero puede ser útil para futuras inicializaciones)
    public function __construct() {
        // Constructor vacío
    }

    // Devuelve la URL base, eliminando una posible barra final para mantener consistencia
    public function dameUrlBase() {
        return rtrim($this->urlBase, '/');
    }

    // Devuelve un enlace HTML al listado principal de clientes (datos_clientes.php)
    public function dameMenuInicio() {
        return '<a href="' . $this->dameUrlBase() . '/Cliente/datos_clientes.php">Inicio</a>';
    }

    // Devuelve un enlace HTML al formulario para registrar un nuevo usuario (nuevo.php)
    public function dameMenuNuevo() {
        return '<a href="' . $this->dameUrlBase() . '/Cliente/nuevo.php">Nuevo Usuario</a>';
    }

    // Devuelve un enlace HTML al formulario de modificación de un usuario, usando su ID como parámetro
    public function dameMenuModificar($id_usuario) {
        return '<a href="' . $this->dameUrlBase() . '/Cliente/modificar.php?Id_usuario=' . urlencode($id_usuario) . '">Modificar</a>';
    }

    // Devuelve un enlace HTML para eliminar un usuario, pasando el ID como parámetro
    public function dameMenuEliminar($id_usuario) {
        return '<a href="' . $this->dameUrlBase() . '/Cliente/eliminar.php?Id_usuario=' . urlencode($id_usuario) . '">Eliminar</a>';
    }
}

?>
