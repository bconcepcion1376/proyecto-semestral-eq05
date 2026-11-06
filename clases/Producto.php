<?php
defined('APP_ACCESO') or exit('Acceso denegado');

class Producto {
    private $nombre;
    private $precio;

    public function __construct($nombre, $precio) {
        $this->setNombre($nombre);
        $this->setPrecio($precio);
    }

    public function getNombre() { return $this->nombre; }
    public function getPrecio() { return $this->precio; }

    public function setNombre($nombre) {
        if (empty(trim($nombre))) {
            throw new Exception("El nombre del producto es obligatorio.");
        }
        $this->nombre = trim($nombre);
    }

    public function setPrecio($precio) {
        if (!is_numeric($precio) || $precio < 0) {
            throw new Exception("El precio debe ser un número válido mayor o igual a cero.");
        }
        $this->precio = floatval($precio);
    }
}