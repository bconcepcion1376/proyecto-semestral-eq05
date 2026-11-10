<?php
defined('APP_ACCESO') or exit('Acceso denegado');

/*
 * Validador: revisa los datos que llegan de un formulario y guarda los errores.
 * Cada método recibe el nombre del campo, su valor y, si hace falta, la regla.
 */
class Validador {
    // Errores encontrados: campo => mensaje (uno por campo)
    private $errores;

    public function __construct() {
        $this->errores = [];
    }

    // Guarda el error de un campo, solo si ese campo todavía no tiene uno
    private function agregarError($campo, $mensaje) {
        if (!isset($this->errores[$campo])) {
            $this->errores[$campo] = $mensaje;
        }
    }

    // true si se encontró al menos un error
    public function hayErrores() {
        return count($this->errores) > 0;
    }

    // Devuelve todos los errores (campo => mensaje)
    public function getErrores() {
        return $this->errores;
    }

    
    // 1. El campo no puede quedar vacío (solo espacios cuenta como vacío)
    public function requerido($campo, $valor, $etiqueta) {
        if (trim($valor) === '') {
            $this->agregarError($campo, "El campo $etiqueta es obligatorio.");
        }
    }

    // 2. Cantidad de caracteres entre $min y $max
    public function longitud($campo, $valor, $etiqueta, $min, $max) {
        if ($valor === '') {
            return;
        }
        $largo = mb_strlen($valor);
        if ($largo < $min || $largo > $max) {
            $this->agregarError($campo, "El campo $etiqueta debe tener entre $min y $max caracteres.");
        }
    }

    // 3. Formato de correo electrónico
    public function correo($campo, $valor, $etiqueta) {
        if ($valor === '') {
            return;
        }
        if (filter_var($valor, FILTER_VALIDATE_EMAIL) === false) {
            $this->agregarError($campo, "El campo $etiqueta no tiene un correo válido.");
        }
    }

    // 4. El valor debe estar en la lista de permitidos (select, radio y checkbox)
    public function enLista($campo, $valor, $etiqueta, $permitidos) {
        if ($valor === '') {
            return;
        }
        if (!in_array($valor, $permitidos, true)) {
            $this->agregarError($campo, "El valor elegido en $etiqueta no es válido.");
        }
    }

    // 5. Fecha AAAA-MM-DD que exista en el calendario y esté entre $min y $max
    public function fecha($campo, $valor, $etiqueta, $min, $max) {
        if ($valor === '') {
            return;
        }
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $valor)) {
            $this->agregarError($campo, "El campo $etiqueta no tiene una fecha válida.");
            return;
        }
        $partes = explode('-', $valor);
        if (!checkdate((int) $partes[1], (int) $partes[2], (int) $partes[0])) {
            $this->agregarError($campo, "El campo $etiqueta no tiene una fecha válida.");
            return;
        }
        if ($valor < $min || $valor > $max) {
            $this->agregarError($campo, "El campo $etiqueta debe estar entre " . formatear_fecha($min) . " y " . formatear_fecha($max) . ".");
        }
    }

    // 6. Número entre $min y $max
    public function rango($campo, $valor, $etiqueta, $min, $max) {
        if ($valor === '') {
            return;
        }
        if (!is_numeric($valor) || $valor < $min || $valor > $max) {
            $this->agregarError($campo, "El campo $etiqueta debe ser un número entre $min y $max.");
        }
    }

    // 7. Hora en formato HH:MM (de 00:00 a 23:59)
    public function hora($campo, $valor, $etiqueta) {
        if ($valor === '') {
            return;
        }
        if (!preg_match('/^([01]\d|2[0-3]):[0-5]\d$/', $valor)) {
            $this->agregarError($campo, "El campo $etiqueta no tiene una hora válida.");
        }
    }
}